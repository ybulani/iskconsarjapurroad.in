<?php
/**
 * Plugin Name: Gutenverse
 * Description: Collection of easy to use and customizable blocks for WordPress Block Editor. Build a great website using block provided with Gutenverse.
 * Plugin URI: https://gutenverse.com/
 * Author: Jegstudio
 * Version: 1.1.9
 * Author URI: https://jegtheme.com/
 * License: GPLv3
 * Text Domain: gutenverse
 *
 * @package gutenverse
 */

defined( 'GUTENVERSE' ) || define( 'GUTENVERSE', 'gutenverse' );
defined( 'GUTENVERSE_VERSION' ) || define( 'GUTENVERSE_VERSION', '1.1.9' );
defined( 'GUTENVERSE_NAME' ) || define( 'GUTENVERSE_NAME', 'GUTENVERSE' );
defined( 'GUTENVERSE_URL' ) || define( 'GUTENVERSE_URL', plugins_url( GUTENVERSE ) );
defined( 'GUTENVERSE_FILE' ) || define( 'GUTENVERSE_FILE', __FILE__ );
defined( 'GUTENVERSE_DIR' ) || define( 'GUTENVERSE_DIR', plugin_dir_path( __FILE__ ) );
defined( 'GUTENVERSE_LANG_DIR' ) || define( 'GUTENVERSE_LANG_DIR', GUTENVERSE_DIR . 'languages' );
defined( 'GUTENVERSE_PATH' ) || define( 'GUTENVERSE_PATH', plugin_basename( __FILE__ ) );
defined( 'GUTENVERSE_LIBRARY_URL' ) || define( 'GUTENVERSE_LIBRARY_URL', 'https://gutenverse.com/' );
defined( 'GUTENVERSE_STORE_URL' ) || define( 'GUTENVERSE_STORE_URL', 'https://gutenverse.com/products' );

require_once 'vendor/autoload.php';
register_wp_autoload( 'Gutenverse', __DIR__ . '/includes' );
\Gutenverse\Gutenverse::instance();
