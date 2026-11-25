<?php
/**
 * Title: Archive page head
 * Slug: openmu-eclipse/page-archive
 * Categories: openmu-eclipse-pages
 * Description: Banner of category, tag, author and date archives (the archive title and description), followed by the posts grid.
 * Keywords: archive, category, tag
 * Viewport Width: 1200
 *
 * @package OpenMU_Eclipse
 */

?>
<!-- wp:group {"className":"oe-pagehead","layout":{"type":"constrained"}} -->
<div class="wp-block-group oe-pagehead">
	<!-- wp:paragraph {"align":"center","className":"oe-pagehead__eyebrow"} --><p class="has-text-align-center oe-pagehead__eyebrow"><?php echo openmu_eclipse_icon( 'news' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built by the helper. ?><?php esc_html_e( 'Archive', 'openmu-eclipse' ); ?></p><!-- /wp:paragraph -->
	<!-- wp:query-title {"type":"archive","textAlign":"center","showPrefix":false} /-->
	<!-- wp:term-description {"textAlign":"center","className":"oe-pagehead__lead"} /-->
	<!-- wp:html --><div class="oe-orn" aria-hidden="true"></div><!-- /wp:html -->
</div>
<!-- /wp:group -->
<!-- wp:pattern {"slug":"openmu-eclipse/posts-list"} /-->
