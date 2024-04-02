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

        // Opening row shortcode
        $shortcodes = '';
        $shortcodes .= '[row h_align="center"]';
        $shortcodes .= '[col span__sm="12" span__md="10"]';
        $shortcodes .= '[row_inner col_bg_radius="3" v_align="equal" padding="0px 0px 0px 0px" class="align-buttons"]';

        while ($query->have_posts()) {

            $query->the_post();

            // Declare variables
            $ls_attraction_title             = get_the_title();
            //$ls_attraction_title             = preg_replace('/\s+/', '<br>', $ls_attraction_title);
            $ls_attraction_featured_image    = get_the_post_thumbnail_url();
            $ls_attraction_short_description = get_field('ls_attraction_short_description');
            $ls_attraction_learn_more_link   = get_field('ls_learn_more_button_link');
            $ls_attraction_post_link         = get_the_permalink();

            $shortcodes .= '[col_inner span="4" span__sm="12" span__md="6" margin="0px 0px 50px 0px" margin__sm="0px 0px 30px 0px" margin__md="0px 0px 40px 0px" bg_color="rgb(255,255,255)" class="special-clickable-card attraction-card"]';
            $shortcodes .= '[ux_html]';
            $shortcodes .= '<a class="clickable-card-link" href="' . $ls_attraction_post_link . '"></a>';
            $shortcodes .= '[/ux_html]';
            $shortcodes .= '[ux_image id="' . $ls_attraction_featured_image . '" height="75%" class="mb-0"]';
            $shortcodes .= '[row_inner_1]';
            $shortcodes .= '[col_inner_1 span__sm="12" padding="30px 30px 0px 30px" align="center"]';
            $shortcodes .= '[ux_text font_size="1.4"]';
            $shortcodes .= '<h4>' . $ls_attraction_title . '</h4>';
            $shortcodes .= '[/ux_text]';
            $shortcodes .= '[ux_text font_size="0.9"]';
            $shortcodes .= '<p>' . $ls_attraction_short_description . '</p>';
            $shortcodes .= '[/ux_text]';
            $shortcodes .= '[/col_inner_1]';
            $shortcodes .= '[/row_inner_1]';
            $shortcodes .= '[button text="Learn More" color="alert" style="outline" padding="5px 30px 5px 30px" expand="0" icon="icon-angle-right" class="attraction-button"]';
            $shortcodes .= '[/col_inner]';
        }

        // Close off opening shortcodes
        $shortcodes .= '[/row_inner]';
        $shortcodes .= '[/col]';
        $shortcodes .= '[/row]';


        // Output the shortcodes
        echo do_shortcode($shortcodes);

        // Clean up
        wp_reset_postdata();
    }

    return ob_get_clean();
}

add_shortcode('ls_attractions', 'ls_shortcode_attractions');
