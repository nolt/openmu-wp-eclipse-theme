<?php
/**
 * OpenMU Eclipse theme bootstrap.
 *
 * A standalone block theme for OpenMU (MU Online server emulator) websites. This file
 * only defines the theme's version and loads the parts in inc/:
 *
 * - setup.php      theme supports, translations, editor style
 * - assets.php     stylesheets, scripts, font preloads, the site-wide ambient background
 * - blocks.php     the theme's dynamic blocks (blocks/*), block styles, pattern categories,
 *                  and helpers the patterns use (art addresses, plugin blocks)
 * - nav.php        the header menu model: pages by address, "Server" submenu
 * - site-setup.php pages + Reading settings when the theme is activated
 *
 * @package OpenMU_Eclipse
 */

defined( 'ABSPATH' ) || exit;

/** Theme version; busts browser caches of the theme's CSS and JS. */
const OPENMU_ECLIPSE_VERSION = '0.1.0';

require_once get_theme_file_path( 'inc/setup.php' );
require_once get_theme_file_path( 'inc/assets.php' );
require_once get_theme_file_path( 'inc/blocks.php' );
require_once get_theme_file_path( 'inc/nav.php' );
require_once get_theme_file_path( 'inc/site-setup.php' );
