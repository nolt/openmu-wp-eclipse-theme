<?php
/**
 * Title: Home events teaser
 * Slug: openmu-eclipse/home-events
 * Categories: openmu-eclipse
 * Description: The next game events from the plugin's events block, with a link to the full schedule.
 * Keywords: events, schedule, blood castle, devil square
 * Viewport Width: 1400
 *
 * @package OpenMU_Eclipse
 */

?>
<!-- wp:group {"align":"full","className":"oe-section oe-home-events","layout":{"type":"constrained","wideSize":"76rem"}} -->
<div class="wp-block-group alignfull oe-section oe-home-events">
	<!-- wp:paragraph {"className":"oe-eyebrow"} --><p class="oe-eyebrow"><?php esc_html_e( 'Never miss a battle', 'openmu-eclipse' ); ?></p><!-- /wp:paragraph -->
	<!-- wp:heading {"textAlign":"center","className":"is-style-oe-ornate"} --><h2 class="wp-block-heading has-text-align-center is-style-oe-ornate"><?php esc_html_e( 'Upcoming events', 'openmu-eclipse' ); ?></h2><!-- /wp:heading -->
	<?php
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- pre-escaped block markup / core helper escapes.
	echo openmu_eclipse_plugin_block(
		'openmu/events',
		array(
			'limit' => 6,
			'align' => 'wide',
		)
	);
	?>
	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-buttons">
		<!-- wp:button {"className":"is-style-outline"} -->
		<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( openmu_eclipse_page_url( 'events' ) ); ?>"><?php esc_html_e( 'Full schedule', 'openmu-eclipse' ); ?></a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
