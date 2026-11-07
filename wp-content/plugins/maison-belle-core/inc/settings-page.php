<?php
/**
 * "Salon Settings" admin page, built with the WordPress Settings API.
 *
 * One option (mb_settings) holds an array of values. The page is split into tabs;
 * saving a tab only changes the fields on that tab.
 *
 * @package MaisonBelleCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the option and the admin menu entry.
 */
function mb_settings_register() {
	register_setting(
		'mb_settings_group',
		'mb_settings',
		array(
			'type'              => 'array',
			'sanitize_callback' => 'mb_sanitize_settings',
			'default'           => array(),
			'show_in_rest'      => false,
		)
	);
}
add_action( 'admin_init', 'mb_settings_register' );

/**
 * Add the "Salon Settings" top-level menu.
 */
function mb_settings_menu() {
	add_menu_page(
		__( 'Salon Settings', 'maison-belle-core' ),
		__( 'Salon Settings', 'maison-belle-core' ),
		'manage_options',
		'mb-salon-settings',
		'mb_settings_render_page',
		'dashicons-store',
		24
	);
}
add_action( 'admin_menu', 'mb_settings_menu' );

/**
 * Sanitise submitted values. Only the fields of the submitted tab are touched.
 *
 * @param mixed $input Raw $_POST['mb_settings'] (already unslashed by options.php).
 * @return array
 */
function mb_sanitize_settings( $input ) {
	$existing = get_option( 'mb_settings', array() );
	$existing = is_array( $existing ) ? $existing : array();
	if ( ! is_array( $input ) || ! current_user_can( 'manage_options' ) ) {
		return $existing;
	}

	$tab    = isset( $input['_tab'] ) ? sanitize_key( $input['_tab'] ) : '';
	$schema = mb_settings_schema();
	if ( ! isset( $schema[ $tab ] ) ) {
		return $existing;
	}

	foreach ( $schema[ $tab ]['fields'] as $key => $field ) {
		$raw = isset( $input[ $key ] ) ? $input[ $key ] : null;

		if ( 'hours' === $field['type'] ) {
			$rows  = array();
			$valid = array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday' );
			foreach ( (array) $raw as $row ) {
				$row    = (array) $row;
				$days   = isset( $row['days'] ) ? array_values( array_intersect( $valid, (array) $row['days'] ) ) : array();
				$opens  = isset( $row['opens'] ) && preg_match( '/^\d{1,2}:\d{2}$/', $row['opens'] ) ? $row['opens'] : '';
				$closes = isset( $row['closes'] ) && preg_match( '/^\d{1,2}:\d{2}$/', $row['closes'] ) ? $row['closes'] : '';
				$rows[] = array(
					'label'  => isset( $row['label'] ) ? sanitize_text_field( $row['label'] ) : '',
					'time'   => isset( $row['time'] ) ? sanitize_text_field( $row['time'] ) : '',
					'days'   => $days,
					'opens'  => $opens,
					'closes' => $closes,
				);
			}
			$existing[ $key ] = $rows;
		} elseif ( 'repeater' === $field['type'] ) {
			$rows = array();
			foreach ( (array) $raw as $row ) {
				$clean = array();
				foreach ( $field['columns'] as $col_key => $col ) {
					$clean[ $col_key ] = mb_sanitize_field_value( $col, isset( $row[ $col_key ] ) ? $row[ $col_key ] : '', false );
				}
				$rows[] = $clean;
			}
			$existing[ $key ] = $rows;
		} else {
			$existing[ $key ] = mb_sanitize_field_value( $field, null === $raw ? '' : $raw, false );
		}
	}
	return $existing;
}

/**
 * Output the admin page.
 */
function mb_settings_render_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$schema = mb_settings_schema();
	// Tab switching is a read-only view parameter, no state changes.
	$tab = isset( $_GET['tab'] ) ? sanitize_key( wp_unslash( $_GET['tab'] ) ) : 'general'; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	if ( ! isset( $schema[ $tab ] ) ) {
		$tab = 'general';
	}
	$values = mb_get_settings();

	echo '<div class="wrap mb-settings"><h1>' . esc_html__( 'Salon Settings', 'maison-belle-core' ) . '</h1>';
	settings_errors();

	echo '<nav class="nav-tab-wrapper">';
	foreach ( $schema as $slug => $def ) {
		printf(
			'<a href="%1$s" class="nav-tab%2$s">%3$s</a>',
			esc_url( add_query_arg( array( 'page' => 'mb-salon-settings', 'tab' => $slug ), admin_url( 'admin.php' ) ) ),
			$slug === $tab ? ' nav-tab-active' : '',
			esc_html( $def['label'] )
		);
	}
	echo '</nav>';

	echo '<form method="post" action="options.php">';
	settings_fields( 'mb_settings_group' );
	echo '<input type="hidden" name="mb_settings[_tab]" value="' . esc_attr( $tab ) . '">';
	echo '<table class="form-table" role="presentation"><tbody>';
	foreach ( $schema[ $tab ]['fields'] as $key => $field ) {
		$name  = 'mb_settings[' . $key . ']';
		$value = $values[ $key ];
		echo '<tr><th scope="row"><label for="mb_' . esc_attr( $key ) . '">' . esc_html( $field['label'] ) . '</label></th><td>';
		if ( 'hours' === $field['type'] ) {
			mb_render_hours_field( $name, $field, $value );
		} elseif ( 'repeater' === $field['type'] ) {
			mb_render_repeater_field( $name, $field, $value );
		} else {
			mb_render_field( $name, $field, $value, 'mb_' . $key );
		}
		if ( ! empty( $field['help'] ) ) {
			echo '<p class="description">' . esc_html( $field['help'] ) . '</p>';
		}
		echo '</td></tr>';
	}
	echo '</tbody></table>';
	submit_button();
	echo '</form>';

	if ( 'general' === $tab ) {
		mb_render_seed_box();
	}
	echo '</div>';
}

