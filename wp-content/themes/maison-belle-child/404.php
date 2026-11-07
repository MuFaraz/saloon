<?php
/**
 * 404: "Lost your polish?"
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<section class="not-found">
	<div class="container-x not-found__grid">
		<div class="not-found__copy">
			<p class="eyebrow"><?php esc_html_e( 'Error 404', 'maison-belle-child' ); ?></p>
			<h1 class="display-xl not-found__title"><?php esc_html_e( 'Lost your', 'maison-belle-child' ); ?> <em><?php esc_html_e( 'polish?', 'maison-belle-child' ); ?></em></h1>
			<p class="not-found__text"><?php esc_html_e( 'The page you are looking for has slipped away. Let us guide you back to something beautiful.', 'maison-belle-child' ); ?></p>
			<div class="not-found__actions">
				<?php
				mb_button( array( 'label' => __( 'Back to home', 'maison-belle-child' ), 'href' => home_url( '/' ) ) );
				mb_button( array( 'label' => __( 'View services', 'maison-belle-child' ), 'href' => mb_page_url( 'services' ), 'variant' => 'outline' ) );
				?>
			</div>
		</div>
		<?php
		mb_image(
			array(
				'alt'       => __( 'Soft decorative arch', 'maison-belle-child' ),
				'tone'      => 'blush',
				'icon'      => 'sparkle',
				'shape'     => 'arch',
				'class'     => 'not-found__img',
				'icon_size' => '5rem,5rem',
			)
		);
		?>
	</div>
</section>
<?php
get_footer();
