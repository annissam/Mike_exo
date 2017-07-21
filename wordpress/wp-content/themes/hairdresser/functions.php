<?php
/* Theme auto update */
include_once get_template_directory().'/anps-framework/classes/AnpsUpgrade.php';
AnpsUpgrade::init();

/* Title tag theme support */
add_theme_support('title-tag');

/* Custom header theme support */
add_theme_support('custom-header');

/* Custom background theme support */
add_theme_support('custom-background');

/* Image sizes */
add_theme_support('post-thumbnails');

/* team */
add_image_size('anps-team-3', 370, 360, false);
// Blog views
add_image_size('anps-blog-grid', 720, 412, true);
add_image_size('anps-blog-full', 1200);
add_image_size('anps-blog-masonry-3-columns', 360, 0, false);
// Recent blog, portfolio
add_image_size('anps-post-thumb', 360, 267, true);
// Portfolio random grid
add_image_size('anps-portfolio-random-width-2', 554, 202, true);
add_image_size('anps-portfolio-random-height-2', 262, 433, true);
add_image_size('anps-portfolio-random-width-2-height-2', 554, 433, true);
//featured
add_image_size('anps-featured', 720, 470, true);

if(!is_admin()) {
    include_once get_template_directory().'/anps-framework/classes/Options.php';
    $anps_page_data = $options->get_page_setup_data();
    $anps_options_data = $options->get_page_data();
    $anps_media_data = $options->get_media();
    $anps_social_data = $options->get_social();
    $anps_shop_data = $options->get_shop_setup_data();
}

if(is_admin()) {
    /* Checking google fonts subsets for each font in admin */
    include_once get_template_directory() . '/anps-framework/classes/gfonts_ajax.php';
}
/* Include helper.php */
include_once get_template_directory().'/anps-framework/helpers.php';
if (!isset($content_width)) {
    $content_width = 967;
}
add_filter('widget_text', 'do_shortcode');
/* Widgets */
include_once(get_template_directory() . '/anps-framework/widgets/widgets.php');
/* Shortcodes */
include_once(get_template_directory() . '/anps-framework/shortcodes.php');
if (is_admin()) {
    include_once(get_template_directory() . '/shortcodes/shortcodes_init.php');
}
/* On setup theme */
add_action('after_setup_theme', 'anps_register_custom_fonts');
function anps_register_custom_fonts() {
    if (!isset($_GET['stylesheet'])) {
        $_GET['stylesheet'] = '';
    }
    $theme = wp_get_theme($_GET['stylesheet']);
    if (!isset($_GET['activated'])) {
        $_GET['activated'] = '';
    }
    if ($_GET['activated'] == 'true' && $theme->get_template() == "hairdresser") {
        include_once get_template_directory().'/anps-framework/classes/Options.php';
        include_once get_template_directory().'/anps-framework/classes/Style.php';
        /* Add google fonts*/
        if(get_option('anps_google_fonts', '')=='') {
            $style->update_gfonts_install();
        }
        /* Add custom fonts to options */
        $style->get_custom_fonts();
        /* Add default fonts */
        if(get_option('font_type_1', '')=='') {
            update_option("font_type_1", "Montserrat");
        }
        if(get_option('font_type_2', '')=='') {
            update_option("font_type_2", "PT+Sans");
        }
    }
    $fonts_installed = get_option('fonts_intalled');

    if($fonts_installed==1)
        return;

    /* Get custom font */
    include_once get_template_directory().'/anps-framework/classes/Style.php';
    $fonts = $style->get_custom_fonts();
    /* Update custom font */
    foreach($fonts as $name=>$value) {
        $arr_save[] = array('value'=>$value, 'name'=>$name);
    }
    update_option('anps_custom_fonts', $arr_save);
    update_option('fonts_intalled', 1);
}
/* Team metaboxes */
include_once(get_template_directory() . '/anps-framework/team_meta.php');
/* Portfolio metaboxes */
include_once(get_template_directory() . '/anps-framework/portfolio_meta.php');
/* Portfolio metaboxes */
include_once(get_template_directory() . '/anps-framework/metaboxes.php');
/* Menu metaboxes */
include_once(get_template_directory() . '/anps-framework/menu_meta.php');
/* Heading metaboxes */
include_once(get_template_directory() . '/anps-framework/heading_meta.php');
/* Featured video metabox */
include_once(get_template_directory() . '/anps-framework/featured_video_meta.php');

