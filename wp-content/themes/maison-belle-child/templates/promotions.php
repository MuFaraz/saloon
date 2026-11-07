<?php
/**
 * Template Name: Promotions
 *
 * Offer cards. Items come from the Promotions post type (Promotions → Add New).
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

get_header();

mb_page_hero_for_page(
	array(
		'eyebrow' => __( 'Promotions', 'maison-belle-child' ),
		'title'   => __( 'Little *indulgences*', 'maison-belle-child' ),
	)
);

$mb_promos = function_exists( 'mb_get_promotions' ) ? mb_get_promotions() : array();
?>

<section class="section" aria-label="<?php esc_attr_e( 'Current offers', 'maison-belle-child' ); ?>">
	<div class="container-x">
		<?php if ( $mb_promos ) : ?>
			<ul class="promo-grid">
				<?php foreach ( $mb_promos as $mb_i => $mb_promo ) : ?>
					<li class="reveal promo-grid__item"<?php echo mb_delay( $mb_i * 100 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<article class="promo group">
							<div class="promo__blob" aria-hidden="true"></div>
							<span class="promo__icon"><?php echo mb_icon( $mb_promo['icon'], 'ico ico--xl' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
							<?php if ( $mb_promo['tag'] ) : ?>
								<p class="eyebrow promo__tag"><?php echo esc_html( $mb_promo['tag'] ); ?></p>
							<?php endif; ?>
							<h2 class="display-md promo__title"><?php echo esc_html( $mb_promo['title'] ); ?></h2>
							<?php if ( $mb_promo['highlight'] ) : ?>
								<p class="promo__highlight"><?php echo esc_html( $mb_promo['highlight'] ); ?></p>
							<?php endif; ?>
							<div class="hairline promo__rule"></div>
							<p class="promo__text"><?php echo esc_html( $mb_promo['text'] ); ?></p>
							<?php if ( $mb_promo['fine'] ) : ?>
								<p class="promo__fine"><?php echo esc_html( $mb_promo['fine'] ); ?></p>
							<?php endif; ?>
							<?php mb_button( array( 'label' => $mb_promo['cta_label'], 'href' => $mb_promo['cta_url'], 'class' => 'promo__cta' ) ); ?>
						</article>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php else : ?>
			<p><?php esc_html_e( 'No offers right now. Please check back soon.', 'maison-belle-child' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php
mb_cta_banner();
get_footer();
