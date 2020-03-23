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
define( 'DB_NAME', 'epiz_25368298_fictionalU' );

//MySQL database username
define( 'DB_USER', 'epiz_25368298' );

//MySQL database password
define( 'DB_PASSWORD', 'jaBfQPm4lY' );

// MySQL hostname 
define( 'DB_HOST', 'sql109.epizy.com' );
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
define('AUTH_KEY',         '9ChH4wwuQV2bcPx5643DgGdnjWUPcpUBwXT1LGhFTB+BlEP6uZxFhcKsHDLKpPuX6514VwdAPRzLOESumV5KqQ==');
define('SECURE_AUTH_KEY',  '80q66ZCE8xjZ+bFn0inyqMfVhcwX9E72759qwCPKCz9jhtLnRROCaWlgCxDmsOpUvdCuWry76xIvpynTgDWAiA==');
define('LOGGED_IN_KEY',    'ibwWSe4Fi5Kgz0jvJL83BwMvKqnd2Q5qsbU21mhuyUbqcvN+2UllAvIac52SMjpbja1wjRT9eqrQWOxWCbsf5A==');
define('NONCE_KEY',        '2L3FRukK+soeGxpXZkx52InsCKLBzZuQ5K7UaUU/LKqGTy0zzJxGV0LOizDccxUwnHfn40ORq3CIqgsiHZ8ijQ==');
define('AUTH_SALT',        'xGI5XELfj1luBL+4sO5ytVeXQzcR5yO8w8hAnL82Go4wQhdVIuhoXNlqzrsXjU8Z3POz70+ihKp6OXR/eBSrcA==');
define('SECURE_AUTH_SALT', 'm1iUqBWD32aROLSMaDxOzfZgnzQNqcDAeH1h+OkykLBN72esNkWwNELmdr0evueeco7tn6k4cZOamhNQHn1tbQ==');
define('LOGGED_IN_SALT',   '8VzBn76veuX2me3VHWNH2RghP0NnCGU//4SefBgi80yu56EW22+zSGQEs2+hGw9TboYmk4ghcK8OqgXCT0HCbw==');
define('NONCE_SALT',       '3HTMR1jhhjyk7faLxc4/bFJ9FnQKFpYTGVqBvmPAuZkMx8wSoCGPK51f2x8LfpBbjjtGr6lxM+dK0cYngk5yUg==');

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
