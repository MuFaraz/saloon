<?php
/**
 * Gallery grid with category filter and lightbox.
 *
 * Args: variant ('full' | 'preview'), limit (items for the preview).
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

$mb_variant = isset( $args['variant'] ) && 'preview' === $args['variant'] ? 'preview' : 'full';
$mb_limit   = 'preview' === $mb_variant ? ( isset( $args['limit'] ) ? (int) $args['limit'] : 6 ) : -1;
$mb_items   = function_exists( 'mb_get_gallery_items' ) ? mb_get_gallery_items( $mb_limit ) : array();
if ( ! $mb_items ) {
	return;
}
$mb_filters = 'full' === $mb_variant ? mb_get_gallery_categories() : array();
?>
<div class="gallery gallery--<?php echo esc_attr( $mb_variant ); ?>" data-gallery>
	<?php if ( $mb_filters ) : ?>
		<div role="group" aria-label="<?php esc_attr_e( 'Filter gallery', 'maison-belle-child' ); ?>" class="gallery__filters">
			<button type="button" class="chip is-active" aria-pressed="true" data-filter="*"><?php esc_html_e( 'All', 'maison-belle-child' ); ?></button>
			<?php foreach ( $mb_filters as $mb_filter ) : ?>
				<button type="button" class="chip" aria-pressed="false" data-filter="<?php echo esc_attr( $mb_filter ); ?>"><?php echo esc_html( $mb_filter ); ?></button>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<ul class="gallery__list gallery__list--<?php echo esc_attr( $mb_variant ); ?>" data-gallery-list>
		<?php foreach ( $mb_items as $mb_i => $mb_item ) : ?>
			<?php
			$mb_offset = 'preview' === $mb_variant && 1 === $mb_i % 3;
			$mb_aspect = 'full' === $mb_variant ? $mb_item['aspect'] : 'portrait';
			?>
			<li class="gallery__item<?php echo $mb_offset ? ' gallery__item--offset' : ''; ?>" data-cat="<?php echo esc_attr( $mb_item['category'] ); ?>">
				<button type="button" class="gallery__trigger group"
					aria-label="<?php echo esc_attr( sprintf( /* translators: %s: image description. */ __( 'View larger: %s', 'maison-belle-child' ), $mb_item['alt'] ) ); ?>"
					data-lightbox-trigger
					data-alt="<?php echo esc_attr( $mb_item['alt'] ); ?>"
					data-cat="<?php echo esc_attr( $mb_item['category'] ); ?>"
					data-aspect="<?php echo esc_attr( $mb_item['aspect'] ); ?>">
					<?php
					mb_image(
						array(
							'id'        => $mb_item['image_id'],
							'alt'       => $mb_item['alt'],
							'tone'      => $mb_item['tone'],
							'icon'      => $mb_item['icon'],
							'shape'     => $mb_offset ? 'arch-soft' : 'rounded',
							'class'     => 'gal-img gal-img--' . $mb_aspect,
							'sizes'     => '(min-width: 1024px) 28vw, 48vw',
							'icon_size' => '2.5rem,3.5rem',
						)
					);
					?>
				</button>
			</li>
		<?php endforeach; ?>
	</ul>

	<dialog class="lightbox" aria-label="<?php esc_attr_e( 'Image viewer', 'maison-belle-child' ); ?>" data-lightbox>
		<figure class="lightbox__figure">
			<div class="lightbox__frame" data-lb-frame></div>
			<figcaption class="lightbox__caption">
				<p class="lightbox__title" data-lb-title></p>
				<p class="lightbox__meta" data-lb-meta></p>
			</figcaption>
			<div class="lightbox__close">
				<button type="button" class="lightbox-btn" data-lb-close aria-label="<?php esc_attr_e( 'Close image viewer', 'maison-belle-child' ); ?>"><?php echo mb_icon( 'close', 'ico ico--md' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></button>
			</div>
			<div class="lightbox__nav">
				<button type="button" class="lightbox-btn lightbox-btn--prev" data-lb-prev aria-label="<?php esc_attr_e( 'Previous image', 'maison-belle-child' ); ?>"><?php echo mb_icon( 'chevron', 'ico ico--md ico--flip' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></button>
				<button type="button" class="lightbox-btn lightbox-btn--next" data-lb-next aria-label="<?php esc_attr_e( 'Next image', 'maison-belle-child' ); ?>"><?php echo mb_icon( 'chevron', 'ico ico--md' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></button>
			</div>
		</figure>
	</dialog>
</div>
