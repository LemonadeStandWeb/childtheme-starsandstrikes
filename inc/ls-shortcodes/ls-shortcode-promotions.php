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
        'posts_per_page' => -1,
    );

    $ls_shortcode_promotions_query = new WP_Query($ls_shortcode_promotions_args);

    if ($ls_shortcode_promotions_query->have_posts()) {

        while ($ls_shortcode_promotions_query->have_posts()) {

            $ls_shortcode_promotions_query->the_post();

            // Fetch promotion details
            $ls_promotions_image             = get_the_post_thumbnail_url();
            $ls_promotions_link              = get_the_permalink();
            $ls_promotions_title             = get_field('ls_promotions_title');
            $ls_promotions_short_title       = get_field('ls_promotions_short_title');
            $ls_promotions_short_description = get_field('ls_promotions_short_description');
            $ls_promotions_card_color        = get_field('ls_promotions_card_color');

            // Build the promotion shortcode
            $shortcodes .= '[col span="4" span__sm="12" bg_color="rgb(255,255,255)" animate="fadeInUp" class="special-clickable-card ' . $ls_css_class_map[$ls_promotions_card_color] . '"]';
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
                $shortcodes .= '[ux_image id="' . $ls_promotions_image . '"]';
            }

            $shortcodes .= '[row_inner]';
            $shortcodes .= '[col_inner span__sm="12" padding="30px 30px 0px 30px"]';
            $shortcodes .= '<h4>' . $ls_promotions_title . '</h4>';
            $shortcodes .= $ls_promotions_short_description;
            $shortcodes .= '[button text="Learn More" color="alert" style="link" expand="0" icon="icon-angle-right"]';
            $shortcodes .= '[/col_inner]';
            $shortcodes .= '[/row_inner]';
            $shortcodes .= '[/col]';
        }
    } else {
        // Display a message if no specials are found
        $shortcodes .= '<p>No promotions available at this time. Please call us for upcoming promotions!</p>';
    }

    echo do_shortcode($shortcodes);

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('ls_promotions', 'ls_shortcode_promotions');
