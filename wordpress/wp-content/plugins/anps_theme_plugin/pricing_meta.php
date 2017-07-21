<?php
add_action('add_meta_boxes', 'anps_pricing_content_add_custom_box');
add_action('save_post', 'anps_pricing_content_save_postdata');
function anps_pricing_content_add_custom_box() {
    $screens = array('anps_pricing');
    foreach ($screens as $screen) {
        add_meta_box('anps_pricing_price_meta', __('Price', "Anps_menu"), 'display_pricing_price_meta_box_content', $screen, 'normal', 'high');
    }
}

function display_pricing_price_meta_box_content($post) {
    $value2 = get_post_meta($post -> ID, $key = 'anps_pricing_price', $single = true);
    echo "<input type='text' name='anps_pricing_price' value='$value2' style='width: 350px' />";
}

function anps_pricing_content_save_postdata($post_id) { 
    if(get_post_type($post_id)=="anps_pricing") {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE || defined('DOING_AJAX') && DOING_AJAX) {
            return;
        }
        if (empty($_POST)) {
            return;
        }
        if(!isset($_POST['post_ID'])) {
            if(!$post_id) {
                return;
            } else {
                $_POST['post_ID'] = $post_id;
            }
        }
        if(!isset($_POST['post_type'])) {
            return;
        }
        // Check permissions
        if ('anps_pricing' == $_POST['post_type']) { 
            if (!current_user_can('edit_page', $post_id))
                return;
        }
        else {
            if (!current_user_can('edit_post', $post_id))
                return;
        }
        $post_ID = $_POST['post_ID'];

        if (!isset($_POST['anps_pricing_price'])) {
            $_POST['anps_pricing_price'] = '';
        }

        $mydata_price = $_POST['anps_pricing_price'];
        add_post_meta($post_ID, 'anps_pricing_price', $mydata_price, true) or update_post_meta($post_ID, 'anps_pricing_price', $mydata_price);
    } else {
        return;
    }
}
