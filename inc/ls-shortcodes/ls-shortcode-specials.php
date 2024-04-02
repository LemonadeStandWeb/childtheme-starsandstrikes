<?php

function ls_shortcode_specials()
{

    ob_start();

    /**
     * Weekday-to-CSS-Class Map
     * 
     * Associative array to map the days of the week to a CSS class for the specials cards.
     */
    $ls_css_class_map = array(
        'sunday'    => 'red-card',
        'monday'    => 'maroon-card',
        'tuesday'   => 'purple-card',
        'wednesday' => 'dark-blue-card',
        'friday'    => 'blue-card',
        'saturday'  => 'orange-card',
        'everyday'  => 'gradient-card'
    );

    $shortcodes = '';

    $ls_shortcode_specials_args = array(
        'post_type'      => 'specials',
        'posts_per_page' => -1,
    );

    $ls_shortcode_specials_query = new WP_Query($ls_shortcode_specials_args);

    if ($ls_shortcode_specials_query->have_posts()) {

        $shortcodes .= '[row_inner v_align="equal"]';

        while ($ls_shortcode_specials_query->have_posts()) {

            $ls_shortcode_specials_query->the_post();

            // Fetch special details
            $ls_special_image = get_the_post_thumbnail_url();
            $ls_special_link = get_the_permalink();
            $ls_specials_what_day = get_field('ls_specials_what_day');
            $ls_specials_title = get_field('ls_specials_title');
            $ls_specials_short_description = get_field('ls_specials_short_description');

            // Build the promotion shortcode
            $shortcodes .= '[col_inner span="4" span__sm="12" span__md="12" bg_color="rgb(255,255,255)" animate="fadeInUp" class="special-clickable-card ' . $ls_css_class_map[$ls_specials_what_day] . '"]';
            $shortcodes .= '[ux_html]';
            $shortcodes .= '<div class="special-box">' . $ls_specials_what_day . ' Deal</div>';
            $shortcodes .= '<a href="' . $ls_special_link . '" class="clickable-card-link"></a>';
            $shortcodes .= '[/ux_html]';

            // Fetch the featured image and display if available
            if ($ls_special_image) {
                $shortcodes .= '[ux_image id="' . $ls_special_image . '" height="67%"]';
            }

            $shortcodes .= '[row_inner_1]';
            $shortcodes .= '[col_inner_1 span__sm="12" padding="30px 30px 0px 30px"]';
            $shortcodes .= '<h4>' . $ls_specials_title . '</h4>';
            $shortcodes .= '<p>' . $ls_specials_short_description . '</p>';
            $shortcodes .= '[button text="Learn More" color="alert" style="link" expand="0" icon="icon-angle-right"]';
            $shortcodes .= '[/col_inner_1]';
            $shortcodes .= '[/row_inner_1]';
            $shortcodes .= '[/col_inner]';
        }

        $shortcodes .= '[/row_inner]';

    } else {
        // Display a message if no specials are found
        $shortcodes .= '<p>No specials available at this time. Please call us for upcoming specials!</p>';
    }

    echo do_shortcode($shortcodes);

    wp_reset_postdata();

    return ob_get_clean();
}

add_shortcode('ls_specials', 'ls_shortcode_specials');
