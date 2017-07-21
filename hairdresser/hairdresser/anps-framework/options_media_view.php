<?php
include_once(get_template_directory() . '/anps-framework/classes/Options.php');
include_once(get_template_directory() . '/anps-framework/classes/Style.php');
wp_enqueue_script('font_subsets');
/* get all fonts */
$fonts = $style->all_fonts();
$anps_media_data = $options->get_media();
if (isset($_GET['save_media'])) {
    $options->save_media(); 
}
?>
<form action="themes.php?page=theme_options&sub_page=options_media&save_media" method="post">
    <div class="content-top"><input type="submit" value="<?php esc_html_e("Save all changes", 'hairdresser'); ?>" /><div class="clear"></div></div>
    <div class="content-inner">
        <h3><?php esc_html_e("Heading background:", 'hairdresser'); ?></h3>
        <!-- Heading background -->
        <div class="input floatleft onehalf">
            <label for="heading_bg"><?php esc_html_e("Page heading background", 'hairdresser'); ?></label>
            <input id="heading_bg" type="text" size="36" name="heading_bg" value="<?php if(isset($anps_media_data['heading_bg'])) {echo esc_attr($anps_media_data['heading_bg']);}else{ echo "";} ?>" />
            <input id="_btn" class="upload_image_button" type="button" value="Upload" />
            <p class="fullwidth"><?php esc_html_e("Enter an URL or upload an image for the page heading background.", 'hairdresser'); ?></p>
            <div class="clear"></div>
        </div>
        <!-- Search heading background -->
        <div class="input onehalf">
            <label for="search_heading_bg"><?php esc_html_e("Search page heading background", 'hairdresser'); ?></label>
            <input id="search_heading_bg" type="text" size="36" name="search_heading_bg" value="<?php if(isset($anps_media_data['search_heading_bg'])) {echo esc_attr($anps_media_data['search_heading_bg']);}else{ echo "";} ?>" />
            <input id="_btn" class="upload_image_button" type="button" value="Upload" />
            <p class="fullwidth"><?php esc_html_e("Enter an URL or upload an image for the search page heading background.", 'hairdresser'); ?></p>
            <div class="clear"></div>
        </div>
        <hr>
        <h3><?php esc_html_e("Favicon and logo:", 'hairdresser'); ?></h3>
        <p><?php esc_html_e("If you would like to use your logo and favicon, upload them to your theme here.", 'hairdresser'); ?></p>

        <!-- Logo -->
        <div class="input onehalf floatleft">
            <label for="logo"><?php esc_html_e("Logo", 'hairdresser'); ?></label>
            <?php
                $logo_width = 157;
                $logo_height = 18;

                if( $anps_media_data['logo-width'] ) {
                    $logo_width = $anps_media_data['logo-width'];
                }
                
                if( $anps_media_data['logo-height'] ) {
                    $logo_height = $anps_media_data['logo-height'];
                }

                if(isset($anps_media_data['logo']) && $anps_media_data['logo']!=''): 
            ?>
            <div class="preview"><img width="<?php echo esc_attr($logo_width); ?>" height="<?php echo esc_attr($logo_height); ?>" src="<?php echo esc_attr($anps_media_data['logo']); ?>"></div>
        <?php endif; ?>
            <input id="logo" type="text" size="36" name="logo" value="<?php echo esc_attr($anps_media_data['logo']); ?>" />
            <input id="_btn" class="upload_image_button" type="button" value="Upload" />
            <p class="fullwidth"><?php esc_html_e("Enter an URL or upload an image for the logo.", 'hairdresser'); ?></p>
        
            <div class="input fullwidth" style="min-height:0;">
                <?php
                if(get_option('auto_adjust_logo', 'on')=="on") {
                    $checked='checked';
                } else {
                    $checked = '';
                }
                ?>
                <label class="onehalf floatleft" for="auto_adjust_logo"><?php esc_html_e("Auto adjust logo size?", 'hairdresser'); ?></label>
                <div class="onehalf floatleft last" style="text-align:left; margin-top: 3px;">
                    <input id="auto_adjust_logo" class="small_input" style="margin-left: 0px; margin-top: 10px;" type="checkbox" name="auto_adjust_logo" <?php echo esc_attr($checked); ?> />
                </div>
            </div>

            <div class="input onehalf floatleft first addspace onoff">
                <label for="logo-width"><?php esc_html_e("Logo width", 'hairdresser'); ?></label>
                <input style="width: 100px;" id="logo-width" type="text" name="logo-width" value="<?php echo esc_attr($logo_width); ?>" /> px
            </div>

            <div class="input onehalf floatleft last addspace onoff">
                <label for="logo-height"><?php esc_html_e("Logo height", 'hairdresser'); ?></label>
                <input style="width: 100px;" id="logo-height" type="text" name="logo-height" value="<?php echo esc_attr($logo_height); ?>" /> px
            </div>
        </div>
        <!-- Sticky logo -->
        <div class="input onehalf stickylogo">
            <label for="sticky_logo"><?php esc_html_e("Sticky logo", 'hairdresser'); ?></label>
            <?php if(isset($anps_media_data['sticky_logo']) && $anps_media_data['sticky_logo']!=''): ?>
            <div class="preview onehalf"><img width="<?php echo esc_attr($logo_width); ?>" height="<?php echo esc_attr($logo_height); ?>" src="<?php echo esc_url($anps_media_data['sticky_logo']); ?>"></div>
            <?php endif; ?>
            <input class="wninety" id="sticky_logo" type="text" size="36" name="sticky_logo" value="<?php if(isset($anps_media_data['sticky_logo'])) { echo esc_attr($anps_media_data['sticky_logo']); } ?>" />
            <input id="_btn" class="upload_image_button" type="button" value="Upload" />
            <p clasS="fullwidth"><?php esc_html_e("Enter an URL or upload an image for the logo.", 'hairdresser'); ?></p>   
        </div>
        <div class="clear"></div>
        <hr>
                <!-- Favicon -->
        <div class="input onehalf">
            <label for="favicon"><?php esc_html_e("Favicon", 'hairdresser'); ?></label>
            <?php if(isset($anps_media_data['favicon'])&&$anps_media_data['favicon']!=""): ?>
            <div class="preview"><img src="<?php echo esc_url($anps_media_data['favicon']); ?>"></div>
            <?php endif; ?>
            <input id="favicon" type="text" size="36" name="favicon" value="<?php if(isset($anps_media_data['favicon'])) { echo esc_attr($anps_media_data['favicon']); } ?>" />
            <input id="_btn" class="upload_image_button" type="button" value="Upload" />
            <p class="fullwidth"><?php esc_html_e("Enter an URL or upload an image for the favicon.", 'hairdresser'); ?></p>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <h3><?php esc_html_e("Text based logo", 'accounting'); ?></h3>
        <div class="input twothirds">
        <label for="anps_text_logo"><?php esc_html_e('Text based logo', 'accounting'); ?></label>
        <?php $value2 = get_option('anps_text_logo', ''); 
                wp_editor(str_replace('\\"', '"', $value2), 'anps_text_logo', array(    
                            'wpautop' => true,
                            'media_buttons' => false,   
                            'quicktags' => false,
                            'textarea_name' => 'anps_text_logo',
                            'tinymce' => array(
                                'toolbar1' => 'bold, italic, underline, forecolor, fontsizeselect',
                                'toolbar2' => ''
                            )
                            )); ?>        
        </div>
        <div class="input onethird">
            <label for="anps_text_logo_font"><?php esc_html_e('Logo font', 'accounting'); ?></label>
            <select name="anps_text_logo_font" id="anps_text_logo_font">
                <?php foreach($fonts as $name=>$value) : ?>
                <optgroup label="<?php echo esc_attr($name); ?>">
                <?php foreach ($value as $font) : 
                        $selected = '';
                        if ($font['value'] == get_option('anps_text_logo_font')) {
                            $selected = 'selected="selected"';   
                            if($name=="Google fonts") {
                                $subsets = $font['subsets'];
                            } else {
                                $subsets = "";
                            }
                        }
                        ?>
                        <option value="<?php echo esc_attr($font['value'])."|".esc_attr($name); ?>" <?php echo $selected; ?>><?php echo esc_attr($font['name']); ?></option>
                <?php endforeach; ?>
                </optgroup>  
                <?php endforeach; ?>
            </select>
        </div>
        <div class="clear"></div>
    </div>
    <div class="content-top" style="border-style: solid none; margin-top: 70px">
        <input type="submit" value="<?php esc_html_e("Save all changes", 'hairdresser'); ?>">
        <div class="clear"></div>
    </div>
</form>
<?php wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_register_script('my-upload', get_template_directory_uri() . 'anps-framework/upload_image.js', array('jquery', 'media-upload', 'thickbox'));
    wp_enqueue_script('my-upload');
    wp_enqueue_style('thickbox');