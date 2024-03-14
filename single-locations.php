<?php
/*
Template name: Locations Single
*/ ?>

<?php get_template_part('templates/parts/ls-cpt-header'); ?>

<main id="main" class="<?php flatsome_main_classes(); ?>">

    <?php do_action('flatsome_before_page'); ?>

    <div id="content" role="main">

        <?php while (have_posts()) : the_post(); ?>
            <style>
                h1,
                h2,
                h3,
                h4,
                h5,
                h6 {
                    font-family: 'open sans';
                    text-transform: uppercase;
                }

                .uppercase {
                    letter-spacing: -.04em;
                }

                .icon-box.icon-box-left {
                    justify-content: center;
                }

                .icon-box-left .icon-box-text {
                    flex: unset;
                }

                /* tabs special styling */

                .custom-tabs .nav {
                    box-shadow: 5px 5px 10px 0px rgba(42, 42, 48, 0.08), -5px -5px 10px 0px rgba(255, 255, 255, 0.60);
                    background-color: white;
                    border-radius: 3px;
                    display: flex;
                    flex-direction: row;
                    padding: 10px;
                    margin-bottom: 30px;
                }

                .custom-tabs .nav {
                    background-color: #efefef;
                }

                .custom-tabs .nav .tab a {
                    display: flex;
                    flex-direction: row;
                    justify-content: center;
                }

                @media (max-width: 800px) {
                    .custom-tabs .nav .tab {
                        width: 100%;
                        margin: 0.3em 0em;
                    }
                }

                .custom-tabs .nav .tab a {
                    padding: 10px 20px;
                    border-radius: 5px;
                    background-color: #f6f6f8;
                }

                .custom-tabs .nav .tab a {
                    background-color: white;
                }

                .custom-tabs .nav .tab.active a,
                .custom-tabs .nav .tab a:hover {
                    background: #f68e3d;
                    color: white;
                }

                .custom-tabs.tabbed-content .nav>li {
                    margin: 0px 5px;
                }
            </style>
            <?php

            // Declare variables
            $ls_location_name = get_the_title();
            $ls_location_image = get_the_post_thumbnail_url();
            $ls_location_background_video = get_field('ls_locations_background_video');
            $ls_location_background_image = get_field('ls_locations_background_image');
            $ls_location_notice = get_field('ls_locations_notice');
            $ls_location_address = esc_attr(get_field('ls_locations_location_address'));
            $ls_location_phone = get_field('ls_locations_phone_number');
            $ls_location_phone = preg_replace('/[^0-9]/', '', $ls_location_phone);
            $ls_location_event_link = get_field('ls_locations_plan_an_event_link');
            $ls_location_lane_link = get_field('ls_locations_reserve_a_lane_link');
            $ls_location_hours = get_field('ls_locations_hours');
            $ls_attraction_availability = get_field('ls_attraction_location_availability');
            $current_location = get_the_ID();

            $shortcodes = '';

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

            $attractions_query = new WP_Query($attractions_args);

            if ($attractions_query->have_posts()) {

                while ($attractions_query->have_posts()) {
                    $attractions_query->the_post();

                    $ls_attraction_name = get_the_title();
                    $ls_attraction_icon = get_field('ls_attraction_icon');
                    $ls_attraction_link = get_the_permalink();

                    $shortcodes .= '[col_inner span="3" span__sm="6"]';
                    $shortcodes .= '[featured_box img="' . $ls_attraction_icon . '" pos="center" tooltip="' . $ls_attraction_name . '" font_size="xsmall" icon_color="rgb(247, 213, 77)" class="simple"]';
                    $shortcodes .= '[/featured_box]';
                    $shortcodes .= '[/col_inner]';
                }
            } else {
                $shortcodes .= '[col_inner padding="20px 20px 5px 20px"][ux_text]<p>Please call us to ask about all available attractions!</p>[/ux_text][/col_inner]';
            }

            wp_reset_postdata();

            $shortcodes .= '[/row_inner]';
            $shortcodes .= '[/col]';

            $shortcodes .= '[col span="4" span__sm="12" span__md="10" color="light" animate="fadeInRight"]';
            $shortcodes .= '[title style="center" text="Hours" tag_name="h4" class="mb-0"]';
            $shortcodes .= '[row_inner]';
            $shortcodes .= '[col_inner span__sm="12" span__md="12" align="center" bg_color="rgba(0, 0, 0, 0.5)" bg_radius="10" color="light" class="box-glow show-radius"]';

            $shortcodes .= '[row_inner_1]';
            $shortcodes .= '[col_inner_1 span__sm="12" padding="20px 20px 10px 20px" align="left" bg_color="#f7d54d"]';

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

            $shortcodes .= '<table class="hours__table">';
            $shortcodes .= '<tbody>';

            // Display Hours Table
            if (have_rows('ls_locations_hours')) {

                while (have_rows('ls_locations_hours')) {

                    the_row();

                    // Grab subfields
                    $day = get_sub_field('ls_locations_repeater_title');
                    $hours = get_sub_field('ls_locations_repeater_hours');

                    $shortcodes .= '<tr>';
                    $shortcodes .= '<td><strong>' . $day . '</strong></td>';
                    $shortcodes .= '<td>' . $hours . '</td>';
                    $shortcodes .= '</tr>';
                }
            } else {
                $shortcodes .= '<p>No hours available. Please call us for availability!</p>';
            }

            $shortcodes .= '</tbody>';
            $shortcodes .= '</table>';

            $shortcodes .= '[button text="Map Location" style="link" size="large" padding="0px 0px 0px 0px" expand="true" icon="icon-map-pin-fill" icon_pos="left" link="' . $ls_location_address . '" target="_blank" class="text-yellow"]';
            $shortcodes .= '[button text="Call Us" style="link" size="large" expand="true" icon="icon-phone" icon_pos="left" link="tel:+1' . $ls_location_phone . '" class="text-yellow"]';


            $shortcodes .= '[/col_inner_1]';
            $shortcodes .= '[/row_inner_1]';

            $shortcodes .= '[/col_inner]';


            $shortcodes .= '[col_inner span__sm="12" align="center"]';
            $shortcodes .= '[follow]';
            $shortcodes .= '[/col_inner]';

            $shortcodes .= '[/row_inner]';
            $shortcodes .= '[/col]';
            $shortcodes .= '[/row]';

            $shortcodes .= '[gap height="0px"]';
            $shortcodes .= '[gap height="75px"]';

            $shortcodes .= '[row style="collapse"]';
            $shortcodes .= '[col span__sm="12" padding__sm="0px 10px 0px 10px" padding__md="0px 10px 0px 10px" margin="0px 0px -250px 0px" align="center" animate="fadeInUp"]';
            $shortcodes .= '[ux_text text_color="rgb(255,255,255)"]';
            $shortcodes .= '<h2>Daily Specials</h2>';
            $shortcodes .= '[/ux_text]';

            // Daily Specials would go here
            $shortcodes .= '[row_inner]';
            $shortcodes .= '[col_inner span__sm="12" padding="30px 30px 30px 30px" align="center" bg_color="rgb(255,255,255)" bg_radius="12" animate="fadeInUp" depth="5"]';
            $shortcodes .= '[/col_inner]';
            $shortcodes .= '[/row_inner]';

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