<?php
/**
 * Blocks, block styles, pattern categories and the helpers the patterns use.
 *
 * The theme has three server-rendered ("dynamic") blocks in blocks/: the header menu
 * (site-nav), the eclipse scene (scene) and the three-class showcase (class-showcase).
 * They are registered from their block.json files; "autoRegister" lets the editor show
 * them without any editor script.
 *
 * @package OpenMU_Eclipse
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registers the theme's dynamic blocks from blocks/<name>/block.json.
 */
function openmu_eclipse_register_blocks(): void {
	foreach ( array( 'site-nav', 'scene', 'class-showcase' ) as $name ) {
		register_block_type( get_theme_file_path( 'blocks/' . $name ) );
	}
}
add_action( 'init', 'openmu_eclipse_register_blocks' );

/**
 * Registers the block styles the theme's CSS provides, and the pattern categories.
 */
function openmu_eclipse_register_styles_and_categories(): void {
	// "mu-window" is the name the OpenMU WP Connect plugin puts on its event windows, so it
	// has to exist under exactly this name; the other styles are the theme's own.
	register_block_style(
		'core/group',
		array(
			'name'  => 'mu-window',
			'label' => __( 'Window', 'openmu-eclipse' ),
		)
	);
	register_block_style(
		'core/group',
		array(
			'name'  => 'oe-glass',
			'label' => __( 'Glass panel', 'openmu-eclipse' ),
		)
	);
	register_block_style(
		'core/group',
		array(
			'name'  => 'oe-card',
			'label' => __( 'Card', 'openmu-eclipse' ),
		)
	);
	register_block_style(
		'core/heading',
		array(
			'name'  => 'oe-ornate',
			'label' => __( 'Ornate (centred, with divider)', 'openmu-eclipse' ),
		)
	);
	register_block_style(
		'core/button',
		array(
			'name'  => 'oe-ghost',
			'label' => __( 'Ghost', 'openmu-eclipse' ),
		)
	);

	register_block_pattern_category( 'openmu-eclipse', array( 'label' => __( 'OpenMU Eclipse', 'openmu-eclipse' ) ) );
	register_block_pattern_category( 'openmu-eclipse-pages', array( 'label' => __( 'OpenMU Eclipse pages', 'openmu-eclipse' ) ) );
}
add_action( 'init', 'openmu_eclipse_register_styles_and_categories' );

/**
 * Returns the address of a file in assets/art/, or '' when the file does not exist (yet).
 *
 * Callers leave the image out for '' so a missing picture is a CSS fallback rather than a
 * 404 in the console.
 *
 * @param string $path Path inside assets/art/, e.g. "scene/eclipse.svg".
 * @return string
 */
function openmu_eclipse_art_url( string $path ): string {
	return file_exists( get_theme_file_path( 'assets/art/' . $path ) ) ? get_theme_file_uri( 'assets/art/' . $path ) : '';
}

/**
 * Returns an <img> tag for a file of assets/art/, or '' when the file is missing.
 *
 * @param string               $path  Path inside assets/art/.
 * @param array<string,string> $attrs Extra attributes (class, alt, loading ...).
 * @return string
 */
function openmu_eclipse_art_img( string $path, array $attrs = array() ): string {
	$url = openmu_eclipse_art_url( $path );
	if ( '' === $url ) {
		return '';
	}
	$attrs += array(
		'alt'      => '',
		'decoding' => 'async',
		'loading'  => 'lazy',
	);
	$html   = '<img src="' . esc_url( $url ) . '"';
	foreach ( $attrs as $key => $value ) {
		$html .= ' ' . esc_attr( $key ) . '="' . esc_attr( $value ) . '"';
	}
	return $html . ' />';
}

/**
 * Returns the markup of an OpenMU WP Connect block, or a notice when the plugin is not active.
 *
 * Used by the patterns with server data. Without the plugin the unknown block would render
 * as nothing, and the page would look broken instead of telling the admin what is missing.
 *
 * @param string               $name       Block name, e.g. "openmu/ranking".
 * @param array<string, mixed> $attributes Block attributes.
 * @return string Block markup.
 */
