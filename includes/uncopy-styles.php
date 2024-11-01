<?php
if (!defined('WPINC')) {
    die;
}

// CSS
function uncopy_admin_stylesheet()
{
    wp_register_style('uncopy-style', UNCOPY_URL . 'admin/css/uncopy-admin-style.css');
    wp_enqueue_style('uncopy-style');
}
function uncopy_admin_stylesheet_global()
{
    wp_register_style('uncopy-style', UNCOPY_URL . 'admin/css/uncopy-admin-style-global.css');
    wp_enqueue_style('uncopy-style');
}

if(isset($_GET['page']) && esc_html($_GET['page']) == 'uncopy'){
    add_action('admin_enqueue_scripts', 'uncopy_admin_stylesheet');
}

add_action('admin_enqueue_scripts', 'uncopy_admin_stylesheet_global');