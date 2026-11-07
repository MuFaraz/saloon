<?php
/**
 * Fallback template (archives, categories, tags, anything not matched elsewhere).
 * Shows the same article cards as the blog page.
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

get_header();

if ( is_category() || is_tag() || is_archive() ) {
	mb_page_hero( __( 'The journal', 'maison-belle-child' ), single_term_title( '', false ) ? single_term_title( '', false ) : get_the_archive_title(), get_the_archive_description() ? wp_strip_all_tags( get_the_archive_description() ) : '' );
} else {
	mb_page_hero( __( 'The journal', 'maison-belle-child' ), get_bloginfo( 'name' ) );
}
?>

<section class="section" aria-label="<?php esc_attr_e( 'Articles', 'maison-belle-child' ); ?>">
	<div class="container-x">
		<?php if ( have_posts() ) : ?>
			<ul class="post-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<li class="reveal">
						<a href="<?php the_permalink(); ?>" class="post-card group">
							<?php mb_post_image( get_the_ID(), array( 'class' => 'post-card__img', 'sizes' => '(min-width:768px) 45vw, 90vw', 'icon_size' => '4rem,4rem' ) ); ?>
							<p class="eyebrow post-card__cat"><?php echo esc_html( mb_post_category() ); ?></p>
							<h2 class="display-md post-card__title"><?php the_title(); ?></h2>
							<p class="post-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
							<p class="post-meta post-meta--card"><?php echo esc_html( mb_post_date() ); ?> · <?php echo esc_html( mb_reading_time() ); ?></p>
						</a>
					</li>
				<?php endwhile; ?>
			</ul>
			<?php the_posts_pagination( array( 'prev_text' => __( 'Newer', 'maison-belle-child' ), 'next_text' => __( 'Older', 'maison-belle-child' ) ) ); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'Nothing found here yet.', 'maison-belle-child' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
