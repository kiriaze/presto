<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //

$hostname = $_SERVER['HTTP_HOST']; // ex. localhost, site.dev, localhost/site etc...

switch ($hostname) {

    case 'local.dev':
        define('DB_NAME', 'local_db');
        define('DB_USER', 'root');
        define('DB_PASSWORD', '');
        define('DB_HOST', '127.0.0.1'); // some need localhost
        define('DEBUG', true);
        break;

    default:
        define('DB_NAME', 'prod_db');
        define('DB_USER', 'username');
        define('DB_PASSWORD', 'password');
        define('DB_HOST', 'localhost');
        define('DEBUG', true);
        break;

}


/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');


// ========================
// Custom Content Directory
// ========================
define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/wp-content' );
define( 'WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/wp-content' );


// =============================================
// Set simple-child as Default theme
// =============================================
$themes = scandir(WP_CONTENT_DIR . '/themes', 1);
foreach ($themes as $theme) {
    if ( $theme == 'simple-child' ) {
        $default_theme = ucfirst($theme);
    }
}
define('WP_DEFAULT_THEME', $default_theme);


// ================================================
// You almost certainly do not want to change these
// ================================================
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );


// ==============================================================
// Table prefix
// Change this if you have multiple installs in the same database
// ==============================================================
$table_prefix  = 'wp_';

// ================================
// Language
// Leave blank for American English
// ================================
define( 'WPLANG', '' );


// ============
// Hide errors
// ============
ini_set( 'display_errors', 0 );
define( 'WP_DEBUG_DISPLAY', true );


// =================================================================
// Debug mode
// =================================================================
define( 'SAVEQUERIES', DEBUG );
define( 'WP_DEBUG', DEBUG );


// =================================================================
// Memory
// =================================================================
define('WP_MEMORY_LIMIT', '64M');


// ======================================
// Load a Memcached config if we have one
// ======================================
if ( file_exists( dirname( __FILE__ ) . '/memcached.php' ) )
	$memcached_servers = include( dirname( __FILE__ ) . '/memcached.php' );

// ===================
// Bootstrap WordPress
// ===================
if ( !defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/wp/' );
require_once( ABSPATH . 'wp-settings.php' );