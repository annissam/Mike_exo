<div class="envoo-admin">
<?php $themever = wp_get_theme(get_template()); $version = $themever["Version"]; ?>
    <ul class="envoo-admin-menu">
        <li><a id="anpslogo" href="http://anpsthemes.com" target="_blank"></a><h2 class="small_lh"><?php esc_html_e("Theme Options", 'hairdresser'); ?><br/><span id="version"><?php echo esc_attr('version: '). esc_attr($version);?></span></h2></li>


        <li>
            <a class="has-submenu" <?php if (!isset($_GET['sub_page']) || $_GET['sub_page'] == "theme_style" || $_GET['sub_page'] == "theme_style_google_font" || $_GET['sub_page'] == "theme_style_custom_font") echo 'id="selected-menu-item"'; ?> href="themes.php?page=theme_options&sub_page=theme_style"><?php esc_html_e("Style Settings", 'hairdresser'); ?></a>
            <ul class="envoo-admin-submenu">
                <li><a <?php if (!isset($_GET['sub_page']) || $_GET['sub_page'] == "theme_style") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=theme_style"><i class="fa fa-tint"></i><?php esc_html_e("Theme Style", 'hairdresser'); ?></a></li>
                <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "theme_style_google_font") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=theme_style_google_font"><i class="fa fa-google"></i><?php esc_html_e("Update google fonts", 'hairdresser'); ?></a></li>
                <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "theme_style_custom_font") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=theme_style_custom_font"><i class="fa fa-text-height"></i><?php esc_html_e("Custom fonts", 'hairdresser'); ?></a></li>
                <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "theme_style_custom_css") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=theme_style_custom_css"><i class="fa fa-code"></i><?php esc_html_e("Custom css", 'hairdresser'); ?></a></li>
            </ul>
        </li>
        <li>
            <a class="has-submenu" <?php if (isset($_GET['sub_page']) && ( $_GET['sub_page'] == "options" || $_GET['sub_page'] == "options_page_setup" || $_GET['sub_page'] == "options_social_accounts" || $_GET['sub_page'] == "options_media" )) echo 'id="selected-menu-item"'; ?> href="themes.php?page=theme_options&sub_page=options"><?php esc_html_e("General Settings", 'hairdresser'); ?></a>
            <ul class="envoo-admin-submenu">
                <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "options") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=options"><i class="fa fa-columns"></i><?php esc_html_e("Page layout", 'hairdresser'); ?></a></li>
                <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "options_page_setup") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=options_page_setup"><i class="fa fa-cog"></i><?php esc_html_e("Page setup", 'hairdresser'); ?></a></li>
                <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "options_media") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=options_media"><i class="fa fa-picture-o"></i><?php esc_html_e("Logos & Media", 'hairdresser'); ?></a></li>
                <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "google_maps") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=google_maps"><i class="fa fa-map"></i><?php _e("Google Maps", 'hairdresser'); ?></a></li>
            </ul>
        </li>
        <?php if(is_plugin_active('anps_theme_plugin/anps_theme_plugin.php')&& function_exists('anps_portfolio')) : ?>
        <li>
            <a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "dummy_content")
                        echo 'id="selected-menu-item"'; ?> href="themes.php?page=theme_options&sub_page=dummy_content"><i class="fa fa-dropbox"></i><?php esc_html_e("Dummy Content", 'hairdresser'); ?></a>
        </li>
        <?php endif; ?>
        <li>
            <a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "theme_upgrade")
                        echo 'id="selected-menu-item"'; ?> href="themes.php?page=theme_options&sub_page=theme_upgrade"><i class="fa fa-cloud-download"></i><?php esc_html_e("Theme upgrade", 'hairdresser'); ?></a>
        </li>
    </ul>
        <?php
        if(!isset($_GET['sub_page'])) {
            $_GET['sub_page']='';
        }
        ?>
        <div class="envoo-admin-content <?php echo esc_attr($_GET['sub_page']);?>">
        <?php
        switch($_GET['sub_page']) {
            case 'options': include_once(get_template_directory() . '/anps-framework/options_page_view.php'); break;
            case 'options_page': include_once(get_template_directory() . '/anps-framework/options_page_view.php'); break;
            case 'options_page_setup': include_once(get_template_directory() . '/anps-framework/options_page_setup_view.php'); break;
            //case 'options_social_accounts': include_once 'options_social_accounts_view.php'; break;
            case 'options_media': include_once(get_template_directory() . '/anps-framework/options_media_view.php'); break;
            case 'google_maps': include_once 'google_maps_view.php'; break;
            case 'dummy_content': include_once(get_template_directory() . '/anps-framework/dummy_view.php'); break;
            case 'theme_upgrade': include_once(get_template_directory() . '/anps-framework/theme_upgrade_view.php'); break;
            case 'theme_style_google_font': include_once(get_template_directory() . '/anps-framework/update_google_font_view.php'); break;
            case 'theme_style_custom_font': include_once(get_template_directory() . '/anps-framework/update_custom_font_view.php'); break;
            case 'theme_style_custom_css': include_once(get_template_directory() . '/anps-framework/custom_css_view.php'); break;
            default: include_once(get_template_directory() . '/anps-framework/style_view.php');
        }
        ?>
    </div>
</div>
