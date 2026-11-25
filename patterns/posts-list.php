<?php
/**
 * Title: Posts list
 * Slug: openmu-eclipse/posts-list
 * Categories: openmu-eclipse
 * Description: The news archive: a grid of post cards for the main query (news page, categories, tags, search) with pagination.
 * Keywords: news, archive, posts, grid
 * Viewport Width: 1200
 *
 * @package OpenMU_Eclipse
 */

?>
<!-- wp:group {"className":"oe-pagebody","layout":{"type":"constrained","wideSize":"76rem"}} -->
<div class="wp-block-group oe-pagebody">
	<!-- wp:query {"queryId":21,"query":{"perPage":9,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"align":"wide","className":"oe-posts","layout":{"type":"default"}} -->
	<div class="wp-block-query alignwide oe-posts">
		<!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
		<?php echo openmu_eclipse_post_card(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- block markup. ?>
		<!-- /wp:post-template -->
		<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} -->
		<!-- wp:query-pagination-previous {"label":"<?php echo esc_attr( __( 'Newer', 'openmu-eclipse' ) ); ?>"} /-->
		<!-- wp:query-pagination-numbers /-->
		<!-- wp:query-pagination-next {"label":"<?php echo esc_attr( __( 'Older', 'openmu-eclipse' ) ); ?>"} /-->
		<!-- /wp:query-pagination -->
		<!-- wp:query-no-results -->
		<!-- wp:group {"className":"is-style-oe-glass","layout":{"type":"constrained"}} -->
		<div class="wp-block-group is-style-oe-glass">
			<!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center"><?php esc_html_e( 'Nothing found here yet.', 'openmu-eclipse' ); ?></p><!-- /wp:paragraph -->
			<!-- wp:search {"label":"<?php echo esc_attr( __( 'Search', 'openmu-eclipse' ) ); ?>","showLabel":false,"buttonText":"<?php echo esc_attr( __( 'Search', 'openmu-eclipse' ) ); ?>"} /-->
		</div>
		<!-- /wp:group -->
		<!-- /wp:query-no-results -->
	</div>
	<!-- /wp:query -->
</div>
<!-- /wp:group -->
