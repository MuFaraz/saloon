<?php
/**
 * Default page template (any page without a special template).
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	mb_page_hero_for_page( array( 'eyebrow' => '', 'title' => get_the_title() ) );
	?>
	<section class="section" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
		<div class="container-x">
			<div class="mb-prose"><?php the_content(); ?></div>
		</div>
	</section>
	<?php
	mb_cta_banner();
endwhile;

get_footer();
