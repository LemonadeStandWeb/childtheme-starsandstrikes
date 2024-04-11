<?php
/*
Template name: Locations single.php
*/ ?>

<?php get_template_part('templates/parts/ls-cpt-header'); ?>

<main id="main" class="<?php flatsome_main_classes(); ?>">

    <?php do_action('flatsome_before_page'); ?>

    <div id="content" role="main">

        <?php while (have_posts()) : the_post(); ?>

            <?php
            /**
             * Displays the attractions available at the current location.
             *
             * @param string $location the ID of the current location.
             * @return string The shortcode output of the attractions section.
             */
            function ls_display_attractions($location)
            {

                $output = '';
                $output .= '[title style="bold" text="Activities Available" tag_name="h4" size="63"]';
                $output .= '[row_inner class="location-activity-tiles"]';

                $attractions_args = array(
                    'post_type' => 'attractions',
                    'posts_per_page' => -1,
                    'meta_query' => array(
                        array(
                            'key' => 'ls_attraction_location_availability',
                            'value' => '"' . $location . '"',
                            'compare' => 'LIKE'
                        )
                    )
                );

                // The query to fetch attractions
                $attractions_query = new WP_Query($attractions_args);

                // Begin building the attractions section if any attractions are available at the location.
                if ($attractions_query->have_posts()) {

                    while ($attractions_query->have_posts()) {
                        $attractions_query->the_post();

                        // Fetch attraction details
                        $ls_attraction_icon = get_field('ls_attraction_icon');
                        $ls_attraction_name = get_the_title();
                        $ls_attraction_link = get_the_permalink();

                        // Build the attraction shortcode
                        $output .= '[col_inner span="3" span__sm="6"]';
                        $output .= '[featured_box img="' . $ls_attraction_icon . '" pos="center" tooltip="' . $ls_attraction_name . '" font_size="xsmall" icon_color="rgb(247, 213, 77)" class="simple" link="' . $ls_attraction_link . '"]';
                        $output .= '[/featured_box]';
                        $output .= '[/col_inner]';
                    }
                } else {
                    // Display a message if no attractions are available at the location
                    $output .= '[col_inner padding="20px 20px 5px 20px"][ux_text]<p>Please call us to ask about all available attractions!</p>[/ux_text][/col_inner]';
                }

                // Reset the post data after the attractions loop
                wp_reset_postdata();

                // Close the "Activities Available" row
                $output .= '[/row_inner]';

                return $output;
            }

            /**
             * Displays the daily hours of operation table for locations.
             * 
             * The hours table is built by looping through the repeater field 'ls_locations_hours' and displaying the day and hours.
             *
             * @return string The shortcodes for the hours table.
             */
            function ls_display_hours_table()
            {
                $output = '';
                $output .= '<table class="hours__table">';
                $output .= '<tbody>';

                // Display Hours Table
                if (have_rows('ls_locations_hours')) {

                    while (have_rows('ls_locations_hours')) {

                        the_row();

                        // Grab subfields
                        $day = get_sub_field('ls_locations_repeater_title');
                        $hours = get_sub_field('ls_locations_repeater_hours');

                        // Build the table
                        $output .= '<tr>';
                        $output .= '<td><strong>' . $day . '</strong></td>';
                        $output .= '<td>' . $hours . '</td>';
                        $output .= '</tr>';
                    }
                } else {
                    // If no hours are available, display a message
                    $output .= '<p>No hours available. Please call us for availability!</p>';
                }

                // Close the hours table
                $output .= '</tbody>';
                $output .= '</table>';

                return $output;
            }

            /**
             * Displays the 'Hours' column for a location.
             *
             * The 'Hours' column also has a conditional notice with a tooltip if available. 
             * It displays the location name, address, phone number, and a button to call the location.
             *
             * @param string $location_notice The notice for the location.
             * @param string $location_name The name of the location.
             * @param string $location_address The address of the location.
             * @param string $location_phone The phone number of the location.
             * @return string The shortcode output for the hours column.
             */
            function ls_display_hours_column($location_notice, $location_name, $location_address, $location_phone)
            {
                $output = '';
                // Opening 4 column
                $output .= '[col span="4" span__sm="12" span__md="10" color="light" animate="fadeInRight"]';

                $output .= '[title style="center" text="Hours" tag_name="h4" class="mb-0"]';
                $output .= '[row_inner]';
                $output .= '[col_inner span__sm="12" span__md="12" align="center" bg_color="rgba(0, 0, 0, 0.5)" bg_radius="10" color="light" class="box-glow show-radius"]';
                $output .= '[row_inner_1]';
                $output .= '[col_inner_1 span__sm="12" padding="20px 20px 10px 20px" align="left" bg_color="#f7d54d"]';

                if($location_notice){
                    $output .= '[featured_box img="849" img_width="25" pos="left" tooltip="' . $location_notice . '" icon_color="#f04c36" class="align-icons icon-alert"]';
                } else {
                    $output .= '[featured_box img_width="25" pos="left" icon_color="#f04c36" class="align-icons icon-alert"]';
                }

                $output .= '[ux_text text_color="#23201f"]';

                if ($location_name) {
                    $output .= '<h4 class="uppercase mb-0">' . $location_name . '</h4>';
                } else {
                    $output .= '<h4 class="uppercase mb-0">Location Info</h4>';
                }
                $output .= '[/ux_text]';
                $output .= '[/featured_box]';
                $output .= '[/col_inner_1]';
                $output .= '[/row_inner_1]';
                $output .= '[row_inner_1]';
                $output .= '[col_inner_1 span__sm="12" padding="0px 30px 0px 30px"]';

                // Display hours of operation
                $output .= ls_display_hours_table();

                // Display 'Map Location' button if available
                if ($location_address) {
                    $output .= '[button text="Map Location" style="link" size="large" padding="0px 0px 0px 0px" expand="true" icon="icon-map-pin-fill" icon_pos="left" link="' . $location_address . '" target="_blank" class="text-yellow"]';
                }

                // Display 'Call Us' button if available
                if ($location_phone) {
                    $output .= '[button text="Call Us" style="link" size="large" expand="true" icon="icon-phone" icon_pos="left" link="tel:+1' . $location_phone . '" class="text-yellow"]';
                }
                $output .= '[/col_inner_1]';
                $output .= '[/row_inner_1]';
                $output .= '[/col_inner]';
                $output .= '[col_inner span__sm="12" align="center"]';

                // Insert share icons ux block
                $output .= '[follow]';

                $output .= '[/col_inner]';
                $output .= '[/row_inner]';

                // Close the 'Hours' 4 column
                $output .= '[/col]';

                return $output;
            }

            /**
             * Displays the first returned promotion for a given location.
             *
             * @param string $location The location to fetch the promotion for.
             * @return string The shortcode output of the first returned promotion.
             */
            function ls_display_featured_promotion($location)
            {

                $promotions_args = array(
                    'post_type' => 'promotions',
                    'posts_per_page' => 1,
                    'meta_query' => array(
                        array(
                            'key' => 'ls_promotions_locations',
                            'value' => '"' . $location . '"',
                            'compare' => 'LIKE'
                        )
                    )
                );

                $promotions_query = new WP_Query($promotions_args);

                if ($promotions_query->have_posts()) {
                    $promotions_query->the_post();

                    // Fetch promotion details
                    $ls_promotions_image = get_the_post_thumbnail_url();
                    $ls_promotions_link = get_the_permalink();
                    $ls_promotions_title = get_field('ls_promotions_title');
                    $ls_promotions_short_description = get_field('ls_promotions_short_description');

                    $output = '';
                    $output .= '[row h_align="center"]';
                    $output .= '[col span__sm="12" span__md="10" margin="-125px 0px 125px 0px" margin__sm="-125px 0px 76px 0px" bg_color="rgb(255,255,255)" bg_radius="10" depth="5" class="show-radius"]';
                    
                    $output .= '[row_inner style="collapse" v_align="equal" h_align="center"]';
                    $output .= '[col_inner span="4" span__sm="12" span__md="12" force_first="medium" padding="0px 0px 0px 0px" padding__md="200px 0px 0px 0px"]';
                    $output .= '[ux_image id="' . $ls_promotions_image . '" class="fill"]';
                    $output .= '[/col_inner]';
                    $output .= '[col_inner span="8" span__sm="12" span__md="12" force_first="medium"]';
                    $output .= '[ux_image id="693" image_size="original" image_overlay="rgba(255, 255, 255, 0.314)" class="fill"]';
                    $output .= '[row_inner_1 h_align="center"]';
                    $output .= '[col_inner_1 span="10" padding="0px 50px 0px 0px" padding__md="0px 0px 0px 0px"]';
                    $output .= '[gap]';
                    $output .= '<h2>' . $ls_promotions_title . '</h2>';
                    $output .= '<p>' . $ls_promotions_short_description . '</p>';
                    $output .= '[button text="Learn More" color="alert" radius="3" expand="0" link="' . $ls_promotions_link . '"]';
                    $output .= '[/col_inner_1]';
                    $output .= '[/row_inner_1]';
                    $output .= '[/col_inner]';
                    $output .= '[/row_inner]';

                    $output .= '[/col]';
                    $output .= '[/row]';

                    return $output;
                }
            }

            /**
             * Displays all specials available at the current location.
             *
             * This function fetches and displays all specials available at the current location by looping through the 'specials' custom post type.
             * It retrieves the title, image, and short description of each special and builds a shortcode to display them.
             * If no specials are available at the location, it displays a message.
             *
             * @param string $location The current location.
             * @param array $css_class_map The CSS class map for the specials.
             * @return string The shortcode output of the specials.
             */
            function ls_display_specials($location, $css_class_map)
            {

                global $ls_index_days_map;

                $output = '';
                $output .= '[col span="7" span__sm="12" span__md="10" padding="0px 0px 0px 60px" padding__md="0px 0px 0px 0px"]';
                $output .= '[ux_slider style="focus" slide_width="40%" slide_width__sm="100%" slide_width__md="60%" slide_align="left" hide_nav="true" nav_pos="outside" nav_style="simple" nav_color="dark" class="specials-slider custom-slider-btns"]';

                $specials_args = array(
                    'post_type' => 'specials',
                    'posts_per_page' => -1,
                    'meta_query' => array(
                        array(
                            'key' => 'ls_specials_locations',
                            'value' => '"' . $location . '"',
                            'compare' => 'LIKE'
                        )
                    )
                );

                $specials_query = new WP_Query($specials_args);

                $specials_array = [];

                if ($specials_query->have_posts()) {

                    while ($specials_query->have_posts()) {

                        $specials_query->the_post();

                        // Make the post data available
                        global $post;

                        // Map each day of the week to its corresponding sort index
                        $ls_specials_what_day = get_field('ls_specials_what_day');
                        $sort_index = $ls_index_days_map[$ls_specials_what_day];

                        // Build an array of specials with their sort index
                        $specials_array[] = array(
                            'post' => $post,
                            'sort_index' => $sort_index
                        );
                    }

                    // Sort the specials array by the sort index
                    usort($specials_array, function ($a, $b) {
                        return $a['sort_index'] <=> $b['sort_index'];
                    });

                    // Loop through the sorted specials array and build the shortcode
                    foreach ($specials_array as $special) {

                        $post = $special['post'];
                        setup_postdata($post);

                        // Fetch special details
                        $ls_special_image = get_the_post_thumbnail_url();
                        $ls_special_link = get_the_permalink();
                        $ls_specials_what_day = get_field('ls_specials_what_day');
                        $ls_specials_title = get_field('ls_specials_title');
                        $ls_specials_short_description = get_field('ls_specials_short_description');

                        // Build the special shortcode
                        $output .= '[row_inner]';
                        $output .= '[col_inner span__sm="12" bg_color="rgb(255,255,255)" class="special-clickable-card ' . $css_class_map[$ls_specials_what_day] . '"]';
                        $output .= '[ux_html]';
                        $output .= '<div class="special-box">' . $ls_specials_what_day . ' Deal</div>';
                        $output .= '<a href="' . $ls_special_link . '" class="clickable-card-link"></a>';
                        $output .= '[/ux_html]';

                        // Add the special image if available
                        if ($ls_special_image) {
                            $output .= '[ux_image id="' . $ls_special_image . '" height="67%"]';
                        }
                        $output .= '[row_inner_1]';
                        $output .= '[col_inner_1 span__sm="12" padding="30px 30px 0px 30px"]';
                        $output .= '<h4>' . $ls_specials_title . '</h4>';
                        $output .= $ls_specials_short_description;
                        $output .= '[button text="Learn More" color="alert" style="link" expand="0" icon="icon-angle-right"]';
                        $output .= '[/col_inner_1]';
                        $output .= '[/row_inner_1]';
                        $output .= '[/col_inner]';
                        $output .= '[/row_inner]';
                    }
                } else {
                    // Build the special shortcode
                    $output .= '[row_inner]';
                    $output .= '[col_inner span__sm="12" bg_color="rgb(255,255,255)" class="special-clickable-card ' . $css_class_map['monday'] . '"]';
                    $output .= '[ux_html]';
                    $output .= '<div class="special-box">Coming Soon!</div>';
                    $output .= '<a href="/contact" class="clickable-card-link"></a>';
                    $output .= '[/ux_html]';

                    $output .= '[ux_image id="645"]';
                    $output .= '[row_inner_1]';
                    $output .= '[col_inner_1 span__sm="12" padding="30px 30px 0px 30px"]';
                    $output .= '<h4>Lorem Ipsum</h4>';
                    $output .= '<p>No specials available. Please contact us for availability!</p>';
                    $output .= '[button text="Learn More" color="alert" style="link" expand="0" icon="icon-angle-right"]';
                    $output .= '[/col_inner_1]';
                    $output .= '[/row_inner_1]';
                    $output .= '[/col_inner]';
                    $output .= '[/row_inner]';
                }

                wp_reset_postdata();

                $output .= '[/ux_slider]';
                $output .= '[/col]';

                return $output;
            }

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
                'thursday'  => 'red-card',
                'friday'    => 'blue-card',
                'saturday'  => 'orange-card',
                'everyday'  => 'gradient-card'
            );

            /**
             * Weekday-to-Index Map
             * 
             * Associative array to map the days of the week to an index for sorting specials.
             */
            $ls_index_days_map = array(
                'sunday'    => 0,
                'monday'    => 1,
                'tuesday'   => 2,
                'wednesday' => 3,
                'thursday'  => 4,
                'friday'    => 5,
                'saturday'  => 6,
                'everyday'  => 7
            );

            /**
             * Variables setup
             * 
             * Initializing variables to store location details, sanitizing the phone number, and fetching links to book an event or reserve a lane.
             * 
             * @var string  $ls_location_name              Text          The name of the location. 
             * @var int     $ls_location_image             Image ID      The featured image of the location. 
             * @var string  $ls_location_background_video  Text          The background video URL of the location. 
             * @var int     $ls_location_background_image  Image ID      The background image of the location for mobile or if no video is available. 
             * @var string  $ls_location_notice            Text          The Tooltip text to be displayed next to the hours table title. 
             * @var string  $ls_location_address           URL           The address of the location. 
             * @var int     $ls_location_phone             Number        The phone number of the location. 
             * @var string  $ls_location_event_link        Text          The link to plan an event form. 
             * @var string  $ls_location_lane_link         Text          The link to reserve a lane form. 
             * @var array   $ls_location_hours             Repeater      The hours of the location. 
             * @var array   $ls_attraction_availability    Relationship  The availability of attractions at the location. 
             * @var array   $ls_special_availability       Relationship  The availability of specials at the location.
             */
            $ls_location_name               = get_the_title();
            $ls_location_image              = get_the_post_thumbnail_url();
            $ls_location_background_video   = get_field('ls_locations_background_video');
            $ls_location_background_image   = get_field('ls_locations_background_image');
            $ls_location_notice             = get_field('ls_locations_notice');
            $ls_location_address_share_link = esc_attr(get_field('ls_locations_location_address_share_link'));
            $ls_location_phone              = get_field('ls_locations_phone_number');
            $ls_location_phone              = preg_replace('/[^0-9]/', '', $ls_location_phone);
            $ls_location_event_link         = get_field('ls_locations_plan_an_event_link');
            $ls_location_lane_link          = get_field('ls_locations_reserve_a_lane_link');
            $ls_location_hours              = get_field('ls_locations_hours');
            $ls_attraction_availability     = get_field('ls_attraction_location_availability');
            $ls_special_availability        = get_field('ls_specials_locations');
            $current_location               = get_the_ID();

            // Initialize shortcode variable as empty and start building the shortcodes
            $shortcodes = '';

            // Begin building the 'Hero' section
            $shortcodes .= '[section bg="' . $ls_location_background_image . '" bg_size="original" bg_overlay="rgba(12, 35, 66, 0.797)" padding="100px" video_mp4="' . $ls_location_background_video . '"]';
            $shortcodes .= '[gap height="164px" height__md="108px"]';
            $shortcodes .= '[row h_align="center"]';
            $shortcodes .= '[col span="8" span__sm="12" span__md="10" padding="0px 50px 0px 0px" padding__sm="0px 0px 0px 0px" padding__md="0px 0px 0px 0px" align="left" color="light" animate="fadeInLeft"]';

            $shortcodes .= '[ux_text font_size="1.8" font_size__md="1.5" font_size__sm="1.15"]';
            $shortcodes .= '<h1 class="mb-0 uppercase">' . $ls_location_name . '</h1>';
            $shortcodes .= '[/ux_text]';

            $shortcodes .= '[gap height="20px"]';

            $shortcodes .= '[row_inner style="small"]';
            $shortcodes .= '[col_inner span="4" span__sm="12" span__md="12"]';
            $shortcodes .= '[button text="Book a Party" color="alert" size="large" expand="true" link="' . $ls_location_event_link . '"]';
            $shortcodes .= '[/col_inner]';
            $shortcodes .= '[col_inner span="4" span__sm="12" span__md="12"]';
            $shortcodes .= '[button text="Reserve a Lane" color="success" size="large" expand="true" link="' . $ls_location_lane_link . '"]';
            $shortcodes .= '[/col_inner]';
            $shortcodes .= '[/row_inner]';

            $shortcodes .= ls_display_attractions($current_location);

            // Close the column containing location name, buttons, and attractions
            $shortcodes .= '[/col]';

            $shortcodes .= ls_display_hours_column($ls_location_notice, $ls_location_name, $ls_location_address_share_link, $ls_location_phone);

            // Close the hero section
            $shortcodes .= '[/row]';
            $shortcodes .= '[gap height="0px"]';
            $shortcodes .= '[/section]';


            // Begin building the 'Specials' section
            $shortcodes .= '[section padding="79px" class="background-repeat"]';
            $shortcodes .= ls_display_featured_promotion($current_location);
            $shortcodes .= '[row style="collapse" width="full-width" v_align="middle" h_align="center"]';

            // Column that displays the 'Specials' section title and description
            $shortcodes .= '[col span="5" span__sm="12" span__md="10" padding__md="0px 30px 0px 30px" max_width="450px" max_width__md="100%"]';
            $shortcodes .= '[ux_text font_size="1.4"]';
            $shortcodes .= '<h2 class="mb-0">Specials</h2>';
            $shortcodes .= '[/ux_text]';
            $shortcodes .= '[ux_text font_size="1.2"]';
            $shortcodes .= '<p><strong>Save big when you get away and play.</strong></p>';
            $shortcodes .= '[/ux_text]';
            $shortcodes .= '<p>Save on fun at Stars and Strikes. Our specials make it easier than ever to have fun with your friends and family. Click to learn more about each special. We’ll see you soon!</p>';
            $shortcodes .= '[/col]';

            // Display specials section content slider
            $shortcodes .= ls_display_specials($current_location, $ls_css_class_map);

            // Close row that contains the specials content and slider
            $shortcodes .= '[/row]';

            // Grab the content within the editor and add it to the shortcodes
            ob_start();
            the_content();
            $ls_content_shortcode = ob_get_clean();
            $shortcodes .= $ls_content_shortcode;

            // Close the specials section and display the CTA
            $shortcodes .= '[/section]';
            $shortcodes .= '[block id="schedule-event"]';
            ?>

            <?php
            echo do_shortcode($shortcodes);
            ?>

        <?php endwhile;

        ?>
    </div>

    <?php do_action('flatsome_after_page'); ?>

    <?php get_footer(); ?>