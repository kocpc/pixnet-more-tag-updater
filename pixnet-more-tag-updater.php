<?php
/**
 * PIXNET More Tag Updater
 *
 * Plugin Name: 痞客邦 More 標籤更新工具
 * Description: 一鍵將痞客邦 More 標籤轉換為 WordPress 格式。
 * Author: Hiram Huang <me@hiram.tw>
 * Author URI: https://www.facebook.com/naxqihao
 * Version: 0.1
 * Text Domain: pixnet-more-tag-updater
 * Domain Path: /languages
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 *
 * @author      Hiram Huang <me@hiram.tw>
 * @package     pixnet-more-tag-updater
 * @license     http://www.gnu.org/licenses/gpl-3.0.txt
 * @link        Github Repo: https://github.com/kocpc/pixnet-more-tag-updater
 * @since       0.1
 */
 
/**
 * If file is opened directly, return 403 error
 */
if( ! function_exists ( 'add_action' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

/**
 * Defines plugin named constant
 */
define( 'PMTU_VERSION', 0.1 );
define( 'PMTU_PATH_FULL', __FILE__ );
define( 'PMTU_BASE_FULL', dirname(__FILE__) );
define( 'PMTU_BASE_RELATIVE', plugin_basename(__FILE__) );
define( 'PMTU_FILE_BASENAME', pathinfo( __FILE__, PATHINFO_FILENAME ) );
define( 'PMTU_TEXT_DOMAIN', 'pixnet-more-tag-updater' );

/**
 * Load languages
 */
function load_languages() {
    load_plugin_textdomain( PMTU_TEXT_DOMAIN, false, PMTU_FILE_BASENAME . '/languages' );
}
add_action( 'plugins_loaded', 'load_languages' );

/**
 * Import plugin classes.
 */
include_once( PMTU_BASE_FULL . '/settings/class-pixnet-more-tag-updater-settings.php' );

/**
 * Initial plugin.
 */
PIXNET_MORE_TAG_UPDATER_SETTINGS::init();