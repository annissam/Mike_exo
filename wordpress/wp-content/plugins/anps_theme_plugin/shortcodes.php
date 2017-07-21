<?php
add_shortcode("anps_pricing", "anps_pricing_func");
/* Pricing shortcode */
function anps_pricing_func($atts, $content) {
    extract( shortcode_atts( array(
            'orderby' => 'title',
            'order' => 'ASC',
            'category_ids' => '',
            'category_orderby' => 'title',
            'category_order' => 'ASC',
            'in_row' => 2,
        ), $atts ) );
    $bootstrap_class = "col-md-".( 12 / $in_row);
    $tab_content_class = "";
    $menu_data = "";

    $menu_data .= "<ul class='nav nav-tabs pricing-nav-tabs'>";

    $filters = get_terms('anps_pricing_category', array('hide_empty' => true, 'orderby'=>$category_orderby, 'order'=>$category_order));
    $i=1;
    foreach ($filters as $item) {
        if(strpos($category_ids, strval($item->term_id)) === false && $category_ids !== '') { continue; }
        $class="";
        if($i=="1") {
            $class = " class='active'";
        }
        $menu_data .= '<li'.$class.'><a href="#'.$item->slug.'" data-toggle="tab">' . $item->name . '</a></li>';
        $i++;
    }
    $menu_data .= "</ul>";
    $menu_data .= "<div class='pricing-tab-content tab-content$tab_content_class'>";
    $i=1;
    foreach ($filters as $item) {
        if(strpos($category_ids, strval($item->term_id)) === false && $category_ids !== '') { continue; }

        $class="";
        if($i=="1") {
            $class = " active";
        }
        $menu_data .= '<div id="'.$item->slug.'" class="row tab-pane'.$class.'">';
        $args = array(
        'post_type' => 'anps_pricing',
        'orderby' => $orderby,
        'order' => $order,
        'showposts' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'anps_pricing_category',
                'field' => 'id',
                'terms' => $item->term_id
            )
        )
        );
        $menu_posts = new WP_Query( $args );
        while($menu_posts->have_posts()) {
            $menu_posts->the_post();
            $menu_data .= "<div class='pricing-item $bootstrap_class'>";
            $menu_data .= '<div class="pricing-item-header">';
            $menu_data .= "<h3 class='pricing-item-title'>".get_the_title()."</h3>";
            $menu_data .= '<span class="pricing-item-divider"></span>';
            $menu_data .= '<span class="pricing-item-price">' . get_post_meta(get_the_ID(), $key = 'anps_pricing_price', $single = true) . '</span>';
            $menu_data .= '</div>';
            ob_start();
            the_content();
            $menu_data .= ob_get_clean();
            $menu_data .= "</div>";
        }
        $menu_data .= "</div>";
        $i++;
    }
    wp_reset_postdata();
    $menu_data .= "</div>";
    return $menu_data;
}
/* END Pricing shortcode */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'js_composer/js_composer.php' )) {
    add_action( 'init', 'anps_pricing_vc_map' );
    /* VC Pricing shortcode */
    function anps_pricing_vc_map() {
        vc_map( array(
            "name" => __("Pricing", 'hairdresser'),
            "base" => "anps_pricing",
            "class" => "",
            //"icon" => get_template_directory_uri()."/images/visual-composer/anpsicon_restaurantmenu.png",
            "category" => 'hairdresser',
            "params" => array(
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Items in row", 'hairdresser'),
                    "param_name" => "in_row",
                    "value" => array(1,2,3),
                    "save_always" => true
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Items Order By", 'hairdresser'),
                    "param_name" => "orderby",
                    "value" => array(__("Default", 'hairdresser')=>'', __("Date", 'hairdresser')=>'date', __("Id", 'hairdresser')=>'ID', __("Title", 'hairdresser')=>'title', __("Name", 'hairdresser')=>'name', __("Menu order", 'hairdresser')=>'menu_order'),
                    "save_always" => true
                ),

                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Items Order", 'hairdresser'),
                    "param_name" => "order",
                    "value" => array(__("ASC", 'hairdresser')=>'ASC', __("DESC", 'hairdresser')=>'DESC'),
                    "save_always" => true
                ),
                array(
                 "type" => "textfield",
                 "holder" => "div",
                 "heading" => esc_html__("Category IDs", 'hairdresser'),
                 "param_name" => "category_ids",
                 "description" => esc_html__("Filter posts by category IDs (eg. 145, 156).", 'hairdresser')
               ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Categories Order By", 'hairdresser'),
                    "param_name" => "category_orderby",
                    "value" => array(__("Default", 'hairdresser')=>'', __("Date", 'hairdresser')=>'date', __("Id", 'hairdresser')=>'ID', __("Title", 'hairdresser')=>'title', __("Name", 'hairdresser')=>'name'),
                    "save_always" => true
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Categories Order", 'hairdresser'),
                    "param_name" => "category_order",
                    "value" => array(__("ASC", 'hairdresser')=>'ASC', __("DESC", 'hairdresser')=>'DESC'),
                    "save_always" => true
                )
            )
         ));
    }
}
