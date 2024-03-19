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
            * Variables setup
            * 
            * Initializing variables to store location details, sanitizing the phone number, and fetching links to book an event or reserve a lane.
            * 
            * @var string  $ls_location_name              The name of the location. (Text field)
            * @var int     $ls_location_image             The featured image of the location. (Image ID)
            * @var string  $ls_location_background_video  The background video URL of the location. (Text field)
            * @var int     $ls_location_background_image  The background image of the location for mobile or if no video is available. (Image ID)
            * @var string  $ls_location_notice            Tooltip text to be displayed next to the hours table title. (Text field)
            * @var string  $ls_location_address           The address of the location. (URL field)
            * @var int     $ls_location_phone             The phone number of the location. (Number field)
            * @var string  $ls_location_event_link        The link to plan an event form. (Text field)
            * @var string  $ls_location_lane_link         The link to reserve a lane form. (Text field)
            * @var array   $ls_location_hours             The hours of the location. (Repeater field)
            * @var array   $ls_attraction_availability    The availability of attractions at the location. (Relationship field)
            * @var array   $ls_special_availability       The availability of specials at the location. (Relationship field)
            */
            $ls_location_name             = get_the_title();
            $ls_location_image            = get_the_post_thumbnail_url();
            $ls_location_background_video = get_field('ls_locations_background_video');
            $ls_location_background_image = get_field('ls_locations_background_image');
            $ls_location_notice           = get_field('ls_locations_notice');
            $ls_location_address          = esc_attr(get_field('ls_locations_location_address'));
            $ls_location_phone            = get_field('ls_locations_phone_number');
            $ls_location_phone            = preg_replace('/[^0-9]/', '', $ls_location_phone);
            $ls_location_event_link       = get_field('ls_locations_plan_an_event_link');
            $ls_location_lane_link        = get_field('ls_locations_reserve_a_lane_link');
            $ls_location_hours            = get_field('ls_locations_hours');
            $ls_attraction_availability   = get_field('ls_attraction_location_availability');
            $ls_special_availability      = get_field('ls_specials_locations');
            $current_location             = get_the_ID();

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

            // Initialize shortcode variable as empty and start building the shortcodes
            $shortcodes = '';

            /**
             * Begin building hero section
             * 
             * The hero section includes the location name, background image or video, and buttons to book an event or reserve a lane.
             */
            $shortcodes .= '[section bg="' . $ls_location_background_image . '" bg_size="original" bg_overlay="rgba(12, 35, 66, 0.797)" padding="100px" video_mp4="' . $ls_location_background_video . '"]';
            $shortcodes .= '[gap height="164px" height__md="108px"]';
            $shortcodes .= '[row h_align="center"]';
            $shortcodes .= '[col span="8" span__sm="12" span__md="10" padding="0px 50px 0px 0px" padding__sm="0px 0px 0px 0px" padding__md="0px 0px 0px 0px" align="left" color="light" animate="fadeInLeft"]';
            $shortcodes .= '[ux_text font_size="2.4" font_size__sm="1.15"]';
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

            /**
             * Attractions Query
             * 
             * Fetches and displays all attractions available at the current location by looping through the
             * 'attractions' custom post type and displaying the title, icon, and link to the attraction.
             */

            $shortcodes .= '[title style="bold" text="Activities Available" tag_name="h4" size="63"]';
            $shortcodes .= '[row_inner col_bg="rgba(0, 0, 0, 0.5)" col_bg_radius="5"]';

            $attractions_args = array(
                'post_type' => 'attractions',
                'posts_per_page' => -1,
                'meta_query' => array(
                    array(
                        'key' => 'ls_attraction_location_availability',
                        'value' => '"' . $current_location . '"',
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
                    $ls_attraction_name = get_the_title();
                    $ls_attraction_icon = get_field('ls_attraction_icon');
                    $ls_attraction_link = get_the_permalink();

                    // Build the attraction shortcode
                    $shortcodes .= '[col_inner span="3" span__sm="6"]';
                    $shortcodes .= '[featured_box img="' . $ls_attraction_icon . '" pos="center" tooltip="' . $ls_attraction_name . '" font_size="xsmall" icon_color="rgb(247, 213, 77)" class="simple"]';
                    $shortcodes .= '[/featured_box]';
                    $shortcodes .= '[/col_inner]';
                }
            } else {
                // Display a message if no attractions are available at the location
                $shortcodes .= '[col_inner padding="20px 20px 5px 20px"][ux_text]<p>Please call us to ask about all available attractions!</p>[/ux_text][/col_inner]';
            }

            // Reset the post data after the attractions loop
            wp_reset_postdata();

            // Close the attractions part of the shortcode
            $shortcodes .= '[/row_inner]';
            $shortcodes .= '[/col]';

            /**
             * Begin building the 'Hours' section
             * 
             * The 'Hours' section also has a conditional notice with a tooltip if available. 
             * It displays the location name, address, phone number, and a button to call the location.
             */
            $shortcodes .= '[col span="4" span__sm="12" span__md="10" color="light" animate="fadeInRight"]';
            $shortcodes .= '[title style="center" text="Hours" tag_name="h4" class="mb-0"]';
            $shortcodes .= '[row_inner]';
            $shortcodes .= '[col_inner span__sm="12" span__md="12" align="center" bg_color="rgba(0, 0, 0, 0.5)" bg_radius="10" color="light" class="box-glow show-radius"]';
            $shortcodes .= '[row_inner_1]';
            $shortcodes .= '[col_inner_1 span__sm="12" padding="20px 20px 10px 20px" align="left" bg_color="#f7d54d"]';

            // Display icon and tooltip if notice is available
            $shortcodes .= '[featured_box img="';
            if ($ls_location_notice) {
                $shortcodes .= '849" img_width="25" pos="left" tooltip="' . $ls_location_notice;
            } else {
                // If $ls_location_notice is empty, don't add an image
                $shortcodes .= '" img_width="25" pos="left';
            }
            $shortcodes .= '" icon_color="#f04c36" class="align-icons"]';
            $shortcodes .= '[ux_text text_color="#23201f"]';
            $shortcodes .= '<h4 class="uppercase mb-0">' . $ls_location_name . '</h4>';
            $shortcodes .= '[/ux_text]';
            $shortcodes .= '[/featured_box]';
            $shortcodes .= '[/col_inner_1]';
            $shortcodes .= '[/row_inner_1]';
            $shortcodes .= '[row_inner_1]';
            $shortcodes .= '[col_inner_1 span__sm="12" padding="0px 30px 0px 30px"]';

            /**
             * Hours Table
             * 
             * The hours table is built by looping through the repeater field 'ls_locations_hours' and displaying the day and hours.
             */
            $shortcodes .= '<table class="hours__table">';
            $shortcodes .= '<tbody>';

            // Display Hours Table
            if (have_rows('ls_locations_hours')) {

                while (have_rows('ls_locations_hours')) {

                    the_row();

                    // Grab subfields
                    $day = get_sub_field('ls_locations_repeater_title');
                    $hours = get_sub_field('ls_locations_repeater_hours');

                    // Build the table
                    $shortcodes .= '<tr>';
                    $shortcodes .= '<td><strong>' . $day . '</strong></td>';
                    $shortcodes .= '<td>' . $hours . '</td>';
                    $shortcodes .= '</tr>';
                }
            } else {
                // If no hours are available, display a message
                $shortcodes .= '<p>No hours available. Please call us for availability!</p>';
            }

            // Close the hours table
            $shortcodes .= '</tbody>';
            $shortcodes .= '</table>';

            /**
             * Location Contact Information
             * 
             * Display the location address and phone number buttons.
             */
            if ( $ls_location_address ) {
                $shortcodes .= '[button text="Map Location" style="link" size="large" padding="0px 0px 0px 0px" expand="true" icon="icon-map-pin-fill" icon_pos="left" link="' . $ls_location_address . '" target="_blank" class="text-yellow"]';
            }
            
            if ( $ls_location_phone ) {
                $shortcodes .= '[button text="Call Us" style="link" size="large" expand="true" icon="icon-phone" icon_pos="left" link="tel:+1' . $ls_location_phone . '" class="text-yellow"]';
            }
            $shortcodes .= '[/col_inner_1]';
            $shortcodes .= '[/row_inner_1]';
            $shortcodes .= '[/col_inner]';
            $shortcodes .= '[col_inner span__sm="12" align="center"]';

            // Insert share icons ux block
            $shortcodes .= '[follow]';

            $shortcodes .= '[/col_inner]';
            $shortcodes .= '[/row_inner]';
            $shortcodes .= '[/col]';
            $shortcodes .= '[/row]';
            $shortcodes .= '[gap height="0px"]';
            $shortcodes .= '[/section]';

            /**
             * Begin building the 'Specials' section
             * 
             * The 'Specials' section displays the specials available at the location. It fetches the specials assigned to the location and displays them in a slider.
             */
            $shortcodes .= '[section bg="694" bg_size="original" padding="79px"]';
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
            
            /**
             * Specials Query
             * 
             * Fetches and displays all specials available at the current location by looping through the
             * 'specials' custom post type and displaying the title, image, and short description.
             */

            $shortcodes .= '[col span="7" span__sm="12" span__md="10" padding="0px 0px 0px 60px" padding__md="0px 0px 0px 0px"]';
            $shortcodes .= '[ux_slider style="focus" slide_width="40%" slide_width__sm="100%" slide_width__md="60%" slide_align="left" hide_nav="true" nav_pos="outside" nav_style="simple" nav_color="dark" class="specials-slider"]';

            $specials_args = array(
                'post_type' => 'specials',
                'posts_per_page' => -1,
                'meta_query' => array(
                    array(
                        'key' => 'ls_specials_locations',
                        'value' => '"' . $current_location . '"',
                        'compare' => 'LIKE'
                    )
                )
            );

            // The query to fetch specials
            $specials_query = new WP_Query($specials_args);

            if ( $specials_query->have_posts() ) {

                while ( $specials_query->have_posts() ) {
                    $specials_query->the_post();

                    // Fetch special details
                    $ls_special_image = get_the_post_thumbnail_url();
                    $ls_special_link = get_the_permalink();
                    $ls_specials_what_day = get_field('ls_specials_what_day');
                    $ls_specials_title = get_field('ls_specials_title');
                    $ls_specials_short_description = get_field('ls_specials_short_description');

                    // Build the special shortcode
                    $shortcodes .= '[row_inner]';
                    $shortcodes .= '[col_inner span__sm="12" bg_color="rgb(255,255,255)" class="special-clickable-card ' . $ls_css_class_map[$ls_specials_what_day] . '"]';
                    $shortcodes .= '[ux_html]';
                    $shortcodes .= '<div class="special-box">' . $ls_specials_what_day . ' Deal</div>';
                    $shortcodes .= '<a href="' . $ls_special_link . '" class="clickable-card-link"></a>';
                    $shortcodes .= '[/ux_html]';

                    // Add the special image if available
                    if ($ls_special_image) {
                        $shortcodes .= '[ux_image id="' . $ls_special_image . '"]';
                    }
                    $shortcodes .= '[row_inner_1]';
                    $shortcodes .= '[col_inner_1 span__sm="12" padding="30px 30px 0px 30px"]';
                    $shortcodes .= '<h4>' . $ls_specials_title . '</h4>';
                    $shortcodes .= $ls_specials_short_description;
                    $shortcodes .= '[button text="Learn More" color="alert" style="link" expand="0" icon="icon-angle-right"]';
                    $shortcodes .= '[/col_inner_1]';
                    $shortcodes .= '[/row_inner_1]';
                    $shortcodes .= '[/col_inner]';
                    $shortcodes .= '[/row_inner]';

                }
            } else {
                // Display a message if no specials are available at the location
                $shortcodes .= '<p>No specials currently available. Please call us for upcoming specials!</p>';
            }
        
            wp_reset_postdata();
            
            $shortcodes .= '[/ux_slider]';
            $shortcodes .= '[/col]';
            $shortcodes .= '[/row]';
            $shortcodes .= '[/section]';
            ?>

            <?php
            echo do_shortcode($shortcodes);
            the_content();
            ?>

        <?php endwhile; // end of the loop. 

        ?>
    </div>

    <?php do_action('flatsome_after_page'); ?>

    <?php get_footer(); ?>