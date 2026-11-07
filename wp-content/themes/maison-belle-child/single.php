<?php
/**
 * Single blog post: header banner, image, readable article, prev/next, related posts.
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();

	$mb_blog_id  = (int) get_option( 'page_for_posts' );
	$mb_blog_url = $mb_blog_id ? get_permalink( $mb_blog_id ) : home_url( '/' );
	$mb_cat_ids  = wp_get_post_categories( get_the_ID() );

	// Related: same category first, then the latest others.
	$mb_related = get_posts(
		array(
			'post__not_in'   => array( get_the_ID() ),
			'category__in'   => $mb_cat_ids,
			'posts_per_page' => 2,
		)
	);
	if ( count( $mb_related ) < 2 ) {
		$mb_exclude = array_merge( array( get_the_ID() ), wp_list_pluck( $mb_related, 'ID' ) );
		$mb_related = array_merge( $mb_related, get_posts( array( 'post__not_in' => $mb_exclude, 'posts_per_page' => 2 - count( $mb_related ) ) ) );
	}
	?>
	<article <?php post_class(); ?>>
		<header class="article-head">
			<div class="container-x article-head__inner">
				<a href="<?php echo esc_url( $mb_blog_url ); ?>" class="link-line article-head__back">
					<?php echo mb_icon( 'arrow', 'ico ico--sm ico--flip' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<?php esc_html_e( 'All articles', 'maison-belle-child' ); ?>
				</a>
				<p class="eyebrow eyebrow-center article-head__cat"><?php echo esc_html( mb_post_category() ); ?></p>
				<h1 class="display-lg hero-in article-head__title"><?php the_title(); ?></h1>
				<p class="article-head__meta"><?php echo esc_html( mb_post_date() ); ?> · <?php echo esc_html( mb_reading_time() ); ?> · <?php echo esc_html( mb_s( 'wordmark_main', get_bloginfo( 'name' ) ) ); ?></p>
			</div>
			<div class="hairline"></div>
		</header>

		<div class="container-x article-figure">
			<?php mb_post_image( get_the_ID(), array( 'class' => 'article-figure__img', 'sizes' => '(min-width:1024px) 900px, 95vw', 'priority' => true, 'icon_size' => '5rem,5rem' ) ); ?>
		</div>

		<div class="container-x article-body">
			<div class="mb-prose">
				<?php the_content(); ?>
			</div>
		</div>
	</article>

	<?php
	$mb_prev = get_previous_post();
	$mb_next = get_next_post();
	if ( $mb_prev || $mb_next ) :
		?>
		<nav class="container-x post-nav" aria-label="<?php esc_attr_e( 'More articles', 'maison-belle-child' ); ?>">
			<div class="post-nav__inner">
				<?php if ( $mb_prev ) : ?>
					<a href="<?php echo esc_url( get_permalink( $mb_prev ) ); ?>" class="post-nav__link" rel="prev">
						<span class="post-nav__label"><?php esc_html_e( 'Previous', 'maison-belle-child' ); ?></span>
						<span class="post-nav__title"><?php echo esc_html( get_the_title( $mb_prev ) ); ?></span>
					</a>
				<?php endif; ?>
				<?php if ( $mb_next ) : ?>
					<a href="<?php echo esc_url( get_permalink( $mb_next ) ); ?>" class="post-nav__link post-nav__link--next" rel="next">
						<span class="post-nav__label"><?php esc_html_e( 'Next', 'maison-belle-child' ); ?></span>
						<span class="post-nav__title"><?php echo esc_html( get_the_title( $mb_next ) ); ?></span>
					</a>
				<?php endif; ?>
			</div>
		</nav>
	<?php endif; ?>

	<?php if ( $mb_related ) : ?>
		<section class="more-articles" aria-label="<?php esc_attr_e( 'More articles', 'maison-belle-child' ); ?>">
			<div class="container-x">
				<h2 class="display-md more-articles__title"><?php esc_html_e( 'Keep reading', 'maison-belle-child' ); ?></h2>
				<ul class="more-articles__grid">
					<?php foreach ( $mb_related as $mb_post ) : ?>
						<li class="reveal">
							<a href="<?php echo esc_url( get_permalink( $mb_post ) ); ?>" class="post-card post-card--small group">
								<?php mb_post_image( $mb_post, array( 'class' => 'post-card__img', 'sizes' => '(min-width:768px) 40vw, 90vw' ) ); ?>
								<p class="eyebrow post-card__cat post-card__cat--small"><?php echo esc_html( mb_post_category( $mb_post ) ); ?></p>
								<h3 class="display-md post-card__title post-card__title--small"><?php echo esc_html( get_the_title( $mb_post ) ); ?></h3>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</section>
	<?php endif; ?>

	<?php
	mb_cta_banner();
endwhile;

get_footer();
