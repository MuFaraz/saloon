<?php
/**
 * Home: About / "Our story".
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

$mb_list = function_exists( 'mb_lines' ) ? mb_lines( mb_s( 'about_list' ) ) : array();
?>
<section class="section about" aria-label="<?php esc_attr_e( 'About us', 'maison-belle-child' ); ?>">
	<div class="container-x about__grid">
		<div class="reveal about__art">
			<div class="about__art-inner">
				<?php
				mb_image(
					array(
						'id'        => (int) mb_s( 'about_image_main' ),
						'alt'       => __( 'The calm, ivory-toned interior of the salon', 'maison-belle-child' ),
						'tone'      => 'mauve',
						'icon'      => 'flower',
						'shape'     => 'arch',
						'class'     => 'about__img-main',
						'sizes'     => '(min-width:1024px) 36vw, 80vw',
						'icon_size' => '5rem,5rem',
					)
				);
				mb_image(
					array(
						'id'    => (int) mb_s( 'about_image_accent' ),
						'alt'   => __( 'Manicure station set with polishes and tools', 'maison-belle-child' ),
						'tone'  => 'ivory',
						'icon'  => 'bottle',
						'shape' => 'rounded',
						'class' => 'about__img-accent',
						'sizes' => '20vw',
					)
				);
				?>
				<span class="about__ring" aria-hidden="true"></span>
			</div>
		</div>

		<div class="about__copy">
			<?php
			mb_section_heading(
				array(
					'align'   => 'left',
					'eyebrow' => mb_s( 'about_eyebrow' ),
					'title'   => mb_s( 'about_title' ),
				)
			);
			?>
			<div class="reveal" style="--d:100ms">
				<p class="about__lead"><?php echo esc_html( mb_s( 'about_p1' ) ); ?></p>
				<p class="about__body"><?php echo esc_html( mb_s( 'about_p2' ) ); ?></p>
				<?php if ( $mb_list ) : ?>
					<ul class="ticks">
						<?php foreach ( $mb_list as $mb_line ) : ?>
							<li><span class="ticks__icon"><?php echo mb_icon( 'check', 'ico ico--sm' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span><?php echo esc_html( $mb_line ); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
				<div class="about__actions">
					<?php mb_book_button(); ?>
					<a href="<?php echo esc_url( mb_page_url( 'services' ) ); ?>" class="link-line"><?php echo esc_html( mb_s( 'about_link' ) ); ?></a>
				</div>
			</div>
		</div>
	</div>
</section>
