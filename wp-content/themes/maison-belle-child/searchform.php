<?php
/**
 * Search form (styled like the contact form fields).
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

$mb_uid = wp_unique_id( 'search-' );
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $mb_uid ); ?>" class="mb-label"><?php esc_html_e( 'Search', 'maison-belle-child' ); ?></label>
	<div class="search-form__row">
		<input type="search" id="<?php echo esc_attr( $mb_uid ); ?>" class="mb-input" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Search the journal and pages', 'maison-belle-child' ); ?>">
		<button type="submit" class="btn btn-primary"><?php esc_html_e( 'Search', 'maison-belle-child' ); ?></button>
	</div>
</form>
