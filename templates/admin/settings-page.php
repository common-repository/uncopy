<?php
if (!defined('WPINC')) {
    die;
}

$tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : null;

$tabs = [
    [
        'title' => 'General',
        'slug' => '',
        'icon' => 'general.svg',
        'color' => '#3699FF',
    ],
    [
        'title' => 'Javascript',
        'slug' => 'javascript',
        'icon' => 'javascript.svg',
        'color' => '#FFD600',
        'badge' => 'PRO',
    ],
    [
        'title' => 'HTML',
        'slug' => 'html',
        'icon' => 'html.svg',
        'color' => '#FF6D00',
        'badge' => 'PRO',
    ],
    [
        'title' => 'Back-end',
        'slug' => 'backend',
        'icon' => 'wp.svg',
        'color' => '#01579B',
        'badge' => 'PRO',
    ],
    [
        'title' => 'Anti AdBlocker',
        'slug' => 'anti-adblocker',
        'icon' => 'google-ad.svg',
        'color' => '#1E88E5',
        'badge' => 'PRO',
    ],
    [
        'title' => 'Advanced',
        'slug' => 'advanced',
        'icon' => 'advanced.svg',
        'color' => '#29B0EA',
        'badge' => 'PRO',
    ],
];

?>

    <div class="wrap uncopy uncopy-<?php echo UNCOPY_IS_PRO ? 'pro' : 'free'; ?>">
        <br>
        <form method="post" action="options.php">
            <div class="uncopy-box">

                <div class="row" style=" height: 65px; ">
                    <div class="col">
                        <div class="row">
                            <div class="col-auto">
                                <a target="_blank" href="<?php echo UNCOPY_WEBSITE; ?>#pricing">
                                <img src="<?php echo UNCOPY_URL . '/frontend/images/logo-text.png'; ?>" alt="UnCopy Logo">
                            </a>
                            </div>
                            <div class="col-auto" style="display:flex;align-items:center">
                                <?php
if (UNCOPY_IS_PRO) {
    ?>
                                    <span class="label label-light-warning label-inline">PRO Version</span>
                                    <?php
} else {
    ?>
                                        <span class="label label-light-danger label-inline badge-pro">Free Version</span> <span class="ml-5 badge-pro"> (Plese Active your Plugin by Clicking Go PRO to enable all features)</span>
                                        <?php
}
?>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto btn-save-col">
                        <?php if ($tab != "advanced"): ;?>
				                        <a target="_blank" href="<?php echo UNCOPY_WEBSITE; ?>#pricing" class="button button-primary btn-pro" value="1" style=" margin-right: 10px; ">
		                                    <img src="<?php echo UNCOPY_URL . '/admin/images/icons/pro.svg'; ?>" alt="Go PRO">
				                            <span>
				                            Go <strong>PRO</strong>
				                        </span>
				                        </a>
				                        <button type="submit" name="submit" id="submit" class="button button-success" value="1">


				                        <img src="<?php echo UNCOPY_URL . '/admin/images/icons/check.svg'; ?>" alt="Save Button">
				                        Save Changes
				                    </button>
				                        <?php endif;?>
                    </div>
                    <!-- <div class="col-12">
                </div> -->
                </div>
                <hr>
                <div class="row">
                    <div class="col-1-1 px-0 uncopy-nav">
                        <ul class="navi navi-hover navi-accent navi-link-rounded-lg">
                            <?php foreach ($tabs as $t): ?>
                            <li class="navi-item">
                                <a class="navi-link <?php echo $tab == $t['slug'] ? 'active' : ''; ?>" href="admin.php?page=uncopy&tab=<?php echo $t['slug']; ?>">
                                    <span class="navi-icon">
                                    <img src="<?php echo UNCOPY_URL . '/admin/images/icons/' . esc_html($t['icon']); ?>" alt="Save Button">
                                </span>

                                    <span class="navi-text">
                                    <?php echo esc_html($t['title']); ?>
                                </span>
                                    <?php if (isset($t['badge']) && $t['badge']): ;?>
				                                    <span class="label label-light-<?php echo $t['slug'] == 'javascript' ? 'warning' : 'danger'; ?> label-inline badge-pro">
				                                    <?php echo esc_html($t['badge']); ?>
				                                </span>
				                                    <?php endif;?>
                                </a>
                            </li>
                            <?php endforeach;?>

                        </ul>
                    </div>
                    <div class="col uncopy-body">
                        <?php
switch ($tab):
case 'anti-adblocker':
    do_settings_sections('uncopy-anti-adblocker-options-page');
    settings_fields('uncopy-settings');
case 'advanced':
    do_settings_sections('uncopy-advanced-options-page');
    settings_fields('uncopy-settings');

case 'backend':
    do_settings_sections('uncopy-backend-options-page');
    settings_fields('uncopy-settings');

case 'javascript':
    do_settings_sections('uncopy-javascript-options-page');
    settings_fields('uncopy-settings');

    break;
case 'html':
    do_settings_sections('uncopy-html-options-page');
    settings_fields('uncopy-settings');

    break;

default:
    do_settings_sections('uncopy-general-options-page');
    settings_fields('uncopy-settings');

    break;
    endswitch;
    ?>

                    </div>
                </div>
            </div>

            <input type="hidden" name="type" value=<?php echo $tab ? esc_html($tab) : 'general'; ?>>

        </form>

    </div>