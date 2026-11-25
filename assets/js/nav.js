/*
 * OpenMU Eclipse - header behaviour (vanilla, deferred).
 *
 * What it does:
 * 1. Makes the sticky header compact once the page is scrolled (class "is-compact").
 * 2. Opens/closes the full-screen menu on phones (button .oe-nav__toggle).
 * 3. Opens/closes the "Server" submenu by click, tap or keyboard (hover is pure CSS).
 * Without this script the menu is still a plain list of links (see theme.css, ".oe-js").
 */
(function () {
	'use strict';

	var header = document.querySelector('.oe-header');
	var nav = document.querySelector('[data-oe-nav]');

	/* 1. Compact header: toggled with one passive scroll listener, throttled by rAF. */
	if (header) {
		var ticking = false;
		var update = function () {
			header.classList.toggle('is-compact', window.scrollY > 40);
			ticking = false;
		};
		window.addEventListener('scroll', function () {
			if (!ticking) { ticking = true; window.requestAnimationFrame(update); }
		}, { passive: true });
		update();
	}

	if (!nav) { return; }

	var toggle = nav.querySelector('.oe-nav__toggle');
	var subToggles = nav.querySelectorAll('.oe-nav__sub-toggle');
	var phone = window.matchMedia('(max-width: 900px)');

	/* 2. Phone menu: open state lives on the nav (class + aria-expanded) and the page (no scroll). */
	function setMenu(open) {
		nav.classList.toggle('is-open', open);
		toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
		document.documentElement.classList.toggle('oe-nav-open', open);
		if (!open) { closeSubs(); }
	}

	/* 3. Submenus: close all, or all except one. */
	function closeSubs(except) {
		subToggles.forEach(function (btn) {
			if (btn === except) { return; }
			btn.setAttribute('aria-expanded', 'false');
			btn.parentNode.classList.remove('is-open');
		});
	}

	toggle.addEventListener('click', function () {
		setMenu(!nav.classList.contains('is-open'));
	});

	subToggles.forEach(function (btn) {
		btn.addEventListener('click', function () {
			var open = btn.getAttribute('aria-expanded') !== 'true';
			closeSubs(btn);
			btn.setAttribute('aria-expanded', open ? 'true' : 'false');
			btn.parentNode.classList.toggle('is-open', open);
		});
	});

	/* A click anywhere else closes the submenu; a link inside the phone menu closes the menu. */
	document.addEventListener('click', function (e) {
		if (!nav.contains(e.target)) { closeSubs(); }
		var link = e.target.closest ? e.target.closest('.oe-nav a') : null;
		if (link && nav.classList.contains('is-open')) { setMenu(false); }
	});

	/* Escape closes the submenu first, then the phone menu, and gives focus back. */
	document.addEventListener('keydown', function (e) {
		if (e.key !== 'Escape') { return; }
		var openSub = nav.querySelector('.oe-nav__sub-toggle[aria-expanded="true"]');
		if (openSub) { closeSubs(); openSub.focus(); return; }
		if (nav.classList.contains('is-open')) { setMenu(false); toggle.focus(); }
	});

	/* Leaving the phone layout (rotate, resize) must not leave the page locked. */
	var onChange = function () { if (!phone.matches) { setMenu(false); } };
	if (phone.addEventListener) { phone.addEventListener('change', onChange); } else { phone.addListener(onChange); }
})();
