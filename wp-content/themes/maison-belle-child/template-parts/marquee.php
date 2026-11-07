<?php
/**
 * Scrolling words banner. The second copy is hidden from assistive tech.
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

$mb_words = function_exists( 'mb_lines' ) ? mb_lines( mb_s( 'marquee_words' ) ) : array();
if ( ! $mb_words ) {
	return;
}
$mb_dark = ! empty( $args['dark'] );
?>
<div class="marquee<?php echo $mb_dark ? ' marquee--dark' : ''; ?>" role="presentation">
	<div class="marquee-track">
		<?php for ( $mb_copy = 0; $mb_copy < 2; $mb_copy++ ) : ?>
			<ul class="marquee__row"<?php echo $mb_copy ? ' aria-hidden="true"' : ''; ?>>
				<?php foreach ( $mb_words as $mb_word ) : ?>
					<li><span class="marquee__word"><?php echo esc_html( $mb_word ); ?></span><span class="marquee__star" aria-hidden="true">✦</span></li>
				<?php endforeach; ?>
			</ul>
		<?php endfor; ?>
	</div>
</div>
