<?php

function ls_shortcode_promotions()
{

    ob_start();

    /**
     * Weekday-to-CSS-Class Map
     * 
     * Associative array to map the days of the week to a CSS class for the specials cards.
     */
    $ls_css_class_map = array(
        'red'       => 'red-card',
        'maroon'    => 'maroon-card',
        'purple'    => 'purple-card',
        'dark-blue' => 'dark-blue-card',
        'blue'      => 'blue-card',
        'orange'    => 'orange-card',
        'gradient'  => 'gradient-card'
    );

    $shortcodes = '';

    $ls_shortcode_promotions_args = array(
        'post_type'      => 'promotions',
        'posts_per_page' => 12,
    );

    $ls_shortcode_promotions_query = new WP_Query($ls_shortcode_promotions_args);

    if ($ls_shortcode_promotions_query->have_posts()) {

        $shortcodes .= '[row_inner v_align="equal"]';

        while ($ls_shortcode_promotions_query->have_posts()) {

            $ls_shortcode_promotions_query->the_post();

            // Fetch promotion details
            $ls_promotions_image             = get_the_post_thumbnail_url();
            $ls_promotions_link              = get_the_permalink();
            $ls_promotions_title             = get_field('ls_promotions_title');
            $ls_promotions_short_title       = get_field('ls_promotions_short_title');
            $ls_promotions_short_description = get_field('ls_promotions_short_description');
            $ls_promotions_card_color        = get_field('ls_promotions_card_color');

            $ls_promotions_card_class        = array_key_exists($ls_promotions_card_color, $ls_css_class_map) && !empty($ls_css_class_map[$ls_promotions_card_color])
                // If the color is set, use the color class
                ? $ls_css_class_map[$ls_promotions_card_color]
                // Default to blue card if no color is set
                : 'blue-card';

            // Build the promotion shortcode
            $shortcodes .= '[col_inner span="4" span__sm="12" span__md="12" bg_color="rgb(255,255,255)" animate="fadeInUp" class="special-clickable-card ' . $ls_promotions_card_class . '"]';
            $shortcodes .= '[ux_html]';

            if ($ls_promotions_short_title) {

                $ls_promotions_short_title = $ls_promotions_short_title;
            } else {

                $ls_promotions_short_title = 'Promotion';
            }
            $shortcodes .= '<div class="special-box">' . $ls_promotions_short_title . '</div>';
            $shortcodes .= '<a href="' . $ls_promotions_link . '" class="clickable-card-link"></a>';
            $shortcodes .= '[/ux_html]';

            // Fetch the featured image and display if available
            if ($ls_promotions_image) {
                $shortcodes .= '[ux_image id="' . $ls_promotions_image . '" height="67%"]';
            }

            $shortcodes .= '[row_inner_1]';
            $shortcodes .= '[col_inner_1 span__sm="12" padding="30px 30px 0px 30px"]';
            $shortcodes .= '<h4>' . $ls_promotions_title . '</h4>';
            $shortcodes .= '<p>' . $ls_promotions_short_description . '</p>';
            $shortcodes .= '[button text="Learn More" color="alert" style="link" expand="0" icon="icon-angle-right"]';
            $shortcodes .= '[/col_inner_1]';
            $shortcodes .= '[/row_inner_1]';
            $shortcodes .= '[/col_inner]';
        }

        $shortcodes .= '[/row_inner]';

    } else {
        // Display a message if no specials are found
        $shortcodes .= '<p>No promotions available at this time. Please call us for upcoming promotions!</p>';
    }

    echo do_shortcode($shortcodes);

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('ls_promotions', 'ls_shortcode_promotions');
