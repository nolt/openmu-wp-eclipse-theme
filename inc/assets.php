<?php
/**
 * Stylesheets, scripts and the site-wide ambient background.
 *
 * Everything is local (no CDN, no external fonts). Scripts are small, vanilla and deferred.
 *
 * @package OpenMU_Eclipse
 */

defined( 'ABSPATH' ) || exit;

/**
 * Enqueues the front-end CSS and JS.
 *
 * The plugin stylesheet depends on the plugin's own handles when they exist, so the theme
 * rules come after them and win on equal specificity.
 */
function openmu_eclipse_enqueue_assets(): void {
	$uri = get_theme_file_uri( 'assets/' );
	$ver = OPENMU_ECLIPSE_VERSION;

	wp_enqueue_style( 'openmu-eclipse', $uri . 'css/theme.css', array(), $ver );
	wp_enqueue_style( 'openmu-eclipse-scene', $uri . 'css/scene.css', array( 'openmu-eclipse' ), $ver );
	wp_enqueue_style( 'openmu-eclipse-plugin', $uri . 'css/plugin.css', array( 'openmu-eclipse' ), $ver );

	// Deferred in the footer: nothing here blocks rendering.
	$args = array(
		'strategy'  => 'defer',
		'in_footer' => true,
	);
	wp_enqueue_script( 'openmu-eclipse-nav', $uri . 'js/nav.js', array(), $ver, $args );
	wp_enqueue_script( 'openmu-eclipse-scene', $uri . 'js/scene.js', array(), $ver, $args );
	wp_enqueue_script( 'openmu-eclipse-showcase', $uri . 'js/showcase.js', array(), $ver, $args );
}
add_action( 'wp_enqueue_scripts', 'openmu_eclipse_enqueue_assets' );

/**
 * Preloads the two bundled fonts so the heading and body text do not flash.
 */
function openmu_eclipse_preload_fonts(): void {
	foreach ( array( 'cinzel', 'inter' ) as $font ) {
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
			esc_url( get_theme_file_uri( 'assets/fonts/' . $font . '.woff2' ) )
		);
	}
}
add_action( 'wp_head', 'openmu_eclipse_preload_fonts', 1 );

/**
 * Adds the "oe-js" class to <html> so CSS can tell visitors with JavaScript from those without.
 *
 * Printed inline and first so that "no-js" fallbacks (all showcase panels, open menu list)
 * apply only to visitors without scripts. Printed through core, so a Content Security Policy
 * plugin can add its nonce. Fail-safe: when the menu script (nav.js, which adds "oe-ready")
 * has not started after four seconds (blocked, failed to load), the class goes again and the
 * menu falls back to its plain list of links instead of a button that does nothing.
 */
function openmu_eclipse_js_class(): void {
	wp_print_inline_script_tag( "(function(d){d.classList.add('oe-js');setTimeout(function(){if(!d.classList.contains('oe-ready')){d.classList.remove('oe-js');}},4000);})(document.documentElement);" );
}
add_action( 'wp_head', 'openmu_eclipse_js_class', 0 );

/**
 * Prints the calm site-wide ambient background right after <body> opens.
 *
 * It is a fixed layer behind the whole page (see assets/css/scene.css); the home page's
 * hero brings its own, stronger scene on top of it.
 */
function openmu_eclipse_ambient(): void {
	echo openmu_eclipse_render_scene( 'ambient' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped while built.
}
add_action( 'wp_body_open', 'openmu_eclipse_ambient' );
