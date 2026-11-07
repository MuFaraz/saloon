<?php
/**
 * Home hero.
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="hero" aria-labelledby="hero-title">
	<div class="hero__bg" aria-hidden="true">
		<div class="hero__blob hero__blob--rose"></div>
		<div class="hero__blob hero__blob--sand"></div>
	</div>

	<div class="container-x hero__grid">
		<div class="hero__copy">
			<p class="hero-in eyebrow" style="--i:0"><?php echo esc_html( mb_s( 'hero_eyebrow' ) ); ?></p>
			<h1 id="hero-title" class="display-xl hero__title">
				<span class="hero-in block" style="--i:1"><?php echo mb_em( mb_s( 'hero_line1' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<span class="hero-in block" style="--i:2"><?php echo mb_em( mb_s( 'hero_line2' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
			</h1>
			<p class="hero-in hero__text" style="--i:3"><?php echo esc_html( mb_s( 'hero_text' ) ); ?></p>
			<div class="hero-in hero__actions" style="--i:4">
				<?php
				mb_book_button( array( 'label' => mb_s( 'hero_cta_book' ) ) );
				mb_button(
					array(
						'label'   => mb_s( 'hero_cta_view' ),
						'href'    => mb_page_url( 'services' ),
						'variant' => 'outline',
					)
				);
				?>
			</div>
			<?php if ( mb_s( 'announcement' ) ) : ?>
				<div class="hero-in hero__note" style="--i:5">
					<span class="hairline hero__note-line" aria-hidden="true"></span>
					<span><?php echo esc_html( mb_s( 'announcement' ) ); ?></span>
				</div>
			<?php endif; ?>
		</div>

		<div class="hero-in hero__art" style="--i:2">
			<div class="hero__art-inner">
				<span class="hero__ring hero__ring--1" aria-hidden="true"></span>
				<span class="hero__ring hero__ring--2" aria-hidden="true"></span>

				<?php
				mb_image(
					array(
						'id'        => (int) mb_s( 'hero_image_main' ),
						'alt'       => __( 'Elegant hands with a soft blush manicure', 'maison-belle-child' ),
						'tone'      => 'blush',
						'icon'      => 'bottle',
						'shape'     => 'arch',
						'priority'  => true,
						'sizes'     => '(min-width: 1024px) 30vw, 60vw',
						'class'     => 'hero__img-main',
						'icon_size' => '4rem,5rem',
					)
				);
				mb_image(
					array(
						'id'        => (int) mb_s( 'hero_image_accent' ),
						'alt'       => __( 'Detail of a champagne-gold nail finish', 'maison-belle-child' ),
						'tone'      => 'gold',
						'icon'      => 'sparkle',
						'shape'     => 'circle',
						'sizes'     => '(min-width: 1024px) 16vw, 36vw',
						'class'     => 'hero__img-accent',
						'icon_size' => '2.25rem,3rem',
					)
				);
				?>

				<div class="hero__rating float-slow">
					<?php mb_stars(); ?>
					<p class="hero__rating-text">
						<?php echo esc_html( mb_s( 'rating_value' ) ); ?> <span class="text-gold">★</span>
						<?php
						/* translators: %s: number of reviews, e.g. 500+. */
						echo esc_html( sprintf( __( 'from %s happy clients', 'maison-belle-child' ), mb_s( 'rating_count' ) ) );
						?>
					</p>
					<?php if ( mb_s( 'rating_label' ) ) : ?>
						<p class="hero__rating-label"><?php echo esc_html( mb_s( 'rating_label' ) ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
