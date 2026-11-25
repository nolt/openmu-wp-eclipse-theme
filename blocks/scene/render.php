<?php
/**
 * Render of the openmu-eclipse/scene block: the eclipse scene layers (see inc/blocks.php).
 *
 * @package OpenMU_Eclipse
 *
 * @var array $attributes Block attributes (variant: "hero" or "ambient").
 */

defined( 'ABSPATH' ) || exit;

echo openmu_eclipse_render_scene( (string) ( $attributes['variant'] ?? 'hero' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped while built.
