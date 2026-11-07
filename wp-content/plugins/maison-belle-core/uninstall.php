<?php
/**
 * Uninstall: runs only when the plugin is DELETED from the Plugins screen.
 *
 * Safety first: services, gallery, reviews, promotions, posts and pages are NEVER
 * deleted automatically. Only the settings option is removed, and only when the
 * site owner explicitly opts in by defining MB_CORE_REMOVE_DATA in wp-config.php.
 *
 * @package MaisonBelleCore
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

if ( defined( 'MB_CORE_REMOVE_DATA' ) && MB_CORE_REMOVE_DATA ) {
	delete_option( 'mb_settings' );
}
