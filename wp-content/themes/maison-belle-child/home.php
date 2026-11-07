<?php
/**
 * Blog index (the "Posts page"): featured article + two-column list.
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

get_header();

mb_page_hero_for_page(
	array(
		'eyebrow' => __( 'The journal', 'maison-belle-child' ),
		'title'   => __( 'Notes on *beauty* & care', 'maison-belle-child' ),
	)
);

global $wp_query;
$mb_posts    = $wp_query->posts;
$mb_featured = null;
if ( $mb_posts && ! is_paged() ) {
	$mb_featured = array_shift( $mb_posts );
}
?>

<section class="section" aria-label="<?php esc_attr_e( 'Articles', 'maison-belle-child' ); ?>">
	<div class="container-x">
		<?php if ( $mb_featured ) : ?>
			<div class="reveal">
				<a href="<?php echo esc_url( get_permalink( $mb_featured ) ); ?>" class="post-feature group">
					<?php mb_post_image( $mb_featured, array( 'class' => 'post-feature__img', 'sizes' => '(min-width:768px) 45vw, 90vw', 'icon_size' => '5rem,5rem', 'priority' => true ) ); ?>
					<div class="post-feature__body">
						<p class="eyebrow"><?php echo esc_html( mb_post_category( $mb_featured ) ); ?> · <?php esc_html_e( 'Featured', 'maison-belle-child' ); ?></p>
						<h2 class="display-lg post-feature__title"><?php echo esc_html( get_the_title( $mb_featured ) ); ?></h2>
						<p class="post-feature__excerpt"><?php echo esc_html( get_the_excerpt( $mb_featured ) ); ?></p>
						<p class="post-meta"><?php echo esc_html( mb_post_date( $mb_featured ) ); ?> · <?php echo esc_html( mb_reading_time( $mb_featured ) ); ?></p>
						<span class="link-line post-feature__more"><?php esc_html_e( 'Read article', 'maison-belle-child' ); ?> <?php echo mb_icon( 'arrow', 'ico ico--sm' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					</div>
				</a>
			</div>
		<?php endif; ?>

		<?php if ( $mb_posts ) : ?>
			<ul class="post-grid">
				<?php foreach ( $mb_posts as $mb_i => $mb_post ) : ?>
					<li class="reveal"<?php echo mb_delay( $mb_i * 100 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<a href="<?php echo esc_url( get_permalink( $mb_post ) ); ?>" class="post-card group">
							<?php mb_post_image( $mb_post, array( 'class' => 'post-card__img', 'sizes' => '(min-width:768px) 45vw, 90vw', 'icon_size' => '4rem,4rem' ) ); ?>
							<p class="eyebrow post-card__cat"><?php echo esc_html( mb_post_category( $mb_post ) ); ?></p>
							<h2 class="display-md post-card__title"><?php echo esc_html( get_the_title( $mb_post ) ); ?></h2>
							<p class="post-card__excerpt"><?php echo esc_html( get_the_excerpt( $mb_post ) ); ?></p>
							<p class="post-meta post-meta--card"><?php echo esc_html( mb_post_date( $mb_post ) ); ?> · <?php echo esc_html( mb_reading_time( $mb_post ) ); ?></p>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php elseif ( ! $mb_featured ) : ?>
			<p><?php esc_html_e( 'Articles are coming soon.', 'maison-belle-child' ); ?></p>
		<?php endif; ?>

		<?php
		the_posts_pagination(
			array(
				'mid_size'  => 1,
				'prev_text' => __( 'Newer', 'maison-belle-child' ),
				'next_text' => __( 'Older', 'maison-belle-child' ),
			)
		);
		?>
	</div>
</section>

<?php
get_footer();