//install paralax slider
include_once(get_template_directory() . '/anps-framework/install_plugins.php');
/* Admin bar theme options menu */
include_once(get_template_directory() . '/anps-framework/classes/adminBar.php');
/* PHP header() NO ERRORS */
if (is_admin())
    add_action('init', 'anps_do_output_buffer');
function anps_do_output_buffer() {
    ob_start();
}
/* Infinite scroll 08.07.2013 */
function anps_infinite_scroll_init() {
    add_theme_support( 'infinite-scroll', array(
        'type'       => 'click',
        'footer_widgets' => true,
        'container'  => 'section-content',
        'footer'     => 'site-footer',
    ) );
}
add_action( 'init', 'anps_infinite_scroll_init' );
/* MegaMenu */
class anps_description_walker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {

        $item->url = $item->url;

        global $wp_query;
        $menu_style = get_option('menu_style', '1');
        if( isset($_GET['header']) && $_GET['header'] == 'type-2' ) {
            $menu_style = '2';
        }
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $class_names = $value = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="'. esc_attr( $class_names ) . '"';

        $output .= $indent . '<li' . $value . $class_names .'>';
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url       ) .'"' : '';

        $children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
        if (empty($children)) {
            $dropdownfix = "";
        }
        else
        {
            $dropdownfix = ' class="dropdown-toggle" data-hover="dropdown"';
        }

        $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';
        $description = do_shortcode($description);

        $append = "";
        $prepend = "";

        if($depth==0 && $menu_style!="2")
        {
            $description = $append = $prepend = "";
        }
        $locations = get_theme_mod('nav_menu_locations');

        if($locations['primary']) {
            $item_output = "";
            $item_output = $args->before;
            $item_output .= '<a'. $attributes . $dropdownfix . '>';   //Andrej dodal dropdownfix


            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
            $item_output .= '</a>';
            $item_output .= $description.$args->link_after;
            $item_output .= $args->after;
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth = 0, $args, $args, $current_object_id = 0 );
        }
    }
}
function anps_custom_colors() {
    echo '<style type="text/css">
        #gallery_images .image {width: 23%;margin:0 1%;float: left}
        #gallery_images ul:after {content: "";display: table;clear: both;}
        #gallery_images .image img {max-width: 100%;height: 50px;}
    </style>';
}
add_action('admin_head', 'anps_custom_colors');
/* Post/Page gallery images */
include_once(get_template_directory() . '/anps-framework/gallery_images.php');

function anps_scripts_and_styles() {
    wp_enqueue_style("font-awesome-4-5", "https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css");
    wp_enqueue_style("owl-css", get_template_directory_uri() . "/js/owl//assets/owl.carousel.css");

    //transitions
    $transition_style = 'transition-'. get_option( 'logo_transition_style', '5' ) . '.css';
    wp_enqueue_style("anps-transition", get_template_directory_uri()  . "/css/transitions/". $transition_style);

    global $is_IE;

    if ( $is_IE ) {
        wp_enqueue_style("anps-ie-fix", get_template_directory_uri() . '/css/ie-fix.css');
        wp_enqueue_script( "anps-iefix", get_template_directory_uri()  . "/js/ie-fix.js", '', '', true );
    }

    wp_register_script( "anps-isotope", get_template_directory_uri()  . "/js/jquery.isotope.min.js", '', '', true );


    wp_enqueue_script("anps-woo_quantity", get_template_directory_uri() . "/js/quantity_woo23.js",array("jquery"), "", true);
    wp_enqueue_script( "bootstrap", get_template_directory_uri()  . "/js/bootstrap/bootstrap.min.js", '', '', true );

    $google_maps_api = get_option('anps_google_maps', '');

    if( $google_maps_api != '' ) {
        $google_maps_api = '?key=' . $google_maps_api;
    }

    wp_register_script( "gmap3_link", "https://maps.google.com/maps/api/js" . $google_maps_api, '', '', true );
    wp_register_script( "gmap3", get_template_directory_uri()  . "/js/gmap3.min.js", array('jquery'), '', true );
    wp_register_script( "countto", get_template_directory_uri()  . "/js/countto.js", '', '', true );
    wp_enqueue_script( "waypoints", get_template_directory_uri()  . "/js/waypoints.js", '', '', true );
    wp_enqueue_script( "parallax", get_template_directory_uri()  . "/js/parallax.js", '', '', true );
    wp_enqueue_script( "anps-functions", get_template_directory_uri()  . "/js/functions.js", array('jquery'), '', true );
    wp_enqueue_script( "imagesloaded", get_template_directory_uri()  . "/js/imagesloaded.js", array('jquery'), '', true );
    wp_enqueue_script( "doubletap", get_template_directory_uri()  . "/js/doubletaptogo.js", array('jquery'), '', true );
    wp_enqueue_script("owl", get_template_directory_uri() . "/js/owl/owl.carousel.js",array("jquery"), "", true);

    if( is_plugin_active('responsive-lightbox/responsive-lightbox.php') ) {
        wp_deregister_style( "prettyphoto-css");
        wp_deregister_script( "prettyphoto");
        wp_deregister_style( "prettyPhoto-css");
        wp_deregister_script( "prettyPhoto");
    }
}
add_action( 'wp_enqueue_scripts', 'anps_scripts_and_styles' );



