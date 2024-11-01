<?php
if (!defined('ABSPATH')) {
    die();
}
header("Content-type: application/javascript; charset: UTF-8");

// Javascript
$uncopy_js_set = 'uncopy_settings_javascript_';
$right_click = get_option($uncopy_js_set . 'right_click');
$disable_keys = get_option($uncopy_js_set . 'disable_keys');
$text_selection = get_option($uncopy_js_set . 'text_selection');
$image_text_dragging = get_option($uncopy_js_set . 'image_text_dragging');

/*
<script>
 */
?>

const unCopyConfig = {
    js: {
        right_click: <?php echo esc_html($right_click) ? 1 : 0;?>,
        disable_keys: <?php echo esc_html($disable_keys) ? 1 : 0;?>,
        text_selection: <?php echo esc_html($text_selection) ? 1 : 0;?>,
        image_text_dragging: <?php echo esc_html($image_text_dragging) ? 1 : 0;?>,
    }
}