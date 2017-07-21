<?php
include_once(get_template_directory() . '/anps-framework/classes/Options.php');

$anps_options_data = $options->get_page_data();
if (isset($_GET['save_page'])) {
    update_option("vertical_menu",$_POST['vertical_menu']);

    update_option("page_sidebar_left", $_POST['page_sidebar_left']);
    update_option("page_sidebar_right", $_POST['page_sidebar_right']);

    update_option("post_sidebar_left", $_POST['post_sidebar_left']);
    update_option("post_sidebar_right", $_POST['post_sidebar_right']);
  $options->save_page();
}
?>
<form action="themes.php?page=theme_options&sub_page=options_page&save_page" method="post">

    <div class="content-top"><input type="submit" value="<?php esc_html_e("Save all changes", 'hairdresser'); ?>" /><div class="clear"></div></div>

    <div class="content-inner">
        <!-- Page layout -->
        <h3><?php esc_html_e("Page layout:", 'hairdresser'); ?></h3>
        <p><?php esc_html_e("Here you can change all the settings about responsive layout and will your site be boxed (when checked you will have more options).", 'hairdresser'); ?></p>
        <div class="info">
            <!-- Hide slider on mobile -->
            <div class="input onoffswitch fullwidth floatleft">
                <?php
                if(!isset($anps_options_data['hide_slider_on_mobile']))
                    $checked='';
                elseif ($anps_options_data['hide_slider_on_mobile'] == '-1')
                    $checked = '';
                elseif ($anps_options_data['hide_slider_on_mobile'] == '')
                    $checked = '';
                else
                    $checked = 'checked';
                ?>
                <label class="onehalf floatleft" for="hide_slider_on_mobile"><?php esc_html_e("Hide slider on mobile", "hairdresser"); ?></label>
                <input type="checkbox" name="hide_slider_on_mobile" class="onoffswitch-checkbox onehalf floatright" id="hide_slider_on_mobile" <?php echo esc_attr($checked); ?>>
               <label class="onoffswitch-label" for="hide_slider_on_mobile">
                   <span class="onoffswitch-inner">
                   <span class="onoffswitch-active"><span class="onoffswitch-switch">ON</span></span>
                   <span class="onoffswitch-inactive"><span class="onoffswitch-switch">OFF</span></span>
                   </span>
               </label>
            </div>
            <!-- Boxed -->
            <div class="input onoffswitch fullwidth floatleft">
                <?php
                if(!isset($anps_options_data['boxed']))
                    $checked='';
                elseif ($anps_options_data['boxed'] == '-1')
                    $checked = '';
                elseif ($anps_options_data['boxed'] == '')
                    $checked = '';
                else
                    $checked = 'checked';
                ?>
                <label class="onehalf floatleft" for="boxed"><?php esc_html_e("Boxed", 'hairdresser'); ?></label>
                <input id="is-boxed" class="onoffswitch-checkbox onehalf floatright" style="margin-left: 74px" type="checkbox" name="boxed" <?php echo esc_attr($checked); ?> />
                <label class="onoffswitch-label" for="is-boxed">
                   <span class="onoffswitch-inner">
                   <span class="onoffswitch-active"><span class="onoffswitch-switch">ON</span></span>
                   <span class="onoffswitch-inactive"><span class="onoffswitch-switch">OFF</span></span>
                   </span>
               </label>
            </div>
            <!-- Pattern -->
            <div <?php if ($checked == "") echo 'style="display:none"'; ?> class="input fullwidth" id="pattern-select-wrapper">
                <label for="pattern"><?php esc_html_e("Pattern", 'hairdresser'); ?></label>
                <div class="admin-patern-radio">
                    <?php for ($i = 0; $i < 10; $i++) :
                        if (isset($anps_options_data['pattern']) && $anps_options_data['pattern'] == $i)
                            $checked = 'checked';
                        else
                            $checked = '';
                        ?>
                        <input type="radio" name="pattern" value="<?php echo esc_attr($i); ?>" <?php echo esc_attr($checked); ?>/>
                    <?php endfor; ?>
                </div>
                <div class="admin-patern-select fullwidth">
                    <?php for ($i = 0; $i < 10; $i++) : ?>
                        <?php if (isset($anps_options_data['pattern']) && $anps_options_data['pattern'] == $i): ?>
                            <img id="selected-pattern" src="<?php echo get_template_directory_uri(); ?>/css/boxed/pattern-<?php echo esc_attr($i); ?>.png" />
                        <?php else: ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/css/boxed/pattern-<?php echo esc_attr($i); ?>.png" />
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
                <div style="clear: both"></div>
            </div>
            <!-- Custom background -->
            <div class="input fullwidth" <?php if (!isset($anps_options_data['boxed']) || $anps_options_data['pattern'] != 0 || $anps_options_data['boxed'] == '-1' || $anps_options_data['boxed'] == '') echo 'style="display: none"'; ?> id="patern-type-wrapper">
                <label for="pattern"><?php esc_html_e("Custom background type", 'hairdresser' ); ?></label>
                <div class="patern-type">
                    <?php $types = array('stretched', 'tilled', 'custom color');
                    foreach ($types as $type) :
                        if(!isset($anps_options_data['type']))
                            $checked='';
                        elseif ($anps_options_data['type'] == $type)
                            $checked = 'checked';
                        else
                            $checked = '';
                        ?>
                    <span class="onethird">
                        <input style="display: inline-block;" type="radio" id="back-type-<?php echo esc_attr($type); ?>" name="type" value="<?php echo esc_attr($type); ?>" <?php echo esc_attr($checked); ?>/>
                        <label style="font-weight: normal;display: inline; margin: 0; cursor: pointer" for="back-type-<?php echo esc_attr($type); ?>"><?php echo esc_attr($type); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- Custom pattern -->
            <?php
                $custom_pattern = '';
                if(isset($anps_options_data['custom_pattern'])) {
                    $custom_pattern = $anps_options_data['custom_pattern'];
                }
            ?>
            <div class="input fullwidth"  <?php if ((!isset($anps_options_data['boxed']) || ( isset($anps_options_data['pattern']) && $anps_options_data['pattern'] != 0 ) || (isset($anps_options_data['boxed']) && $anps_options_data['boxed'] == '-1') || (isset($anps_options_data['boxed']) && $anps_options_data['boxed'] == '') || (isset($anps_options_data['type'] ) && ($anps_options_data['type'] != "stretched") && $anps_options_data['type'] != "tilled" ))) echo 'style="display: none"'; ?> id="custom-patern-wrapper">
                <label for="custom_pattern"><?php esc_html_e("Custom background image/pattern", 'hairdresser'); ?></label>
                <input class="wninety" id="custom_pattern" type="text" size="36" name="custom_pattern" value="<?php echo esc_attr($custom_pattern); ?>" />
                <input id="_btn" class="upload_image_button" type="button" value="Upload" />
            </div>
            <!-- Custom background color -->
            <?php
                $custom_bg_color = '';
                if(isset($anps_options_data['bg_color'])) {
                    $custom_bg_color = $anps_options_data['bg_color'];
                }
            ?>
            <div id="custom-background-color-wrapper" class="input" <?php if ((!isset($anps_options_data['boxed']) || $anps_options_data['pattern'] != 0 || $anps_options_data['boxed'] == '-1' || $anps_options_data['boxed'] == '') || (!isset($anps_options_data['type']) || $anps_options_data['type'] != "custom color") ) echo 'style="display: none"'; ?>>
                <label for="bg_color"><?php esc_html_e("Custom background color", 'hairdresser'); ?></label>
                <input data-value="<?php echo esc_attr($anps_options_data['bg_color']); ?>" readonly style="background: <?php echo esc_attr($custom_bg_color); ?>" class="color-pick-color"><input class="color-pick" type="text" name="bg_color" value="<?php echo esc_attr($anps_options_data['bg_color']); ?>" id="bg_color" />
            </div>
    </div>
        <div class="clear"></div>
        <!-- Page Sidebars (global settings) -->
        <?php global $wp_registered_sidebars;  ?>

        <h3><?php esc_html_e("Page Sidebars", 'hairdresser'); ?></h3>
        <p><?php esc_html_e("This will change the default sidebar value on all pages. It can be changed on each page individually.", 'hairdresser'); ?></p>

        <!-- Left Sidebar -->
        <div class="input onehalf" style="padding-top: 0;">
            <label for="page-sidebar-left"><?php esc_html_e("Left Sidebar", 'hairdresser'); ?></label>
            <select name="page_sidebar_left" id="page-sidebar-left">
                <option value="0"></option>
            <?php
                global $wp_registered_sidebars;
                $sidebars = $wp_registered_sidebars;

                if( is_array($sidebars) && !empty($sidebars) ) {
                    foreach( $sidebars as $sidebar ) {
                        if( $anps_options_data['page_sidebar_left'] && $anps_options_data['page_sidebar_left'] == esc_attr($sidebar['name']) ) {
                            echo '<option value="' . esc_attr($sidebar['name']) . '" selected>' . esc_attr($sidebar['name']) . '</option>';
                        } else {
                            echo '<option value="' . esc_attr($sidebar['name']) . '">' . esc_attr($sidebar['name']) . '</option>';
                        }
                    }
                }
            ?>
            </select>
        </div>

        <!-- Right Sidebar -->
        <div class="input onehalf" style="padding-top: 0;">
            <label for="page-sidebar-right"><?php esc_html_e("Right Sidebar", 'hairdresser'); ?></label>
            <select name="page_sidebar_right" id="page-sidebar-right">
                <option value="0"></option>
            <?php
                global $wp_registered_sidebars;
                $sidebars = $wp_registered_sidebars;

                if( is_array($sidebars) && !empty($sidebars) ) {
                    foreach( $sidebars as $sidebar ) {
                        if( $anps_options_data['page_sidebar_right'] && $anps_options_data['page_sidebar_right'] == esc_attr($sidebar['name']) ) {
                            echo '<option value="' . esc_attr($sidebar['name']) . '" selected>' . esc_attr($sidebar['name']) . '</option>';
                        } else {
                            echo '<option value="' . esc_attr($sidebar['name']) . '">' . esc_attr($sidebar['name']) . '</option>';
                        }
                    }
                }
            ?>
            </select>
        </div>

       <div class="clear"></div>
        <!-- Post Sidebars (global settings) -->
        <?php global $wp_registered_sidebars;  ?>

        <h3><?php esc_html_e("Post Sidebars", 'hairdresser'); ?></h3>
        <p><?php esc_html_e("This will change the default sidebar value on all posts. It can be changed on each post individually.", 'hairdresser'); ?></p>

        <!-- Left Sidebar -->
        <div class="input onehalf" style="padding-top: 0;">
            <label for="post-sidebar-left"><?php esc_html_e("Left Sidebar", 'hairdresser'); ?></label>
            <select name="post_sidebar_left" id="post-sidebar-left">
                <option value="0"></option>
            <?php
                global $wp_registered_sidebars;
                $sidebars = $wp_registered_sidebars;

                if( is_array($sidebars) && !empty($sidebars) ) {
                    foreach( $sidebars as $sidebar ) {
                        if( $anps_options_data['post_sidebar_left'] && $anps_options_data['post_sidebar_left'] == esc_attr($sidebar['name']) ) {
                            echo '<option value="' . esc_attr($sidebar['name']) . '" selected>' . esc_attr($sidebar['name']) . '</option>';
                        } else {
                            echo '<option value="' . esc_attr($sidebar['name']) . '">' . esc_attr($sidebar['name']) . '</option>';
                        }
                    }
                }
            ?>
            </select>
        </div>

        <!-- Right Sidebar -->
        <div class="input onehalf" style="padding-top: 0;">
            <label for="post-sidebar-right"><?php esc_html_e("Right Sidebar", 'hairdresser'); ?></label>
            <select name="post_sidebar_right" id="post-sidebar-right">
                <option value="0"></option>
            <?php
                global $wp_registered_sidebars;
                $sidebars = $wp_registered_sidebars;

                if( is_array($sidebars) && !empty($sidebars) ) {
                    foreach( $sidebars as $sidebar ) {
                        if( $anps_options_data['post_sidebar_right'] && $anps_options_data['post_sidebar_right'] == esc_attr($sidebar['name']) ) {
                            echo '<option value="' . esc_attr($sidebar['name']) . '" selected>' . esc_attr($sidebar['name']) . '</option>';
                        } else {
                            echo '<option value="' . esc_attr($sidebar['name']) . '">' . esc_attr($sidebar['name']) . '</option>';
                        }
                    }
                }
            ?>
            </select>
        </div>


        <div class="clear"></div>
        <h3><?php esc_html_e("Heading", 'hairdresser'); ?></h3>
        <!-- Disable page title, breadcrumbs and background -->
            <div class="input onoffswitch fullwidth floatleft">
                <?php
                if(!isset($anps_options_data['disable_heading']))
                    $checked='';
                elseif ($anps_options_data['disable_heading'] == '-1')
                    $checked = '';
                elseif ($anps_options_data['disable_heading'] == '')
                    $checked = '';
                else
                    $checked = 'checked';
                ?>
                <label class="onehalf floatleft" for="disable_heading"><?php esc_html_e("Disable page title, breadcrumbs and background", 'hairdresser'); ?></label>
                <input class="onoffswitch-checkbox onehalf floatright" style="margin-left: 117px" type="checkbox" id="disable_heading" name="disable_heading" <?php echo esc_attr($checked); ?> />
                <label class="onoffswitch-label" for="disable_heading">
                   <span class="onoffswitch-inner">
                   <span class="onoffswitch-active"><span class="onoffswitch-switch">ON</span></span>
                   <span class="onoffswitch-inactive"><span class="onoffswitch-switch">OFF</span></span>
                   </span>
               </label>
            </div>
            <!-- END Disable page title, breadcrumbs and background -->
            <!-- Breadcrumbs disable -->
            <div class="input onoffswitch fullwidth floatleft">
                <?php
                if(!isset($anps_options_data['breadcrumbs']))
                    $checked='';
                elseif ($anps_options_data['breadcrumbs'] == '-1')
                    $checked = '';
                elseif ($anps_options_data['breadcrumbs'] == '')
                    $checked = '';
                else
                    $checked = 'checked';
                ?>
                <label class="onehalf floatleft" for="breadcrumbs"><?php esc_html_e("Disable breadcrumbs", 'hairdresser'); ?></label>
                <input class="onoffswitch-checkbox onehalf floatright" style="margin-left: 63px" type="checkbox" id="breadcrumbs" name="breadcrumbs" <?php echo esc_attr($checked); ?> />
                <label class="onoffswitch-label" for="breadcrumbs">
                   <span class="onoffswitch-inner">
                   <span class="onoffswitch-active"><span class="onoffswitch-switch">ON</span></span>
                   <span class="onoffswitch-inactive"><span class="onoffswitch-switch">OFF</span></span>
                   </span>
               </label>
            </div>
            <!-- END Breadcrumbs disable -->
            <div class="clear"></div>

        <h3><?php esc_html_e("Vertical menu?", 'hairdresser'); ?></h3>
            <p>This option overrides other menu options</p>
            <div class="clear"></div>
            <div class="input onoffswitch fullwidth floatleft">
                <?php
                if(!isset($anps_options_data['vertical_menu']))
                    $checked='';
                elseif ($anps_options_data['vertical_menu'] == '-1')
                    $checked = '';
                elseif ($anps_options_data['vertical_menu'] == '')
                    $checked = '';
                else
                    $checked = 'checked';
                ?>


                <label class="onehalf floatleft" for="vertical_menu"><?php esc_html_e("Enable vertical menu?", 'hairdresser'); ?></label>
                <input class="onoffswitch-checkbox onehalf floatright vertical-menu-switch" style="margin-left: 63px" type="checkbox" id="vertical_menu" name="vertical_menu" <?php echo esc_attr($checked); ?> />
                <label class="onoffswitch-label" for="vertical_menu">
                   <span class="onoffswitch-inner">
                   <span class="onoffswitch-active"><span class="onoffswitch-switch">ON</span></span>
                   <span class="onoffswitch-inactive"><span class="onoffswitch-switch">OFF</span></span>
                   </span>
               </label>
            </div>

            <!-- Custom menu background -->
            <div class="input fullwidth" id="custom-header-bg-vertical-wrap">
                <label for="custom-header-bg-vertical"><?php esc_html_e("Custom vertical menu background image", 'hairdresser'); ?></label>
                <input class="wninety" id="custom-header-bg-vertical" type="text" size="36" name="custom-header-bg-vertical" value="<?php if (isset($anps_options_data['custom-header-bg-vertical'])) { echo esc_attr($anps_options_data['custom-header-bg-vertical']); } ?>" />
                <input id="_btn" class="upload_image_button" type="button" value="Upload" />
            </div>

            <!-- END Vertical menu -->
            <div class="clear"></div>

            <!-- comments on pages -->
            <h3><?php esc_html_e("Comments on pages", 'hairdresser'); ?></h3>
            <div class="input onoffswitch fullwidth floatleft">
                <?php
                if(!isset($anps_options_data['anps_pagecomments']))
                    $checked='';
                elseif ($anps_options_data['anps_pagecomments'] == '-1')
                    $checked = '';
                elseif ($anps_options_data['anps_pagecomments'] == '')
                    $checked = '';
                else
                    $checked = 'checked';
                ?>
                <label class="onehalf floatleft" for="anps_pagecomments"><?php esc_html_e("Disable comments on pages", 'hairdresser'); ?></label>
                <input class="onoffswitch-checkbox onehalf floatright" style="margin-left: 63px" type="checkbox" id="anps_pagecomments" name="anps_pagecomments" <?php echo esc_attr($checked); ?> />
                <label class="onoffswitch-label" for="anps_pagecomments">
                   <span class="onoffswitch-inner">
                   <span class="onoffswitch-active"><span class="onoffswitch-switch">ON</span></span>
                   <span class="onoffswitch-inactive"><span class="onoffswitch-switch">OFF</span></span>
                   </span>
               </label>
            </div>
            <div class="clear"></div>
            <!-- /comments on pages -->


    <h3><?php esc_html_e("Mobile layout", 'hairdresser'); ?></h3>

             <select name="footer_columns">
                    <option value="0">*** Select ***</option>
                    <?php
                            $pages = array("1"=>"1 column" ,"2"=>"2 columns");
                            foreach ($pages as $key=>$item) :
                                    if (isset($anps_options_data['footer_columns']) && $anps_options_data['footer_columns']==$key) {
                                            $selected = 'selected="selected"';
                                    }
                                    else {
                                            $selected = '';
                                    }
                    ?>      <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_html($item); ?></option>
                    <?php endforeach; ?>
            </select>
            <div class="clear"></div>


</div>

<div class="content-top" style="border-style: solid none; margin-top: 70px">
    <input type="submit" value="<?php esc_html_e("Save all changes", 'hairdresser'); ?>">
    <div class="clear"></div>
</div>
</form>


<?php
    if (isset($_GET['save_page'])) {
      //update_option("rtl", $_POST['rtl']);
    }
?>
