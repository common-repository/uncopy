<?php

if (!defined('WPINC')) {
    die;
}
// Load JS on the frontend
function uncopy_frontend_scripts()
{

    wp_enqueue_script(
        'uncopy-frontend',
        UNCOPY_URL . 'frontend/js/uncopy-frontend.min.js',
        [],
        UNCOPY_VERSION
    );
}
add_action('wp_enqueue_scripts', 'uncopy_frontend_scripts');

function dynamic_enqueue_scripts()
{

    wp_enqueue_script(
        'dynamic-javascript', //handle
        admin_url('admin-ajax.php') . '?action=dynamic_javascript_action&wpnonce=' . wp_create_nonce('dynamic-javascript-nonce'), // src
        [], // dependencies, I use jquery in dynamic-javascript.php
        UNCOPY_VERSION // version number
    );

}

function dynamic_javascript_loader()
{
    $nonce = $_REQUEST['wpnonce'];
    if (!wp_verify_nonce($nonce, 'dynamic-javascript-nonce')) {
        die('invalid nonce');
    } else {
        require_once dirname(__FILE__) . '/dynamic-javascript.php';
    }
    exit;
}

add_action('wp_enqueue_scripts', 'dynamic_enqueue_scripts');

add_action('wp_ajax_dynamic_javascript_action', 'dynamic_javascript_loader');
add_action('wp_ajax_nopriv_dynamic_javascript_action', 'dynamic_javascript_loader');
