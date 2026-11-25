<?php
/**
 * Title: Header
 * Slug: openmu-eclipse/header
 * Categories: openmu-eclipse
 * Block Types: core/template-part/header
 * Description: Sticky glass header: emblem, site title, the theme menu and the Play now button.
 * Inserter: no
 *
 * @package OpenMU_Eclipse
 */

?>
<!-- wp:group {"align":"full","className":"oe-header","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull oe-header">
	<!-- wp:group {"className":"oe-brand","layout":{"type":"default"}} -->
	<div class="wp-block-group oe-brand">
		<!-- wp:image {"sizeSlug":"full","linkDestination":"custom"} -->
		<figure class="wp-block-image size-full"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( openmu_eclipse_emblem_url() ); ?>" alt="" width="40" height="40"/></a></figure>
		<!-- /wp:image -->
		<!-- wp:site-title {"level":0} /-->
	</div>
	<!-- /wp:group -->
	<!-- wp:openmu-eclipse/site-nav /-->
</div>
<!-- /wp:group -->
