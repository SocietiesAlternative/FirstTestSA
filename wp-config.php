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
define( 'DB_NAME', 'wp_aws' );

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
define( 'AUTH_KEY',         ';*26b+ssG,3I6}v/!Rl{hDxnw0kFA]3VZ|:W-acfjN.FSl$muRQQRriy3wHm,&tL' );
define( 'SECURE_AUTH_KEY',  '}$%scpAQ~>]Gx6N%38]?^L9Km?b/)u=Kg}wiC!5Vvq9Jdr0:[ty2<09O4>3lDXt!' );
define( 'LOGGED_IN_KEY',    '%8)PEx+d9Ft=]?a<(PCoJ+Y+?Z!,VQ3H{E;^:uY`XT40:Ece)=oU(6poa?+|d_M2' );
define( 'NONCE_KEY',        '/b<th3Xv;,0g81Er1;/a 068_BNKr^G1JI}Z=Y,LMc7r>|]*(z%1ehR=@0zrvlIc' );
define( 'AUTH_SALT',        '6.0n;Y.hLK~2|-u|mfsOdL@q0O$,<CLWZemH0)f0 wNB&*s<.xtfW;%dm3@gU^7M' );
define( 'SECURE_AUTH_SALT', 'x0&J}*-Id;|_lF|(+xX3}g%-%%i[8-q_,Y[NxELHI@[^.1]~x;NMjZ@(WTs`LyCw' );
define( 'LOGGED_IN_SALT',   'Ie0ylP$Ep<x+573hAuy9|AQi2Zg9<b*U8L_4P`:a&pXkl+?Zcg1Xs@kkws|RJuJm' );
define( 'NONCE_SALT',       'NXKIE^Y=m^#|z~9EJJ^`0Keq<p,3N!bQeN3gu)gRh3I=8F:7&Xv,f{?n*hX}k4tC' );

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
