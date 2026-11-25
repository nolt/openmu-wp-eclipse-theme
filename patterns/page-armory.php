<?php
/**
 * Title: Armory page
 * Slug: openmu-eclipse/page-armory
 * Categories: openmu-eclipse-pages
 * Description: Page head and the Armory block of the OpenMU WP Connect plugin. Used by the "armory" page template.
 * Keywords: armory, server
 * Viewport Width: 1200
 *
 * @package OpenMU_Eclipse
 */

?>
<?php echo openmu_eclipse_pagehead( 'armory', __( 'Inspect a hero', 'openmu-eclipse' ), __( 'Search a character by name and see its class, level and the items it wears.', 'openmu-eclipse' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- block markup. ?>
<!-- wp:group {"className":"oe-pagebody","layout":{"type":"constrained","wideSize":"76rem"}} -->
<div class="wp-block-group oe-pagebody">
	<?php echo openmu_eclipse_plugin_block( 'openmu/armory', array( 'align' => 'wide' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- block markup. ?>
</div>
<!-- /wp:group -->
