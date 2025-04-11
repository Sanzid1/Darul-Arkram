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
define( 'DB_NAME', 'darul_arkam' );

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
define( 'AUTH_KEY',         'FtQ&FIf)gULIMow2CJ5_/Fdfk=cUqNkutH*>hp2*$i9iKL*OZGRy,Aa:p4CDh]P2' );
define( 'SECURE_AUTH_KEY',  '|zP_+,Q,R%Gh^)&5.`ko0^:Gi>;%~X+d[]G+KXT2c}O3pTlHB-|q1 @v}|*Bw>Gw' );
define( 'LOGGED_IN_KEY',    'zZ};E3fj_7crZ)b28mt:y;DY#{D_%[5C(;#uFnxTH `!7xwc<<W`l:sk.7af0QYk' );
define( 'NONCE_KEY',        '5##@MAS5^b=aaXtl}zo==##Qj<FYSVn53%ThQkg9OaRzM]^ycI93K5)A6uA{G9@<' );
define( 'AUTH_SALT',        '_L0v$^#bbRJ]E-}MHJ|/<y-wbg(KE N>Q^eM#O8FJ%ba9iTfi]4e0c@Sjb>bVEN)' );
define( 'SECURE_AUTH_SALT', 'pzQ>O[FB=6z.O%w?2R?6Ld5dMI3t1~^,5EEkv)pDC 2ohbf<qQT,&Up>5RjG9cpi' );
define( 'LOGGED_IN_SALT',   'G2eu@Zg%&hDHW_YOlwHuU!Y KidZiKO`I!A)Gn:X_s;9p?c0Fq?XS.@/@s0KpLLc' );
define( 'NONCE_SALT',       '|=ld|Fb*Y.pO}QyU}:8s@~#};85V{juJsd9FgtBzO_}s&Iz?B1 = ;!(KWz#aYBG' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
