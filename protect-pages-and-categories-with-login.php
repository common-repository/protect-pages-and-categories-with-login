<?php
/**
 * Plugin Name: Protect pages and categories with login
 * Plugin URI:
 * Description: Protect pages and categories with login using a shortcode.
 * Version: 1.3
 * Author: Federico Rota
 * Author URI: http://www.spazioquattro.it
 * License: GPL2
 * Text Domain: protect-pages-and-categories-with-login
 * Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

define('SP4_PPCL_FILE', __FILE__);
define('SP4_PPCL_PATH', plugin_dir_path(__FILE__));
define('SP4_PPCL_BASENAME', plugin_basename( __FILE__ ));

require SP4_PPCL_PATH.'includes/plugin-class.php';

$sp4_PPCL = new sp4_PPCL() ;