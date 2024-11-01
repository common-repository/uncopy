<?php

if (!defined('WPINC')) {
    die;
}
// Load JS on the frontend
function uncopy_frontend_style()
{

    wp_enqueue_style(
        'uncopy-frontend',
        UNCOPY_URL . 'frontend/css/uncopy-frontend.min.css',
        [],
        UNCOPY_VERSION
    );
}
add_action('wp_enqueue_scripts', 'uncopy_frontend_style', 100);
