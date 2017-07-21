<?php
class AnpsOpeningTime extends WP_Widget {
    public function __construct() {
        parent::__construct('AnpsOpeningTime', 'AnpsThemes - Opening time', array('description' => esc_html__('Enter opening time.', 'hairdresser')));
    }
    function form($instance) {
        $instance = wp_parse_args((array) $instance, array(
            'title' => '',
            'day_1'=>'',
            'day_2'=>'',
            'day_3'=>'',
            'day_4'=>'',
            'day_5'=>'',
            'day_6'=>'',
            'day_7'=>'',
            'opening_time_1'=>'',
            'opening_time_2'=>'',
            'opening_time_3'=>'',
            'opening_time_4'=>'',
            'opening_time_5'=>'',
            'opening_time_6'=>'',
            'opening_time_7'=>'',
            'exposed_1'=>'',
            'exposed_2'=>'',
            'exposed_3'=>'',
            'exposed_4'=>'',
            'exposed_5'=>'',
            'exposed_6'=>'',
            'exposed_7'=>'',
        ));
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e("Title", 'hairdresser'); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" class="widefat" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>
    <?php for($i=1;$i<8;$i++) : ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('day_'.$i)); ?>"><?php echo esc_html__('Day', 'hairdresser')." $i"; ?></label>
                <input id="<?php echo esc_attr($this->get_field_id('day_'.$i)); ?>" name="<?php echo esc_attr($this->get_field_name('day_'.$i)); ?>" type="text" class="widefat" value="<?php echo esc_attr($instance['day_'.$i]); ?>" />
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('opening_time_'.$i)); ?>"><?php echo esc_html__('Opening time Day', 'hairdresser')." $i"; ?></label>
                <input id="<?php echo esc_attr($this->get_field_id('opening_time_'.$i)); ?>" name="<?php echo esc_attr($this->get_field_name('opening_time_'.$i)); ?>" type="text" class="widefat" value="<?php echo esc_attr($instance['opening_time_'.$i]); ?>" />
            </p>
            <?php 
            $checked = '';
            if($instance['exposed_'.$i]=="on") {
                $checked = "checked";
            }
            ?>
            <p>               
                <input id="<?php echo esc_attr($this->get_field_id('exposed_'.$i)); ?>" name="<?php echo esc_attr($this->get_field_name('exposed_'.$i)); ?>" type="checkbox" <?php echo esc_attr($checked); ?>/>
                <label for="<?php echo esc_attr($this->get_field_id('exposed_'.$i)); ?>"><?php echo esc_html__('Exposed Day', 'hairdresser')." $i"; ?></label>
            </p>
    <?php endfor;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        for($i=1; $i<8; $i++) {
            $instance['day_'.$i] = $new_instance['day_'.$i];
            $instance['opening_time_'.$i] = $new_instance['opening_time_'.$i];
            $instance['exposed_'.$i] = $new_instance['exposed_'.$i];
        }
        return $instance;
    }
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        echo $before_widget;
        if(isset($instance['title'])&&$instance['title']!="") : ?>
        <div class="opening-time">
            <h3 class="widget-title"><?php echo esc_html($instance['title']); ?></h3>     
            <ul>
                <?php for($i=1;$i<8;$i++) : ?>
                <?php if(isset($instance['day_'.$i]) && $instance['day_'.$i]!="") : ?>
                <li class="opening-time-item<?php if(isset($instance['exposed_'.$i]) && $instance['exposed_'.$i]!=""){ echo " highlited";}?>">
                    <strong><?php echo esc_html($instance['day_'.$i]); ?></strong>
                    <?php if(isset($instance['opening_time_'.$i]) && $instance['opening_time_'.$i]!="") : ?>
                    <?php echo esc_html($instance['opening_time_'.$i]); ?>
                    <?php endif; ?>
                </li>
                <?php endif; ?>
                <?php endfor; ?>
            </ul>
        </div>
        <?php endif;
        echo $after_widget;
    }
}
add_action('widgets_init', create_function('', 'return register_widget("AnpsOpeningTime");'));