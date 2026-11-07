<?php
/**
 * Home page (static front page).
 *
 * Every text and picture here comes from Salon Settings and the content types of the
 * Maison Belle Core plugin, so nothing needs editing in this file.
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

get_header();

get_template_part( 'template-parts/hero' );
get_template_part( 'template-parts/strip' );
get_template_part( 'template-parts/about' );
get_template_part( 'template-parts/marquee' );
get_template_part( 'template-parts/service-cards' );
get_template_part( 'template-parts/why' );
get_template_part( 'template-parts/reviews' );
?>

<section class="section section--sand section--gallery" aria-label="<?php esc_attr_e( 'Gallery preview', 'maison-belle-child' ); ?>">
	<div class="container-x">
		<?php
		mb_section_heading(
			array(
				'eyebrow' => mb_s( 'gallery_eyebrow' ),
				'title'   => mb_s( 'gallery_title' ),
				'intro'   => mb_s( 'gallery_intro' ),
			)
		);
		?>
		<div class="reveal gallery-preview">
			<?php get_template_part( 'template-parts/gallery-grid', null, array( 'variant' => 'preview', 'limit' => 6 ) ); ?>
		</div>
		<div class="gallery-more">
			<?php mb_button( array( 'label' => __( 'View full gallery', 'maison-belle-child' ), 'href' => mb_page_url( 'gallery' ), 'variant' => 'outline' ) ); ?>
		</div>
	</div>
</section>

<?php
get_template_part( 'template-parts/visit' );
mb_cta_banner();

get_footer();
