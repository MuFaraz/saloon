<?php
/**
 * Plugin Name:       Maison Belle Core
 * Description:       Content layer for the Maison Belle nail salon site: services, gallery, reviews and promotions, the Salon Settings page, schema.org NailSalon markup and demo content seeding. Survives a theme change.
 * Version:           1.0.0
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            Maison Belle
 * License:           GPL-2.0-or-later
 * Text Domain:       maison-belle-core
 *
 * @package MaisonBelleCore
 */

defined( 'ABSPATH' ) || exit;

define( 'MB_CORE_VERSION', '1.0.0' );
define( 'MB_CORE_FILE', __FILE__ );
define( 'MB_CORE_DIR', plugin_dir_path( __FILE__ ) );
define( 'MB_CORE_URL', plugin_dir_url( __FILE__ ) );

require_once MB_CORE_DIR . 'inc/settings-schema.php';
require_once MB_CORE_DIR . 'inc/helpers.php';
require_once MB_CORE_DIR . 'inc/post-types.php';
require_once MB_CORE_DIR . 'inc/meta-boxes.php';
require_once MB_CORE_DIR . 'inc/term-meta.php';
require_once MB_CORE_DIR . 'inc/settings-page.php';
require_once MB_CORE_DIR . 'inc/schema.php';
require_once MB_CORE_DIR . 'inc/contact-form.php';
require_once MB_CORE_DIR . 'inc/shortcodes.php';
require_once MB_CORE_DIR . 'inc/seeder.php';

/**
 * On activation: register content types so rewrite rules are correct.
 */
function mb_core_activate() {
	mb_register_post_types();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'mb_core_activate' );

/**
 * On deactivation: clean rewrite rules only. Content is never touched.
 */
function mb_core_deactivate() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'mb_core_deactivate' );
