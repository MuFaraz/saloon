<?php
/**
 * Walk-ins & appointments strip under the hero.
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

$mb_strip = array_filter(
	(array) mb_s( 'strip', array() ),
	function ( $row ) {
		return ! empty( $row['title'] );
	}
);
if ( ! $mb_strip ) {
	return;
}
?>
<section aria-label="<?php esc_attr_e( 'Walk-ins and appointments', 'maison-belle-child' ); ?>" class="strip">
	<div class="container-x strip__grid">
		<?php foreach ( $mb_strip as $mb_row ) : ?>
			<div class="strip__item">
				<span class="strip__icon"><?php echo mb_icon( $mb_row['icon'], 'ico ico--lg' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<div>
					<h2 class="strip__title"><?php echo esc_html( $mb_row['title'] ); ?></h2>
					<p class="strip__text"><?php echo esc_html( $mb_row['text'] ); ?></p>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>
