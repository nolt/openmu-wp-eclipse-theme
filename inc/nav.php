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
		$page = get_page_by_path( $slug );
		if ( ! $page || 'publish' !== $page->post_status ) {
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
	$page = get_page_by_path( $slug );
	return $page ? get_permalink( $page ) : home_url( '/' . $slug . '/' );
}
