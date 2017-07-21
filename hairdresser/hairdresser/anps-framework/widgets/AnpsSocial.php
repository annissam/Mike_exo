<?php
class AnpsSocial extends WP_Widget {
    public function __construct() {
        parent::__construct(
                'AnpsSocial', 'AnpsThemes - Social icons', array('description' => __('Enter social icons to show on page', 'constructo'),)
        );
    }
    function form($instance) {
        $instance = wp_parse_args((array) $instance, array(
            'title' => '',
            'sidebar_content' => '',
            'icon_0' => '', 
            'icon_1' => '', 
            'icon_2' => '', 
            'icon_3' => '', 
            'icon_4' => '', 
            'icon_5' => '', 
            'icon_6' => '', 
            'icon_7' => '', 
            'icon_8' => '', 
            'icon_9' => '', 
            'icon_10' => '', 
            'icon_11' => '', 
            'url_0'=>'',
            'url_1'=>'',
            'url_2'=>'',
            'url_3'=>'',
            'url_4'=>'',
            'url_5'=>'',
            'url_6'=>'',
            'url_7'=>'',
            'url_8'=>'',
            'url_9'=>'',
            'url_10'=>'',
            'url_11'=>'',
            'target'=>''
        ));
        $icon_array = array();
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e("Title", 'constructo'); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" class="widefat" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>
        <?php 
        $checked = '';
        if($instance['sidebar_content']=="on") {
            $checked = "checked";
        }
        ?>
        <p>
            <input id="<?php echo esc_attr($this->get_field_id('sidebar_content')); ?>" name="<?php echo esc_attr($this->get_field_name('sidebar_content')); ?>" type="checkbox" <?php echo esc_attr($checked); ?> />
            <label for="<?php echo esc_attr($this->get_field_id('sidebar_content')); ?>"><?php _e("Sidebar content", 'constructo'); ?></label>
        </p>
        <?php for($i=0; $i<12; $i++) : ?>
        <p>

            <?php $anps_select_id_social = $this->get_field_id('icon_'.$i);?>
            <div class="anps-iconpicker">
                <i class="fa <?php echo esc_attr($instance['icon_'.$i]); ?>"></i>
                <input type="text" value="<?php echo esc_attr($instance['icon_'.$i]); ?>" id="<?php echo esc_attr($this->get_field_id('icon_'.$i)); ?>" name="<?php echo esc_attr($this->get_field_name('icon_'.$i)); ?>">
                <button type="button"><?php _e('Select icon', 'constructo'); ?></button>
            </div>
        </p>
        <p>
            <input id="<?php echo esc_attr($this->get_field_id('url_'.$i)); ?>" name="<?php echo esc_attr($this->get_field_name('url_'.$i)); ?>" type="text" class="widefat" value="<?php echo esc_attr($instance['url_'.$i]); ?>" />
        </p>
        <?php endfor; ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('target')); ?>"><?php _e("Target", 'constructo'); ?></label>
            <?php $target_array = array("_self", "_blank", "_parent", "_top");?>
            <select id="<?php echo esc_attr($this->get_field_id('target')); ?>" name="<?php echo esc_attr($this->get_field_name('target')); ?>">
                <?php foreach($target_array as $key=>$item) : ?>
                <option <?php if ($key == $instance['target']) {
                        echo 'selected="selected"';
                    } ?> value="<?php echo esc_attr($key); ?>"><?php echo esc_html($item); ?></option>
                <?php endforeach; ?>
            </select>
        </p>

        <?php
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        for($i=0; $i<12; $i++) {
            $instance['icon_'.$i] = $new_instance['icon_'.$i];
            $instance['url_'.$i] = $new_instance['url_'.$i];
        }
        $instance['title'] = $new_instance['title'];
        $instance['target'] = $new_instance['target'];
        $instance['sidebar_content'] = $new_instance['sidebar_content'];
        return $instance;
    }
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $icon = "";
        if( isset($instance['icon']) ) {
            $icon = $instance['icon'];
        }
        $url = '';
        if( isset($instance['url']) ) {
            $url = $instance['url'];
        }
        $title = '';
        if( isset($instance['title']) ) {
            $title = $instance['title'];
        }
        $sidebar_content = '';
        if( isset($instance['sidebar_content']) ) {
            $sidebar_content = $instance['sidebar_content'];
        }
        if($sidebar_content=="on") {
            $class = "social";
        } else {
            $class = "socialize";
        }
        $target = "";
        if(isset($instance['target'] )) {
            $instance['target'] = $instance['target'] ;
        } else {
            $instance['target'] = "";
        }
        switch($instance['target']) {
            case 0 :
                $target = "_self";
                break;
            case 1 :
                $target = "_blank";
                break;
            case 2 :
                $target = "_parent";
                break;
            case 3 :
                $target = "_top";
                break;
            default :
                $target = "_self";
        }
        echo $before_widget;
        ?>
        <?php if($title) : ?>
        <h3 class="widget-title"><?php echo esc_html($title); ?></h3>
        <?php endif; ?>
        <ul class="<?php echo esc_attr($class); ?>">
            <?php for($i=0; $i<12; $i++) : 
                if(isset($instance['icon_'.$i]) && $instance['icon_'.$i]!="") : ?>
            <li>
                <?php if($instance['url_'.$i]!="") : ?>
                <a class="fa <?php echo trim(esc_attr($instance['icon_'.$i])); ?>" href="<?php echo esc_url($instance['url_'.$i]); ?>" target="<?php echo esc_attr($target); ?>"></a>
                <?php else : ?>
                <span class="fa <?php echo trim(esc_attr($instance['icon_'.$i])); ?>"></span>
                <?php endif; ?>
            </li>
            <?php endif; ?>
            <?php endfor; ?>
        </ul>
        <?php
        echo $after_widget;
    }
}
add_action( 'widgets_init', create_function('', 'return register_widget("AnpsSocial");') );