function openmu_eclipse_plugin_block( string $name, array $attributes = array() ): string {
	if ( WP_Block_Type_Registry::get_instance()->is_registered( $name ) ) {
		return '<!-- wp:' . $name . ( $attributes ? ' ' . wp_json_encode( $attributes ) : '' ) . ' /-->';
	}

	$notice = sprintf(
		/* translators: %s: plugin name. */
		__( 'This section shows data from the game server. It needs the %s plugin: install and activate it.', 'openmu-eclipse' ),
		'OpenMU WP Connect'
	);
	return '<!-- wp:group {"className":"is-style-oe-glass","layout":{"type":"default"}} --><div class="wp-block-group is-style-oe-glass">'
		. '<!-- wp:paragraph --><p>' . esc_html( $notice ) . '</p><!-- /wp:paragraph --></div><!-- /wp:group -->';
}

/**
 * Returns the markup of an icon: a mask of assets/art/icons/<name>.svg painted in the text colour.
 *
 * @param string $name  Icon file name without extension, e.g. "download".
 * @param string $extra Extra CSS classes.
 * @return string
 */
function openmu_eclipse_icon( string $name, string $extra = '' ): string {
	return '<span class="oe-icon oe-icon--' . esc_attr( $name ) . ( $extra ? ' ' . esc_attr( $extra ) : '' ) . '" aria-hidden="true"></span>';
}

/**
 * Renders the eclipse scene: the stacked, parallax-ready layers behind the hero or the page.
 *
 * "hero" is the full scene inside the home page's hero; "ambient" is the calmer, fixed
 * version behind every page. Both are decorative (aria-hidden). Layers whose SVG from
 * assets/art/scene/ does not exist yet are left out; the CSS then draws a simple stand-in.
 *
 * @param string $variant "hero" or "ambient".
 * @return string
 */
function openmu_eclipse_render_scene( string $variant = 'ambient' ): string {
	$variant = 'hero' === $variant ? 'hero' : 'ambient';
	// Per layer: file, parallax depth (how far it moves with scroll/pointer: far = small).
	$layers = array(
		'sun'    => array( 'scene/eclipse.svg', '0.04' ),
		'far'    => array( 'scene/mountains-far.svg', '0.10' ),
		'castle' => array( 'scene/castle.svg', '0.16' ),
		'near'   => array( 'scene/mountains-near.svg', '0.22' ),
		'fog'    => array( 'scene/fog.svg', '0.30' ),
	);
	$eager  = 'hero' === $variant ? 'eager' : 'lazy';

	ob_start();
	?>
	<div class="oe-scene oe-scene--<?php echo esc_attr( $variant ); ?>" aria-hidden="true" data-oe-scene="<?php echo esc_attr( $variant ); ?>">
		<div class="oe-scene__sky"></div>
		<div class="oe-scene__stars"></div>
		<?php foreach ( $layers as $key => $layer ) : ?>
			<?php $img = openmu_eclipse_art_img( $layer[0], array( 'loading' => $eager ) ); ?>
			<div class="oe-scene__layer oe-scene__layer--<?php echo esc_attr( $key ); ?><?php echo '' === $img ? ' is-fallback' : ''; ?>" style="--d:<?php echo esc_attr( $layer[1] ); ?>">
				<?php if ( 'sun' === $key ) : ?>
					<span class="oe-scene__corona"></span>
					<span class="oe-scene__disc"></span>
				<?php endif; ?>
				<?php echo $img; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built by openmu_eclipse_art_img(). ?>
			</div>
		<?php endforeach; ?>
		<div class="oe-scene__vignette"></div>
		<canvas class="oe-scene__embers" data-oe-embers></canvas>
	</div>
	<?php
	return (string) ob_get_clean();
}

/**
 * Returns the address of the emblem, or a plain inline diamond when emblem.svg is missing.
 *
 * @return string
 */
function openmu_eclipse_emblem_url(): string {
	$url = openmu_eclipse_art_url( 'logo/emblem.svg' );
	if ( '' !== $url ) {
		return $url;
	}
	return 'data:image/svg+xml,' . rawurlencode( '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><circle cx="16" cy="16" r="9" fill="#000" stroke="#e8b75a" stroke-width="2"/></svg>' );
}

/**
 * Returns block markup for the banner at the top of a subpage: eyebrow with icon, the page
 * title (editable in the page itself), a lead line and the ornament divider.
 *
 * @param string $icon    Icon name (file in assets/art/icons/), e.g. "ranking".
 * @param string $eyebrow Small label above the title.
 * @param string $lead    Sentence under the title; '' for none.
 * @return string Block markup.
 */
