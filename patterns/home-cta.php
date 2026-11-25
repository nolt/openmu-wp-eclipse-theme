<?php
/**
 * Title: Download and Discord call to action
 * Slug: openmu-eclipse/home-cta
 * Categories: openmu-eclipse
 * Description: A closing panel with a glowing eclipse: download button and a link to the community Discord. Replace the Discord link with your invitation.
 * Keywords: download, discord, call to action
 * Viewport Width: 1400
 *
 * @package OpenMU_Eclipse
 */

?>
<!-- wp:group {"align":"full","className":"oe-section","layout":{"type":"constrained","wideSize":"76rem"}} -->
<div class="wp-block-group alignfull oe-section">
	<!-- wp:group {"align":"wide","className":"oe-cta","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide oe-cta">
		<!-- wp:heading {"textAlign":"center"} --><h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Your legend starts today', 'openmu-eclipse' ); ?></h2><!-- /wp:heading -->
		<!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center"><?php esc_html_e( 'Download the client, join the community on Discord and meet the players waiting for you on the battlefield.', 'openmu-eclipse' ); ?></p><!-- /wp:paragraph -->
		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
		<div class="wp-block-buttons">
			<!-- wp:button -->
			<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( openmu_eclipse_page_url( 'download' ) ); ?>"><?php echo openmu_eclipse_icon( 'download' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built by the helper. ?><?php esc_html_e( 'Download the client', 'openmu-eclipse' ); ?></a></div>
			<!-- /wp:button -->
			<!-- wp:button {"className":"is-style-outline"} -->
			<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="#"><?php echo openmu_eclipse_icon( 'discord' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built by the helper. ?><?php esc_html_e( 'Join Discord', 'openmu-eclipse' ); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
