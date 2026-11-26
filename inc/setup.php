<?php
/**
 * Theme setup: translations, theme supports and editor style.
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
