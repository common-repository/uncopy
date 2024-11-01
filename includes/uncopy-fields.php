<?php
if (!defined('WPINC')) {
    die;
}

$tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : '';
$type = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '';

define('fields_pro_badge', '<span class="label label-inline label-light-warning label-sm ml-5 badge-pro">PRO</span>');

// HTML Protection
if ($type == 'html' || $tab == "html") {
    include __DIR__ . '/fields/html.php';
    add_action('admin_init', 'uncopy_html_settings');

// Backend Protection
} elseif ($type == 'backend' || $tab == "backend") {
    include __DIR__ . '/fields/backend.php';
    add_action('admin_init', 'uncopy_backend_settings');

// Anti-AdBlocker Protection
} elseif ($type == 'anti-adblocker' || $tab == "anti-adblocker") {
    include __DIR__ . '/fields/anti-adblocker.php';
    add_action('admin_init', 'uncopy_anti_adblocker_settings');
// Advanced
} elseif ($type == 'advanced' || $tab == "advanced") {
    include __DIR__ . '/fields/advanced.php';
    add_action('admin_init', 'uncopy_advanced_settings');

// Javascrip Protection
} elseif ($type == 'javascript' || $tab == "javascript") {
    include __DIR__ . '/fields/javascript.php';
    add_action('admin_init', 'uncopy_javascript_settings');

// General Settings
} elseif ($type == 'general' || $tab == "") {
    include __DIR__ . '/fields/general.php';
    add_action('admin_init', 'uncopy_general_settings');
}

include __DIR__ . '/fields/callbacks.php';