function anps_theme_styles() {
    global $anps_options_data;

    if (get_option('font_source_1', "Google fonts")=='Google fonts') {
        $font1_subset = get_option("font_type_1_subsets", array("latin", "latin-ext"));
        $font1_implode_subset = implode(",", $font1_subset);
        wp_enqueue_style( "anps-font_type_1",  'https://fonts.googleapis.com/css?family=' . get_option('font_type_1', 'Montserrat') . ':400italic,400,600,700,300&subset='.$font1_implode_subset);
    } else {
        wp_enqueue_style( "anps-font_type_1",  'https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700,300&subset=latin,latin-ext');
    }

    if (get_option('font_source_2', "Google fonts")=='Google fonts' && get_option('font_type_1', 'Montserrat')!=get_option('font_type_2', 'PT+Sans')) {
        $font2_subset = get_option("font_type_2_subsets", array("latin", "latin-ext"));
        $font2_implode_subset = implode(",", $font2_subset);
        wp_enqueue_style( "anps-font_type_2",  'https://fonts.googleapis.com/css?family=' . get_option('font_type_2', 'PT+Sans') . ':400italic,400,600,700,300&subset='.$font2_implode_subset);
    }

    if (get_option('font_source_navigation', "Google fonts")=='Google fonts' && get_option('font_type_1', 'Montserrat')!=get_option('font_type_navigation', "Montserrat")) {
        $font3_subset = get_option("font_type_navigation_subsets", array("latin", "latin-ext"));
        $font3_implode_subset = implode(",", $font3_subset);
        wp_enqueue_style( "anps-font_type_navigation",  'https://fonts.googleapis.com/css?family=' . get_option('font_type_navigation', 'Montserrat') . ':400italic,400,600,700,300&subset='.$font3_implode_subset);
    }

    if (get_option('anps_text_logo_source_1', "Google fonts")=='Google fonts' && get_option('font_type_1', 'Montserrat')!=get_option('anps_text_logo_font', 'Montserrat')) {
        wp_enqueue_style( "anps_text_logo_font",  'https://fonts.googleapis.com/css?family=' . get_option('anps_text_logo_font', '') . ':400italic,400,600,700,300');
    }

    wp_enqueue_style( "theme_main_style", get_bloginfo( 'stylesheet_url' ) );
    wp_enqueue_style( "anps_core", get_template_directory_uri() . "/css/core.css" );
    wp_enqueue_style( "theme_wordpress_style", get_template_directory_uri() . "/css/wordpress.css" );

    ob_start();
    anps_custom_styles();
    anps_custom_styles_buttons();
    $custom_css = ob_get_clean();

    $custom_css = trim(preg_replace('/\s+/', ' ', $custom_css));
    wp_add_inline_style( 'theme_wordpress_style', $custom_css );

    wp_enqueue_style( "anps-custom", get_template_directory_uri() . '/custom.css' );
    $responsive = "";
    if (isset($anps_options_data['responsive'])) {
        $responsive = $anps_options_data['responsive'];
    }
}

