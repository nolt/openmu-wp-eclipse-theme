<?php
/**
 * Title: Home how to start
 * Slug: openmu-eclipse/home-steps
 * Categories: openmu-eclipse
 * Description: Four numbered steps from account to first login.
 * Keywords: steps, start, guide, how to
 * Viewport Width: 1400
 *
 * @package OpenMU_Eclipse
 */

$openmu_steps = array(
	array( 'user', __( 'Create an account', 'openmu-eclipse' ), __( 'Register with a login and a password. It takes less than a minute.', 'openmu-eclipse' ) ),
	array( 'download', __( 'Download the client', 'openmu-eclipse' ), __( 'Get the game client and unpack it to a folder of your choice.', 'openmu-eclipse' ) ),
	array( 'server', __( 'Connect', 'openmu-eclipse' ), __( 'Start the launcher or the game; the server address is already set.', 'openmu-eclipse' ) ),
	array( 'sword', __( 'Create a hero', 'openmu-eclipse' ), __( 'Log in, create a character and step into Lorencia.', 'openmu-eclipse' ) ),
);
?>
<!-- wp:group {"align":"full","className":"oe-section","layout":{"type":"constrained","wideSize":"76rem"}} -->
<div class="wp-block-group alignfull oe-section">
	<!-- wp:paragraph {"className":"oe-eyebrow"} --><p class="oe-eyebrow"><?php esc_html_e( 'How to start', 'openmu-eclipse' ); ?></p><!-- /wp:paragraph -->
	<!-- wp:heading {"textAlign":"center","className":"is-style-oe-ornate"} --><h2 class="wp-block-heading has-text-align-center is-style-oe-ornate"><?php esc_html_e( 'Four steps to the battlefield', 'openmu-eclipse' ); ?></h2><!-- /wp:heading -->
	<!-- wp:group {"align":"wide","className":"oe-steps","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide oe-steps">
		<?php foreach ( $openmu_steps as $openmu_step ) : ?>
		<!-- wp:group {"className":"oe-step","layout":{"type":"default"}} -->
		<div class="wp-block-group oe-step">
			<!-- wp:html --><?php echo openmu_eclipse_icon( $openmu_step[0] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built by the helper. ?><!-- /wp:html -->
			<!-- wp:heading {"level":3} --><h3 class="wp-block-heading"><?php echo esc_html( $openmu_step[1] ); ?></h3><!-- /wp:heading -->
			<!-- wp:paragraph --><p><?php echo esc_html( $openmu_step[2] ); ?></p><!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
