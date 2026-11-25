<?php
/**
 * Title: Account page
 * Slug: openmu-eclipse/page-account
 * Categories: openmu-eclipse-pages
 * Description: Page head and the Account block of the OpenMU WP Connect plugin. Used by the "account" page template.
 * Keywords: account, server
 * Viewport Width: 1200
 *
 * @package OpenMU_Eclipse
 */

?>
<?php echo openmu_eclipse_pagehead( 'account', __( 'Your account', 'openmu-eclipse' ), __( 'Sign in to see your characters, change your password or create a new account.', 'openmu-eclipse' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- block markup. ?>
<!-- wp:group {"className":"oe-pagebody","layout":{"type":"constrained","wideSize":"76rem"}} -->
<div class="wp-block-group oe-pagebody">
	<?php echo openmu_eclipse_plugin_block( 'openmu/account', array( 'align' => 'wide' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- block markup. ?>
</div>
<!-- /wp:group -->
