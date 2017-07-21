<?php

global $anps_page_data, $row_inner, $anps_options_data;
$meta = get_post_meta(get_the_ID());
$num_of_sidebars = 0;

/* Left Sidebar */

$left_sidebar = get_option('page_sidebar_left');

if( isset($meta['sbg_selected_sidebar']) && $meta['sbg_selected_sidebar'][0] != "0" ) {
    if( $meta['sbg_selected_sidebar'][0] == "-1" ) {
        $left_sidebar = false;
    } else {
        $left_sidebar = $meta['sbg_selected_sidebar'][0];
    }
}

if ( $left_sidebar ) {
    $num_of_sidebars++;
}

/* Right Sidebar */

$right_sidebar = get_option('page_sidebar_right');

if (isset($meta['sbg_selected_sidebar_replacement']) && $meta['sbg_selected_sidebar_replacement'][0] != "0") {
    if( $meta['sbg_selected_sidebar_replacement'][0] == "-1" ) {
        $right_sidebar = false;
    } else {
        $right_sidebar = $meta['sbg_selected_sidebar_replacement'][0];
    }
}

if( $right_sidebar ) {
    $num_of_sidebars++;
}
$anps_show_comments = "1";
if (isset($anps_options_data['anps_pagecomments']) && ($anps_options_data['anps_pagecomments']=='on')) {
    $anps_show_comments ="0";
}


/* Classes */

$anps_row_class = "normal";
if ($num_of_sidebars != '0') {
    $anps_row_class = "row";
}

?>
<section class="container content-container">
    <div class="<?php echo esc_attr($anps_row_class);?>">

        <?php
            while (have_posts()) : the_post();
                if( ! strpos('pre' . get_the_content(), 'vc_row') ) {
                    echo '<div class="row">';
                }

                if ($left_sidebar != "0" && $left_sidebar != "-1" && $left_sidebar): ?>
                    <aside class="sidebar col-md-<?php if($num_of_sidebars == 1) { echo "3"; } else if($num_of_sidebars == 2) { echo "3"; } ?>">
                        <ul>
                            <?php dynamic_sidebar($left_sidebar);?>
                        </ul>
                    </aside>
                <?php endif; ?>

                <?php if($num_of_sidebars == 0 && strpos('pre' . get_the_content(), 'vc_row')): ?>
                    <?php the_content(); ?>

                    <?php if (('open' == $post->comment_status) && ($anps_show_comments== "1")) :?>
                            <section class="comments">
                                <?php  comments_template();?>
                            </section>
                    <?php endif; ?>
                <?php else: ?>
                    <div class='col-md-<?php echo 12-esc_attr($num_of_sidebars)*3; ?>'>
                        <?php the_content(); ?>
                        
                        <?php if (('open' == $post->comment_status) && ($anps_show_comments== "1")) :?>
                                <section class="comments">
                                    <?php  comments_template();?>
                                </section>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php if ($right_sidebar != "0" && $right_sidebar != "-1" && $right_sidebar): ?>
                    <aside class="sidebar col-md-<?php if($num_of_sidebars == 1) { echo "3"; } else if($num_of_sidebars == 2) { echo "3"; } ?>">
                        <ul>
                            <?php dynamic_sidebar($right_sidebar); ?>
                        </ul>
                    </aside>
                <?php endif;

                if( ! strpos('pre' . get_the_content(), 'vc_row') ) {
                    echo '</div>';
                }
            endwhile; // end of the loop. ?>
    </div>
</section>
