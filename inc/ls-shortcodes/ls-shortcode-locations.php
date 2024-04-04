<?php

/**
 * Display Locations in a card format
 */
function ls_shortcode_locations()
{
    ob_start();

    $args = array(
        'post_type'      => 'locations',
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
            $ls_location_title             = get_the_title();
            $ls_location_post_link         = get_the_permalink();

            $shortcodes .= '[col_inner span="4" span__sm="12" span__md="6" margin="0px 0px 50px 0px" margin__sm="0px 0px 30px 0px" margin__md="0px 0px 40px 0px" bg_color="rgb(255,255,255)" class="special-clickable-card attraction-card"]';
            $shortcodes .= '[ux_html]';
            $shortcodes .= '<a class="clickable-card-link" href="' . $ls_location_post_link . '"></a>';
            $shortcodes .= '[/ux_html]';
            $shortcodes .= '[ux_image id="2137" height="75%" class="mb-0"]';
            $shortcodes .= '[row_inner_1]';
            $shortcodes .= '[col_inner_1 span__sm="12" padding="30px 30px 0px 30px" align="center"]';
            $shortcodes .= '[ux_text font_size="1.4"]';
            $shortcodes .= '<h4>' . $ls_location_title . '</h4>';
            $shortcodes .= '[/ux_text]';
            $shortcodes .= '[ux_text font_size="0.9"]';
            $shortcodes .= '<p>lorem ipsum dolor sit amet</p>';
            $shortcodes .= '[/ux_text]';
            $shortcodes .= '[/col_inner_1]';
            $shortcodes .= '[/row_inner_1]';
            $shortcodes .= '[button text="View Location" color="alert" style="outline" padding="5px 30px 5px 30px" expand="0" icon="icon-angle-right" class="attraction-button"]';
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

add_shortcode('ls_locations', 'ls_shortcode_locations');