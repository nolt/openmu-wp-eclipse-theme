<?php
/**
 * Title: Single post
 * Slug: openmu-eclipse/single-post
 * Categories: openmu-eclipse-pages
 * Description: A news article: banner with category, title and meta, the cover image, the text in a glass box, tags, previous/next links and comments.
 * Keywords: post, article, single
 * Viewport Width: 1200
 *
 * @package OpenMU_Eclipse
 */

?>
<!-- wp:group {"className":"oe-pagehead","layout":{"type":"constrained","wideSize":"60rem"}} -->
<div class="wp-block-group oe-pagehead">
	<!-- wp:post-terms {"term":"category","textAlign":"center","className":"oe-pagehead__eyebrow"} /-->
	<!-- wp:post-title {"textAlign":"center","level":1} /-->
	<!-- wp:group {"className":"oe-single__meta","layout":{"type":"flex","justifyContent":"center","flexWrap":"wrap"}} -->
	<div class="wp-block-group oe-single__meta">
		<!-- wp:post-date /-->
		<!-- wp:post-author-name {"isLink":false} /-->
	</div>
	<!-- /wp:group -->
	<!-- wp:html --><div class="oe-orn" aria-hidden="true"></div><!-- /wp:html -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"oe-pagebody","layout":{"type":"constrained","contentSize":"50rem","wideSize":"60rem"}} -->
<div class="wp-block-group oe-pagebody">
	<!-- wp:post-featured-image {"aspectRatio":"16/9","align":"wide","className":"oe-single__cover"} /-->
	<!-- wp:group {"className":"oe-prose","layout":{"type":"constrained","contentSize":"100%"}} -->
	<div class="wp-block-group oe-prose">
		<!-- wp:post-content {"layout":{"type":"constrained","contentSize":"100%"}} /-->
	</div>
	<!-- /wp:group -->
	<!-- wp:post-terms {"term":"post_tag","prefix":"<?php echo esc_attr( __( 'Tags: ', 'openmu-eclipse' ) ); ?>","className":"oe-tags"} /-->
	<!-- wp:group {"className":"oe-postnav","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"}} -->
	<div class="wp-block-group oe-postnav">
		<!-- wp:post-navigation-link {"type":"previous","label":"<?php echo esc_attr( __( 'Previous', 'openmu-eclipse' ) ); ?>","showTitle":true,"linkLabel":false} /-->
		<!-- wp:post-navigation-link {"textAlign":"right","type":"next","label":"<?php echo esc_attr( __( 'Next', 'openmu-eclipse' ) ); ?>","showTitle":true,"linkLabel":false} /-->
	</div>
	<!-- /wp:group -->
	<!-- wp:comments -->
	<div class="wp-block-comments">
		<!-- wp:comments-title {"level":3} /-->
		<!-- wp:comment-template -->
		<!-- wp:group {"layout":{"type":"default"}} -->
		<div class="wp-block-group">
			<!-- wp:comment-author-name /-->
			<!-- wp:comment-date /-->
			<!-- wp:comment-content /-->
			<!-- wp:comment-reply-link /-->
		</div>
		<!-- /wp:group -->
		<!-- /wp:comment-template -->
		<!-- wp:comments-pagination -->
		<!-- wp:comments-pagination-previous /-->
		<!-- wp:comments-pagination-numbers /-->
		<!-- wp:comments-pagination-next /-->
		<!-- /wp:comments-pagination -->
		<!-- wp:post-comments-form /-->
	</div>
	<!-- /wp:comments -->
</div>
<!-- /wp:group -->
