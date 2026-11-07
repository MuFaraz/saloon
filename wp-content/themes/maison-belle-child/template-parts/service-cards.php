<?php
/**
 * Home: four service category cards.
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

$mb_menu = function_exists( 'mb_get_services_menu' ) ? mb_get_services_menu() : array();
if ( ! $mb_menu ) {
	return;
}
?>
<section class="section" aria-label="<?php esc_attr_e( 'Services', 'maison-belle-child' ); ?>">
	<div class="container-x">
		<?php
		mb_section_heading(
			array(
				'eyebrow' => mb_s( 'services_eyebrow' ),
				'title'   => mb_s( 'services_title' ),
				'intro'   => mb_s( 'services_intro' ),
			)
		);
		?>
		<ul class="service-grid">
			<?php foreach ( $mb_menu as $mb_i => $mb_cat ) : ?>
				<li class="reveal"<?php echo mb_delay( $mb_i * 90 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<a href="<?php echo esc_url( mb_page_url( 'services' ) . '#' . $mb_cat['id'] ); ?>" class="service-card group">
						<?php
						mb_image(
							array(
								'id'    => $mb_cat['image_id'],
								'alt'   => $mb_cat['alt'] ? $mb_cat['alt'] : $mb_cat['name'],
								'tone'  => $mb_cat['tone'],
								'icon'  => $mb_cat['icon'],
								'shape' => 'arch-soft',
								'class' => 'service-card__img',
								'sizes' => '(min-width: 1024px) 22vw, (min-width: 640px) 45vw, 90vw',
							)
						);
						?>
						<div class="service-card__body">
							<span class="service-card__badge"><?php echo mb_icon( $mb_cat['icon'], 'ico ico--lg' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
							<span class="service-card__num">0<?php echo (int) ( $mb_i + 1 ); ?></span>
							<h3 class="display-md service-card__title"><?php echo esc_html( $mb_cat['name'] ); ?></h3>
							<p class="service-card__short"><?php echo esc_html( $mb_cat['short'] ); ?></p>
							<div class="service-card__foot">
								<span class="service-card__from">
									<?php
									/* translators: %s: lowest price in the category, e.g. $28. */
									echo esc_html( sprintf( __( 'From %s', 'maison-belle-child' ), mb_format_price( $mb_cat['from'] ) ) );
									?>
								</span>
								<span class="service-card__more"><?php esc_html_e( 'Explore', 'maison-belle-child' ); ?> <?php echo mb_icon( 'arrow', 'ico ico--sm' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
							</div>
						</div>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
