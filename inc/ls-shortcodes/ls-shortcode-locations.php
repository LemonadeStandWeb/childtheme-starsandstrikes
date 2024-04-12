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
            $ls_location_building_image    = get_field('ls_locations_building_image');
            $ls_location_address           = get_field('ls_locations_location_address');

            $shortcodes .= '[col_inner span="4" span__sm="12" span__md="6" margin="0px 0px 50px 0px" margin__sm="0px 0px 30px 0px" margin__md="0px 0px 40px 0px" bg_color="rgb(255,255,255)" class="special-clickable-card attraction-card"]';
            $shortcodes .= '[ux_html]';
            $shortcodes .= '<a class="clickable-card-link" href="' . $ls_location_post_link . '"></a>';
            $shortcodes .= '[/ux_html]';

            if ($ls_location_building_image) {
                $shortcodes .= '[ux_image id="' . $ls_location_building_image . '" height="56.25%" class="mb-0"]';
            } else {
                $shortcodes .= '[ux_image id="700" height="75%" class="mb-0"]';
            }

            $shortcodes .= '[row_inner_1]';
            $shortcodes .= '[col_inner_1 span__sm="12" padding="30px 30px 0px 30px" align="center"]';
            $shortcodes .= '[ux_text font_size="1.4"]';
            $shortcodes .= '<h4>' . $ls_location_title . '</h4>';
            $shortcodes .= '[/ux_text]';

            // Display the location address if available
            if ($ls_location_address) {

                $shortcodes .= '[ux_text font_size="0.9"]';

                // Loop over segments and construct address
                $address = '';
                foreach (array('street_number', 'street_name', 'city', 'state', 'post_code',) as $i => $k) {
                    if (isset($ls_location_address[$k])) {
                        $address .= sprintf('<span class="segment-%s">%s</span>, ', $k, $ls_location_address[$k]);
                    }
                }

                // Trim trailing comma.
                $address = trim($address, ', ');

                $shortcodes .= '<p>' . $address . '</p>';
                $shortcodes .= '[/ux_text]';
            }

            $shortcodes .= '[/col_inner_1]';
            $shortcodes .= '[/row_inner_1]';
            $shortcodes .= '[button text="Location Details" link="' . $ls_location_post_link . '" color="alert" style="outline" padding="5px 30px 5px 30px" expand="0" icon="icon-angle-right" class="attraction-button"]';
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
