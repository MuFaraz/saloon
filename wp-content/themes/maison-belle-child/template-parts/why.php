<?php
/**
 * Home: "Why choose us" grid.
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

$mb_reasons = array_values(
	array_filter(
		(array) mb_s( 'reasons', array() ),
		function ( $row ) {
			return ! empty( $row['title'] );
		}
	)
);
if ( ! $mb_reasons ) {
	return;
}
?>
<section class="section section--blush" aria-label="<?php esc_attr_e( 'Why choose us', 'maison-belle-child' ); ?>">
	<div class="container-x">
		<?php
		mb_section_heading(
			array(
				'eyebrow' => mb_s( 'why_eyebrow' ),
				'title'   => mb_s( 'why_title' ),
			)
		);
		?>
		<ul class="why-grid">
			<?php foreach ( $mb_reasons as $mb_i => $mb_reason ) : ?>
				<li class="reveal why-item"<?php echo mb_delay( $mb_i * 80 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<span class="why-item__num">0<?php echo (int) ( $mb_i + 1 ); ?></span>
					<span class="why-item__icon"><?php echo mb_icon( $mb_reason['icon'], 'ico ico--xl' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<h3 class="display-md why-item__title"><?php echo esc_html( $mb_reason['title'] ); ?></h3>
					<p class="why-item__text"><?php echo esc_html( $mb_reason['text'] ); ?></p>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
