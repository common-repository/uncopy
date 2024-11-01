<?php
if (!defined('WPINC')) {
    die;
}

// CSS
function uncopy_add_my_js()
{
    // wp_enqueue_script('uncopy-js', UNCOPY_URL . 'admin/js/alpine.min.js');

}

add_action('admin_enqueue_scripts', 'uncopy_add_my_js');