/**
 * Hours editor: a few rows with label, text, days and open / close times.
 *
 * @param string $name  Base input name.
 * @param array  $field Field definition.
 * @param array  $value Saved rows.
 */
function mb_render_hours_field( $name, $field, $value ) {
	$days  = array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday' );
	$value = is_array( $value ) ? array_values( $value ) : array();
	echo '<div class="mb-hours">';
	for ( $i = 0; $i < $field['rows']; $i++ ) {
		$row = wp_parse_args( isset( $value[ $i ] ) ? $value[ $i ] : array(), array( 'label' => '', 'time' => '', 'days' => array(), 'opens' => '', 'closes' => '' ) );
		/* translators: %d: row number. */
		echo '<div class="mb-hours__row"><strong>' . esc_html( sprintf( __( 'Row %d', 'maison-belle-core' ), $i + 1 ) ) . '</strong><div class="mb-hours__grid">';
		printf( '<label>%s<input type="text" class="regular-text" name="%s[%d][label]" value="%s" placeholder="Mon – Sat"></label>', esc_html__( 'Label', 'maison-belle-core' ), esc_attr( $name ), (int) $i, esc_attr( $row['label'] ) );
		printf( '<label>%s<input type="text" class="regular-text" name="%s[%d][time]" value="%s" placeholder="10am – 7pm"></label>', esc_html__( 'Hours as shown', 'maison-belle-core' ), esc_attr( $name ), (int) $i, esc_attr( $row['time'] ) );
		printf( '<label>%s<input type="time" name="%s[%d][opens]" value="%s"></label>', esc_html__( 'Opens (24h)', 'maison-belle-core' ), esc_attr( $name ), (int) $i, esc_attr( $row['opens'] ) );
		printf( '<label>%s<input type="time" name="%s[%d][closes]" value="%s"></label>', esc_html__( 'Closes (24h)', 'maison-belle-core' ), esc_attr( $name ), (int) $i, esc_attr( $row['closes'] ) );
		echo '</div><div class="mb-hours__days">';
		foreach ( $days as $day ) {
			printf(
				'<label><input type="checkbox" name="%1$s[%2$d][days][]" value="%3$s"%4$s> %3$s</label>',
				esc_attr( $name ),
				(int) $i,
				esc_attr( $day ),
				checked( in_array( $day, (array) $row['days'], true ), true, false )
			);
		}
		echo '</div></div>';
	}
	echo '</div>';
}

/**
 * Repeater editor with a fixed number of rows.
 *
 * @param string $name  Base input name.
 * @param array  $field Field definition.
 * @param array  $value Saved rows.
 */
function mb_render_repeater_field( $name, $field, $value ) {
	$value = is_array( $value ) ? array_values( $value ) : array();
	echo '<div class="mb-repeater">';
	for ( $i = 0; $i < $field['rows']; $i++ ) {
		/* translators: %d: row number. */
		echo '<div class="mb-repeater__row"><strong>' . esc_html( sprintf( __( 'Item %d', 'maison-belle-core' ), $i + 1 ) ) . '</strong>';
		foreach ( $field['columns'] as $col_key => $col ) {
			$val = isset( $value[ $i ][ $col_key ] ) ? $value[ $i ][ $col_key ] : '';
			echo '<label>' . esc_html( $col['label'] ) . '<br>';
			mb_render_field( $name . '[' . $i . '][' . $col_key . ']', $col, $val, 'mb_' . md5( $name . $i . $col_key ) );
			echo '</label>';
		}
		echo '</div>';
	}
	echo '</div>';
}

/**
 * "Install demo content" box shown under the General tab.
 */
function mb_render_seed_box() {
	$url = wp_nonce_url( admin_url( 'admin-post.php?action=mb_seed_demo' ), 'mb_seed_demo' );
	echo '<hr><h2>' . esc_html__( 'Demo content', 'maison-belle-core' ) . '</h2>';
	echo '<p>' . esc_html__( 'Creates the demo pages, menus, services, gallery, reviews, promotions and blog posts. It is safe to run again: nothing is duplicated, and your edits to existing items are kept (only missing items are created).', 'maison-belle-core' ) . '</p>';
	echo '<p><a class="button" href="' . esc_url( $url ) . '">' . esc_html__( 'Install / repair demo content', 'maison-belle-core' ) . '</a></p>';
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- read-only notice flag.
	if ( isset( $_GET['mb_seeded'] ) ) {
		echo '<div class="notice notice-success inline"><p>' . esc_html__( 'Demo content is ready.', 'maison-belle-core' ) . '</p></div>';
	}
}
