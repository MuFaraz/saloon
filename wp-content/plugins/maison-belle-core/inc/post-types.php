<?php
/**
 * Custom post types and taxonomies: services, gallery, reviews, promotions.
 *
 * All are admin-only (not public URLs): the theme lists them on normal pages.
 *
 * @package MaisonBelleCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register content types and taxonomies.
 */
function mb_register_post_types() {
	$common = array(
		'public'              => false,
		'publicly_queryable'  => false,
		'show_ui'             => true,
		'show_in_rest'        => true,
		'exclude_from_search' => true,
		'has_archive'         => false,
		'rewrite'             => false,
		'hierarchical'        => false,
	);

	register_post_type(
		'mb_service',
		array_merge(
			$common,
			array(
				'labels'        => mb_cpt_labels( __( 'Service', 'maison-belle-core' ), __( 'Services', 'maison-belle-core' ) ),
				'menu_icon'     => 'dashicons-art',
				'menu_position' => 25,
				'supports'      => array( 'title', 'page-attributes' ),
				'taxonomies'    => array( 'mb_service_cat' ),
			)
		)
	);

	register_post_type(
		'mb_gallery',
		array_merge(
			$common,
			array(
				'labels'        => mb_cpt_labels( __( 'Gallery item', 'maison-belle-core' ), __( 'Gallery', 'maison-belle-core' ) ),
				'menu_icon'     => 'dashicons-format-gallery',
				'menu_position' => 26,
				'supports'      => array( 'title', 'thumbnail', 'page-attributes' ),
				'taxonomies'    => array( 'mb_gallery_cat' ),
			)
		)
	);

	register_post_type(
		'mb_review',
		array_merge(
			$common,
			array(
				'labels'        => mb_cpt_labels( __( 'Review', 'maison-belle-core' ), __( 'Reviews', 'maison-belle-core' ) ),
				'menu_icon'     => 'dashicons-star-filled',
				'menu_position' => 27,
				'supports'      => array( 'title', 'page-attributes' ),
			)
		)
	);

	register_post_type(
		'mb_promo',
		array_merge(
			$common,
			array(
				'labels'        => mb_cpt_labels( __( 'Promotion', 'maison-belle-core' ), __( 'Promotions', 'maison-belle-core' ) ),
				'menu_icon'     => 'dashicons-tickets-alt',
				'menu_position' => 28,
				'supports'      => array( 'title', 'page-attributes' ),
			)
		)
	);

	$tax_common = array(
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_rest'       => true,
		'show_admin_column'  => true,
		'hierarchical'       => true,
		'rewrite'            => false,
	);

	register_taxonomy(
		'mb_service_cat',
		'mb_service',
		array_merge(
			$tax_common,
			array(
				'labels' => mb_cpt_labels( __( 'Service category', 'maison-belle-core' ), __( 'Service categories', 'maison-belle-core' ) ),
			)
		)
	);

	register_taxonomy(
		'mb_gallery_cat',
		'mb_gallery',
		array_merge(
			$tax_common,
			array(
				'labels' => mb_cpt_labels( __( 'Gallery category', 'maison-belle-core' ), __( 'Gallery categories', 'maison-belle-core' ) ),
			)
		)
	);
}
add_action( 'init', 'mb_register_post_types' );

/**
 * Build a full labels array from singular / plural names.
 *
 * @param string $singular Singular name.
 * @param string $plural   Plural name.
 * @return array
 */
function mb_cpt_labels( $singular, $plural ) {
	return array(
		'name'               => $plural,
		'singular_name'      => $singular,
		'menu_name'          => $plural,
		'add_new'            => __( 'Add New', 'maison-belle-core' ),
		/* translators: %s: singular name. */
		'add_new_item'       => sprintf( __( 'Add New %s', 'maison-belle-core' ), $singular ),
		/* translators: %s: singular name. */
		'edit_item'          => sprintf( __( 'Edit %s', 'maison-belle-core' ), $singular ),
		/* translators: %s: singular name. */
		'new_item'           => sprintf( __( 'New %s', 'maison-belle-core' ), $singular ),
		/* translators: %s: plural name. */
		'all_items'          => sprintf( __( 'All %s', 'maison-belle-core' ), $plural ),
		/* translators: %s: plural name. */
		'search_items'       => sprintf( __( 'Search %s', 'maison-belle-core' ), $plural ),
		/* translators: %s: plural name. */
		'not_found'          => sprintf( __( 'No %s found.', 'maison-belle-core' ), strtolower( $plural ) ),
		'featured_image'     => __( 'Photo', 'maison-belle-core' ),
		'set_featured_image' => __( 'Set photo', 'maison-belle-core' ),
		'remove_featured_image' => __( 'Remove photo', 'maison-belle-core' ),
		'use_featured_image' => __( 'Use as photo', 'maison-belle-core' ),
	);
}

/**
 * Admin list columns: price for services, order for everything.
 */
function mb_admin_columns() {
	add_filter(
		'manage_mb_service_posts_columns',
		function ( $cols ) {
			$cols['mb_price'] = __( 'Price', 'maison-belle-core' );
			return $cols;
		}
	);
	add_action(
		'manage_mb_service_posts_custom_column',
		function ( $col, $post_id ) {
			if ( 'mb_price' === $col ) {
				echo esc_html( mb_format_price( get_post_meta( $post_id, 'mb_price', true ) ) );
			}
		},
		10,
		2
	);
	add_filter(
		'manage_mb_gallery_posts_columns',
		function ( $cols ) {
			$new = array();
			foreach ( $cols as $key => $label ) {
				if ( 'title' === $key ) {
					$new['mb_thumb'] = __( 'Photo', 'maison-belle-core' );
				}
				$new[ $key ] = $label;
			}
			return $new;
		}
	);
	add_action(
		'manage_mb_gallery_posts_custom_column',
		function ( $col, $post_id ) {
			if ( 'mb_thumb' === $col ) {
				echo get_the_post_thumbnail( $post_id, array( 60, 60 ) ) ? wp_kses_post( get_the_post_thumbnail( $post_id, array( 60, 60 ) ) ) : '<span style="color:#999">' . esc_html__( 'Placeholder', 'maison-belle-core' ) . '</span>';
			}
		},
		10,
		2
	);
}
add_action( 'admin_init', 'mb_admin_columns' );
