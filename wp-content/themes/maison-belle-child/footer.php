<?php
/**
 * Site footer: four columns, oversized wordmark, legal row, mobile Call/Book bar.
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

$mb_name   = (string) mb_s( 'salon_name', get_bloginfo( 'name' ) );
$mb_cats   = function_exists( 'mb_get_service_categories' ) ? mb_get_service_categories() : array();
$mb_policy = get_page_by_path( 'policy' );
$mb_credit = (string) mb_s( 'footer_credit' );
?>
</main>

<footer class="site-footer on-dark">
	<div class="hairline"></div>
	<div class="container-x site-footer__main">
		<div class="site-footer__grid">
			<div class="site-footer__brand">
				<?php mb_wordmark( true ); ?>
				<p class="site-footer__blurb"><?php echo esc_html( mb_s( 'footer_blurb' ) ); ?></p>
				<?php mb_social_links( 'social-list', 'social-link social-link--dark' ); ?>
			</div>

			<nav aria-label="<?php esc_attr_e( 'Footer', 'maison-belle-child' ); ?>" class="site-footer__explore">
				<h2 class="eyebrow footer-title footer-title--explore"><?php esc_html_e( 'Explore', 'maison-belle-child' ); ?></h2>
				<?php mb_nav( 'footer', 'footer', 'footer-list' ); ?>
				<?php if ( $mb_cats ) : ?>
					<ul class="footer-list footer-list--services">
						<?php foreach ( $mb_cats as $mb_cat ) : ?>
							<li><a href="<?php echo esc_url( mb_page_url( 'services' ) . '#' . $mb_cat->slug ); ?>"><?php echo esc_html( $mb_cat->name ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</nav>

			<div class="site-footer__hours">
				<h2 class="eyebrow footer-title"><?php esc_html_e( 'Opening hours', 'maison-belle-child' ); ?></h2>
				<div class="site-footer__hours-list"><?php mb_hours_list( true ); ?></div>
				<?php if ( mb_s( 'footer_hours_note' ) ) : ?>
					<p class="site-footer__note"><?php echo esc_html( mb_s( 'footer_hours_note' ) ); ?></p>
				<?php endif; ?>
			</div>

			<div class="site-footer__visit">
				<h2 class="eyebrow footer-title"><?php esc_html_e( 'Visit us', 'maison-belle-child' ); ?></h2>
				<address class="site-footer__address">
					<p>
						<?php echo esc_html( mb_s( 'street' ) ); ?><br>
						<?php echo esc_html( mb_s( 'city' ) . ', ' . mb_s( 'region' ) . ' ' . mb_s( 'postal' ) ); ?>
					</p>
					<p>
						<a href="tel:<?php echo esc_attr( mb_phone_tel() ); ?>"><?php echo esc_html( mb_s( 'phone' ) ); ?></a><br>
						<a href="mailto:<?php echo esc_attr( mb_s( 'email' ) ); ?>"><?php echo esc_html( mb_s( 'email' ) ); ?></a>
					</p>
					<a href="<?php echo esc_url( mb_maps_url() ); ?>" target="_blank" rel="noopener noreferrer" class="site-footer__directions"><?php esc_html_e( 'Get directions', 'maison-belle-child' ); ?></a>
				</address>
				<?php mb_book_button( array( 'variant' => 'light', 'size' => 'sm', 'class' => 'site-footer__book' ) ); ?>
			</div>
		</div>
	</div>

	<div class="site-footer__giant" aria-hidden="true">
		<p data-text="<?php echo esc_attr( mb_s( 'wordmark_main', $mb_name ) ); ?>"></p>
	</div>

	<div class="site-footer__legal">
		<div class="container-x site-footer__legal-inner">
			<p>&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php echo esc_html( $mb_name ); ?>. <?php esc_html_e( 'All rights reserved.', 'maison-belle-child' ); ?></p>
			<?php if ( $mb_credit ) : ?>
				<p class="site-footer__credit"><?php echo esc_html( $mb_credit ); ?></p>
			<?php endif; ?>
			<?php if ( $mb_policy ) : ?>
				<a href="<?php echo esc_url( get_permalink( $mb_policy ) ); ?>"><?php echo esc_html( mb_s( 'footer_policy' ) ); ?></a>
			<?php endif; ?>
		</div>
	</div>
</footer>

<?php /* Sticky bottom action bar: mobile only. */ ?>
<div class="mobile-bar">
	<div class="mobile-bar__inner">
		<a href="tel:<?php echo esc_attr( mb_phone_tel() ); ?>" class="btn btn-outline btn--grow" aria-label="<?php echo esc_attr( sprintf( /* translators: %s: phone number. */ __( 'Call %s', 'maison-belle-child' ), mb_s( 'phone' ) ) ); ?>">
			<?php echo mb_icon( 'phone', 'ico ico--sm' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php esc_html_e( 'Call', 'maison-belle-child' ); ?>
		</a>
		<?php mb_book_button( array( 'class' => 'btn--grow' ) ); ?>
	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>
