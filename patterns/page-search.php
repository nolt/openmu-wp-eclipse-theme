<?php
/**
 * Title: Search results page
 * Slug: openmu-eclipse/page-search
 * Categories: openmu-eclipse-pages
 * Description: Banner with the search phrase and a search field, followed by the results as cards.
 * Keywords: search, results
 * Viewport Width: 1200
 *
 * @package OpenMU_Eclipse
 */

?>
<!-- wp:group {"className":"oe-pagehead","layout":{"type":"constrained"}} -->
<div class="wp-block-group oe-pagehead">
	<!-- wp:paragraph {"align":"center","className":"oe-pagehead__eyebrow"} --><p class="has-text-align-center oe-pagehead__eyebrow"><?php esc_html_e( 'Search', 'openmu-eclipse' ); ?></p><!-- /wp:paragraph -->
	<!-- wp:query-title {"type":"search","textAlign":"center"} /-->
	<!-- wp:search {"label":"<?php echo esc_attr( __( 'Search', 'openmu-eclipse' ) ); ?>","showLabel":false,"buttonText":"<?php echo esc_attr( __( 'Search', 'openmu-eclipse' ) ); ?>"} /-->
</div>
<!-- /wp:group -->
<!-- wp:pattern {"slug":"openmu-eclipse/posts-list"} /-->
