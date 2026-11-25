<?php
/**
 * Title: Ranking page
 * Slug: openmu-eclipse/page-ranking
 * Categories: openmu-eclipse-pages
 * Description: Page head and the Ranking block of the OpenMU WP Connect plugin. Used by the "ranking" page template.
 * Keywords: ranking, server
 * Viewport Width: 1200
 *
 * @package OpenMU_Eclipse
 */

?>
<?php echo openmu_eclipse_pagehead( 'ranking', __( 'Hall of heroes', 'openmu-eclipse' ), __( 'The strongest characters of the server, ordered by resets and level. Click a name to see the equipment.', 'openmu-eclipse' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- block markup. ?>
<!-- wp:group {"className":"oe-pagebody","layout":{"type":"constrained","wideSize":"76rem"}} -->
<div class="wp-block-group oe-pagebody">
	<?php
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- pre-escaped block markup / core helper escapes.
	echo openmu_eclipse_plugin_block(
		'openmu/ranking',
		array(
			'align' => 'wide',
			'limit' => 50,
		)
	); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- block markup. 
	?>
</div>
<!-- /wp:group -->
