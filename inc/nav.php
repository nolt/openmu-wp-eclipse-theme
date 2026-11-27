<?php
/**
 * The header menu model.
 *
 * The scope is fixed (shared with the other OpenMU themes): Home, News, Download, a
 * "Server" submenu (Ranking, Mini games, Armory, Events, Commands) and Account. Items are
 * found by page address (slug), so renaming or translating a page keeps the menu working;
 * a page that does not exist or is not published is simply left out.
 *
 * @package OpenMU_Eclipse
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the menu as a tree: each entry has 'slug', 'label', 'url', 'hint' (tooltip) and optionally 'children'.
 *
 * The label of a page is its own title, so editing a page title changes the menu. The
 * Account item keeps the page title too; for visitors without a player session (the
 * plugin's session is not a WordPress login) it only gets a "Sign in" hint as 'title'.
 *
 * @return array<int, array<string, mixed>>
 */
function openmu_eclipse_menu(): array {
	$item = static function ( string $slug ): ?array {
		$page = openmu_eclipse_public_page( $slug );
		if ( ! $page ) {
			return null;
		}
		$hint = '';
		if ( 'account' === $slug && function_exists( 'openmu_wp_connect_account_current' ) && ! openmu_wp_connect_account_current() ) {
			$hint = __( 'Sign in', 'openmu-eclipse' );
		}
		return array(
			'slug'  => $slug,
			'label' => get_the_title( $page ),
			'url'   => get_permalink( $page ),
			'hint'  => $hint,
		);
	};

	$server = array_filter( array_map( $item, array( 'ranking', 'mini-games', 'armory', 'events', 'commands' ) ) );

	$menu = array();
	foreach ( array( 'home', 'news', 'download' ) as $slug ) {
		$entry = $item( $slug );
		if ( $entry ) {
			$menu[] = $entry;
		}
	}
	if ( $server ) {
		$menu[] = array(
			'slug'     => 'server',
			'label'    => __( 'Server', 'openmu-eclipse' ),
			'url'      => '',
			'children' => array_values( $server ),
		);
	}
	$account = $item( 'account' );
	if ( $account ) {
		$menu[] = $account;
	}
	return $menu;
}

/**
 * Tells whether a menu entry is the page being viewed (or, for posts, the News page).
 *
 * @param string $slug Page address of the entry.
 * @return bool
 */
function openmu_eclipse_menu_is_current( string $slug ): bool {
	if ( 'home' === $slug ) {
		return is_front_page();
	}
	if ( 'news' === $slug ) {
		return is_home() || is_singular( 'post' ) || is_category() || is_tag() || is_date() || is_author();
	}
	return is_page( $slug );
}

/**
 * Returns the address of a theme page by its slug, or the home address if it does not exist.
 *
 * @param string $slug Page address, e.g. "download".
 * @return string
 */
function openmu_eclipse_page_url( string $slug ): string {
	$page = openmu_eclipse_public_page( $slug );
	$url  = $page ? get_permalink( $page ) : false;
	return is_string( $url ) && '' !== $url ? $url : home_url( '/' . $slug . '/' );
}

/**
 * Whether the visitor is logged in as a player (session of the OpenMU WP Connect plugin).
 *
 * Players are not WordPress users. Used to turn the "Create account" button into "My account" for
 * players who already have one; the plugin keeps pages out of page caches while its session
 * cookie is present, and this helper asks for that again, so the label never reaches other
 * visitors.
 */
function openmu_eclipse_player_logged_in(): bool {
	$player = function_exists( 'openmu_wp_connect_account_current' ) && null !== openmu_wp_connect_account_current();
	// The page now differs per player: ask for no-cache here too, not only through the plugin's hook.
	if ( $player && function_exists( 'openmu_wp_connect_account_send_no_cache' ) ) {
		openmu_wp_connect_account_send_no_cache();
	}
	return $player;
}

/**
 * Returns a page of the theme's fixed set when visitors may see it, else null.
 *
 * get_page_by_path() alone also finds drafts, private and scheduled pages and, when no page
 * has the address, a Media Library upload with that name. The menu, buttons and the footer
 * use this instead, so they never show the title of a hidden page or lead to someone's upload.
 *
 * @param string $slug Page address, e.g. "download".
 */
function openmu_eclipse_public_page( string $slug ): ?WP_Post {
	$page = get_page_by_path( $slug, OBJECT, 'page' );
	return $page instanceof WP_Post && 'publish' === $page->post_status ? $page : null;
}
