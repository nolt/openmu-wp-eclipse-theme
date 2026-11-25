<?php
/**
 * Theme setup: translations, editor style and the hand-over of the client assets folder.
 *
 * @package OpenMU_Eclipse
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registers what the theme supports; hooked to after_setup_theme.
 *
 * Translations are loaded by WordPress itself from languages/ (the text domain is
 * declared in style.css); the editor gets the same stylesheet as the front end.
 */
function openmu_eclipse_setup(): void {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'post-thumbnails' );
	add_editor_style( 'assets/css/editor.css' );
	// Cards on the news page use this size (16:10 crop).
	add_image_size( 'openmu-eclipse-card', 720, 450, true );
}
add_action( 'after_setup_theme', 'openmu_eclipse_setup' );

/**
 * Hands the theme's assets/client/ folder to the OpenMU WP Connect plugin.
 *
 * The folder holds the class renders and item data of the armory. The inventory textures
 * (character-view/) are deliberately not shipped, so the plugin draws its neutral view,
 * which assets/css/plugin.css restyles.
 *
 * @param array{path: string, url: string}|mixed $folder The plugin's own folder (kept when the theme has none).
 * @return array{path: string, url: string} Folder with the client files, path and address.
 */
function openmu_eclipse_client_assets( $folder ): array {
	// The public release ships no game client files: without the folder the plugin keeps its own
	// (uploads) folder, where a site owner can put the files from their own client.
	if ( ! is_dir( get_theme_file_path( 'assets/client/' ) ) ) {
		return is_array( $folder ) ? $folder : array();
	}
	return array(
		'path' => get_theme_file_path( 'assets/client/' ),
		'url'  => get_theme_file_uri( 'assets/client/' ),
	);
}
add_filter( 'openmu_wp_connect_client_assets', 'openmu_eclipse_client_assets' );
