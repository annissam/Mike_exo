<?php
class AnpsPricing {
    public function __construct() {
        $this->register_post_type();
        register_taxonomy('anps_pricing_category', 'anps_pricing', array('hierarchical' => true, 'label' => 'Categories', 'query_var' => true, 'rewrite' => true));             
        add_action("manage_anps_pricing_posts_custom_column", array("AnpsPricing", "pricing_custom_columns"));
        add_filter("manage_edit-anps_pricing_columns", array("AnpsPricing","pricing_edit_columns"));
    }        
    
    public function pricing_edit_columns() {
        $columns = array(
                    "cb" => "<input type='checkbox' />",
                    "title" => __("Title"),
                    "anps_pricing_category" => __("Categories"),
                    "anps_pricing_price" => __("Price"),
                    "date" => __("Date")
                   );
        return $columns;
    }
        
    public static function pricing_custom_columns($column) {
        global $post; 
        switch ($column){
            case "anps_pricing_category":
                echo get_the_term_list($post->ID, 'anps_pricing_category', '', ', ','');
            break;
            case "anps_pricing_price":
                echo get_post_meta( $post->ID, $key = 'anps_pricing_price', $single = true );
            break;
        }
    }
    
    private function register_post_type() {
        $args = array(
          'labels' => array(
              'name' =>'Pricing',
              'singular_name' => 'Pricing',
              'add_new' => 'Add new',
              'add_new_item' => 'Add new item',
              'edit_item' => 'Edit item',
              'new_item' => 'New item',
              'view_item' => 'View pricing',
              'search_items' => 'Search pricing',
              'not_found' => 'No pricing item found'
          ),
            'query_var' => 'pricing',
            'rewrite' => array(
                'slug' => 'pricing'
            ),
            'public' => true,
            'supports' => array(
                            'title',
                            'editor',
                            'categories'
            )
        );       
       register_post_type('anps_pricing', $args);
    }
}
add_action('init', 'anps_pricing');
function anps_pricing() {
    new AnpsPricing();
}
include_once "pricing_meta.php";