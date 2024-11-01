<?php
function uncopy_javascript_settings()
{

    add_settings_section(
        'uncopy_javascript_settings',
        '',
        'uncopy_no_callback',
        'uncopy-javascript-options-page'
    );

    $fields = [
        [
            'title' => 'Right Click',
            'name' => 'right_click',
            'callback' => 'uncopy_switch_callback',
        ],
        [
            'title' => 'Ignored Selector' . fields_pro_badge,
            'name' => 'ignored_context_menu_selectors',
            'callback' => 'uncopy_textarea_callback',
            'is_pro' => true,
        ],
        [
            'title' => 'Disable Keys',
            'name' => 'disable_keys',
            'callback' => 'uncopy_switch_callback',
        ],

        [
            'title' => 'Text Selection',
            'name' => 'text_selection',
            'callback' => 'uncopy_switch_callback',
        ],

        [
            'title' => 'Image/Text Dragging',
            'name' => 'image_text_dragging',
            'callback' => 'uncopy_switch_callback',
        ],
        [
            'title' => 'Safari Reader Mode' . fields_pro_badge,
            'name' => 'safari_reader_mode',
            'callback' => 'uncopy_switch_callback',
            'is_pro' => true,
        ],
        [
            'title' => 'Disable Print Screen' . fields_pro_badge,
            'name' => 'disable_print_screen',
            'callback' => 'uncopy_switch_callback',
            'is_pro' => true,
        ],
        [
            'title' => 'Developer Tools' . fields_pro_badge,
            'name' => 'developer_tools',
            'callback' => 'uncopy_switch_callback',
            'is_pro' => true,
        ],
        [
            'title' => 'Dev Tools Message' . fields_pro_badge,
            'name' => 'developer_tools_msg',
            'callback' => 'uncopy_javascript_developer_tools_callback',
            'is_pro' => true,
        ],
    ];

    foreach ($fields as $field_key => $field) {
        add_settings_field(
            'uncopy_settings_javascript_' . $field['name'],
            $field['title'],
            $field['callback'],
            'uncopy-javascript-options-page',
            'uncopy_javascript_settings',
            [
                'slug' => 'uncopy_settings_javascript_' . $field['name'],
                'des' => $field['description'] ?? '',
                'is_pro' => $field['is_pro'] ?? false,
            ]
        );

        register_setting(
            'uncopy-settings',
            'uncopy_settings_javascript_' . $field['name']
        );
    }

}

function uncopy_javascript_developer_tools_callback($args)
{
    $javascript_developer_tools_msg = get_option('uncopy_settings_javascript_developer_tools_msg');
    ?>
        <div style="position:relative;" <?php echo (UNCOPY_IS_PRO && $args['is_pro']) || (!$args['is_pro']) ? '' : 'go-pro';?>>
            <?php wp_editor(wp_kses_post($javascript_developer_tools_msg), 'uncopy_settings_javascript_developer_tools_msg', array('textarea_name' => 'uncopy_settings_javascript_developer_tools_msg'));?>
        </div>

    <?php
}

function uncopy_textarea_callback($args)
{
    $ignored_context_menu_selectors = get_option('uncopy_settings_javascript_ignored_context_menu_selectors');

    ?>
        <div style="position:relative;" <?php echo (UNCOPY_IS_PRO && $args['is_pro']) || (!$args['is_pro']) ? '' : 'go-pro';?>>
            <textarea <?php echo (UNCOPY_IS_PRO && $args['is_pro']) || (!$args['is_pro']) ? '' : 'disabled';?> placeholder=".selector&#10;#selector&#10;article" name="uncopy_settings_javascript_ignored_context_menu_selectors" rows="4" cols="1" class="large-text" spellcheck="false"><?php echo esc_html($ignored_context_menu_selectors);?></textarea>
            <p  class="description">* <code>.selector</code> for  <code>&lt;div class=&quot;selector&quot;&gt;</code>, <code>#selector</code> for <code>&lt;div id=&quot;selector&quot;&gt;</code> and <code>article</code> for <code>&lt;article&gt;</code>, you put multiple selector per new line ...</p>
        </div>

    <?php
}