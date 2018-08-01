<?php

// Autoload Composer dependencies
require_once(dirname(__DIR__) . '/vendor/autoload.php');

// Define base paths
$root_dir = dirname(__DIR__);
$webroot_dir = $root_dir . '/app';
define('WEBROOT_DIR', $webroot_dir);

// Load env variables
$dotenv = new Dotenv\Dotenv($root_dir);
$dotenv->load();
$dotenv->required('ENVIRONMENT')->allowedValues(['development', 'staging', 'production']);

/**
 * ENVIRONMENT
 */
define('WP_ENV', getenv('ENVIRONMENT')); // development | staging | production

/**
 * URLs
 */
define('WP_HOME', getenv('WP_HOME'));
define('WP_SITEURL', getenv('WP_SITEURL'));


// ========================
// Custom Content Directory
// ========================
define('CONTENT_DIR', '/content');
define('WP_CONTENT_DIR', $webroot_dir . CONTENT_DIR);
define('WP_CONTENT_URL', WP_HOME . CONTENT_DIR);


// ==============================================================
// DB settings
// Table prefix
// Change this if you have multiple installs in the same database
// ==============================================================

$table_prefix = 'wp_';
define('USE_MYSQL', (bool) getenv('USE_MYSQL'));  // turn it to true if you want to use MySQL instead of SQLite
define('DB_NAME', getenv('DB_NAME'));
define('DB_USER', getenv('DB_USER'));
define('DB_PASSWORD', getenv('DB_PASSWORD'));
define('DB_HOST', getenv('DB_HOST'));


// ==============================================================
// SQLITE DB
// ==============================================================
define('DB_DIR', dirname(__DIR__) . '/database/');
define('DB_FILE', 'db.sqlite');


// ==============================================================
// Authentication Unique Keys and Salts.
//
// Change these to different unique phrases!
// You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
// You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
//
// @since 2.6.0
// ==============================================================
define('AUTH_KEY',         getenv('AUTH_KEY'));
define('SECURE_AUTH_KEY',  getenv('SECURE_AUTH_KEY'));
define('LOGGED_IN_KEY',    getenv('LOGGED_IN_KEY'));
define('NONCE_KEY',        getenv('NONCE_KEY'));
define('AUTH_SALT',        getenv('AUTH_SALT'));
define('SECURE_AUTH_SALT', getenv('SECURE_AUTH_SALT'));
define('LOGGED_IN_SALT',   getenv('LOGGED_IN_SALT'));
define('NONCE_SALT',       getenv('NONCE_SALT'));


// ==============================================================
// Consistently update via composer and disallow file edit via browser
// ==============================================================
// define('AUTOMATIC_UPDATER_DISABLED', true);
define('DISALLOW_FILE_EDIT', true);


// =============================================
// In most cases you want to run a true cron task
// =============================================
define('DISABLE_WP_CRON', getenv('DISABLE_WP_CRON'));


// ================================================
// You almost certainly do not want to change these
// ================================================
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

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
define('WP_MEMORY_LIMIT', '512M'); // public
define('WP_MAX_MEMORY_LIMIT', '512M'); // admin


// ======================================
// Load a Memcached config if we have one
// ======================================
if ( file_exists( dirname( __FILE__ ) . '/memcached.php' ) )
	$memcached_servers = include( dirname( __FILE__ ) . '/memcached.php' );

// ===================
// Bootstrap WordPress
// ===================
if ( !defined( 'ABSPATH' ) )
	define( 'ABSPATH', $webroot_dir . '/wordpress/' );
require_once( ABSPATH . 'wp-settings.php' );
