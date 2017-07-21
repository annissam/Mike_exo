<?php
require_once  get_template_directory() . '/anps-framework/class-tgm-plugin-activation.php';
add_action('tgmpa_register', 'anps_register_required_plugins');
function anps_register_required_plugins() {
    $plugins = array(
        array(
            'name' => 'Revolution Slider WP',
            'slug' => 'revslider',
            'source' => 'http://astudio.si/preview/plugins/'."hairdresser".'/revslider.zip',
            'required' => false,
            'version' => '',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => '',
        ),
        array(
            'name' => 'Contact form 7',
            'slug' => 'contact-form-7',
            'required' => true,
            'version' => '',
            'force_activation' => true,
            'force_deactivation' => false,
            'external_url' => '',
        ),
        array(
            'name' => 'Anps Theme plugin',
            'slug' => 'anps_theme_plugin',
            'source' => 'http://astudio.si/preview/plugins/'."hairdresser".'/anps_theme_plugin.zip',
            'required' => true,
            'version' => '',
            'force_activation' => true,
            'force_deactivation' => true,
            'external_url' => '',
        ),
        array(
            'name' => 'Visual Composer',
            'slug' => 'js_composer',
            'source' => 'http://astudio.si/preview/plugins/'."hairdresser".'/js_composer.zip',
            'required' => false,
            'version' => '',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => '',
        ),
        array(
            'name' => 'WooCommerce',
            'slug' => 'woocommerce',
            'source' => 'http://downloads.wordpress.org/plugin/woocommerce.zip',
            'required' => false,
            'version' => '',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => '',
        )
    );
    $config = array(
        'domain' => "hairdresser",
        'default_path' => '',
        'parent_slug' => 'themes.php', 
        'menu' => 'install-required-plugins',
        'has_notices' => true,
        'is_automatic' => true,
        'message' => '',
        'strings' => array(
            'nag_type' => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );
    tgmpa($plugins, $config);
}
