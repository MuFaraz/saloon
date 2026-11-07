<?php
/**
 * Template Name: Services (price menu)
 *
 * Price menu with a sticky category nav and dotted leaders. Content comes from the
 * Services post type (Services → Add New, grouped by Service categories).
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

get_header();

mb_page_hero_for_page(
	array(
		'eyebrow' => __( 'Services & prices', 'maison-belle-child' ),
		'title'   => __( 'The *menu*', 'maison-belle-child' ),
		'intro'   => '',
	)
);

$mb_menu = function_exists( 'mb_get_services_menu' ) ? mb_get_services_menu() : array();
?>

<?php if ( $mb_menu ) : ?>
	<nav aria-label="<?php esc_attr_e( 'Service categories', 'maison-belle-child' ); ?>" class="cat-nav" data-cat-nav>
		<ul class="cat-nav__list no-scrollbar container-x">
			<?php foreach ( $mb_menu as $mb_i => $mb_cat ) : ?>
				<li><a href="#<?php echo esc_attr( $mb_cat['id'] ); ?>" class="chip chip--nav<?php echo 0 === $mb_i ? ' is-active' : ''; ?>"<?php echo 0 === $mb_i ? ' aria-current="true"' : ''; ?>><?php echo esc_html( $mb_cat['name'] ); ?></a></li>
			<?php endforeach; ?>
		</ul>
	</nav>

	<?php foreach ( $mb_menu as $mb_i => $mb_cat ) : ?>
		<?php $mb_odd = 1 === $mb_i % 2; ?>
		<section id="<?php echo esc_attr( $mb_cat['id'] ); ?>" aria-labelledby="<?php echo esc_attr( $mb_cat['id'] ); ?>-title" class="menu-block<?php echo $mb_odd ? ' menu-block--odd' : ''; ?>">
			<div class="container-x menu-block__grid">
				<div class="reveal menu-block__art">
					<?php
					mb_image(
						array(
							'id'        => $mb_cat['image_id'],
							'alt'       => $mb_cat['alt'] ? $mb_cat['alt'] : $mb_cat['name'],
							'tone'      => $mb_cat['tone'],
							'icon'      => $mb_cat['icon'],
							'shape'     => 'arch',
							'class'     => 'menu-block__img',
							'sizes'     => '(min-width:1024px) 38vw, 80vw',
							'icon_size' => '5rem,5rem',
						)
					);
					?>
				</div>
				<div class="menu-block__content">
					<div class="reveal">
						<span class="eyebrow">
							<?php
							/* translators: 1: category number, 2: lowest price. */
							echo esc_html( sprintf( __( '0%1$d · From %2$s', 'maison-belle-child' ), $mb_i + 1, mb_format_price( $mb_cat['from'] ) ) );
							?>
						</span>
						<div class="menu-block__title-row">
							<h2 id="<?php echo esc_attr( $mb_cat['id'] ); ?>-title" class="display-lg"><?php echo esc_html( $mb_cat['name'] ); ?></h2>
							<?php echo mb_icon( $mb_cat['icon'], 'ico ico--2xl text-gold' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
						<?php if ( $mb_cat['blurb'] ) : ?>
							<p class="menu-block__blurb"><?php echo esc_html( $mb_cat['blurb'] ); ?></p>
						<?php endif; ?>
						<div class="hairline menu-block__rule-top"></div>
					</div>
					<div class="reveal" style="--d:80ms">
						<ul class="price-list">
							<?php foreach ( $mb_cat['items'] as $mb_item ) : ?>
								<li>
									<div class="price-list__row">
										<h3 class="price-list__name"><?php echo esc_html( $mb_item['name'] ); ?></h3>
										<span class="leader" aria-hidden="true"></span>
										<span class="price-list__price"><?php echo esc_html( mb_format_price( $mb_item['price'] ) ); ?></span>
									</div>
									<?php if ( $mb_item['description'] || $mb_item['duration'] ) : ?>
										<?php // No whitespace between the duration and the description: the design spaces them with a margin. ?>
										<p class="price-list__desc"><?php if ( $mb_item['duration'] ) : ?><span class="price-list__time"><?php echo esc_html( $mb_item['duration'] ); ?></span><?php endif; ?><?php echo esc_html( $mb_item['description'] ); ?></p>
									<?php endif; ?>
								</li>
							<?php endforeach; ?>
						</ul>
						<div class="hairline menu-block__rule-bottom"></div>
						<?php
						mb_book_button(
							array(
								'variant' => 'outline',
								/* translators: %s: category name. */
								'label'   => sprintf( __( 'Book %s', 'maison-belle-child' ), $mb_cat['name'] ),
							)
						);
						?>
					</div>
				</div>
			</div>
		</section>
	<?php endforeach; ?>
<?php else : ?>
	<section class="section"><div class="container-x"><p><?php esc_html_e( 'The menu is being updated. Please call us for prices.', 'maison-belle-child' ); ?></p></div></section>
<?php endif; ?>

<?php
mb_cta_banner();
get_footer();
