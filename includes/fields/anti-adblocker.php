<?php
function uncopy_anti_adblocker_settings()
{

    add_settings_section(
        'uncopy_anti_adblocker_settings',
        '',
        'uncopy_no_callback',
        'uncopy-anti-adblocker-options-page'
    );

    $fields = [
        [
            'title' => 'Magic Anti-Adblocker' . fields_pro_badge,
            'name' => 'automatic',
            'callback' => 'uncopy_switch_callback',
            'is_pro' => true,
        ],
        [
            'title' => 'Anti AdBlocker Urls' . fields_pro_badge,
            'name' => 'urls',
            'callback' => 'uncopy_anti_type_protection_callback',
            'is_pro' => true,
        ],
        [
            'title' => 'Anti-AdBlocker Msg' . fields_pro_badge,
            'name' => 'anti_adblocker_msg',
            'callback' => 'uncopy_anti_adblocker_msg_callback',
            'is_pro' => true,
        ],
    ];

    foreach ($fields as $field_key => $field) {

        if ($field['callback'] != 'uncopy_no_callback') {
            add_settings_field(
                'uncopy_settings_anti_adblocker_' . $field['name'],
                $field['title'],
                $field['callback'],
                'uncopy-anti-adblocker-options-page',
                'uncopy_anti_adblocker_settings',
                [
                    'slug' => 'uncopy_settings_anti_adblocker_' . $field['name'],
                    'des' => $field['description'] ?? '',
                    'is_pro' => $field['is_pro'] ?? false,
                ]
            );
        }

        register_setting(
            'uncopy-settings',
            'uncopy_settings_anti_adblocker_' . $field['name']
        );
    }

}

function uncopy_anti_type_protection_callback($args)
{
    $anti_adblocker_urls = get_option('uncopy_settings_anti_adblocker_urls');

    ?>

        <div style="position:relative;" <?php echo (UNCOPY_IS_PRO && $args['is_pro']) || (!$args['is_pro']) ? '' : 'go-pro';?>>
            <textarea placeholder="https://googlesyndication.com &#10;https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js" name="uncopy_settings_anti_adblocker_urls" rows="7" cols="1" class="large-text" spellcheck="false"><?php echo esc_html($anti_adblocker_urls);?></textarea>
            <p class="description">* We will check all links if it blocked it mean user use ad-blocker we will show message to disable it.</p>
            <p class="description">* as default we check google AdSense Url (https://googlesyndication.com and https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js) to check it, you can put your own script/domain etc...</p>
            <p class="description">* you can check multiple urls per new line ...</p>
        </div>

    <?php
}

function uncopy_anti_adblocker_msg_callback($args)
{
    $anti_adblocker_msg = get_option('uncopy_settings_anti_adblocker_anti_adblocker_msg');
    // '<div style="width: 100% !important;height: 100%  !important;position: fixed  !important;background-color: #f8f8f8  !important;z-index: 999999999999  !important;-webkit-text-stroke-width: thin  !important;text-align: center  !important;top: 0  !important;left: 0  !important;display: flex;justify-content: center;align-items: center;"> <div><img style="height: 150px;margin-top: 70px;" src="https://uncopy.test/wp-content/plugins/uncopy/frontend/images/logo-lg.png"> <h3 style="color: red;">Javascript Disabled!</h3> <p>Please <a target="_blank" href="https://www.enable-javascript.com/">Enable Javascript</a> if you disabled it, or use another browser we preferred <a target="_blank" href="https: //www.google.com/chrome/">Google Chrome</a>.</p></div> </div>'
    ?>
        <div style="position:relative;" <?php echo (UNCOPY_IS_PRO && $args['is_pro']) || (!$args['is_pro']) ? '' : 'go-pro';?>>
            <?php wp_editor($anti_adblocker_msg, 'anti_adblocker_msg', $settings = array('textarea_name' => 'uncopy_settings_anti_adblocker_anti_adblocker_msg'));?>
        </div>

    <?php
}