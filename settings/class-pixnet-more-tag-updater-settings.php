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
        
        // Hook to admin_init to receive form call
        add_action( 'admin_init', array( 'PIXNET_MORE_TAG_UPDATER_SETTINGS', 'watch_the_form_action_call' ) );
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
    
    /**
     * Watch the form action call
     * 
     * @since 0.1
     */
    public static function watch_the_form_action_call() {
        
        // If PMTU_START_CONVERT no data, pass
        if( ! isset( $_POST['PMTU_START_CONVERT'] ) ) {
            return;
        }
        
        // Check nonce and referer
        if( ! check_admin_referer( 'PMTU_START_CONVERT' ) || ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'PMTU_START_CONVERT' ) ) {
            return;
        }
        
        // Check permission
        if( ! current_user_can( 'manage_options' ) ) {
            return;
        }
        
        // Call $wpdb
        global $wpdb;
        
        // Full name of wp_posts table
        $posts_table = $wpdb->prefix . 'posts';
        
        // SQL query string
        $SQL_QUERY = $wpdb->prepare(
            "
            UPDATE %s
            SET `post_content` = REPLACE( `post_content`, '<!-- more -->', '<!--more-->' ),
                `post_content` = REPLACE( `post_content`, '&lt;!-- more --&gt;', '<!--more-->' )
            WHERE `post_content` LIKE '%-- more --%'
            ",
            $posts_table
        );
        
        // Execute SQL query
        if( false === $wpdb->query( $SQL_QUERY ) ) {
            wp_redirect( get_admin_url( null, 'tools.php?page=pixnet-more-tag-updater-settings&success=false') );
            exit;
        } else {
            wp_redirect( get_admin_url( null, 'tools.php?page=pixnet-more-tag-updater-settings&success=true') );
            exit;
        }
    }
    
}