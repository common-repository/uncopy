<?php
if (!defined('WPINC')) {
    die;
}

// Create Menu
function uncopy_settings_page()
{
    add_menu_page('UnCopy', "UnCopy", "manage_options", "uncopy", "uncopy_settings_page_markup", UNCOPY_URL . 'admin/images/wp-menu-icon.png', 1000);
}
add_action("admin_menu", "uncopy_settings_page");

// Add a link to your settings page in your plugin
function uncopy_add_settings_link($links)
{
    array_unshift($links, '<a href="admin.php?page=uncopy">Settings</a>');

    if(!UNCOPY_IS_PRO){
        array_push($links, '<a href="#" style=" color: red; font-weight: bold; ">Go PRO</a>');
    }
    return $links;
}
$filter_name = "plugin_action_links_" . UNCOPY_BASENAME;
add_filter($filter_name, 'uncopy_add_settings_link');

// Settings
function uncopy_settings_page_markup()
{
    if (!current_user_can('manage_options')) {return;}

    include UNCOPY_DIR . "templates/admin/settings-page.php";
}
