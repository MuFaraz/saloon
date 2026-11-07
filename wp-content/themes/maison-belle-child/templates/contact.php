<?php
/**
 * Template Name: Contact
 *
 * Contact details, social links, Contact Form 7 form and the Google Map.
 * Details come from Salon Settings; the form is the Contact Form 7 form whose ID is
 * set in Salon Settings → Contact, hours & booking.
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

get_header();

mb_page_hero_for_page(
	array(
		'eyebrow' => __( 'Contact', 'maison-belle-child' ),
		'title'   => __( 'Say *hello*', 'maison-belle-child' ),
	)
);
?>

<section class="section" aria-label="<?php esc_attr_e( 'Contact details', 'maison-belle-child' ); ?>">
	<div class="container-x contact__grid">
		<div class="reveal contact__info">
			<h2 class="display-md"><?php esc_html_e( 'Find us', 'maison-belle-child' ); ?></h2>
			<ul class="contact__list">
				<li class="contact__row">
					<span class="contact__icon"><?php echo mb_icon( 'pin', 'ico ico--md' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<div>
						<h3 class="info-row__label"><?php esc_html_e( 'Address', 'maison-belle-child' ); ?></h3>
						<div class="contact__value"><p><?php echo esc_html( mb_full_address() ); ?></p></div>
					</div>
				</li>
				<li class="contact__row">
					<span class="contact__icon"><?php echo mb_icon( 'phone', 'ico ico--md' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<div>
						<h3 class="info-row__label"><?php esc_html_e( 'Phone', 'maison-belle-child' ); ?></h3>
						<div class="contact__value"><a href="tel:<?php echo esc_attr( mb_phone_tel() ); ?>"><?php echo esc_html( mb_s( 'phone' ) ); ?></a></div>
					</div>
				</li>
				<li class="contact__row">
					<span class="contact__icon"><?php echo mb_icon( 'mail', 'ico ico--md' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<div>
						<h3 class="info-row__label"><?php esc_html_e( 'Email', 'maison-belle-child' ); ?></h3>
						<div class="contact__value"><a href="mailto:<?php echo esc_attr( mb_s( 'email' ) ); ?>" class="break-all"><?php echo esc_html( mb_s( 'email' ) ); ?></a></div>
					</div>
				</li>
				<li class="contact__row">
					<span class="contact__icon"><?php echo mb_icon( 'clock', 'ico ico--md' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<div class="info-row__hours">
						<h3 class="info-row__label"><?php esc_html_e( 'Hours', 'maison-belle-child' ); ?></h3>
						<div class="info-row__hours-list"><?php mb_hours_list(); ?></div>
					</div>
				</li>
			</ul>
			<?php mb_social_links( 'contact__social', 'social-link' ); ?>
			<div class="contact__actions">
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

		<div class="reveal contact__form" style="--d:100ms">
			<h2 class="display-md contact__form-title"><?php esc_html_e( 'Send a message', 'maison-belle-child' ); ?></h2>
			<?php mb_contact_form(); ?>
			<?php /* Shown by main.js after the form is sent (replaces the form, like the approved design). */ ?>
			<div class="form-success" role="status" hidden data-form-success>
				<span class="form-success__icon"><?php echo mb_icon( 'check', 'ico ico--xl' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<h3 class="display-md form-success__title"><?php esc_html_e( 'Thank you', 'maison-belle-child' ); ?><span data-form-name></span>.</h3>
				<p class="form-success__text"><?php esc_html_e( 'Your message has been received. We will reply within one business day.', 'maison-belle-child' ); ?></p>
				<button type="button" class="btn btn-outline btn-sm form-success__again" data-form-again><?php esc_html_e( 'Send another message', 'maison-belle-child' ); ?></button>
			</div>
		</div>
	</div>
</section>

<section class="contact__map" aria-label="<?php esc_attr_e( 'Map', 'maison-belle-child' ); ?>">
	<div class="container-x">
		<?php mb_map_embed( 'map--tall' ); ?>
	</div>
</section>

<?php
get_footer();
