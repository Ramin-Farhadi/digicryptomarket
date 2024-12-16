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
define( 'DB_NAME', 'bitnami_wordpress' );

/** Database username */
define( 'DB_USER', 'bn_wordpress' );

/** Database password */
define( 'DB_PASSWORD', '8b6494455cf742eb5efc0f4fbea1b3928901658ae8f104d5bff3ebf3f20acb22' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1:3306' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',         '_{}5*3Ro)9jg@(+`_@ui@@S[|J)^]w#8Hp5,0:M6]^fvXtcVN7t3~Mj,V`AkW9-K' );
define( 'SECURE_AUTH_KEY',  'a2lQ{?MKLr~+U^C]3]Id9s{4fgS%[X$aCrK} V4(F!-K1d8|%R kY1]:IP^}lJ+Z' );
define( 'LOGGED_IN_KEY',    '9{ZfY`-S;lPctqlSg=`tiFGy;4V>b_{2M!5^RS!Qeg%wNc*Kct6fVH1Z7|~]m>[C' );
define( 'NONCE_KEY',        'oKY&?V_w2Hfb-dwC+4$GhZ4S?]Etsq-ttCF]Ob;>@?$rROuc9dEi5.#a~7S=Fsl<' );
define( 'AUTH_SALT',        'u+vPd/9U2Ej$! %4D*Vg0FyAK!K0G[cqE5t<O*t/4J)H3ShK^K5brKMemZufG6TF' );
define( 'SECURE_AUTH_SALT', 'z-a<mdZ&LN;,:XS))Jq!a={Nm-i~pab4Dd:]_+C8ZST)x/3uQMe9nJAG*Bl<?-0d' );
define( 'LOGGED_IN_SALT',   'X-l@+U<P%~W`)he!oT2fyQh>l3DADJM$M1fpsdlRBW/!R1?Mu2frmppMB$r<tCnV' );
define( 'NONCE_SALT',       '{:{Tml.ZOc:EH!qvla}tI%B@yT+s9Uw0n`jz`o}Wubw;a;u5m3@TVeA?_,NUrTPt' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );


define( 'WP_ALLOW_MULTISITE', true );
define( 'MULTISITE', true );
define( 'SUBDOMAIN_INSTALL', true );
$base = '/';
define( 'DOMAIN_CURRENT_SITE', 'digicryptomarket.com' );
define( 'PATH_CURRENT_SITE', '/' );
define( 'SITE_ID_CURRENT_SITE', 1 );
define( 'BLOG_ID_CURRENT_SITE', 1 );

/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

/**
 * Disable pingback.ping xmlrpc method to prevent WordPress from participating in DDoS attacks
 * More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/
 */
if ( !defined( 'WP_CLI' ) ) {
	// remove x-pingback HTTP header
	add_filter("wp_headers", function($headers) {
		unset($headers["X-Pingback"]);
		return $headers;
	});
	// disable pingbacks
	add_filter( "xmlrpc_methods", function( $methods ) {
		unset( $methods["pingback.ping"] );
		return $methods;
	});
}
