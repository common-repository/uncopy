<?php

if (!defined('WPINC')) {
    die;
}

function uncopy_add_noscript_tag($tag)
{
    $logo = UNCOPY_URL . 'frontend/images/logo-lg.png';
    $disabled_js_msg = get_option('uncopy_settings_html_disabled_js_msg');

    echo '<noscript><div style="display:flex;width: 100% !important; height: 100% !important; position: fixed !important; background-color: #f8f8f8 !important; z-index: 999999999999 !important; -webkit-text-stroke-width: thin !important; text-align: center !important; top: 0 !important; left: 0 !important; display: flex; justify-content: center; align-items: center;">';
    echo wp_kses_post($disabled_js_msg);
    echo '</div></noscript>';

}

add_action('wp_head', 'uncopy_add_noscript_tag');
