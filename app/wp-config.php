<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
if (file_exists(dirname(__FILE__) . '/local.php')) {

// LOCAL DATABASE SETTINGS
// WP database name
define( 'DB_NAME', 'dbname' );

//MySQL database username
define( 'DB_USER', 'dbuser' );

//MySQL database password
define( 'DB_PASSWORD', '123' );

// MySQL hostname 
define( 'DB_HOST', 'localhost' );

} else {
// LIVE DATABASE SETTINGS
// WP database name
define( 'DB_NAME', 'brianj15_universityData' );

//MySQL database username
define( 'DB_USER', 'brianj15_wp692' );

//MySQL database password
define( 'DB_PASSWORD', 'VN)*UQ1@fP++' );

// MySQL hostname 
define( 'DB_HOST', 'localhost' );
}



/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
	define('AUTH_KEY',         'R,&*y%5LcQZ6DvIbU$VNB*B{Yd>bx.RLQ(ns-?Gt|^nf`~=Yl6g7oSECd,P&Y+rU');
	define('SECURE_AUTH_KEY',  'fiT1-fEMXop*/7~cGz4CD$*Cc. |toT`fFW!A!~|}0Up0h4FH8e==V{--!aFhn0F');
	define('LOGGED_IN_KEY',    'X.tGjHf` ._rzH,a,kuW7m~hoK)}f0P^Z$_~<jStU5{B):yq;&V/?i3;iC^1b9GF');
	define('NONCE_KEY',        '?bb@=h`#6Fa|ya/q27:W?)L~unUbEWhoJ7L7,S-zoD2VJmx8+]:BI}BA;g%A8qdu');
	define('AUTH_SALT',        '|Z6aVrNk~Ss+X$ F `.kU#YbIVETn>]DdR5[JN|Hh:50yw1*y<[7S:Z&1?~tZ#A-');
	define('SECURE_AUTH_SALT', 'KA$^7V~*3$M^>(+boPDS#r+ J:]#;2JYZhf)Hhn!MhO~T--2+;.m$ygok;G]/k%#');
	define('LOGGED_IN_SALT',   ';$vzcvH8e-?6Y>-Q!E,V@iTIIl]PNA)Q5q1cCUqR5Gv/Q*V?AK61ZXABFgd.)k4e');
	define('NONCE_SALT',       '|fsbWe_Cf(gg7gAKr.u*,wz|[}Dn9fhJSw39b:K0xiWN_B/okvbK/sk4z>`z)tLx');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
