<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         'kWRtBkgV]k%exNZTyS5Blc4RjqiKj!DCTz>dh2EKMZJWL[Thf>9z;kfDrelEA[L`' );
define( 'SECURE_AUTH_KEY',  'aa;oe&Syii4<dW8K<z VkvZWWzi+y6}_.`LOsxi>xo!N>9iGcL?l(px=m.%aNbpq' );
define( 'LOGGED_IN_KEY',    '8GVt#Hl}tl^KRR20](YeoNRG/~GV3KT-4+HbB1d@IR-GlzlCTU3+}</lXPt{ZOCU' );
define( 'NONCE_KEY',        'b1md8+)2-in EzQ%M2N&{Ylr ]1-<G1aGISdncazXhxuh+AMEMUay<>[ +DW@To0' );
define( 'AUTH_SALT',        'WlgOgN!1hdoBbaV|_RfBv%smWL@N]syHP:e/>9NTsk$2aX>MdK5S>$lDrfYOEZl}' );
define( 'SECURE_AUTH_SALT', 'bQsSj@_odk<X$y8z/NEJ%uz{^(C2/M>`;S5}:>k=|!80=p@3Lpf91hP7G5+vd~=a' );
define( 'LOGGED_IN_SALT',   'ks2+eLe1DRjGIo},vP>zjk!# N]};X!j3<u6gJtv1BN1fFYg-P@Q-`ZH:/AFJLEH' );
define( 'NONCE_SALT',       '*T3M?oF>gT~V<ivC[ oQfT1*L5Dqz*5oITOX2N{$}ap>!V1nM)BhzxzS:S*/GWA.' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
