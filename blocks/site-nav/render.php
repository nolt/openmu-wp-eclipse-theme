<?php
/**
 * Render of the openmu-eclipse/site-nav block: the header menu.
 *
 * Markup contract with assets/js/nav.js and assets/css/theme.css:
 * - .oe-nav__toggle opens the full-screen panel on phones (aria-expanded);
 * - .oe-nav__sub-toggle opens a submenu (works with hover, keyboard and touch);
 * - without JavaScript the panel is simply a visible list (class "oe-js" is absent).
 *
 * @package OpenMU_Eclipse
 */

defined( 'ABSPATH' ) || exit;

$openmu_menu = openmu_eclipse_menu();
if ( ! $openmu_menu ) {
	return;
}
?>
<nav
<?php
// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- core helper escapes.
echo get_block_wrapper_attributes(
	array(
		'class'      => 'oe-nav',
		'aria-label' => __( 'Main menu', 'openmu-eclipse' ),
	)
);
?>
data-oe-nav>
	<button type="button" class="oe-nav__toggle" aria-expanded="false" aria-controls="oe-nav-panel">
		<span class="oe-nav__burger" aria-hidden="true"><span></span><span></span><span></span></span>
		<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'openmu-eclipse' ); ?></span>
	</button>
	<div class="oe-nav__panel" id="oe-nav-panel">
		<ul class="oe-nav__list">
			<?php foreach ( $openmu_menu as $openmu_entry ) : ?>
				<?php if ( ! empty( $openmu_entry['children'] ) ) : ?>
					<?php
					$openmu_active = false;
					foreach ( $openmu_entry['children'] as $openmu_child ) {
						$openmu_active = $openmu_active || openmu_eclipse_menu_is_current( $openmu_child['slug'] );
					}
					?>
					<li class="oe-nav__item oe-nav__item--parent<?php echo $openmu_active ? ' is-current' : ''; ?>">
						<button type="button" class="oe-nav__link oe-nav__sub-toggle" aria-expanded="false" aria-haspopup="true">
							<?php echo esc_html( $openmu_entry['label'] ); ?>
							<span class="oe-nav__caret" aria-hidden="true"></span>
						</button>
						<ul class="oe-nav__sub">
							<?php foreach ( $openmu_entry['children'] as $openmu_child ) : ?>
								<?php $openmu_current = openmu_eclipse_menu_is_current( $openmu_child['slug'] ); ?>
								<li>
									<a class="oe-nav__sublink<?php echo $openmu_current ? ' is-current' : ''; ?>" href="<?php echo esc_url( $openmu_child['url'] ); ?>"<?php echo $openmu_current ? ' aria-current="page"' : ''; ?>>
										<?php echo openmu_eclipse_icon( 'mini-games' === $openmu_child['slug'] ? 'minigames' : $openmu_child['slug'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built by the helper. ?>
										<?php echo esc_html( $openmu_child['label'] ); ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</li>
				<?php else : ?>
					<?php $openmu_current = openmu_eclipse_menu_is_current( $openmu_entry['slug'] ); ?>
					<li class="oe-nav__item<?php echo $openmu_current ? ' is-current' : ''; ?>">
						<a class="oe-nav__link" href="<?php echo esc_url( $openmu_entry['url'] ); ?>"<?php echo $openmu_current ? ' aria-current="page"' : ''; ?><?php echo '' !== $openmu_entry['hint'] ? ' title="' . esc_attr( $openmu_entry['hint'] ) . '"' : ''; ?>><?php echo esc_html( $openmu_entry['label'] ); ?></a>
					</li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
		<a class="oe-nav__play wp-element-button" href="<?php echo esc_url( openmu_eclipse_page_url( 'download' ) ); ?>"><?php esc_html_e( 'Play now', 'openmu-eclipse' ); ?></a>
	</div>
</nav>
