<?php
/**
 * Home: "Visit us" with details and map.
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="section" aria-label="<?php esc_attr_e( 'Visit us', 'maison-belle-child' ); ?>">
	<div class="container-x visit__grid">
		<div class="visit__info">
			<?php
			mb_section_heading(
				array(
					'align'   => 'left',
					'eyebrow' => mb_s( 'visit_eyebrow' ),
					'title'   => mb_s( 'visit_title' ),
				)
			);
			?>
			<div class="reveal visit__rows" style="--d:100ms">
				<div class="info-row">
					<?php echo mb_icon( 'pin', 'ico ico--lg info-row__icon' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<div>
						<h3 class="info-row__label"><?php esc_html_e( 'Address', 'maison-belle-child' ); ?></h3>
						<p class="info-row__value"><?php echo esc_html( mb_full_address() ); ?></p>
					</div>
				</div>
				<div class="info-row">
					<?php echo mb_icon( 'phone', 'ico ico--lg info-row__icon' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<div>
						<h3 class="info-row__label"><?php esc_html_e( 'Call or email', 'maison-belle-child' ); ?></h3>
						<p class="info-row__value"><a href="tel:<?php echo esc_attr( mb_phone_tel() ); ?>"><?php echo esc_html( mb_s( 'phone' ) ); ?></a></p>
						<p class="info-row__mail"><a href="mailto:<?php echo esc_attr( mb_s( 'email' ) ); ?>"><?php echo mb_icon( 'mail', 'ico ico--sm' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> <?php echo esc_html( mb_s( 'email' ) ); ?></a></p>
					</div>
				</div>
				<div class="info-row">
					<?php echo mb_icon( 'clock', 'ico ico--lg info-row__icon' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<div class="info-row__hours">
						<h3 class="info-row__label"><?php esc_html_e( 'Hours', 'maison-belle-child' ); ?></h3>
						<div class="info-row__hours-list"><?php mb_hours_list(); ?></div>
					</div>
				</div>
				<div class="visit__actions">
					<?php
					mb_book_button();
					mb_button(
						array(
							'label'   => __( 'Directions', 'maison-belle-child' ),
							'href'    => mb_maps_url(),
							'variant' => 'outline',
						)
					);
					?>
				</div>
			</div>
		</div>
		<div class="reveal visit__map">
			<?php mb_map_embed( 'map--fill' ); ?>
		</div>
	</div>
</section>
