<?php

if (!defined('WPINC')) {
    die;
}


if (!function_exists('uncopy_check_option_status')) {
    function uncopy_check_option_status($name, $type = 'general')
    {
        $option = get_option('uncopy_settings_' . $type . '_' . $name);
        return checked(1, $option, false);
    }
}
