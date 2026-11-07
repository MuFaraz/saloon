<?php
/**
 * Template Name: Policy
 *
 * Numbered policy sections. Edit the page content normally: every Heading 2 starts a
 * new numbered section, the paragraphs under it belong to that section.
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

get_header();

mb_page_hero_for_page(
	array(
		'eyebrow' => __( 'Good to know', 'maison-belle-child' ),
		'title'   => __( 'Our *policy*', 'maison-belle-child' ),
	)
);

// Split the editor content at each <h2> into numbered sections.
$mb_html     = '';
$mb_sections = array();
while ( have_posts() ) {
	the_post();
	$mb_html = apply_filters( 'the_content', get_the_content() );
}
$mb_parts = preg_split( '/(?=<h2[\s>])/i', $mb_html, -1, PREG_SPLIT_NO_EMPTY );
foreach ( $mb_parts as $mb_part ) {
	if ( preg_match( '/^<h2/i', $mb_part ) ) {
		$mb_sections[] = $mb_part;
	} elseif ( trim( wp_strip_all_tags( $mb_part ) ) ) {
		$mb_sections[] = $mb_part; // Intro text before the first heading.
	}
}
?>

<section class="section" aria-label="<?php esc_attr_e( 'Policy', 'maison-belle-child' ); ?>">
	<div class="container-x">
		<div class="policy">
			<?php
			$mb_n = 0;
			foreach ( $mb_sections as $mb_section ) :
				$mb_numbered = (bool) preg_match( '/^<h2/i', $mb_section );
				if ( $mb_numbered ) {
					++$mb_n;
				}
				?>
				<div class="reveal policy__section">
					<?php if ( $mb_numbered ) : ?>
						<span class="policy__num">0<?php echo (int) $mb_n; ?></span>
					<?php endif; ?>
					<div class="policy__body">
						<?php echo wp_kses_post( $mb_section ); ?>
					</div>
				</div>
			<?php endforeach; ?>
			<p class="policy__help">
				<?php esc_html_e( 'Questions? Call us on', 'maison-belle-child' ); ?>
				<a href="tel:<?php echo esc_attr( mb_phone_tel() ); ?>"><?php echo esc_html( mb_s( 'phone' ) ); ?></a>
				<?php esc_html_e( 'and we will be happy to help.', 'maison-belle-child' ); ?>
			</p>
		</div>
	</div>
</section>

<?php
mb_cta_banner();
get_footer();
