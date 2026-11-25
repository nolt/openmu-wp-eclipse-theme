/*
 * OpenMU Eclipse - the animated scene (vanilla, deferred, no libraries).
 *
 * For every [data-oe-scene] element (the hero scene and the fixed ambient background):
 * - draws drifting embers / magic dust on its <canvas>;
 * - for the hero only: parallax of the layers from the pointer and from scrolling, by
 *   setting the CSS variables --px, --py (pointer, -1..1) and --sy (scroll in px) that
 *   scene.css turns into per-layer movement.
 *
 * Cost control, because this runs on phones too:
 * - few particles (scaled by area, halved on small screens), drawn from a pre-rendered
 *   sprite instead of per-frame gradients, device pixel ratio capped at 1.5;
 * - a scene only animates while it is on screen, and nothing animates in a hidden tab;
 * - the ambient layer sleeps while the hero covers the screen (nobody sees it);
 * - prefers-reduced-motion: no animation and no particles at all (CSS shows a static scene).
 */
(function () {
	'use strict';

	var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	if (reduced) { return; }

	var scenes = Array.prototype.slice.call(document.querySelectorAll('[data-oe-scene]'));
	if (!scenes.length) { return; }

	var DPR = Math.min(window.devicePixelRatio || 1, 1.5);
	var hero = document.querySelector('[data-oe-scene="hero"]');
	var heroCovers = false; // true while the hero fills the viewport

	/* Colour sprites: a soft glowing dot, pre-rendered once per colour (RGB triplets). */
	var COLORS = [[255, 196, 96], [255, 150, 60], [255, 106, 61], [245, 212, 138], [95, 212, 255]];
	var WEIGHTS = [0.34, 0.26, 0.18, 0.14, 0.08]; // arcane cyan stays rare
	var sprites = COLORS.map(function (c) {
		var s = document.createElement('canvas');
		s.width = s.height = 32;
		var g = s.getContext('2d');
		var grad = g.createRadialGradient(16, 16, 0, 16, 16, 16);
		grad.addColorStop(0, 'rgba(' + c.join(',') + ',1)');
		grad.addColorStop(0.25, 'rgba(' + c.join(',') + ',0.55)');
		grad.addColorStop(1, 'rgba(' + c.join(',') + ',0)');
		g.fillStyle = grad;
		g.fillRect(0, 0, 32, 32);
		return s;
	});

	/* Picks a sprite index by weight. */
	function pickColor() {
		var r = Math.random(), sum = 0;
		for (var i = 0; i < WEIGHTS.length; i++) { sum += WEIGHTS[i]; if (r <= sum) { return i; } }
		return 0;
	}

	/* One scene = canvas + particles + visibility state. */
	function Embers(root) {
		this.root = root;
		this.isHero = root.getAttribute('data-oe-scene') === 'hero';
		this.canvas = root.querySelector('[data-oe-embers]');
		if (!this.canvas) { return; }
		this.ctx = this.canvas.getContext('2d');
		this.parts = [];
		this.visible = true;
		this.raf = 0;
		this.last = 0;
		this.resize();
		var self = this;
		if ('ResizeObserver' in window) {
			var t;
			new ResizeObserver(function () { clearTimeout(t); t = setTimeout(function () { self.resize(); }, 150); }).observe(root);
		}
		if ('IntersectionObserver' in window) {
			new IntersectionObserver(function (entries) {
				self.visible = entries[0].isIntersecting;
				if (self.isHero) { heroCovers = entries[0].intersectionRatio > 0.85; }
				self.kick();
			}, { threshold: [0, 0.85, 1] }).observe(root);
		}
	}

	/* Sizes the canvas to the scene and refills the particles for the new area. */
	Embers.prototype.resize = function () {
		var r = this.root.getBoundingClientRect();
		this.w = Math.max(1, Math.round(r.width));
		this.h = Math.max(1, Math.round(r.height));
		this.canvas.width = Math.round(this.w * DPR);
		this.canvas.height = Math.round(this.h * DPR);
		var small = this.w < 700 ? 0.5 : 1;
		var perArea = this.isHero ? 1 / 16000 : 1 / 42000;
		var count = Math.round(Math.min(this.isHero ? 80 : 40, this.w * this.h * perArea) * small);
		while (this.parts.length < count) { this.parts.push(this.spawn(true)); }
		this.parts.length = count;
		this.draw();
	};

	/* Creates a particle; at start they are spread over the whole height, later they enter at the bottom. */
	Embers.prototype.spawn = function (anywhere) {
		var size = 0.8 + Math.random() * Math.random() * 3.2; // mostly small, a few big
		return {
			x: Math.random() * this.w,
			y: anywhere ? Math.random() * this.h : this.h + 10,
			s: size,
			vy: -(6 + Math.random() * 18) * (0.6 + size / 4), // px per second, upwards
			sway: 8 + Math.random() * 22,
			freq: 0.3 + Math.random() * 0.9,
			phase: Math.random() * 6.283,
			tw: 1 + Math.random() * 2.5, // twinkle speed
			c: pickColor()
		};
	};

	/* Draws one frame of all particles (additive blending makes them glow where they overlap). */
	Embers.prototype.draw = function (t) {
		var ctx = this.ctx;
		ctx.setTransform(DPR, 0, 0, DPR, 0, 0);
		ctx.clearRect(0, 0, this.w, this.h);
		ctx.globalCompositeOperation = 'lighter';
		var sec = (t || 0) / 1000;
		for (var i = 0; i < this.parts.length; i++) {
			var p = this.parts[i];
			var fade = Math.min(1, Math.max(0, p.y / (this.h * 0.2))) * Math.min(1, Math.max(0, (this.h - p.y) / 30)); // fade out near the top, fade in at the bottom
			var a = (0.35 + 0.65 * Math.abs(Math.sin(sec * p.tw + p.phase))) * fade;
			var d = p.s * 7;
			ctx.globalAlpha = Math.max(0, Math.min(1, a));
			ctx.drawImage(sprites[p.c], p.x + Math.sin(sec * p.freq + p.phase) * p.sway - d / 2, p.y - d / 2, d, d);
		}
		ctx.globalAlpha = 1;
	};

	/* Advances the particles by dt seconds. */
	Embers.prototype.step = function (dt) {
		for (var i = 0; i < this.parts.length; i++) {
			var p = this.parts[i];
			p.y += p.vy * dt;
			if (p.y < -10) { this.parts[i] = this.spawn(false); }
		}
	};

	/* Whether this scene should be animating right now. */
	Embers.prototype.active = function () {
		if (document.hidden || !this.visible) { return false; }
		return this.isHero || !heroCovers;
	};

	/* Starts the animation loop if it should run and is not running. */
	Embers.prototype.kick = function () {
		if (this.raf || !this.active() || !this.canvas) { return; }
		this.last = 0;
		var self = this;
		var loop = function (t) {
			self.raf = 0;
			if (!self.active()) { return; }
			var dt = self.last ? Math.min(0.05, (t - self.last) / 1000) : 0;
			self.last = t;
			self.step(dt);
			self.draw(t);
			self.raf = window.requestAnimationFrame(loop);
		};
		this.raf = window.requestAnimationFrame(loop);
	};

	var all = scenes.map(function (el) { return new Embers(el); });
	document.addEventListener('visibilitychange', function () { all.forEach(function (e) { if (e.canvas) { e.kick(); } }); });
	// The ambient layer wakes up when the hero leaves the screen.
	window.setInterval(function () { all.forEach(function (e) { if (e.canvas) { e.kick(); } }); }, 1000);

	/* Parallax (hero only): pointer sets --px/--py, scroll sets --sy; one rAF write per frame. */
	if (hero) {
		var px = 0, py = 0, sy = 0, queued = false;
		var write = function () {
			hero.style.setProperty('--px', px.toFixed(3));
			hero.style.setProperty('--py', py.toFixed(3));
			hero.style.setProperty('--sy', sy.toFixed(0));
			queued = false;
		};
		var queue = function () { if (!queued) { queued = true; window.requestAnimationFrame(write); } };
		window.addEventListener('scroll', function () { sy = Math.min(window.scrollY, window.innerHeight * 1.2); queue(); }, { passive: true });
		window.addEventListener('pointermove', function (e) {
			if (e.pointerType === 'touch') { return; }
			px = (e.clientX / window.innerWidth - 0.5) * 2;
			py = (e.clientY / window.innerHeight - 0.5) * 2;
			queue();
		}, { passive: true });
	}
})();
