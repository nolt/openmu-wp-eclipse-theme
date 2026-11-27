<?php
/**
 * Title: Home hero
 * Slug: openmu-eclipse/home-hero
 * Categories: openmu-eclipse
 * Description: Full-screen hero with the animated eclipse scene, headline, call-to-action buttons and the live server status.
 * Keywords: hero, banner, eclipse, header
 * Viewport Width: 1400
 *
 * @package OpenMU_Eclipse
 */

?>
<!-- wp:group {"align":"full","className":"oe-hero","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull oe-hero">
	<!-- wp:openmu-eclipse/scene {"variant":"hero"} /-->

	<!-- wp:group {"className":"oe-hero__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group oe-hero__inner">
		<!-- wp:group {"className":"oe-hero__content","layout":{"type":"default"}} -->
		<div class="wp-block-group oe-hero__content">
			<!-- wp:paragraph {"className":"oe-hero__eyebrow"} --><p class="oe-hero__eyebrow"><?php esc_html_e( 'Season 6 · Free to play', 'openmu-eclipse' ); ?></p><!-- /wp:paragraph -->
			<!-- wp:heading {"level":1,"className":"oe-hero__title"} --><h1 class="wp-block-heading oe-hero__title"><?php esc_html_e( 'Rise beneath the eclipse', 'openmu-eclipse' ); ?></h1><!-- /wp:heading -->
			<!-- wp:paragraph {"className":"oe-hero__lead"} -->
			<p class="oe-hero__lead">
			<?php
			echo esc_html(
				sprintf(
					/* translators: %s: site name. */
					__( 'The sun has gone dark over the old continent. Take up the blade, the staff or the bow and write your legend on %s.', 'openmu-eclipse' ),
					get_bloginfo( 'name' )
				)
			);
			?>
			</p>
			<!-- /wp:paragraph -->
			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( openmu_eclipse_page_url( 'download' ) ); ?>"><?php echo openmu_eclipse_icon( 'play' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built by the helper. ?><?php esc_html_e( 'Play now', 'openmu-eclipse' ); ?></a></div>
				<!-- /wp:button -->
				<!-- wp:button {"className":"is-style-outline"} -->
				<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( openmu_eclipse_page_url( 'account' ) ); ?>"><?php echo esc_html( openmu_eclipse_player_logged_in() ? __( 'My account', 'openmu-eclipse' ) : __( 'Create account', 'openmu-eclipse' ) ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
			<!-- wp:group {"className":"oe-hero__status","layout":{"type":"default"}} -->
			<div class="wp-block-group oe-hero__status">
				<?php echo openmu_eclipse_plugin_block( 'openmu/server-status' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- block markup. ?>
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->

	<!-- wp:html --><span class="oe-hero__cue" aria-hidden="true"></span><!-- /wp:html -->
</div>
<!-- /wp:group -->
