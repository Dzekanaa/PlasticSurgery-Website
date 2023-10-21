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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'duskomarkovic' );

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
define( 'AUTH_KEY',         'XZ7g5[K^,}MHW+ayswz4ec(/C&zL?VQm,)KTkt,(?DxzB-g3t**CoQpW1eBdmu1m' );
define( 'SECURE_AUTH_KEY',  'Q2lBDaAxFhQ=6H[Id?5;T^[)7uG>|^S_CQ0wlRDHt+V6*p&w3C<FNhzlu?3>6d=^' );
define( 'LOGGED_IN_KEY',    '^1jwJAIu0wO)_qQe-0XgGrN6Y&oQ4IF, lz>a7*kdc`Ti+DVUYsc?S^S3xsMpI~m' );
define( 'NONCE_KEY',        'X4o5MI_As%* T=T~OWt_1<_rKdmhua9wm_1)sm!.2f_rF=JzIed?;-, (Ga9,[!6' );
define( 'AUTH_SALT',        'JLLvDqKgrY@/*K}TlKW[[;X$TtTlgSM5[}b?&-4NLHnU_S3vcii):lU(V)S$Dcd<' );
define( 'SECURE_AUTH_SALT', '8E*Sk:J_()$I,.a~VnWO%ndL?a>H{@q2geDO)}/Y5e$e}i`hnQu})TI,?n2xkL.o' );
define( 'LOGGED_IN_SALT',   'lJ*OUUny{9)/>LhffEpwPqbFXVRp9?qGrUh!>fPw~s8HevX9PV`KJ:8wu4]Hq6d*' );
define( 'NONCE_SALT',       ',].6D?I1=YF0[0M59kGDTAb5!OnXUvA=+QC#]/F2!:,:U1#6!heIEj#X+KXA!u]x' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
