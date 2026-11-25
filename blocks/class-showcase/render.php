<?php
/**
 * Render of the openmu-eclipse/class-showcase block: a stage with the three characters, tabs
 * to switch between them and a panel per class.
 *
 * Markup contract with assets/js/showcase.js: each .oe-class-tab controls the panel and
 * figure with the same data-class; the active one carries .is-active. Without JavaScript
 * only the first class is visible, tabs are plain buttons (the page stays complete).
 * Class names, skills and ratings are game terms: they stay English in every language.
 *
 * @package OpenMU_Eclipse
 */

defined( 'ABSPATH' ) || exit;

// Per class: art file, short mark, role line, description, four 1-5 ratings, signature skills.
$openmu_classes = array(
	'dark-knight' => array(
		'name'    => 'Dark Knight',
		'mark'    => 'DK',
		'role'    => __( 'Frontline warrior', 'openmu-eclipse' ),
		'text'    => __( 'Heavy plate, a mighty blade and a wall of vitality. The Dark Knight leads the charge, soaks the hits and cuts down whole packs with sweeping strikes.', 'openmu-eclipse' ),
		'ratings' => array(
			'attack'  => 4,
			'defence' => 5,
			'range'   => 1,
			'support' => 2,
		),
		'skills'  => array( 'Falling Slash', 'Lunge', 'Uppercut', 'Cyclone' ),
	),
	'dark-wizard' => array(
		'name'    => 'Dark Wizard',
		'mark'    => 'DW',
		'role'    => __( 'Arcane artillery', 'openmu-eclipse' ),
		'text'    => __( 'Frail in the robe, devastating at range. The Dark Wizard hurls fire and lightning and brings down a pack of monsters before it reaches him.', 'openmu-eclipse' ),
		'ratings' => array(
			'attack'  => 5,
			'defence' => 1,
			'range'   => 5,
			'support' => 2,
		),
		'skills'  => array( 'Evil Spirit', 'Flame', 'Twister', 'Hellfire' ),
	),
	'fairy-elf'   => array(
		'name'    => 'Fairy Elf',
		'mark'    => 'ELF',
		'role'    => __( 'Archer and healer', 'openmu-eclipse' ),
		'text'    => __( 'Light armour, a longbow and the gift of the forest. The Fairy Elf shoots from afar, heals her party and lends it strength with her blessings.', 'openmu-eclipse' ),
		'ratings' => array(
			'attack'  => 3,
			'defence' => 2,
			'range'   => 5,
			'support' => 5,
		),
		'skills'  => array( 'Triple Shot', 'Heal', 'Greater Defense', 'Greater Damage' ),
	),
);

$openmu_rating_labels = array(
	'attack'  => __( 'Attack', 'openmu-eclipse' ),
	'defence' => __( 'Defence', 'openmu-eclipse' ),
	'range'   => __( 'Range', 'openmu-eclipse' ),
	'support' => __( 'Support', 'openmu-eclipse' ),
);
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'oe-classes' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- core helper escapes. ?> data-oe-showcase>
	<div class="oe-classes__stage">
		<span class="oe-classes__halo" aria-hidden="true"></span>
		<?php $openmu_first = true; ?>
		<?php foreach ( $openmu_classes as $openmu_slug => $openmu_class ) : ?>
			<figure class="oe-classes__figure<?php echo $openmu_first ? ' is-active' : ''; ?>" data-class="<?php echo esc_attr( $openmu_slug ); ?>">
				<?php
				$openmu_img = openmu_eclipse_art_img( 'characters/' . $openmu_slug . '.svg', array( 'alt' => $openmu_class['name'] ) );
				echo '' !== $openmu_img ? $openmu_img : '<span class="oe-classes__stand-in" aria-hidden="true">' . esc_html( $openmu_class['mark'] ) . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built by the helper.
				?>
			</figure>
			<?php $openmu_first = false; ?>
		<?php endforeach; ?>
	</div>

	<div class="oe-classes__info">
		<div class="oe-classes__tabs" role="tablist" aria-label="<?php esc_attr_e( 'Choose a class', 'openmu-eclipse' ); ?>">
			<?php $openmu_first = true; ?>
			<?php foreach ( $openmu_classes as $openmu_slug => $openmu_class ) : ?>
				<button type="button" role="tab" class="oe-class-tab<?php echo $openmu_first ? ' is-active' : ''; ?>" id="oe-tab-<?php echo esc_attr( $openmu_slug ); ?>" data-class="<?php echo esc_attr( $openmu_slug ); ?>" aria-selected="<?php echo $openmu_first ? 'true' : 'false'; ?>" aria-controls="oe-panel-<?php echo esc_attr( $openmu_slug ); ?>"<?php echo $openmu_first ? '' : ' tabindex="-1"'; ?>>
					<span class="oe-class-tab__mark"><?php echo esc_html( $openmu_class['mark'] ); ?></span>
					<span class="oe-class-tab__name"><?php echo esc_html( $openmu_class['name'] ); ?></span>
				</button>
				<?php $openmu_first = false; ?>
			<?php endforeach; ?>
		</div>

		<?php $openmu_first = true; ?>
		<?php foreach ( $openmu_classes as $openmu_slug => $openmu_class ) : ?>
			<div class="oe-classes__panel<?php echo $openmu_first ? ' is-active' : ''; ?>" role="tabpanel" id="oe-panel-<?php echo esc_attr( $openmu_slug ); ?>" aria-labelledby="oe-tab-<?php echo esc_attr( $openmu_slug ); ?>" data-class="<?php echo esc_attr( $openmu_slug ); ?>">
				<p class="oe-classes__role"><?php echo esc_html( $openmu_class['role'] ); ?></p>
				<h3 class="oe-classes__name"><?php echo esc_html( $openmu_class['name'] ); ?></h3>
				<p class="oe-classes__text"><?php echo esc_html( $openmu_class['text'] ); ?></p>
				<dl class="oe-classes__ratings">
					<?php foreach ( $openmu_class['ratings'] as $openmu_key => $openmu_value ) : ?>
						<div class="oe-rating">
							<dt><?php echo esc_html( $openmu_rating_labels[ $openmu_key ] ); ?></dt>
							<dd><span class="oe-rating__bar" role="img" aria-label="<?php echo esc_attr( sprintf( /* translators: 1: rating 1-5. */ __( '%d out of 5', 'openmu-eclipse' ), $openmu_value ) ); ?>">
							<?php
							for ( $openmu_n = 1; $openmu_n <= 5; $openmu_n++ ) :
								?>
								<i<?php echo $openmu_n <= $openmu_value ? ' class="is-on"' : ''; ?>></i><?php endfor; ?></span></dd>
						</div>
					<?php endforeach; ?>
				</dl>
				<ul class="oe-classes__skills" aria-label="<?php esc_attr_e( 'Signature skills', 'openmu-eclipse' ); ?>">
					<?php foreach ( $openmu_class['skills'] as $openmu_skill ) : ?>
						<li><?php echo esc_html( $openmu_skill ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php $openmu_first = false; ?>
		<?php endforeach; ?>
	</div>
</section>
