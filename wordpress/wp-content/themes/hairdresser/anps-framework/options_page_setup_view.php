<?php
	include_once(get_template_directory() . '/anps-framework/classes/Options.php');
	$anps_page_data = $options->get_page_setup_data();
	if (isset($_GET['save_page_setup'])) {
        if(!isset($_POST['anps_post_meta_comments'])) {
            $_POST['anps_post_meta_comments'] = "0";
        }
        if(!isset($_POST['anps_post_meta_categories'])) {
            $_POST['anps_post_meta_categories'] = "0";
        }
        if(!isset($_POST['anps_post_meta_author'])) {
            $_POST['anps_post_meta_author'] = "0";
        }
        if(!isset($_POST['anps_post_meta_date'])) {
            $_POST['anps_post_meta_date'] = "0";
        }
		$options->save_page_setup();}
		?>
<form action="themes.php?page=theme_options&sub_page=options_page_setup&save_page_setup" method="post">
        <div class="content-top">
                <input type="submit" value="<?php esc_html_e("Save all changes", 'hairdresser'); ?>" />
                <div class="clear"></div>
        </div>
        <div class="content-inner">
        <!-- Page setup -->
        <h3><?php esc_html_e("Page setup", 'hairdresser'); ?></h3>
        <!-- Coming soon page -->
        <div class="input onehalf">
            <label for="coming_soon"><?php esc_html_e("Coming soon page", 'hairdresser'); ?></label>
            <select name="coming_soon">
                    <option value="0">*** Select ***</option>
                    <?php
                            $pages = get_pages();
                            foreach ($pages as $item) :
                                    if ($anps_page_data['coming_soon'] == $item->ID) {
                                            $selected = 'selected="selected"';
                                    }
                                    else {
                                            $selected = '';
                                    }
                    ?>      <option value="<?php echo esc_attr($item->ID); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_html($item->post_title); ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
        <!-- Error page -->
        <div class="input onehalf">
            <label for="error_page"><?php esc_html_e("404 error page", 'hairdresser'); ?></label>
            <select name="error_page">
                    <option value="0">*** Select ***</option>
                    <?php
                            $pages = get_pages();
                            foreach ($pages as $item) :
                                    if ($anps_page_data['error_page'] == $item->ID) {
                                            $selected = 'selected="selected"';
                                    }
                                    else {
                                            $selected = '';
                                    }
                    ?>      <option value="<?php echo esc_attr($item->ID); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_html($item->post_title); ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
        <div class="clear"></div>
        <h3><?php esc_html_e("WooCommerce", 'hairdresser'); ?></h3>
        <div class="input onethird">
            <label for="shopping_cart_header"><?php esc_html_e("Display shopping cart icon in header?", 'hairdresser'); ?></label>
            <select name="shopping_cart_header">
                    <?php $pages = array("hide"=>'Never display', "shop_only"=>'only on Woo pages', "always"=>'Display everywhere');
                    foreach ($pages as $key => $item) :
                        if (get_option('shopping_cart_header', "shop_only") == $key) {
                            $selected = 'selected="selected"';
                        } else {
                            $selected = '';
                        } ?>
                <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_attr($item); ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
		<!-- WooCommerce columns -->
        <div class="input onethird">
            <label for="anps_products_columns"><?php _e('How many products in row?', 'hairdresser'); ?></label>
            <select name="anps_products_columns">
                    <?php $pages = array('4'=>'4 products', '3'=>'3 products');
                    foreach ($pages as $key => $item) :
                        if (get_option('anps_products_columns', '4') == $key) {
                            $selected = 'selected="selected"';
                        } else {
                            $selected = '';
                        } ?>
                <option value="<?php echo esc_attr($key); ?>" <?php echo $selected; ?>><?php echo esc_attr($item); ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
        <!-- WooCommerce products per page -->
        <div class='input onethird'>
            <label for='anps_products_per_page'><?php _e("Products per page", 'hairdresser'); ?></label>
            <input type='text' value='<?php echo get_option('anps_products_per_page', '12'); ?>' name='anps_products_per_page' id='anps_products_per_page' />
        </div>
        <div class="clear"></div>
        <h3><?php esc_html_e("Portfolio", 'hairdresser'); ?></h3>
        <!-- Portfolio single style -->
        <div class='input fullwidth'>
            <label for='anps_portfolio_slug'><?php esc_html_e("Portfolio slug", 'hairdresser'); ?></label>
            <input type='text' value='<?php echo get_option('anps_portfolio_slug'); ?>' name='anps_portfolio_slug' id='anps_portfolio_slug' />
        </div>
        <div class="input onethird">
            <label for="portfolio_single"><?php esc_html_e("Portfolio single style", 'hairdresser'); ?></label>
            <select name="portfolio_single">
                    <?php $pages = array("style-1"=>'Style 1', "style-2"=>'Style 2');
                    foreach ($pages as $key => $item) :
                        if (get_option('portfolio_single') == $key) {
                            $selected = 'selected="selected"';
                        } else {
                            $selected = '';
                        } ?>
                <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_attr($item); ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
        <!-- Portfolio single footer -->
        <div class="input twothird">
        <label for="portfolio_single_footer"><?php esc_html_e("Portfolio single footer", 'hairdresser'); ?></label>
        <?php $value2 = get_option('portfolio_single_footer', '');
                wp_editor(str_replace('\\"', '"', $value2), 'portfolio_single_footer', array(
                            'wpautop' => true,
                            'media_buttons' => false,
                            'textarea_name' => 'portfolio_single_footer',
                            'textarea_rows' => 10,
                            'teeny' => true )); ?>
        </div>
        <div class="clear"></div>
        <!-- Menu -->
        <h3><?php esc_html_e("Front page Top Menu", 'hairdresser'); ?></h3>
        <!-- Menu -->
        <div class="input fullwidth" id="headerstyle">
            <?php
                $i=1;
                $images_array = array("top-transparent-menu", "top-background-menu", "bottom-transparent-menu", "bottom-background-menu");
                foreach($images_array as $item) :
                if(get_option('anps_menu_type', 2)==$i) {
                    $checked = " checked";
                } else {
                    $checked = "";
                }
            ?>
            <label class="onequarter" id="head-<?php echo esc_attr($i); ?>">
                <input type="radio" name="anps_menu_type" value="<?php echo esc_attr($i); ?>"<?php echo esc_attr($checked); ?>>
                <img src="<?php echo get_template_directory_uri(); ?>/anps-framework/images/<?php echo esc_attr($item); ?>.jpg">
            </label>
            <?php $i++; endforeach; ?>
        </div>
        <!-- Hidden -->
        <div class="anps_menu_type_font fullwidth ">
            <div class="input onethird" >
                <label for="anps_front_text_color"><?php esc_html_e("Text color", 'hairdresser'); ?></label>
                <input data-value="<?php echo get_option('anps_front_text_color'); ?>" readonly style="background: <?php echo get_option('anps_front_text_color'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_front_text_color" value="<?php echo get_option('anps_front_text_color'); ?>" id="anps_front_text_color" />
            </div>
            <div class="input onethird" >
                <label for="anps_front_text_hover_color"><?php esc_html_e("Text hover color", 'hairdresser'); ?></label>
                <input data-value="<?php echo get_option('anps_front_text_hover_color'); ?>" readonly style="background: <?php echo get_option('anps_front_text_hover_color'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_front_text_hover_color" value="<?php echo get_option('anps_front_text_hover_color'); ?>" id="anps_front_text_hover_color" />
            </div>
            <div class="onoff input head-2 head-4 onethird" >
                <label for="anps_front_bg_color"><?php esc_html_e("Background color", 'hairdresser'); ?></label>
                <input data-value="<?php echo get_option('anps_front_bg_color'); ?>" readonly style="background: <?php echo get_option('anps_front_bg_color'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_front_bg_color" value="<?php echo get_option('anps_front_bg_color'); ?>" id="anps_front_bg_color" />
            </div>
            <div class="onoff input head-1 onethird" >
                <label for="anps_front_topbar_color"><?php esc_html_e("Front page top bar color", 'hairdresser'); ?></label>
                <input data-value="<?php echo get_option('anps_front_topbar_color'); ?>" readonly style="background: <?php echo get_option('anps_front_topbar_color'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_front_topbar_color" value="<?php echo get_option('anps_front_topbar_color'); ?>" id="anps_front_topbar_color" />
            </div>
            <div class="onoff input head-1 onethird" >
                <label for="anps_front_topbar_hover_color"><?php esc_html_e("Front page top bar link hover color", 'hairdresser'); ?></label>
                <input data-value="<?php echo get_option('anps_front_topbar_hover_color'); ?>" readonly style="background: <?php echo get_option('anps_front_topbar_hover_color'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_front_topbar_hover_color" value="<?php echo get_option('anps_front_topbar_hover_color'); ?>" id="anps_front_topbar_hover_color" />
            </div>

            <div class="onoff input head-1 head-3 twothirds">
                <label for="anps_front_logo"><?php esc_html_e("Front page logo", 'hairdresser'); ?></label>
                <input id="anps_front_logo" type="text" size="36" name="anps_front_logo" value="<?php echo esc_attr(get_option('anps_front_logo')); ?>" />
                <input id="_btn" class="upload_image_button width-105" type="button" value="Upload" />
                <p class="fullwidth"><?php esc_html_e("This option is ment for logo color adjustments if needed. Please make sure, the logo is exact same size as logo on other pages.", 'hairdresser'); ?></p>
                <div class="clear"></div>
            </div>


            <div class="onoff input head-1 head-3 twothirds" >

            </div>
        </div>
        <div class="onoff anps_full_screen input fullwidth head-3 head-4" >
            <label for="anps_full_screen"><?php esc_html_e("Full screen content", 'hairdresser'); ?></label>
            <?php $value2 = get_option('anps_full_screen', '');
            wp_editor(str_replace('\\"', '"', $value2), 'anps_full_screen', array(
                                                'wpautop' => true,
                                                'media_buttons' => false,
                                                'textarea_name' => 'anps_full_screen',
                                                'textarea_rows' => 10,
                                                'teeny' => true )); ?>
            <p style="margin-top: 20px;"><h2>Important!</h2>The textarea above is ment for the slider shortcode. It will be shown on the home page before the rest of the site. Add slider shortcode inside the content area above for tis menu type to work. <br/>If you imported our demo, you will also need to remove the slider on your homepage and remove the negative margin on first row (check the screenshot below).<br/><img src="<?php echo get_template_directory_uri(); ?>/anps-framework/images/home-changes.jpg"></p>
        </div>
        <!-- END Hidden -->
        <div class="clearfix"></div>
        <h3><?php esc_html_e("General Top Menu Settings", 'hairdresser'); ?></h3>
        <!-- Top menu -->
        <div class="input onequarter">
            <label for="topmenu_style"><?php esc_html_e("Top bar", 'hairdresser'); ?></label>
            <select name="topmenu_style">
                    <?php $pages = array(
                        "3"=>esc_html__('Disable', 'hairdresser'),
                        "5"=>esc_html__('Enable', 'hairdresser'),
                        "1"=>esc_html__('Enable on desktop, hide on mobile', 'hairdresser'),
                        "4"=>esc_html__("Enable on desktop, disable on mobile", 'hairdresser'),
                    );
                    foreach ($pages as $key => $item) :
                        if (get_option('topmenu_style') == $key) {
                            $selected = 'selected="selected"';
                        } else {
                            $selected = '';
                        } ?>
                <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_html($item); ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
        <div class="input onequarter">
            <label for="anps_above_nav_bar"><?php esc_html_e("Display above menu bar?", 'hairdresser'); ?></label>
            <select name="anps_above_nav_bar">
                    <?php $pages = array("1"=>'Yes', "0"=>'No');
                    foreach ($pages as $key => $item) :
                         ?>
                <option value="<?php echo esc_attr($key); ?>" <?php if (get_option('anps_above_nav_bar') == $key) {echo 'selected="selected"';} else {echo '';} ?>><?php echo esc_attr($item); ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
        <div class="input onequarter">
            <label for="menu_style"><?php esc_html_e("Menu", 'hairdresser'); ?></label>
            <select name="menu_style">
                    <?php $pages = array("1"=>'Normal', "2"=>'Description');
                    foreach ($pages as $key => $item) :
                        if (get_option('menu_style') == $key) {
                            $selected = 'selected="selected"';
                        } else {
                            $selected = '';
                        } ?>
                <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_html($item); ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
        <!-- Menu centered -->
        <div class="input onequarter">
            <?php
            if(get_option('menu_center')=="on") {
                $checked='checked';
            } else {
                $checked = '';
            }
            ?>
            <label for="menu_center"><?php esc_html_e("Menu centered", 'hairdresser'); ?></label>
            <input id="menu_center" class="small_input" style="margin-left: 37px" type="checkbox" name="menu_center" <?php echo esc_attr($checked); ?> />
        </div>
        <!-- Sticky menu -->
        <div class="input onequarter">
            <?php
            if(get_option('sticky_menu')=="on") {
                $checked='checked';
            } else {
                $checked = '';
            }
            ?>
            <label for="sticky_menu"><?php esc_html_e("Sticky menu", 'hairdresser'); ?></label>
            <input id="sticky_menu" class="small_input" style="margin-left: 37px" type="checkbox" name="sticky_menu" <?php echo esc_attr($checked); ?> />
        </div>

         <div class="input onequarter">
            <label for="logo_transition_style"><?php esc_html_e("Sticky logo transition", 'hairdresser'); ?></label>
            <select name="logo_transition_style">
                    <?php $styles = array("1"=>'Fade', "2"=>'Vertical', "3"=>'Scale', "4"=>'None', "5"=>'Simple' );
                    foreach ($styles as $key => $item) :
                        if (get_option('logo_transition_style') == $key) {
                            $selected = 'selected="selected"';
                        } else {
                            $selected = '';
                        } ?>
                <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_html($item); ?></option>
                    <?php endforeach; ?>
            </select>
        </div>

        <div class="input onequarter">
            <?php
            if(get_option('search_icon')=="on") {
                $checked='checked';
            } else {
                $checked = '';
            }
            ?>
            <label for="search_icon"><?php esc_html_e("Display search icon in menu (desktop)?", 'hairdresser'); ?></label>
            <input id="search_icon" class="small_input" style="margin-left: 37px" type="checkbox" name="search_icon" <?php echo esc_attr($checked); ?> />
        </div>
        <div class="input onequarter">
            <?php
            if(get_option('search_icon_mobile')=="on") {
                $checked='checked';
            } else {
                $checked = '';
            }
            ?>
            <label for="search_icon_mobile"><?php esc_html_e("Display search on mobile and tablets?", 'hairdresser'); ?></label>
            <input id="search_icon_mobile" class="small_input" style="margin-left: 37px" type="checkbox" name="search_icon_mobile" <?php echo esc_attr($checked); ?> />
        </div>

        <div class="clear"></div>
        <!-- Prefooter -->
        <h3><?php esc_html_e("Prefooter", 'hairdresser'); ?></h3>
        <!-- Prefooter -->
        <div class="input onehalf">
            <?php
            if(get_option('prefooter')=="on") {
                $checked='checked';
            } else {
                $checked = '';
            }
            ?>
            <label for="prefooter"><?php esc_html_e("Prefooter", 'hairdresser'); ?></label>
            <input id="prefooter" class="small_input" style="margin-left: 25px" type="checkbox" name="prefooter" <?php echo esc_attr($checked); ?> />
        </div>
        <div class="input onehalf">
            <label for="prefooter_style"><?php esc_html_e("Prefooter style", 'hairdresser'); ?></label>
            <select name="prefooter_style">
                <option value="0">*** Select ***</option>
                    <?php $pages = array("5"=>"2/3 + 1/3", "6"=>"1/3 + 2/3","2"=>'2 columns', "3" => '3 columns', "4" => '4 columns');
                    foreach ($pages as $key => $item) :
                        if (get_option('prefooter_style') == $key) {
                            $selected = 'selected="selected"';
                        } else {
                            $selected = '';
                        } ?>
                <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_attr($item); ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
        <div class="clear"></div>
        <h3><?php esc_html_e("Footer", 'hairdresser'); ?></h3>
        <!-- Disable footer -->
        <div class="input onethird">
            <?php
            if(get_option('footer_disable')=="on") {
                $checked='checked';
            } else {
                $checked = '';
            }
            ?>
            <label for="footer_disable"><?php esc_html_e("Disable footer", 'hairdresser'); ?></label>
            <input id="footer_disable" class="small_input" style="margin-left: 37px" type="checkbox" name="footer_disable" <?php echo esc_attr($checked); ?> />
        </div>
        <!-- Footer style -->
        <div class="input onethird">
            <label for="footer_style"><?php esc_html_e("Footer style", 'hairdresser'); ?></label>
            <select name="footer_style">
                <option value="0">*** Select ***</option>
                    <?php $pages = array("2"=>'2 columns', "3" => '3 columns', "4" => '4 columns');
                    foreach ($pages as $key => $item) :
                        if (get_option('footer_style') == $key) {
                            $selected = 'selected="selected"';
                        } else {
                            $selected = '';
                        } ?>
                <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_attr($item); ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
        <!-- Copyright footer -->
        <div class="input onethird">
            <label for="copyright_footer"><?php esc_html_e("Copyright footer", 'hairdresser'); ?></label>
            <select name="copyright_footer">
                <option value="0">*** Select ***</option>
                    <?php $pages = array("1"=>'1 column', "2" => '2 columns');
                    foreach ($pages as $key => $item) :
                        if (get_option('copyright_footer') == $key) {
                            $selected = 'selected="selected"';
                        } else {
                            $selected = '';
                        } ?>
                <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_attr($item); ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
        <div class="clear"></div>
        <!-- Post meta enable/disable -->
        <h3><?php esc_html_e("Disable Post meta elements", 'hairdresser'); ?></h3>
        <p><?php esc_html_e('This allows you to disable post meta on all blog elements and pages. By default no field is checked, so that all meta elements are displayed.', 'hairdresser'); ?></p>
        <div class="input">
            <?php
                $post_meta_arr = array(
                    "anps_post_meta_comments"   => "Comments",
                    "anps_post_meta_categories" => "Categories",
                    "anps_post_meta_author"     => "Author",
                    "anps_post_meta_date"       => "Date"
                );
            ?>
            <?php foreach($post_meta_arr as $key=>$item) : ?>
                <label for="<?php echo esc_attr($key); ?>"><?php echo esc_attr($item); ?></label>
                <input style="margin-left: 37px;" type="checkbox" name="<?php echo esc_attr($key); ?>" id="<?php echo esc_attr($key); ?>" <?php checked(get_option($key), "on") ?>/>
            <?php endforeach; ?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="content-top" style="border-style: solid none; margin-top: 70px">
        <input type="submit" value="<?php esc_html_e("Save all changes", 'hairdresser'); ?>">
        <div class="clear"></div>
    </div>
</form>
