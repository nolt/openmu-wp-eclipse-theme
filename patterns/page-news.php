<?php
/**
 * Title: News page head
 * Slug: openmu-eclipse/page-news
 * Categories: openmu-eclipse-pages
 * Description: Banner of the news page (the page set as the posts page), followed by the posts grid.
 * Keywords: news, blog, posts
 * Viewport Width: 1200
 *
 * @package OpenMU_Eclipse
 */

// The posts page keeps the title the admin gave it; "News" when none is set.
$openmu_news_id    = (int) get_option( 'page_for_posts' );
$openmu_news_title = $openmu_news_id ? get_the_title( $openmu_news_id ) : '';
if ( '' === $openmu_news_title ) {
	$openmu_news_title = __( 'News', 'openmu-eclipse' );
}
?>
<!-- wp:group {"className":"oe-pagehead","layout":{"type":"constrained"}} -->
<div class="wp-block-group oe-pagehead">
	<!-- wp:paragraph {"align":"center","className":"oe-pagehead__eyebrow"} --><p class="has-text-align-center oe-pagehead__eyebrow"><?php echo openmu_eclipse_icon( 'news' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built by the helper. ?><?php esc_html_e( 'Chronicle of the realm', 'openmu-eclipse' ); ?></p><!-- /wp:paragraph -->
	<!-- wp:heading {"textAlign":"center","level":1} --><h1 class="wp-block-heading has-text-align-center"><?php echo esc_html( $openmu_news_title ); ?></h1><!-- /wp:heading -->
	<!-- wp:paragraph {"align":"center","className":"oe-pagehead__lead"} --><p class="has-text-align-center oe-pagehead__lead"><?php esc_html_e( 'Announcements, updates and stories from the server.', 'openmu-eclipse' ); ?></p><!-- /wp:paragraph -->
	<!-- wp:html --><div class="oe-orn" aria-hidden="true"></div><!-- /wp:html -->
</div>
<!-- /wp:group -->
<!-- wp:pattern {"slug":"openmu-eclipse/posts-list"} /-->
