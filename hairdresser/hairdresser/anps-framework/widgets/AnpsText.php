<?php

class AnpsText extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'AnpsText', 'AnpsThemes - Text and icon', array('description' => __('Enter text and/or icon to show on page. Can only be used in the Top bar widget areas.', 'constructo'),)
        );
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, array('icon' => '', 'text'=>''));

        $allowed_html = array(
            'a' => array(
                'href' => array(),
                'title' => array()
            ),
            'br' => array(),
            'em' => array(),
            'strong' => array(),
        );

        $icon = $instance['icon'];
        $text = htmlentities($instance['text']);
        ?>
        <p>
            <div class="anps-iconpicker">
                <i class="fa <?php echo esc_attr($icon); ?>"></i>
                <input type="text" value="<?php echo esc_attr($icon); ?>" id="<?php echo esc_attr($this->get_field_id('icon')); ?>" name="<?php echo esc_attr($this->get_field_name('icon')); ?>">
                <button type="button"><?php _e('Select icon', 'constructo'); ?></button>
            </div>
        </p>
        <p>
            <input id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>" type="text" class="widefat" value="<?php echo wp_kses($text, $allowed_html); ?>" />
        </p>
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['icon'] = $new_instance['icon'];
        $instance['text'] = $new_instance['text'];
        return $instance;
    }

    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $icon = $instance['icon'];
        $text = $instance['text'];
        echo $before_widget;

        $allowed_html = array(
            'a' => array(
                'href' => array(),
                'title' => array()
            ),
            'br' => array(),
            'em' => array(),
            'strong' => array(),
            'span' => array(
                'style' => array(),
                'class' => array()
            )
        );

        ?>

        <span class="fa <?php echo esc_attr($icon);?>"></span>
        <?php echo wp_kses($text, $allowed_html); ?>
        <?php
        echo $after_widget;
    }

}

add_action( 'widgets_init', create_function('', 'return register_widget("AnpsText");') );