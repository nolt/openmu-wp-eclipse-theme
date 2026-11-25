/*
 * OpenMU Eclipse - class showcase switcher (vanilla, deferred).
 *
 * Works on <section data-oe-showcase> rendered by blocks/class-showcase: clicking a tab,
 * pressing Left/Right/Home/End on it, or swiping the stage shows that class's figure and
 * panel. Tabs follow the ARIA tabs pattern (roving tabindex).
 */
(function () {
	'use strict';

	document.querySelectorAll('[data-oe-showcase]').forEach(function (root) {
		var tabs = Array.prototype.slice.call(root.querySelectorAll('.oe-class-tab'));
		if (!tabs.length) { return; }

		/* Shows one class: toggles .is-active on its tab, figure and panel. */
		function show(slug, focus) {
			tabs.forEach(function (tab) {
				var on = tab.getAttribute('data-class') === slug;
				tab.classList.toggle('is-active', on);
				tab.setAttribute('aria-selected', on ? 'true' : 'false');
				tab.tabIndex = on ? 0 : -1;
				if (on && focus) { tab.focus(); }
			});
			root.querySelectorAll('.oe-classes__figure, .oe-classes__panel').forEach(function (el) {
				el.classList.toggle('is-active', el.getAttribute('data-class') === slug);
			});
		}

		/* Index of the active tab, moved by a step with wrap-around. */
		function step(delta, focus) {
			var i = tabs.findIndex(function (t) { return t.classList.contains('is-active'); });
			show(tabs[(i + delta + tabs.length) % tabs.length].getAttribute('data-class'), focus);
		}

		tabs.forEach(function (tab) {
			tab.addEventListener('click', function () { show(tab.getAttribute('data-class'), false); });
			tab.addEventListener('keydown', function (e) {
				if (e.key === 'ArrowRight' || e.key === 'ArrowDown') { e.preventDefault(); step(1, true); }
				else if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') { e.preventDefault(); step(-1, true); }
				else if (e.key === 'Home') { e.preventDefault(); show(tabs[0].getAttribute('data-class'), true); }
				else if (e.key === 'End') { e.preventDefault(); show(tabs[tabs.length - 1].getAttribute('data-class'), true); }
			});
		});

		/* Swipe on the stage (touch): a horizontal move over 40 px switches class. */
		var stage = root.querySelector('.oe-classes__stage');
		var startX = null;
		if (stage) {
			stage.addEventListener('touchstart', function (e) { startX = e.touches[0].clientX; }, { passive: true });
			stage.addEventListener('touchend', function (e) {
				if (startX === null) { return; }
				var dx = e.changedTouches[0].clientX - startX;
				startX = null;
				if (Math.abs(dx) > 40) { step(dx < 0 ? 1 : -1, false); }
			}, { passive: true });
		}
	});
})();
