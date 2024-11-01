<?php
function uncopy_switch_callback($args)
{
    $option = get_option(esc_html( $args['slug'] ));

    ?>
        <div class="d-flex">
            <div class="switch-box is-info">
                <input <?php echo (UNCOPY_IS_PRO && $args['is_pro']) || (!$args['is_pro']) ? '' : 'disabled';?> class="switch-box-input" type="checkbox" id="<?php echo esc_html($args['slug']);?>" name="<?php echo esc_html($args['slug']);?>" value="1"<?php echo (UNCOPY_IS_PRO && $args['is_pro']) || (!$args['is_pro']) ? checked(1, esc_html($option), false) : '';?> />
                <label for="<?php echo esc_html($args['slug']);?>" class="switch-box-slider"></label>
            </div>

            <div x-show="open" class="ml-25">
                <?php echo $args['des'] ? wp_kses_post($args['des']) : '';?>
            </div>
        </div>

    <?php
}

function uncopy_no_callback()
{
}