load_theme_textdomain( "hairdresser", get_template_directory() . '/languages' );

/* Admin only scripts */

function anps_load_custom_wp_admin_scripts($hook) {
    /* Overwrite VC styling */
    wp_enqueue_style( "anps-vc_custom", get_template_directory_uri() . '/css/vc_custom.css' );
    wp_enqueue_style("font-awesome-4-5", "https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css");
    wp_enqueue_style( "anps-wp-backend", get_template_directory_uri() . "/anps-framework/css/wp-backend.css" );

    ob_start();
    anps_custom_styles_buttons();
    $custom_css = ob_get_clean();

    wp_add_inline_style( 'anps-wp-backend', $custom_css );

    wp_enqueue_script('hideseek_js', get_template_directory_uri() . "/anps-framework/js/jquery.hideseek.min.js", array( 'jquery' ), false, true);
    wp_enqueue_script('anps-wp_backend_js', get_template_directory_uri() . "/anps-framework/js/wp_backend.js", array( 'jquery' ), false, true);


    wp_register_script('wp_colorpicker', get_template_directory_uri() . "/anps-framework/js/wp_colorpicker.js", array( 'wp-color-picker' ), false, true);
    if( 'appearance_page_theme_options' != $hook ) {
        return;
    }
    /* Theme Options Style */
    wp_enqueue_style( "anps-admin-style", get_template_directory_uri() . '/anps-framework/css/admin-style.css' );
    if(!isset($_GET['sub_page']) || $_GET['sub_page'] == "theme_style" || $_GET['sub_page'] == "options" || $_GET['sub_page'] == "options_page_setup") {
        wp_enqueue_style( "anps-colorpicker", get_template_directory_uri() . '/anps-framework/css/colorpicker.css' );
    }
    if (isset($_GET['sub_page']) && ($_GET['sub_page'] == "options" || $_GET['sub_page'] == "options_page")) {
        wp_enqueue_script( "anps-pattern", get_template_directory_uri() . "/anps-framework/js/pattern.js" );
    }
    if(!isset($_GET['sub_page']) || $_GET['sub_page'] == "theme_style" || $_GET['sub_page'] == "options" || $_GET['sub_page'] == "options_page_setup") {
        wp_enqueue_script( "anps-colorpicker_theme", get_template_directory_uri() . "/anps-framework/js/colorpicker.js" );
        wp_enqueue_script( "anps-colorpicker_custom", get_template_directory_uri() . "/anps-framework/js/colorpicker_custom.js" );
    }
    wp_enqueue_script( "anps-theme-options", get_template_directory_uri() . "/anps-framework/js/theme-options.js" );
}
add_action( 'admin_enqueue_scripts', 'anps_load_custom_wp_admin_scripts' );


