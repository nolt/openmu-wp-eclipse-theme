<?php
/**
 * Sets the site up when OpenMU Eclipse is activated, so it works out of the box (pages, front page, posts page).
 *
 * On activation (after_switch_theme):
 * 1. The theme's pages are created (see openmu_eclipse_site_pages()), once per site: only the
 *    addresses that have no page yet get one. Existing pages are never changed, whatever
 *    their status, and a page the admin deleted later is not brought back by a new activation.
 * 2. Settings > Reading shows the "home" page as the front page and "news" as the posts
 *    page, but only while the site still shows its latest posts there (the default): a front
 *    page the admin chose stays. The previous setting is kept and restored when another
 *    theme is activated.
 *
 * Nothing is deleted: changes made in the site editor and pages from other themes stay.
 * WordPress runs this hook on the first request after the switch, which can be any visitor's;
 * the work is limited to the steps above and guarded against two requests running it at once.
 *
 * @package OpenMU_Eclipse
 */

defined( 'ABSPATH' ) || exit;

/**
 * Post meta key that marks a page the theme created; its value is the page's address.
 */
const OPENMU_ECLIPSE_PAGE_META = '_openmu_eclipse_page';

/**
 * Option with the Reading settings from before the activation, restored on deactivation.
 */
const OPENMU_ECLIPSE_READING_OPTION = 'openmu_eclipse_previous_reading';

/**
 * Option set once the theme's pages were created on this site, so later activations skip it.
 */
const OPENMU_ECLIPSE_PAGES_OPTION = 'openmu_eclipse_pages_created';

/**
 * Option used as a lock while the setup runs (its value is the start time).
 */
const OPENMU_ECLIPSE_LOCK_OPTION = 'openmu_eclipse_setup_lock';

/**
 * Returns the theme's pages: address => title, in menu order.
 *
 * The addresses are fixed: the header menu (inc/nav.php) and the page templates
 * (templates/page-<address>.html) find the pages by them. Titles are in the site language.
 *
 * @return array<string, string>
 */
function openmu_eclipse_site_pages(): array {
	return array(
		'home'       => __( 'Home', 'openmu-eclipse' ),
		'news'       => __( 'News', 'openmu-eclipse' ),
		'download'   => __( 'Download', 'openmu-eclipse' ),
		'ranking'    => __( 'Ranking', 'openmu-eclipse' ),
		'mini-games' => __( 'Mini games', 'openmu-eclipse' ),
		'armory'     => __( 'Armory', 'openmu-eclipse' ),
		'events'     => __( 'Events', 'openmu-eclipse' ),
		'commands'   => __( 'Commands', 'openmu-eclipse' ),
		'account'    => __( 'Account', 'openmu-eclipse' ),
	);
}

/**
 * Runs the whole setup; hooked to after_switch_theme.
 */
function openmu_eclipse_setup_site(): void {
	// add_option() fails when the row exists, so only one request at a time gets past here.
	// A lock older than five minutes is left over from a request that died and is taken over.
	if ( ! add_option( OPENMU_ECLIPSE_LOCK_OPTION, time(), '', false ) ) {
		if ( time() - (int) get_option( OPENMU_ECLIPSE_LOCK_OPTION ) < 5 * MINUTE_IN_SECONDS ) {
			return;
		}
		update_option( OPENMU_ECLIPSE_LOCK_OPTION, time(), false );
	}

	// Activation happens in wp-admin, where texts follow the admin's own language; the pages
	// are for visitors, so their titles use the site language.
	$switched = switch_to_locale( get_locale() );

	if ( ! get_option( OPENMU_ECLIPSE_PAGES_OPTION ) ) {
		openmu_eclipse_create_pages();
	}
	openmu_eclipse_set_reading();

	if ( $switched ) {
		restore_previous_locale();
	}
	delete_option( OPENMU_ECLIPSE_LOCK_OPTION );
}
add_action( 'after_switch_theme', 'openmu_eclipse_setup_site' );

/**
 * Creates the theme's pages whose addresses have no page yet. Existing pages stay as they are.
 *
 * The flag that stops later activations is set only when every page is in place, so a failed
 * insert is retried on the next activation.
 */
function openmu_eclipse_create_pages(): void {
	$order    = 0;
	$complete = true;

	foreach ( openmu_eclipse_site_pages() as $slug => $title ) {
		// Any status counts: a draft or private page at the address is the admin's choice.
		if ( ! get_page_by_path( $slug, OBJECT, 'page' ) ) {
			$id       = wp_insert_post(
				wp_slash(
					array(
						'post_type'    => 'page',
						'post_status'  => 'publish',
						'post_name'    => $slug,
						'post_title'   => $title,
						'post_content' => '',
						'menu_order'   => $order,
						'meta_input'   => array( OPENMU_ECLIPSE_PAGE_META => $slug ),
					)
				),
				true
			);
			$complete = $complete && ! is_wp_error( $id );
		}
		++$order;
	}

	if ( $complete ) {
		update_option( OPENMU_ECLIPSE_PAGES_OPTION, 1, false );
	}
}

/**
 * Shows the "home" page as the front page and "news" as the posts page.
 *
 * Only while the site shows its latest posts on the front page (WordPress's default, and what
 * openmu_eclipse_restore_reading() puts back), and only with both pages published. The settings
 * from before are stored once (a second activation must not store the theme's own).
 */
function openmu_eclipse_set_reading(): void {
	$home = openmu_eclipse_public_page( 'home' );
	$news = openmu_eclipse_public_page( 'news' );
	if ( ! $home || ! $news || 'posts' !== get_option( 'show_on_front' ) ) {
		return;
	}

	if ( false === get_option( OPENMU_ECLIPSE_READING_OPTION ) ) {
		add_option(
			OPENMU_ECLIPSE_READING_OPTION,
			array(
				'show_on_front'  => get_option( 'show_on_front' ),
				'page_on_front'  => (int) get_option( 'page_on_front' ),
				'page_for_posts' => (int) get_option( 'page_for_posts' ),
			),
			'',
			false
		);
	}

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $home->ID );
	update_option( 'page_for_posts', $news->ID );
}

/**
 * Restores the Reading settings from before the theme when another theme is activated.
 *
 * Runs while this theme is still loaded (switch_theme fires in the request that switches).
 * Settings the admin changed by hand in the meantime are left alone.
 */
function openmu_eclipse_restore_reading(): void {
	$previous = get_option( OPENMU_ECLIPSE_READING_OPTION );
	delete_option( OPENMU_ECLIPSE_READING_OPTION );
	if ( ! is_array( $previous ) ) {
		return;
	}

	$home = get_page_by_path( 'home', OBJECT, 'page' );
	if ( ! $home || (int) get_option( 'page_on_front' ) !== $home->ID ) {
		return;
	}

	update_option( 'show_on_front', $previous['show_on_front'] );
	update_option( 'page_on_front', $previous['page_on_front'] );
	update_option( 'page_for_posts', $previous['page_for_posts'] );
}
add_action( 'switch_theme', 'openmu_eclipse_restore_reading' );
