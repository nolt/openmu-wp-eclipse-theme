<?php
/**
 * Title: Page not found
 * Slug: openmu-eclipse/page-404
 * Categories: openmu-eclipse-pages
 * Description: The 404 screen: a big gold number, a short message, a search field and a way home.
 * Keywords: 404, error, not found
 * Viewport Width: 1200
 *
 * @package OpenMU_Eclipse
 */

?>
<!-- wp:group {"className":"oe-error","layout":{"type":"constrained"}} -->
<div class="wp-block-group oe-error">
	<!-- wp:paragraph {"align":"center","className":"oe-error__code"} --><p class="has-text-align-center oe-error__code">404</p><!-- /wp:paragraph -->
	<!-- wp:heading {"textAlign":"center"} --><h1 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'The path ends here', 'openmu-eclipse' ); ?></h1><!-- /wp:heading -->
	<!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center"><?php esc_html_e( 'This page does not exist or has been moved. Try the search, or return to the start.', 'openmu-eclipse' ); ?></p><!-- /wp:paragraph -->
	<!-- wp:search {"label":"<?php echo esc_attr( __( 'Search', 'openmu-eclipse' ) ); ?>","showLabel":false,"buttonText":"<?php echo esc_attr( __( 'Search', 'openmu-eclipse' ) ); ?>"} /-->
	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-buttons">
		<!-- wp:button -->
		<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to the home page', 'openmu-eclipse' ); ?></a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
