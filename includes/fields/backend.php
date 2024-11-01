<?php
function uncopy_backend_settings()
{

    add_settings_section(
        'uncopy_backend_settings',
        '',
        'uncopy_no_callback',
        'uncopy-backend-options-page'
    );

    $fields = [
        [
            'title' => 'Back-end' . fields_pro_badge,
            'name' => 'backend_type',
            'callback' => 'uncopy_backend_type_protection_callback',
            'is_pro' => true,
        ],
        [
            'title' => 'Backend Urls',
            'name' => 'backend_urls',
            'callback' => 'uncopy_no_callback',
            'is_pro' => true,
        ],
    ];

    foreach ($fields as $field_key => $field) {

        if ($field['callback'] != 'uncopy_no_callback') {
            add_settings_field(
                'uncopy_settings_backend_' . $field['name'],
                $field['title'],
                $field['callback'],
                'uncopy-backend-options-page',
                'uncopy_backend_settings',
                [
                    'slug' => 'uncopy_settings_backend_' . $field['name'],
                    'des' => $field['description'] ?? '',
                    'is_pro' => $field['is_pro'] ?? false,
                ]
            );
        }

        register_setting(
            'uncopy-settings',
            'uncopy_settings_backend_' . $field['name']
        );
    }

}

function uncopy_backend_type_protection_callback($args)
{
    $backend_protection = get_option('uncopy_settings_general_backend');
    $backend_type = get_option('uncopy_settings_backend_backend_type');
    $backend_urls = get_option('uncopy_settings_backend_backend_urls');

    ?>
        <div>
            <label class="radio">
                <input <?php echo esc_html($backend_protection) && (UNCOPY_IS_PRO && $args['is_pro']) || (!$args['is_pro']) ? '' : 'disabled';?> type="radio" name="uncopy_settings_backend_backend_type" value="1" <?php echo checked(1, esc_html($backend_type), false);?>>
                <i class="icon-radio"></i>
                Include
            </label>
            <label class="radio">
                <input <?php echo esc_html($backend_protection) && (UNCOPY_IS_PRO && $args['is_pro']) || (!$args['is_pro']) ? '' : 'disabled';?> type="radio" name="uncopy_settings_backend_backend_type" value="0" <?php echo checked(0, esc_html($backend_type), false);?>>
                <i class="icon-radio"></i>
                Exclude
            </label>
        </div>
        <br>
        <textarea <?php echo esc_html($backend_protection) && (UNCOPY_IS_PRO && $args['is_pro']) || (!$args['is_pro']) ? '' : 'disabled';?> placeholder="wp/v2/posts &#10;wp/v2/categories" name="uncopy_settings_backend_backend_urls" rows="7" cols="1" class="large-text" spellcheck="false"><?php echo esc_html($backend_urls);?></textarea>
        <p  class="description">* put urls here witch api you allowed/not allowed after (wp-json/) ex: (wp-json/wp/v2/posts) you must write (wp/v2/posts) and for each new route you must wirte it in new line.</p>
    <?php
}