function openmu_eclipse_pagehead( string $icon, string $eyebrow, string $lead = '' ): string {
	$markup  = '<!-- wp:group {"className":"oe-pagehead","layout":{"type":"constrained"}} --><div class="wp-block-group oe-pagehead">';
	$markup .= '<!-- wp:paragraph {"align":"center","className":"oe-pagehead__eyebrow"} --><p class="has-text-align-center oe-pagehead__eyebrow">' . openmu_eclipse_icon( $icon ) . esc_html( $eyebrow ) . '</p><!-- /wp:paragraph -->';
	$markup .= '<!-- wp:post-title {"textAlign":"center","level":1} /-->';
	if ( '' !== $lead ) {
		$markup .= '<!-- wp:paragraph {"align":"center","className":"oe-pagehead__lead"} --><p class="has-text-align-center oe-pagehead__lead">' . esc_html( $lead ) . '</p><!-- /wp:paragraph -->';
	}
	$markup .= '<!-- wp:html --><div class="oe-orn" aria-hidden="true"></div><!-- /wp:html -->';
	return $markup . '</div><!-- /wp:group -->';
}

/**
 * Returns block markup for a list of links to the theme's pages.
 *
 * @param array<int, string> $slugs Page addresses; the label is the page's own title.
 * @return string Block markup.
 */
function openmu_eclipse_page_links( array $slugs ): string {
	$items = '';
	foreach ( $slugs as $slug ) {
		$page   = openmu_eclipse_public_page( $slug );
		$name   = $page ? get_the_title( $page ) : ucfirst( str_replace( '-', ' ', $slug ) );
		$items .= '<!-- wp:list-item --><li><a href="' . esc_url( openmu_eclipse_page_url( $slug ) ) . '">' . esc_html( $name ) . '</a></li><!-- /wp:list-item -->';
	}
	return '<!-- wp:list {"className":"oe-links"} --><ul class="wp-block-list oe-links">' . $items . '</ul><!-- /wp:list -->';
}

/**
 * Returns block markup for the news card used by the home page and the news archive:
 * picture, date and category, title, excerpt. Must be placed inside a post template.
 *
 * @return string Block markup.
 */
function openmu_eclipse_post_card(): string {
	return '<!-- wp:group {"className":"oe-card","layout":{"type":"default"}} --><div class="wp-block-group oe-card">'
		. '<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/10","sizeSlug":"openmu-eclipse-card"} /-->'
		. '<!-- wp:group {"className":"oe-card__body","layout":{"type":"default"}} --><div class="wp-block-group oe-card__body">'
		. '<!-- wp:group {"className":"oe-card__meta","layout":{"type":"flex","flexWrap":"wrap"}} --><div class="wp-block-group oe-card__meta">'
		. '<!-- wp:post-date /--><!-- wp:post-terms {"term":"category"} /-->'
		. '</div><!-- /wp:group -->'
		. '<!-- wp:post-title {"level":3,"isLink":true} /-->'
		. '<!-- wp:post-excerpt {"moreText":"' . esc_attr( __( 'Read more', 'openmu-eclipse' ) ) . '","excerptLength":24} /-->'
		. '</div><!-- /wp:group --></div><!-- /wp:group -->';
}

/**
 * Gives posts without a featured image a varied picture on the news cards.
 *
 * core/post-featured-image renders nothing when a post has no image. For the cards
 * (size "openmu-eclipse-card") this filter returns a small composition built from the
 * theme's own art (eclipse, mountains, castle, one of the three heroes) on a sky whose
 * hue depends on the post ID, so neighbouring cards differ but a post always looks the same.
 *
 * @param mixed    $content  Rendered block (empty when there is no image); not typed,
 *                           because a filter of another plugin may hand over null.
 * @param array    $block    Parsed block.
 * @param WP_Block $instance Block instance (carries the post ID in its context).
 * @return string
 */
