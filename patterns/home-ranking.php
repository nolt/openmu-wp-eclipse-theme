<?php
/**
 * Title: Home ranking teaser
 * Slug: openmu-eclipse/home-ranking
 * Categories: openmu-eclipse
 * Description: The top five characters from the plugin's ranking block, with a link to the full ranking.
 * Keywords: ranking, top, characters
 * Viewport Width: 1400
 *
 * @package OpenMU_Eclipse
 */

?>
<!-- wp:group {"align":"full","className":"oe-section","layout":{"type":"constrained","wideSize":"76rem"}} -->
<div class="wp-block-group alignfull oe-section">
	<!-- wp:paragraph {"className":"oe-eyebrow"} --><p class="oe-eyebrow"><?php esc_html_e( 'Hall of heroes', 'openmu-eclipse' ); ?></p><!-- /wp:paragraph -->
	<!-- wp:heading {"textAlign":"center","className":"is-style-oe-ornate"} --><h2 class="wp-block-heading has-text-align-center is-style-oe-ornate"><?php esc_html_e( 'Top players', 'openmu-eclipse' ); ?></h2><!-- /wp:heading -->
	<?php
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- pre-escaped block markup / core helper escapes.
	echo openmu_eclipse_plugin_block(
		'openmu/ranking',
		array(
			'limit' => 5,
			'align' => 'wide',
		)
	);
	?>
	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-buttons">
		<!-- wp:button {"className":"is-style-outline"} -->
		<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( openmu_eclipse_page_url( 'ranking' ) ); ?>"><?php esc_html_e( 'Full ranking', 'openmu-eclipse' ); ?></a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
