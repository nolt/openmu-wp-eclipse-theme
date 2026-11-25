<?php
/**
 * Title: Download page
 * Slug: openmu-eclipse/page-download
 * Categories: openmu-eclipse-pages
 * Description: Page head, the client download options and the system requirements. Replace the "#" links with the real download addresses.
 * Keywords: download, client, launcher, install
 * Viewport Width: 1200
 *
 * @package OpenMU_Eclipse
 */

// Per option: icon, title, text, button label, featured flag. The links are placeholders to edit in the page.
$openmu_downloads = array(
	array( 'download', __( 'Full client for Windows', 'openmu-eclipse' ), __( 'Everything in one archive: the game and the launcher. Unpack it and start the launcher.', 'openmu-eclipse' ), __( 'Download for Windows', 'openmu-eclipse' ), true ),
	array( 'shield', __( 'Launcher only', 'openmu-eclipse' ), __( 'A small program that downloads and updates the game files for you.', 'openmu-eclipse' ), __( 'Download the launcher', 'openmu-eclipse' ), false ),
	array( 'server', __( 'Linux and macOS', 'openmu-eclipse' ), __( 'Run the Windows client with Wine, or use the native Linux build if the server offers one.', 'openmu-eclipse' ), __( 'Download for Linux', 'openmu-eclipse' ), false ),
);
?>
<?php echo openmu_eclipse_pagehead( 'download', __( 'Get the game', 'openmu-eclipse' ), __( 'Pick a package, unpack it and start playing. The server address is already set.', 'openmu-eclipse' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- block markup. ?>
<!-- wp:group {"className":"oe-pagebody","layout":{"type":"constrained","wideSize":"76rem"}} -->
<div class="wp-block-group oe-pagebody">
	<!-- wp:group {"align":"wide","className":"oe-downloads","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide oe-downloads">
		<?php foreach ( $openmu_downloads as $openmu_download ) : ?>
		<!-- wp:group {"className":"is-style-oe-glass oe-download<?php echo $openmu_download[4] ? ' is-featured' : ''; ?>","layout":{"type":"default"}} -->
		<div class="wp-block-group is-style-oe-glass oe-download<?php echo $openmu_download[4] ? ' is-featured' : ''; ?>">
			<?php if ( $openmu_download[4] ) : ?>
			<!-- wp:paragraph --><p><span class="oe-badge"><?php esc_html_e( 'Recommended', 'openmu-eclipse' ); ?></span></p><!-- /wp:paragraph -->
			<?php endif; ?>
			<!-- wp:html --><?php echo openmu_eclipse_icon( $openmu_download[0] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built by the helper. ?><!-- /wp:html -->
			<!-- wp:heading {"textAlign":"center","level":3} --><h3 class="wp-block-heading has-text-align-center"><?php echo esc_html( $openmu_download[1] ); ?></h3><!-- /wp:heading -->
			<!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center"><?php echo esc_html( $openmu_download[2] ); ?></p><!-- /wp:paragraph -->
			<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
			<div class="wp-block-buttons">
				<!-- wp:button <?php echo $openmu_download[4] ? '' : '{"className":"is-style-outline"} '; ?>-->
				<div class="wp-block-button<?php echo $openmu_download[4] ? '' : ' is-style-outline'; ?>"><a class="wp-block-button__link wp-element-button" href="#"><?php echo esc_html( $openmu_download[3] ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->

	<!-- wp:heading {"textAlign":"center","className":"is-style-oe-ornate"} --><h2 class="wp-block-heading has-text-align-center is-style-oe-ornate"><?php esc_html_e( 'System requirements', 'openmu-eclipse' ); ?></h2><!-- /wp:heading -->
	<!-- wp:group {"align":"wide","className":"is-style-oe-glass oe-reqs","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide is-style-oe-glass oe-reqs">
		<!-- wp:group {"layout":{"type":"default"}} -->
		<div class="wp-block-group">
			<!-- wp:heading {"level":3} --><h3 class="wp-block-heading"><?php esc_html_e( 'Minimum', 'openmu-eclipse' ); ?></h3><!-- /wp:heading -->
			<!-- wp:list --><ul class="wp-block-list"><!-- wp:list-item --><li><?php esc_html_e( 'Windows 10 or newer', 'openmu-eclipse' ); ?></li><!-- /wp:list-item --><!-- wp:list-item --><li><?php esc_html_e( 'Dual-core CPU, 4 GB RAM', 'openmu-eclipse' ); ?></li><!-- /wp:list-item --><!-- wp:list-item --><li><?php esc_html_e( '2 GB of free disk space', 'openmu-eclipse' ); ?></li><!-- /wp:list-item --></ul><!-- /wp:list -->
		</div>
		<!-- /wp:group -->
		<!-- wp:group {"layout":{"type":"default"}} -->
		<div class="wp-block-group">
			<!-- wp:heading {"level":3} --><h3 class="wp-block-heading"><?php esc_html_e( 'Recommended', 'openmu-eclipse' ); ?></h3><!-- /wp:heading -->
			<!-- wp:list --><ul class="wp-block-list"><!-- wp:list-item --><li><?php esc_html_e( 'A graphics card with up-to-date drivers', 'openmu-eclipse' ); ?></li><!-- /wp:list-item --><!-- wp:list-item --><li><?php esc_html_e( 'Quad-core CPU, 8 GB RAM', 'openmu-eclipse' ); ?></li><!-- /wp:list-item --><!-- wp:list-item --><li><?php esc_html_e( 'A stable internet connection', 'openmu-eclipse' ); ?></li><!-- /wp:list-item --></ul><!-- /wp:list -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
