<?php
function uncopy_general_settings()
{

    add_settings_section(
        'uncopy_general_settings',
        '',
        'uncopy_no_callback',
        'uncopy-general-options-page'
    );

    $fields = [
        [
            'title' => 'Javascript Protection',
            'name' => 'js',
            'callback' => 'uncopy_switch_callback',
            'description' => 'Disable Right Click, Disable Dragging Image/Text, Text Selection, <code>Ctrl+A</code>, <code>Ctrl+C</code>, <code>Ctrl+X</code>, <code>Ctrl+S</code>, <code>Ctrl+V</code>, Disable <code>Developer Tools</code> and <code>Print Screen</code>.',
        ],
        [
            'title' => 'CSS Protection',
            'name' => 'css',
            'callback' => 'uncopy_switch_callback',
            'description' => 'Disable Text Selection using CSS Technique.',
        ],
        [
            'title' => 'HTML Protection',
            'name' => 'html',
            'callback' => 'uncopy_switch_callback',
            'description' => 'Alert Visitor\'s when Javascript Disabled in Browser to Enable it then they can see your website, you can customize that message.',
        ],
        [
            'title' => 'Back-end Protection' . fields_pro_badge,
            'name' => 'backend',
            'callback' => 'uncopy_switch_callback',
            'description' => 'Protect your wp-json to prevent your posts from being copied by 3rd party, also you can include/exclude specific routes/URLs.',
            'is_pro' => true,
        ],
        [
            'title' => 'Anti-AdBlocker' . fields_pro_badge,
            'name' => 'anti_adblocker',
            'callback' => 'uncopy_switch_callback',
            'description' => 'Alert Visitor\'s to disable AdBlocker if they are using it, using two diffrent way (Manual, Auto) and you can customize that message.',
            'is_pro' => true,
        ],
        [
            'title' => 'User Mode',
            'name' => 'is_user_logged_in',
            'callback' => 'uncopy_switch_callback',
            'description' => 'Disable plugin functionality for logined users. you can customize it in Advanced tab.',
        ],
    ];

    foreach ($fields as $field_key => $field) {
        add_settings_field(
            'uncopy_settings_general_' . $field['name'],
            $field['title'],
            $field['callback'],
            'uncopy-general-options-page',
            'uncopy_general_settings',
            [
                'slug' => 'uncopy_settings_general_' . $field['name'],
                'des' => $field['description'] ?? '',
                'is_pro' => $field['is_pro'] ?? false,
            ]
        );

        register_setting(
            'uncopy-settings',
            'uncopy_settings_general_' . $field['name']
        );
    }

}