function openmu_eclipse_card_fallback( $content, array $block, $instance ): string {
	$content = (string) $content;
	if ( '' !== trim( $content ) || ( $block['attrs']['sizeSlug'] ?? '' ) !== 'openmu-eclipse-card' ) {
		return $content;
	}
	$post_id = (int) ( $instance->context['postId'] ?? 0 );
	// Variant: layers (art files, back to front) and the sky hue shift in degrees.
	$variants = array(
		array( array( 'scene/eclipse.svg', 'sun' ), array( 'scene/mountains-near.svg', 'ground' ) ),
		array( array( 'scene/eclipse.svg', 'sun' ), array( 'characters/dark-knight.svg', 'hero' ) ),
		array( array( 'scene/mountains-far.svg', 'ground' ), array( 'characters/dark-wizard.svg', 'hero' ) ),
		array( array( 'scene/eclipse.svg', 'sun' ), array( 'characters/fairy-elf.svg', 'hero' ) ),
		array( array( 'scene/mountains-far.svg', 'ground' ), array( 'scene/castle.svg', 'castle' ), array( 'scene/fog.svg', 'fog' ) ),
		array( array( 'scene/eclipse.svg', 'sun' ), array( 'scene/castle.svg', 'castle' ), array( 'scene/mountains-near.svg', 'ground' ) ),
	);
	$hues     = array( 0, 40, -35, 90, 150, -70 );
	$pick     = $post_id % count( $variants );

	$html = '';
	foreach ( $variants[ $pick ] as $layer ) {
		$html .= openmu_eclipse_art_img( $layer[0], array( 'class' => 'oe-fallback__' . $layer[1] ) );
	}
	return '<figure class="wp-block-post-featured-image oe-fallback oe-fallback--' . (int) $pick . '" style="--hue:' . (int) $hues[ $pick ] . 'deg" aria-hidden="true"><span class="oe-fallback__sky"></span>' . $html . '</figure>';
}
add_filter( 'render_block_core/post-featured-image', 'openmu_eclipse_card_fallback', 10, 3 );

/**
 * Hides the category label when the post only has the default category ("Uncategorized"),
 * which tells visitors nothing.
 *
 * @param mixed  $content Rendered post-terms block; not typed, another filter may hand over null.
 * @param array  $block   Parsed block.
 * @return string
 */
function openmu_eclipse_hide_default_category( $content, array $block ): string {
	$content = (string) $content;
	if ( 'category' !== ( $block['attrs']['term'] ?? '' ) ) {
		return $content;
	}
	$default = (int) get_option( 'default_category' );
	$terms   = get_the_category();
	if ( 1 === count( $terms ) && $terms[0]->term_id === $default ) {
		return '';
	}
	return $content;
}
add_filter( 'render_block_core/post-terms', 'openmu_eclipse_hide_default_category', 10, 2 );

/**
 * Adds a visible name to the empty sockets of the plugin's character view.
 *
 * The plugin writes "<slot>: empty" for screen readers only. This takes the slot name from
 * that text (so it is already in the site language) and adds it as a faint label, which
 * the paper-doll layout in plugin.css shows in each empty socket.
 *
 * @param mixed $content Rendered armory or account block; not typed, another filter may hand over null.
 * @return string The block with the labels, or unchanged when the pattern cannot be applied.
 */
function openmu_eclipse_label_empty_sockets( $content ): string {
	$content = (string) $content;
	// preg_replace() returns null on a PCRE error (backtrack limit, broken UTF-8); the block
	// must then stay as the plugin rendered it rather than disappear.
	$labelled = preg_replace(
		'#(<li class="openmu-cv__slot [^"]*is-empty">\s*<span class="openmu-cv__sr">\s*)([^<:]+?)(\s*:[^<]*</span>)#u',
		'$1$2$3<span class="oe-slot-label" aria-hidden="true">$2</span>',
		$content
	);
	return null === $labelled ? $content : $labelled;
}

/**
 * Leaves out the OpenMU plugin's blocks on a page that still asks for its password.
 *
 * The page templates place the plugin's blocks (ranking, armory, account ...) next to the
 * page's own content, not inside it, so the password form of the content would not cover
 * them. Hooked to render_block.
 *
 * @param mixed                $content Rendered block; not typed, another filter may hand over null.
 * @param array<string, mixed> $block   Parsed block.
 * @return mixed The block, or an empty string on a locked page.
 */
function openmu_eclipse_hide_plugin_blocks_on_locked_page( $content, array $block ) {
	if ( str_starts_with( (string) ( $block['blockName'] ?? '' ), 'openmu/' ) && is_singular() && post_password_required( get_queried_object_id() ) ) {
		return '';
	}
	return $content;
}
add_filter( 'render_block', 'openmu_eclipse_hide_plugin_blocks_on_locked_page', 10, 2 );
add_filter( 'render_block_openmu/armory', 'openmu_eclipse_label_empty_sockets' );
add_filter( 'render_block_openmu/account', 'openmu_eclipse_label_empty_sockets' );
