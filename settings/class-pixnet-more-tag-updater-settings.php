<?php
/**
 * PIXNET More Tag Updater
 *
 * @author Hiram Huang <me@hiram.tw>
 * @since 0.1
 */

class PIXNET_MORE_TAG_UPDATER_SETTINGS {
    
    const PMTU_SETTINGS_SLUG = 'pixnet-more-tag-updater-settings';
    
    /**
     * Initiator.
     * 
     * @since 0.1
     */
    public static function init() {
        
        // Hook to admin_menu to build a submenu
        add_action( 'admin_menu', array( 'PIXNET_MORE_TAG_UPDATER_SETTINGS', 'build_submenu_under_tools' ) );
        
    }
    
    /**
     * Build submenu under tools
     * 
     * @since 0.1
     */
    public static function build_submenu_under_tools() {
        
        add_submenu_page(
            'tools.php',
            __( '痞客邦 More 標籤轉換工具', PMTU_TEXT_DOMAIN ),
            __( '痞客邦 More 轉換', PMTU_TEXT_DOMAIN ),
            'manage_options',
            self::PMTU_SETTINGS_SLUG,
            array( 'PIXNET_MORE_TAG_UPDATER_SETTINGS', 'render_the_submenu_template' )
        );
        
    }
    
    /**
     * Submenu template render
     * 
     * @since 0.1
     */
    public static function render_the_submenu_template() {
        
        include_once( PMTU_BASE_FULL . '/settings/template-convert-tool.php' );
        
    }
    
}