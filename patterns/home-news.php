<?php
/**
 * Title: Home latest news
 * Slug: openmu-eclipse/home-news
 * Categories: openmu-eclipse
 * Description: The three latest posts as cards, with a link to all news.
 * Keywords: news, posts, blog
 * Viewport Width: 1400
 *
 * @package OpenMU_Eclipse
 */

?>
<!-- wp:group {"align":"full","className":"oe-section","layout":{"type":"constrained","wideSize":"76rem"}} -->
<div class="wp-block-group alignfull oe-section">
	<!-- wp:paragraph {"className":"oe-eyebrow"} --><p class="oe-eyebrow"><?php esc_html_e( 'From the realm', 'openmu-eclipse' ); ?></p><!-- /wp:paragraph -->
	<!-- wp:heading {"textAlign":"center","className":"is-style-oe-ornate"} --><h2 class="wp-block-heading has-text-align-center is-style-oe-ornate"><?php esc_html_e( 'Latest news', 'openmu-eclipse' ); ?></h2><!-- /wp:heading -->
	<!-- wp:query {"queryId":11,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide","className":"oe-posts","layout":{"type":"default"}} -->
	<div class="wp-block-query alignwide oe-posts">
		<!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
		<?php echo openmu_eclipse_post_card(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- block markup. ?>
		<!-- /wp:post-template -->
		<!-- wp:query-no-results -->
		<!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center"><?php esc_html_e( 'No news yet. The first announcement is coming soon.', 'openmu-eclipse' ); ?></p><!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->
	</div>
	<!-- /wp:query -->
	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-buttons">
		<!-- wp:button {"className":"is-style-outline"} -->
		<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( openmu_eclipse_page_url( 'news' ) ); ?>"><?php esc_html_e( 'All news', 'openmu-eclipse' ); ?></a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
