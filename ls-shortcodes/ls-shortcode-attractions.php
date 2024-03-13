<?php
/**
 * Display Attractions in a card format
 */
function ls_shortcode_attractions()
{
    ob_start();

    $args = array(
        'post_type'      => 'attractions',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {

        // Counter to keep track of number of posts
        $counter = 0;

        // Opening row shortcode
        $shortcodes = '[row width="custom" custom_width="95%" v_align="equal"]';

        while ( $query->have_posts() ) {

            $query->the_post();

            // Increment once for each post
            $counter++;

            // Declare variables
            $ls_attraction_title             = get_the_title();
            $ls_attraction_title             = preg_replace( '/\s+/', '<br>', $ls_attraction_title );
            $ls_attraction_featured_image    = get_the_post_thumbnail_url();
            $ls_attraction_short_description = get_field( 'ls_attraction_short_description' );
            $ls_attraction_learn_more_link   = get_field( 'ls_learn_more_button_link' );

            // Determine animation based on counter. 1-4 fadeInLeft, 5-8 fadeInRight
            $ls_attraction_animation_class = ( ( ($counter - 1 ) % 8 ) < 4 ) ? "fadeInLeft" : "fadeInRight";

            // Attractions card shortcode 
            $shortcodes .= '[col span="3" span__sm="12" span__md="6" bg_radius="12" animate="' . $ls_attraction_animation_class .  '" depth_hover="3" class="show-radius gradient-blue-col"]';
            $shortcodes .= '[ux_banner height="300px" bg="' . $ls_attraction_featured_image . '" bg_color="rgba(255, 255, 255, 0)" bg_overlay="rgba(0, 0, 0, 0.4)" hover="zoom"]';
            $shortcodes .= '[text_box position_x="50" position_y="50"]';
            $shortcodes .= '[/text_box]';
            $shortcodes .= '[/ux_banner]';
            $shortcodes .= '[row_inner h_align="center"]';
            $shortcodes .= '[col_inner span="8" span__sm="12" margin="-150px 0px 0px 0px"]';
            $shortcodes .= '[ux_banner height="250px" bg="517" bg_color="rgba(255, 255, 255, 0)"]';
            $shortcodes .= '[text_box width="100" position_x="50" position_y="75"]';
            $shortcodes .= '[ux_text font_size="1.3"]';
            $shortcodes .= '<h3 class="text-yellow"><strong>' . $ls_attraction_title . '</strong></h3>';
            $shortcodes .= '[/ux_text]';
            $shortcodes .= '[/text_box]';
            $shortcodes .= '[/ux_banner]';
            $shortcodes .= '[/col_inner]';
            $shortcodes .= '[col_inner span="10" span__sm="12" margin="-29px 0px 0px 0px" align="center" color="light"]';
            $shortcodes .= '<p>' . $ls_attraction_short_description . '</p>';
            $shortcodes .= '[button text="Learn More" style="link" size="large" class="text-yellow" link="' . $ls_attraction_learn_more_link . '"]';
            $shortcodes .= '[/col_inner]';
            $shortcodes .= '[/row_inner]';
            $shortcodes .= '[/col]';

            // After every 4th post, close the current row and start a new one or else the animation will be off
            if ( $counter % 4 == 0 && $query->current_post + 1 < $query->post_count ) {
                // Close the current row and start a new one
                $shortcodes .= '[/row][row width="custom" custom_width="95%" v_align="equal"]';
            }
        }

        // Close off last row
        $shortcodes .= '[/row]';

        // Output the shortcodes
        echo do_shortcode( $shortcodes );

        // Clean up
        wp_reset_postdata();
    }

    return ob_get_clean();
}

add_shortcode('ls_attractions', 'ls_shortcode_attractions');
