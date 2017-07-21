<?php 
include_once(get_template_directory() . '/anps-framework/classes/Framework.php');
class AnpsDummy extends AnpsFramework {
        
    public function select() {
        return get_option('anps_dummy');
    }
    
    public function save() { 
        $date = explode("/",date("Y/m"));
        $dummy_xml = "dummy1";
        if(isset($_POST['dummy1'])) {
            $dummy_xml = "dummy1";
            update_option('topmenu_style', "4");
        } elseif(isset($_POST['dummy2'])) {
            $dummy_xml = "dummy2";
            update_option('anps_menu_type', "1");
            update_option('anps_front_text_color', "#ffffff");
            update_option('anps_front_text_hover_color', "#000000");
            update_option('anps_front_logo', "http://anpsthemes.com/hairdresser-demo2/wp-content/uploads/2015/11/main-logo-fullscr.png");
            update_option('topmenu_style', "3");
            update_option('auto_adjust_logo', '');
            update_option('logo-width', '157');
            update_option('logo-height', '18');
            /* Buttons */
            update_option('style_2_button_bg', "#940855");
            update_option('style_2_button_hover_bg', "#BD1470");
            
        } elseif(isset($_POST['dummy3'])) {
            $dummy_xml = "dummy3";
            update_option('anps_above_nav_bar', "1");
            update_option('topmenu_style', "3");
            /* Colors */
            update_option('primary_color', "#006287");
            update_option('hovers_color', "#148ab5");
            /* Buttons */
            update_option('default_button_bg', "#006287");
            update_option('default_button_hover_bg', "#148ab5");
            update_option('style_1_button_bg', "#006287");
            update_option('style_1_button_hover_bg', "#148ab5");
            update_option('style_2_button_bg', "#006287");
            update_option('style_2_button_hover_bg', "#148ab5");
            update_option('style_3_button_color', "#006287");
            update_option('style_3_button_hover_bg', "#006287");
            update_option('style_3_button_border_color', "#006287");
            update_option('style_4_button_color', "#006287");
            update_option('style_4_button_hover_color', "#148ab5");
            /* Logos */
            update_option('anps_media_info', array("logo"=>"http://anpsthemes.com/hairdresser-demo3/wp-content/uploads/2015/11/main-logo-blue.png", "logo-width"=>"157", "logo-height"=>"18"));
        } 
        update_option('h2_font_size', "18");
        update_option('anps_acc_info', array('anps_pagecomments'=>'on'));      
        /* set dummy to 1 */
        update_option('anps_dummy', 1);
        /* Import dummy xml */
        include_once WP_PLUGIN_DIR . '/anps_theme_plugin/importer/wordpress-importer.php';
        $parse = new WP_Import();
        $parse->import(get_template_directory() . "/anps-framework/classes/importer/$dummy_xml.xml");
        global $wp_rewrite;
        $blog_id = get_page_by_title("Blog")->ID;
        $error_id = get_page_by_title("404 Page")->ID;
        $first_id = get_page_by_title("Home")->ID;
        $arr = array(
            'error_page'=>$error_id
            );
        
        update_option($this->prefix.'page_setup', $arr); 
        update_option('page_for_posts', $blog_id);
        update_option('page_on_front', $first_id);                                
        update_option('show_on_front', 'page'); 
        update_option('permalink_structure', '/%postname%/'); 
        $wp_rewrite->set_permalink_structure('/%postname%/');    
        $wp_rewrite->flush_rules();
        
        /* Set menu as primary */
	$menu_id = wp_get_nav_menus();
        $locations = get_theme_mod('nav_menu_locations');
        $locations['primary'] = $menu_id[0]->term_id;
        set_theme_mod('nav_menu_locations', $locations);
        update_option('menu_check', true);
        
        /* Install all widgets */
        $this->__add_widgets($dummy_xml);
        
        /* Add revolution slider demo data */
        $this->__add_revslider($dummy_xml);
    }
    
    protected function __add_revslider($dummy_xml) {
        /* Check if slider is installed */
        if(is_plugin_active("revslider/revslider.php")) {
            $slider = new RevSlider();
            if($dummy_xml=='dummy1') {
                $slider_name = "main-slider";
            } elseif($dummy_xml=='dummy2') {
                $slider_name = "main-slider2";
            } elseif($dummy_xml=='dummy3') {
                $slider_name = "main-slider3";
            }
            $response = $slider->importSliderFromPost('', '', get_template_directory() . "/anps-framework/classes/importer/$slider_name.zip");
            //handle error
            if($response["success"] == false){
                $message = $response["error"];
                dmp("<b>Error: ".$message."</b>");
                exit;
            }
        } else {
            echo "Revolution slider is not active. Demo data for revolution slider can't be inserted.";
        }
    }  
    
