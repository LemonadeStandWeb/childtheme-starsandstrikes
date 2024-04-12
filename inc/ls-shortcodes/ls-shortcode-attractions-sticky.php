<?php

/**
 * Display Attractions in gradient icon format within a sticky column
 */
function ls_shortcode_locations_sticky(): bool|string
{
    ob_start();

    // Query all Attractions posts
    $attractions_args = array(
        'post_type' => 'attractions',
        'posts_per_page' => -1
    );

    $query = new WP_Query($attractions_args);

    $shortcodes = '[row_inner]';
    $shortcodes .= '[col_inner span__sm="12" padding="30px 30px 20px 30px" bg_color="#f0f0f0" bg_radius="10"]';

    $shortcodes .= '[ux_text text_align="center"]';
    $shortcodes .= '<h2>All Attractions</h2>';
    $shortcodes .= '[/ux_text]';

    $shortcodes .= '[row_inner_1 style="small" col_bg_radius="10" v_align="equal" depth="5"]';

    if($query->have_posts()) {

        while ($query->have_posts()) {

            $query->the_post();

            $attractions_post_link = get_the_permalink();
            $attractions_post_title = get_the_title();
            $attractions_post_icon = get_field('ls_attraction_gradient_icon');
            $attractions_post_image = get_the_post_thumbnail_url();

            // Build out each attraction
            $shortcodes .= '[col_inner_1 span="6" span__sm="12" span__md="4" padding="20px 0px 20px 0px" bg_color="rgb(59, 45, 116)" class="show-radius clickable-card"]';
            $shortcodes .= '[ux_image id="' . $attractions_post_image . '" class="fill"]';
            $shortcodes .= '[ux_html]';
            $shortcodes .= '<a href="' . $attractions_post_link . '" class="clickable-card-link"></a>';
            $shortcodes .= '[/ux_html]';
            $shortcodes .= '[featured_box img="' . $attractions_post_icon . '" inline_svg="0" img_width="40" pos="center"]';
            $shortcodes .= '[ux_text font_size="0.9" text_align="center" text_color="rgb(255,255,255)" class="relative"]';
            $shortcodes .= '<p class="mb-0"><strong>' . $attractions_post_title . '</strong></p>';
            $shortcodes .= '[/ux_text]';
            $shortcodes .= '[/featured_box]';
            $shortcodes .= '[/col_inner_1]';


        }
        wp_reset_postdata();
    }

    $shortcodes .= '[/row_inner_1]';
    $shortcodes .= '[/col_inner]';
    $shortcodes .= '[/row_inner]';

    echo do_shortcode($shortcodes);

    return ob_get_clean();
}

add_shortcode('ls_locations_sticky', 'ls_shortcode_locations_sticky');
