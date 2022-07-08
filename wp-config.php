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
define( 'DB_NAME', 'sarjapur_road_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         '?_)~*(q[&>@L+sq;y,53{dq(HS7zebX|Zm!88;FQ!@EwM*0_dy7D9*ys5Q>tdIgP' );
define( 'SECURE_AUTH_KEY',  '4j?VP~_woo!gjeGe=H k.5>WiLqF[3ZW~Xi:#7P 2FpGsmj.`?zavnA=n}1So<ti' );
define( 'LOGGED_IN_KEY',    'm87r^^}^haXk$r(;{9?,w?JZ1#7X]@p1OLZ&@ 6#_ F<}j$L3@T92m1{7+l9Lu]m' );
define( 'NONCE_KEY',        ' jAa+r/ ,WFo.zc:a+O)wULmw2&lKD,9PtZ#^^-(WOo(@d|>+ZQ.vNk8ul*4yCo|' );
define( 'AUTH_SALT',        'i[m>8tTKY89##$bT}OcD4{{1Tdy6P~CUDT)6%:VO7Ik!IOd#755.w~,y6E,<;!0I' );
define( 'SECURE_AUTH_SALT', 'R%Uxwmk{<wL8<:5>9D,{oo]Wv-dJAj^A@{nJ3{Ya*4Ln-a-08(`f<`(J~o2?RG-R' );
define( 'LOGGED_IN_SALT',   '^4^EyTiQLzxl7wQG2AOH;*Z^9kWw#|Su)P}V>qHVGsDa0P574m)8wzD-YGrU]&mY' );
define( 'NONCE_SALT',       '~tn03?If^BMtJW>2KSn4G0)ax>5kd]]cHB4O#$U*qZG^V_gXiuyD&*DD}YNO-f7&' );

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
