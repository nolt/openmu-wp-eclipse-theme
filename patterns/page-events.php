<?php
/**
 * Title: Events page
 * Slug: openmu-eclipse/page-events
 * Categories: openmu-eclipse-pages
 * Description: Page head and the Events block of the OpenMU WP Connect plugin. Used by the "events" page template.
 * Keywords: events, server
 * Viewport Width: 1200
 *
 * @package OpenMU_Eclipse
 */

?>
<?php echo openmu_eclipse_pagehead( 'events', __( 'Never miss a battle', 'openmu-eclipse' ), __( 'When the next invasions, Blood Castle and Devil Square start, in your time zone.', 'openmu-eclipse' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- block markup. ?>
<!-- wp:group {"className":"oe-pagebody","layout":{"type":"constrained","wideSize":"76rem"}} -->
<div class="wp-block-group oe-pagebody">
	<?php
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- pre-escaped block markup / core helper escapes.
	echo openmu_eclipse_plugin_block(
		'openmu/events',
		array(
			'align' => 'wide',
			'limit' => 20,
		)
	); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- block markup. 
	?>
</div>
<!-- /wp:group -->