    protected function __add_widgets($dummy_xml) { 
        $secondary_sidebar = 'secondary-widget-area';
        $above_navigation_bar = 'above-navigation-bar';           
        $top_left_sidebar = 'top-bar-left';
        $top_right_sidebar = 'top-bar-right';
        $footer_1_sidebar = "footer-1";
        $footer_2_sidebar = "footer-2";
        $footer_3_sidebar = "footer-3";
        $footer_4_sidebar = "footer-4";
        $copyright_1_sidebar = "copyright-1";
        $widget_anpssocial = 'anpssocial';
        $widget_anpstext = 'anpstext';
        $widget_wptext = 'text';
        $widget_navigation = 'nav_menu';
        $widget_opening_time = 'anpsopeningtime';
        $sidebar_options = get_option('sidebars_widgets');      
        if(!isset($sidebar_options[$secondary_sidebar])){
            $sidebar_options[$secondary_sidebar] = array('_multiwidget'=>1);
        }

        if(!isset($sidebar_options[$top_left_sidebar])){
            $sidebar_options[$top_left_sidebar] = array('_multiwidget'=>1);
        }
        if(!isset($sidebar_options[$top_right_sidebar])){
            $sidebar_options[$top_right_sidebar] = array('_multiwidget'=>1);
        }
        if(!isset($sidebar_options[$above_navigation_bar])){
            $sidebar_options[$above_navigation_bar] = array('_multiwidget'=>1);
        }
        if(!isset($sidebar_options[$footer_1_sidebar])){
            $sidebar_options[$footer_1_sidebar] = array('_multiwidget'=>1);
        }
        if(!isset($sidebar_options[$footer_2_sidebar])){
            $sidebar_options[$footer_2_sidebar] = array('_multiwidget'=>1);
        }
        if(!isset($sidebar_options[$footer_3_sidebar])){
            $sidebar_options[$footer_3_sidebar] = array('_multiwidget'=>1);
        }
        /* Top left sidebar */
        $anpssocial = get_option('widget_'.$widget_anpssocial);
        if(!is_array($anpssocial))$anpssocial = array();
        $socialcount = count($anpssocial)+1;
        $sidebar_options[$top_left_sidebar][] = $widget_anpssocial.'-'.$socialcount;
        $anpssocial[$socialcount] = array(
            'icon_0' => 'fa-facebook',
            'url_0' => "#",
            'icon_1' => 'fa-twitter',
            'url_1' => "#",
            'icon_2' => 'fa-linkedin',
            'url_2' => "#",
            'icon_3' => 'fa-google-plus',
            'url_3' => "#",
        );
        $socialcount++;
        /* END Top left sidebar */
        /* Top right sidebar */
        $anpstext = get_option('widget_'.$widget_anpstext);
        if(!is_array($anpstext))$anpstext = array();
        $textcount = count($anpstext)+1;
        /* First widget */
        $sidebar_options[$top_right_sidebar][] = $widget_anpstext.'-'.$textcount;
        $anpstext[$textcount] = array(
            'icon' => 'fa-clock-o',
            'text' => "Mon - Sat: 8:00 - 17:00"
        );
        $textcount++;
        /* Second widget */
        $sidebar_options[$top_right_sidebar][] = $widget_anpstext.'-'.$textcount;
        $anpstext[$textcount] = array(
            'icon' => 'fa-phone',
            'text' => "+ 386 40 111 5555"
        );
        $textcount++;
        /* Third widget */
        $sidebar_options[$top_right_sidebar][] = $widget_anpstext.'-'.$textcount;
        $anpstext[$textcount] = array(
            'icon' => 'fa-envelope-o',
            'text' => '<a href="mailto:info@yourdomain.com">info@yourdomain.com</a>'
        );
        $textcount++;
        /* END Top right sidebar */
        /* Above navigation sidebar */
        /* First widget */
        $sidebar_options[$above_navigation_bar][] = $widget_anpstext.'-'.$textcount;
        $anpstext[$textcount] = array(
            'icon' => 'fa-clock-o',
            'text' => "Opened: <span style='color:#006287;'>from 8:00 to 17:00</span>"
        );
        $textcount++;
        /* Second widget */
        $sidebar_options[$above_navigation_bar][] = $widget_anpstext.'-'.$textcount;
        $anpstext[$textcount] = array(
            'icon' => 'fa-phone',
            'text' => "Call us free: <span style='color:#006287;'>+057 6854 456</span>"
        );
        $textcount++;
        /* END Above navigation sidebar */
        /* Footer 1 sidebar */
        $wptext = get_option('widget_'.$widget_wptext);
        if(!is_array($wptext))$wptext = array();
        $wptextcount = count($wptext)+1;
        /* Text widget */
        $sidebar_options[$footer_1_sidebar][] = $widget_wptext.'-'.$wptextcount;
        $wptext[$wptextcount] = array(
            'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam turpis quam, sodales in ante sagittis, varius efficitur mauris.<br/><br/>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam turpis quam, sodales in ante sagittis, varius efficitur mauris.',
            'title' => 'ABOUT HAIRDRESSER'
        );
        $wptextcount++;
        /* END Text widget */
        /* END Footer 1 sidebar */
        /* Footer 2 sidebar */
        $wpnavigation = get_option('widget_'.$widget_navigation);
        if(!is_array($wpnavigation))$wpnavigation = array();
        $navigationcount = count($wpnavigation)+1;
        /* Navigation */
        $term = get_term_by('name', 'Side Menu', 'nav_menu');
        $menu_id = $term->term_id;
        $sidebar_options[$footer_2_sidebar][] = $widget_navigation.'-'.$navigationcount;
        $wpnavigation[$navigationcount] = array(
            'nav_menu' => $menu_id,
            'title' => 'NAVIGATION'
        );
        $navigationcount++;
        /* END Navigation */
        /* END Footer 2 sidebar */
        /* Footer 3 sidebar */
        /* Text title */
        $sidebar_options[$footer_3_sidebar][] = $widget_wptext.'-'.$wptextcount;
        $wptext[$wptextcount] = array(
            'text' => '',
            'title' => 'HAIRDRESSER LOCATION'
        );
        $wptextcount++;
        /* END Text title */
        /* Text and icon 1 */
        $sidebar_options[$footer_3_sidebar][] = $widget_anpstext.'-'.$textcount;
        $anpstext[$textcount] = array(
            'icon' => 'fa-map-marker',
            'text' => "Hairdresser<br /> 300 Pennsylvania Ave NW, Washington<br /><br />"
        );
        $textcount++;
        /* END Text and icon 1 */
        /* Text and icon 2 */
        $sidebar_options[$footer_3_sidebar][] = $widget_anpstext.'-'.$textcount;
        $anpstext[$textcount] = array(
            'icon' => 'fa-phone',
            'text' => "Telephone: +386 40 222 455"
        );
        $textcount++;
        /* END Text and icon 2 */
        /* Text and icon 3 */
        $sidebar_options[$footer_3_sidebar][] = $widget_anpstext.'-'.$textcount;
        $anpstext[$textcount] = array(
            'icon' => 'fa-mobile',
            'text' => "Mobile phone: +386 40 112 555"
        );
        $textcount++;
        /* END Text and icon 3 */
        /* Text and icon 4 */
        $sidebar_options[$footer_3_sidebar][] = $widget_anpstext.'-'.$textcount;
        $anpstext[$textcount] = array(
            'icon' => 'fa-fax',
            'text' => "FAX: +386 40 4444 1155"
        );
        $textcount++;
        /* END Text and icon 4 */
        /* END Footer 3 sidebar */
        /* Footer 4 sidebar */
        $anpsopening = get_option('widget_'.$widget_opening_time);
        if(!is_array($anpsopening))$anpsopening = array();
        $openingcount = count($anpsopening)+1;
        $sidebar_options[$footer_4_sidebar][] = $widget_opening_time.'-'.$openingcount;
        $anpsopening[$openingcount] = array(
            'title' => 'Opening time',
            'day_1' => "Monday",
            'opening_time_1' => '08:00 - 17:00',
            'day_2' => "Tuesday",
            'opening_time_2' => '08:00 - 17:00',
            'day_3' => "Wednesday",
            'opening_time_3' => '08:00 - 17:00',
            'day_4' => "Thursday",
            'opening_time_4' => '08:00 - 17:00',
            'day_5' => "Friday",
            'opening_time_5' => '08:00 - 17:00',
            'day_6' => "Saturday",
            'opening_time_6' => '08:00 - 12:00',
            'day_7' => "Sunday",
            'opening_time_7' => 'CLOSED',
            'exposed_7' => 'on',
        );
        $openingcount++;
        /* END Footer 4 sidebar */
        /* Copyright Footer 1 sidebar */
        /* Text */
        $sidebar_options[$copyright_1_sidebar][] = $widget_wptext.'-'.$wptextcount;
        $wptext[$wptextcount] = array(
            'text' => "Hairdresser wordpress theme | &#169; 2015 Hairdresser, All rights reserved"
        );
        $wptextcount++;
        /* END Text */
        /* END Copyright Footer 1 sidebar */
        /* Secondary sidebar */
        /* Navigation */
        /*$locations = get_theme_mod('nav_menu_locations');
        $menu = 2;
        if($locations && $locations['primary']) {
            $menu = $locations['primary'];
        }*/
        $sidebar_options[$secondary_sidebar][] = $widget_navigation.'-'.$navigationcount;
        $wpnavigation[$navigationcount] = array(
            'nav_menu' => $menu_id
        );
        $navigationcount++;
        /* END Navigation */
        /* END Secondary sidebar */
        update_option('sidebars_widgets',$sidebar_options);
        update_option('widget_'.$widget_anpssocial, $anpssocial);
        update_option('widget_'.$widget_anpstext, $anpstext);
        update_option('widget_'.$widget_wptext, $wptext);
        update_option('widget_'.$widget_navigation, $wpnavigation);
        update_option('widget_'.$widget_opening_time, $anpsopening);
    }
}
$anps_dummy = new AnpsDummy();