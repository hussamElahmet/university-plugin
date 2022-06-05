<?php
define( 'WP_CACHE', true );
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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'horizons_wp532' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'jgxkcmmgzflsthqt3ucg3lei6t1gpetpdh5pldetgsm1fhlkabgxvoq7roj0mndf' );
define( 'SECURE_AUTH_KEY',  'ap7w6nkv6j4vs6hfvvtoduf7q6ldo7qg1mtn6n64czqpficltg0un6bnxeq8j90c' );
define( 'LOGGED_IN_KEY',    'kkilehf9arnanj5rfnttb2acvdd3gztnbul4cwcclpdkouojb3t5ea9o7low1yjk' );
define( 'NONCE_KEY',        'czqf9fc0ywkjqueps84zjcaa5pdjhfuxroxoxza5si7swqqryqhrbwyvgqdqrow6' );
define( 'AUTH_SALT',        'bo9kvmbp4rhd0s9yg4aujy7chaq7n4jcqwtrns1gkledwnghnojsvtkueqzml9rg' );
define( 'SECURE_AUTH_SALT', 't0s4x9t1hytpdokjn89usylkwhogxxt6eeqj1xtdrr9fdccwz7xmrvbtmuf2djbw' );
define( 'LOGGED_IN_SALT',   'plyyyqifjnd4fxxkmksu8fxkbpwlsx2kjxodti4zfqtbhrj1nggkbxvs6ih6re2n' );
define( 'NONCE_SALT',       '5anwtrsdxg6amykqvmm6lr5phthebidb41vgavdx045owyzirxz0poatknjgvgax' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wprc_';

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
