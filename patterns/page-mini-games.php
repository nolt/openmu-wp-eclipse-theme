<?php
/**
 * Title: Mini games page
 * Slug: openmu-eclipse/page-mini-games
 * Categories: openmu-eclipse-pages
 * Description: Page head and the Mini games block of the OpenMU WP Connect plugin. Used by the "mini-games" page template.
 * Keywords: mini-games, server
 * Viewport Width: 1200
 *
 * @package OpenMU_Eclipse
 */

?>
<?php echo openmu_eclipse_pagehead( 'minigames', __( 'Arenas', 'openmu-eclipse' ), __( 'Blood Castle, Devil Square, Chaos Castle and Illusion Temple: who won the most.', 'openmu-eclipse' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- block markup. ?>
<!-- wp:group {"className":"oe-pagebody","layout":{"type":"constrained","wideSize":"76rem"}} -->
<div class="wp-block-group oe-pagebody">
	<?php echo openmu_eclipse_plugin_block( 'openmu/minigame-ranking', array( 'align' => 'wide' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- block markup. ?>
</div>
<!-- /wp:group -->
