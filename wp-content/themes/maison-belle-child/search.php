<?php
/**
 * Search results.
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

get_header();

mb_page_hero(
	__( 'Search', 'maison-belle-child' ),
	/* translators: %s: search term. */
	sprintf( __( 'Results for *%s*', 'maison-belle-child' ), str_replace( '*', '', get_search_query( false ) ) )
);
?>

<section class="section" aria-label="<?php esc_attr_e( 'Search results', 'maison-belle-child' ); ?>">
	<div class="container-x">
		<div class="search-box"><?php get_search_form(); ?></div>
		<?php if ( have_posts() ) : ?>
			<ul class="post-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<li class="reveal">
						<a href="<?php the_permalink(); ?>" class="post-card group">
							<?php mb_post_image( get_the_ID(), array( 'class' => 'post-card__img', 'sizes' => '(min-width:768px) 45vw, 90vw', 'icon_size' => '4rem,4rem' ) ); ?>
							<p class="eyebrow post-card__cat"><?php echo esc_html( 'page' === get_post_type() ? __( 'Page', 'maison-belle-child' ) : mb_post_category() ); ?></p>
							<h2 class="display-md post-card__title"><?php the_title(); ?></h2>
							<p class="post-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 28 ) ); ?></p>
						</a>
					</li>
				<?php endwhile; ?>
			</ul>
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<p class="search-empty"><?php esc_html_e( 'We could not find anything for that search. Try a different word, or browse our services.', 'maison-belle-child' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
