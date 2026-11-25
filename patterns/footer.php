<?php
/**
 * Title: Footer
 * Slug: openmu-eclipse/footer
 * Categories: openmu-eclipse
 * Block Types: core/template-part/footer
 * Description: Rich footer: brand and tagline, links to the pages, community links and the legal line.
 * Inserter: no
 *
 * @package OpenMU_Eclipse
 */

?>
<!-- wp:group {"align":"full","className":"oe-footer","layout":{"type":"constrained","wideSize":"76rem"}} -->
<div class="wp-block-group alignfull oe-footer">
	<!-- wp:group {"align":"wide","className":"oe-footer__grid","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide oe-footer__grid">
		<!-- wp:group {"layout":{"type":"default"}} -->
		<div class="wp-block-group">
			<!-- wp:group {"className":"oe-footer__brand","layout":{"type":"default"}} -->
			<div class="wp-block-group oe-footer__brand">
				<!-- wp:image {"sizeSlug":"full","linkDestination":"none"} -->
				<figure class="wp-block-image size-full"><img src="<?php echo esc_url( openmu_eclipse_emblem_url() ); ?>" alt="" width="44" height="44"/></figure>
				<!-- /wp:image -->
				<!-- wp:site-title {"level":0} /-->
			</div>
			<!-- /wp:group -->
			<!-- wp:site-tagline /-->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"layout":{"type":"default"}} -->
		<div class="wp-block-group">
			<!-- wp:heading {"level":2} --><h2 class="wp-block-heading"><?php esc_html_e( 'Game', 'openmu-eclipse' ); ?></h2><!-- /wp:heading -->
			<?php echo openmu_eclipse_page_links( array( 'home', 'news', 'download', 'account' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped while built. ?>
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"layout":{"type":"default"}} -->
		<div class="wp-block-group">
			<!-- wp:heading {"level":2} --><h2 class="wp-block-heading"><?php esc_html_e( 'Server', 'openmu-eclipse' ); ?></h2><!-- /wp:heading -->
			<?php echo openmu_eclipse_page_links( array( 'ranking', 'mini-games', 'armory', 'events', 'commands' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped while built. ?>
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"layout":{"type":"default"}} -->
		<div class="wp-block-group">
			<!-- wp:heading {"level":2} --><h2 class="wp-block-heading"><?php esc_html_e( 'Community', 'openmu-eclipse' ); ?></h2><!-- /wp:heading -->
			<!-- wp:list {"className":"oe-links"} -->
			<ul class="wp-block-list oe-links">
				<!-- wp:list-item --><li><a href="#"><?php esc_html_e( 'Discord', 'openmu-eclipse' ); ?></a></li><!-- /wp:list-item -->
				<!-- wp:list-item --><li><a href="<?php echo esc_url( get_feed_link() ); ?>"><?php esc_html_e( 'News feed (RSS)', 'openmu-eclipse' ); ?></a></li><!-- /wp:list-item -->
			</ul>
			<!-- /wp:list -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","className":"oe-footer__bottom","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide oe-footer__bottom">
		<!-- wp:paragraph -->
		<p>
		<?php
		echo esc_html(
			sprintf(
				/* translators: 1: year, 2: site name. */
				__( '© %1$s %2$s. All rights reserved.', 'openmu-eclipse' ),
				gmdate( 'Y' ),
				get_bloginfo( 'name' )
			)
		);
		?>
		</p>
		<!-- /wp:paragraph -->
		<!-- wp:paragraph -->
		<p><?php esc_html_e( 'A fan-run server, not affiliated with or endorsed by Webzen. MU Online is a trademark of its owners.', 'openmu-eclipse' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