/*************************/
/*WOOCOMMERCE*/
/*************************/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    add_theme_support( 'woocommerce' );
    include_once(get_template_directory() . '/anps-framework/woocommerce/functions.php');
    add_filter( 'woocommerce_enqueue_styles', '__return_false' );

    function anps_products_per_page() {
        return get_option('anps_products_per_page', '12');
    }
    add_filter( 'loop_shop_per_page', 'anps_products_per_page', 20 );


    function anps_loop_columns() {
        return get_option('anps_products_columns', '4');
    }
    add_filter('loop_shop_columns', 'anps_loop_columns');

    function anps_woocommerce_header() {
        global $woocommerce;

        global $anps_shop_data;

        if( isset($anps_shop_data['shop_hide_cart']) && $anps_shop_data['shop_hide_cart'] == "on" ) {
            return false;
        }

        ?>
        <div class="woo-header-cart">
            <a class="cart-contents" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" title="<?php esc_html_e('View your shopping cart', 'woothemes'); ?>">
                <span><?php echo esc_html($woocommerce->cart->cart_contents_count);?></span>
                <i class="fa fa-shopping-cart"></i>
            </a>
        </div>
        <?php
    }

    /* Load legacy files */
    function anps_wc_override_template_path(){
        return 'woocommerce-legacy/';
    }

    if( function_exists('WC') && WC()->version < '2.6.0' ) {
        add_filter( 'woocommerce_template_path', 'anps_wc_override_template_path' );
    }

    // Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
    add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

    function woocommerce_header_add_to_cart_fragment( $fragments ) {
        global $woocommerce;

        ob_start();

        ?>
        <a class="cart-contents" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" title="<?php esc_html_e('View your shopping cart', 'woothemes'); ?>">
            <span><?php echo esc_html($woocommerce->cart->cart_contents_count);?></span>
            <i class="fa fa-shopping-cart"></i>
        </a>
        <div class="mini-cart">
            <?php woocommerce_mini_cart(); ?>
        </div>
        <?php

        $fragments['a.cart-contents'] = ob_get_clean();

        return $fragments;
    }

    /* Support for WooCommerce */
    add_theme_support("woocommerce");

    define("WOOCOMMERCE_USE_CSS", false );


    function anps_myaccount_sidebar($page) { ?>

            <div class="col-md-3 sidebar">

                <ul class="myaccount-menu">
                    <li class="widget-container widget_nav_menu">
                        <div class="menu-main-menu-container">
                            <ul class="menu">
                                <li class="menu-item<?php if($page == "myaccount"){ echo " current-menu-item page_item current_page_item current_page_parent"; } ?>"><a href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); ?>"><?php esc_html_e("My Orders", 'hairdresser'); ?></a></li>
                                <?php if ( in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ): ?>
                                    <li class="menu-item<?php if($page == "wishlist"){ echo " current-menu-item page_item current_page_item current_page_parent"; } ?>"><a href="<?php echo get_permalink( get_option( 'yith_wcwl_wishlist_page_id' ) ); ?>"><?php esc_html_e("My Wishlist", 'hairdresser'); ?></a></li>
                                <?php endif; ?>
                                <li class="menu-item<?php if($page == "billing"){ echo " current-menu-item page_item current_page_item current_page_parent"; } ?>"><a href="<?php echo wc_get_endpoint_url( 'edit-address', 'billing' ); ?>"><?php esc_html_e("Edit Billing Address", 'hairdresser'); ?></a></li>
                                <li class="menu-item<?php if($page == "shipping"){ echo " current-menu-item page_item current_page_item current_page_parent"; } ?>"><a href="<?php echo wc_get_endpoint_url( 'edit-address', 'shipping' ); ?>"><?php esc_html_e("Edit Shipping Address", 'hairdresser'); ?></a></li>
                                <li class="menu-item<?php if($page == "change_account"){ echo " current-menu-item page_item current_page_item current_page_parent"; } ?>"><a href="<?php echo wc_customer_edit_account_url(); ?>"><?php esc_html_e("Change Account", 'hairdresser'); ?></a></li>
                                <?php
                                    if (is_user_logged_in()) {
                                        echo '<li><a href="'. wp_logout_url( get_permalink( woocommerce_get_page_id( 'myaccount' ) ) ) .'">' . esc_html__("Logout", 'hairdresser') . '</a></li>';
                                    }
                                ?>
                            </ul>
                        </div>
                    </li>
                </ul>

            </div>
        <?php
    }

    add_filter( 'woocommerce_output_related_products_args', 'anps_jk_related_products_args' );
    function anps_jk_related_products_args( $args ) {
        global $anps_shop_data;
        if(!isset($anps_shop_data['shop_related_per_page'])||$anps_shop_data['shop_related_per_page']=="") {
            $per_page = 3;
        } else {
            $per_page = $anps_shop_data['shop_related_per_page'];
        }
        $args['posts_per_page'] = $per_page;
        return $args;
    }
}
/*************************/
/*END WOOCOMMERCE*/
/*************************/
/*chrome admin menu fix*/
function anps_chromefix_inline_css()
{
    wp_add_inline_style( 'wp-admin', '#adminmenu { transform: translateZ(0); }' );
}
add_action('admin_enqueue_scripts', 'anps_chromefix_inline_css');

/* Set Revolution Slider as Theme */
if(function_exists( 'set_revslider_as_theme' )){
    add_action( 'init', 'anps_set_rev_as_theme' );
    function anps_set_rev_as_theme() {
        set_revslider_as_theme();
    }
}

/* Change comment form position (WordPress 4.4) */
function anps_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'anps_comment_field_to_bottom' );

/* WooCommerce 2.5 remove link around products */
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
