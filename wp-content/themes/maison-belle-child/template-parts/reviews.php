<?php
/**
 * Home: review carousel.
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

$mb_reviews = function_exists( 'mb_get_reviews' ) ? mb_get_reviews() : array();
if ( ! $mb_reviews ) {
	return;
}
$mb_total = count( $mb_reviews );

$mb_intro  = '<span class="reviews-intro"><span class="reviews-intro__star">' . mb_star_icon( 'ico ico--md' ) . '</span>';
/* translators: 1: rating value, 2: number of reviews. */
$mb_intro .= esc_html( sprintf( __( '%1$s average from %2$s clients', 'maison-belle-child' ), mb_s( 'rating_value' ), mb_s( 'rating_count' ) ) );
if ( mb_s( 'rating_note' ) ) {
	$mb_intro .= ' <span class="reviews-intro__note">' . esc_html( mb_s( 'rating_note' ) ) . '</span>';
}
$mb_intro .= '</span>';
?>
<section class="section section--clip" aria-label="<?php esc_attr_e( 'Reviews', 'maison-belle-child' ); ?>">
	<div class="container-x">
		<?php
		mb_section_heading(
			array(
				'eyebrow'    => mb_s( 'reviews_eyebrow' ),
				'title'      => mb_s( 'reviews_title' ),
				'intro_html' => $mb_intro,
			)
		);
		?>
		<div class="reveal reviews">
			<ul class="review-track no-scrollbar" tabindex="0" aria-label="<?php esc_attr_e( 'Client reviews', 'maison-belle-child' ); ?>" data-carousel>
				<?php foreach ( $mb_reviews as $mb_i => $mb_review ) : ?>
					<li class="review-card" aria-label="<?php echo esc_attr( sprintf( /* translators: 1: number, 2: total. */ __( 'Review %1$d of %2$d', 'maison-belle-child' ), $mb_i + 1, $mb_total ) ); ?>">
						<?php echo mb_quote_icon( 'review-card__quote' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<blockquote class="review-card__text"><?php echo esc_html( $mb_review['text'] ); ?></blockquote>
						<div class="review-card__foot">
							<div>
								<p class="review-card__name"><?php echo esc_html( $mb_review['name'] ); ?></p>
								<p class="review-card__service"><?php echo esc_html( $mb_review['service'] ); ?></p>
							</div>
							<?php mb_stars( $mb_review['rating'], 'ico ico--star' ); ?>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>

			<div class="review-controls">
				<div class="review-controls__progress">
					<span class="review-controls__count" aria-live="polite"><span data-carousel-current>01</span> <span class="text-gold">/</span> 0<?php echo (int) $mb_total; ?></span>
					<span class="review-controls__bar" aria-hidden="true"><span data-carousel-bar style="width:<?php echo esc_attr( round( 100 / $mb_total, 3 ) ); ?>%"></span></span>
				</div>
				<div class="review-controls__buttons">
					<button type="button" class="round-btn" data-carousel-prev aria-label="<?php esc_attr_e( 'Previous review', 'maison-belle-child' ); ?>"><?php echo mb_icon( 'chevron', 'ico ico--md ico--flip' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></button>
					<button type="button" class="round-btn" data-carousel-next aria-label="<?php esc_attr_e( 'Next review', 'maison-belle-child' ); ?>"><?php echo mb_icon( 'chevron', 'ico ico--md' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></button>
				</div>
			</div>
		</div>
	</div>
</section>
