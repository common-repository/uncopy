<?php
function uncopy_html_settings()
{

    add_settings_section(
        'uncopy_html_settings',
        '',
        'uncopy_no_callback',
        'uncopy-html-options-page'
    );

    $fields = [
        [
            'title' => 'Disabled Javascript Message',
            'name' => 'disabled_js_msg',
            'callback' => 'uncopy_html_protection_callback',
            'is_pro' => true,
        ],
    ];

    foreach ($fields as $field_key => $field) {

        if ($field['callback'] != 'uncopy_no_callback') {
            add_settings_field(
                'uncopy_settings_html_' . $field['name'],
                $field['title'],
                $field['callback'],
                'uncopy-html-options-page',
                'uncopy_html_settings',
                [
                    'slug' => 'uncopy_settings_html_' . $field['name'],
                    'des' => $field['description'] ?? '',
                    'is_pro' => $field['is_pro'] ?? false,
                ]
            );
        }

        register_setting(
            'uncopy-settings',
            'uncopy_settings_html_' . $field['name']
        );
    }

}

function uncopy_html_protection_callback($args)
{
    $backend_protection = get_option('uncopy_settings_general_backend');
    $backend_type = get_option('uncopy_settings_advanced_backend_type');
    $backend_urls = get_option('uncopy_settings_advanced_backend_urls');
    $disabled_js_msg = get_option('uncopy_settings_html_disabled_js_msg');
    ?>
        <div style="position:relative;" <?php echo (UNCOPY_IS_PRO && $args['is_pro']) || (!$args['is_pro']) ? '' : 'go-pro';?>>
            <?php wp_editor(wp_kses_post($disabled_js_msg), 'disabled_js_msg', $settings = array('textarea_name' => 'uncopy_settings_html_disabled_js_msg'));?>
        </div>

    <?php
}