<?php
/**
 * PIXNET More Tag Updater
 * 
 * @author Hiram Huang <me@hiram.tw>
 * @since 0.1
 */
 
/**
 * If file is opened directly, return 403 error
 */
if( ! function_exists ('add_action') ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}
?>
<div class="wrap">
    <h1><?php _e( '痞客邦 More 標籤轉換工具', PMTU_TEXT_DOMAIN ) ?></h1>
    <?php // Check success message ?>
    <?php if( isset( $_GET['success'] ) && $_GET['success'] === 'true' ): ?>
        <div class="notice notice-success is-dismissiable">
            <p>轉換成功！</p>
        </div>
    <?php elseif( isset( $_GET['success'] ) && $_GET['success'] === 'false' ): ?>
        <div class="notice notice-error is-dismissiable">
            <p>轉換失敗！</p>
        </div>
    <?php endif; ?>
    <?php // Check success message end ?>
    <p><?php _e( '一鍵將痞客邦 More 標籤轉換為 WordPress 格式。', PMTU_TEXT_DOMAIN ) ?></p>
    <form role="form" action="options.php" method="post">
        <?php wp_nonce_field( 'PMTU_START_CONVERT' ) ?>
        <input type="hidden" name="PMTU_START_CONVERT" value="1">
        <?php submit_button( __( '開始轉換', PMTU_TEXT_DOMAIN ) ) ?>
    </form>
</div>