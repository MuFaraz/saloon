<?php
/**
 * Template Name: Gallery
 *
 * Filterable masonry gallery with a keyboard-friendly lightbox. Items come from
 * the Gallery post type (Gallery → Add New).
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

get_header();

mb_page_hero_for_page(
	array(
		'eyebrow' => __( 'Gallery', 'maison-belle-child' ),
		'title'   => __( 'Our *work*', 'maison-belle-child' ),
	)
);
?>

<section class="section" aria-label="<?php esc_attr_e( 'Gallery', 'maison-belle-child' ); ?>">
	<div class="container-x">
		<?php get_template_part( 'template-parts/gallery-grid', null, array( 'variant' => 'full' ) ); ?>
	</div>
</section>

<?php
mb_cta_banner();
get_footer();
