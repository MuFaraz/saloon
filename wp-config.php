<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'nail_saloon' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'z]>>*|GmPB$BJ:9<mj%b5 }0b@!BUnl;^34skh4a{)I|KnK(YLzNy2(GEoJJFHTE' );
define( 'SECURE_AUTH_KEY',  'hFyG-oO{/{gS_z=}5)%k$zXP:LT1U[3/Br{Ty2~i!Tk9~J#kBl2eAH4rDr]!+t2T' );
define( 'LOGGED_IN_KEY',    'QGW|X Dn[LDJm@=mtJOP_i)vr/9s5B}Jl-h0QB/Q@V`GLDig moHm#i61ZUHR`jX' );
define( 'NONCE_KEY',        'CxGzcF }jb8qLZ*# R`3P6 CbcjQ*MS~5$7qRJf~_mOGo!dhyQ%=,JH|cFedlS5k' );
define( 'AUTH_SALT',        'v}Gki4DJA5$t,s<,5@^p%(ln~|}#QHg4tbOu0Y5xD@T<i7cy{D,VIMl8Um%M2CVQ' );
define( 'SECURE_AUTH_SALT', 's}w7. s1EBpi;P9*Q%y`P#$:ns<]Igz},Z:%<:]_;OSf;*:v7#b.~$vsbQJ$UWfP' );
define( 'LOGGED_IN_SALT',   'wx##h Q,lc*-5?Zu,%m) |A?< K$-Xby;MNk _E8SrF*q@7$7Me/aUe$is]%dp!D' );
define( 'NONCE_SALT',       'LbbMrEih*d8_Fv5N9h9X Kl)bi:LQ3Ts_b[z^s<|b]iE8bT_>?!5DG`C-/K8>%7j' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
