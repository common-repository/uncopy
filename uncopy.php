<?php
/**
 * Plugin Name:       UnCopy
 * Plugin URI:        https://wp-protector.com/uncopy/
 * Description:       This Plugin is used to Protect your website content from copy, save image, view source, inspect element, disable javascript, disable right click, wp-json and adblocker etc.
 * Version:           1.1.0
 * Requires at least: 3.1
 * Requires PHP:      7.2
 * Author:            UnCopy Team
 * Author URI:        https://wp-protector.com/uncopy/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

if (!defined('WPINC')) {
    die;
}

define('UNCOPY_DIR', plugin_dir_path(__FILE__));
define('UNCOPY_URL', plugin_dir_url(__FILE__));
define('UNCOPY_WEBSITE', 'https://wp-protector.com/uncopy/');
define('UNCOPY_BASENAME', plugin_basename(__FILE__));
define('UNCOPY_PREFIX', "uncopy");
define('UNCOPY_VERSION', "1.1.0");
define('UNCOPY_IS_PRO', false);

include UNCOPY_DIR . 'uncopy-helpers.php';

// Enqueue Plugin Admin CSS
include UNCOPY_DIR . 'includes/uncopy-styles.php';

// Enqueue Plugin Admin Js
include UNCOPY_DIR . 'includes/uncopy-js.php';

// Create Settings Fields
include UNCOPY_DIR . 'includes/uncopy-fields.php';

// Create Plugin Admin Menus and Setting Pages
include UNCOPY_DIR . 'includes/uncopy-menus.php';

// Front-End

function uncopy_fontend_includes()
{
    if (!is_user_logged_in() || !uncopy_check_option_status('is_user_logged_in')) {

        if (uncopy_check_option_status('js')) {
            include UNCOPY_DIR . 'frontend/uncopy-js.php';
        }

        if (uncopy_check_option_status('css')) {
            include UNCOPY_DIR . 'frontend/uncopy-css.php';
        }

        if (uncopy_check_option_status('html')) {
            include UNCOPY_DIR . 'frontend/uncopy-html.php';
        }

    }

}
add_action('init', 'uncopy_fontend_includes');

// Plugin Activated
register_activation_hook(__FILE__, UNCOPY_PREFIX . '_activated');
function uncopy_activated()
{
    if (!get_option('uncopy_settings')) {
        update_option('uncopy_settings', 1);
        update_option('uncopy_settings_general_js', 1);
        update_option('uncopy_settings_general_css', 1);
        update_option('uncopy_settings_general_html', 1);
        update_option('uncopy_settings_general_is_user_logged_in', 1);
        update_option('uncopy_settings_javascript_right_click', 1);
        update_option('uncopy_settings_javascript_disable_keys', 1);
        update_option('uncopy_settings_javascript_text_selection', 1);
        update_option('uncopy_settings_javascript_image_text_dragging', 1);

        // HTML
        update_option('uncopy_settings_javascript_developer_tools_msg', '<div style="text-align: center;"> <img style="height: 150px; margin-top: 70px;" src="' . UNCOPY_URL . 'frontend/images/developer_tools.png" /> <h3 style="color: red;">Developer Tools Detected!</h3> Please Close <span style="color: #ff0000;">Developer Tools </span>or use another browser we preferred <a href="https: //www.google.com/chrome/" target="_blank" rel="noopener">Google Chrome</a>. <p>Powered By <a style="color: #006087; font-size: 25px;" href="https://wp-protector.com/uncopy/">UnCopy</a> Plugin.</p> </div>');
        update_option('uncopy_settings_html_disabled_js_msg', '<div style="text-align: center;"> <img style="height: 150px; margin-top: 70px;" src="' . UNCOPY_URL . 'frontend/images/logo-lg.png" /> <h3 style="color: red;">Javascript Disabled!</h3> Please <a href="https://www.enable-javascript.com/" target="_blank" rel="noopener">Enable Javascript</a> if you disabled it, or use another browser we preferred <a href="https: //www.google.com/chrome/" target="_blank" rel="noopener">Google Chrome</a>. <br><small>Please <strong>Refresh </strong>Page After Enable</small> <p>Powered By <a style="color: #006087; font-size: 25px;" href="https://wp-protector.com/uncopy/">UnCopy</a> Plugin.</p> </div>');
        update_option('uncopy_settings_anti_adblocker_anti_adblocker_msg', '<div style="text-align: center;"> <img style="height: 150px; margin-top: 70px;" src="' . UNCOPY_URL . 'frontend/images/alert.png" /> <h3 style="color: red;">AdBlocker Detected!</h3> Please Disable <span style="color: #ff0000;">AdBlocker</span> if you think we are wrong; use another browser we preferred <a href="https: //www.google.com/chrome/" target="_blank" rel="noopener">Google Chrome</a>. <small><br>I already Disabled it <strong>Refresh </strong>Page</small> <p>Powered By <a style="color: #006087; font-size: 25px;" href="https://wp-protector.com/uncopy/">UnCopy</a> Plugin.</p> </div>');

    }
}
