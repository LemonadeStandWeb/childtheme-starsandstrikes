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

            $shortcodes .= '[/section]';

            // Specials Section
            $shortcodes .= '[section bg="694" bg_size="original" padding="79px"]';
            $shortcodes .= '[row style="collapse" width="full-width" v_align="middle" h_align="center"]';

            $shortcodes .= '[col span="5" span__sm="12" span__md="10" padding__md="0px 30px 0px 30px" max_width="450px" max_width__md="100%"]';
            $shortcodes .= '[ux_text font_size="1.4"]';
            $shortcodes .= '<h2 class="mb-0">Specials</h2>';
            $shortcodes .= '[/ux_text]';
            $shortcodes .= '[ux_text font_size="1.2"]';
            $shortcodes .= '<p><strong>Save big when you get away and play.</strong></p>';
            $shortcodes .= '[/ux_text]';
            $shortcodes .= '<p>Save on fun at Stars and Strikes. Our specials make it easier than ever to have fun with your friends and family. Click to learn more about each special. We’ll see you soon!</p>';
            $shortcodes .= '[/col]';

            $shortcodes .= '[col span="7" span__sm="12" span__md="10" padding="0px 0px 0px 60px" padding__md="0px 0px 0px 0px"]';
            $shortcodes .= '[ux_slider style="focus" slide_width="40%" slide_width__sm="100%" slide_width__md="60%" slide_align="left" hide_nav="true" nav_pos="outside" nav_style="simple" nav_color="dark" class="specials-slider"]';
            
            $shortcodes .= '[row_inner]';
            $shortcodes .= '[col_inner span__sm="12" bg_color="rgb(255,255,255)" class="special-clickable-card  gradient-card"]';
            $shortcodes .= '[ux_html]';
            $shortcodes .= '<div class="special-box">Everyday Deal</div>';
            $shortcodes .= '<a href="/" class="clickable-card-link"></a>';
            $shortcodes .= '[/ux_html]';
            $shortcodes .= '[ux_image id="645"]';
            $shortcodes .= '[row_inner_1]';
            $shortcodes .= '[col_inner_1 span__sm="12" padding="30px 30px 0px 30px"]';
            $shortcodes .= '<h4>Stay N\' Play Combo</h4>';
            $shortcodes .= '<p>Pick your dish and enjoy a $10 or $20 Arcade Game Card for one low price!</p>';
            $shortcodes .= '[button text="Learn More" color="alert" style="link" expand="0" icon="icon-angle-right"]';
            $shortcodes .= '[/col_inner_1]';
            $shortcodes .= '[/row_inner_1]';
            $shortcodes .= '[/col_inner]';
            $shortcodes .= '[/row_inner]';

            $shortcodes .= '[row_inner]';
            $shortcodes .= '[col_inner span__sm="12" bg_color="rgb(255,255,255)" class="special-clickable-card  red-card"]';
            $shortcodes .= '[ux_html]';
            $shortcodes .= '<div class="special-box">Sunday Deal</div>';
            $shortcodes .= '<a href="/" class="clickable-card-link"></a>';
            $shortcodes .= '[/ux_html]';
            $shortcodes .= '[ux_image id="645"]';
            $shortcodes .= '[row_inner_1]';
            $shortcodes .= '[col_inner_1 span__sm="12" padding="30px 30px 0px 30px"]';
            $shortcodes .= '<h4>Sunday Morning Specials</h4>';
            $shortcodes .= '<p>Enjoy $1.99 bowling and $1.99 shoe rental from open until noon.</p>';
            $shortcodes .= '[button text="Learn More" color="alert" style="link" expand="0" icon="icon-angle-right"]';
            $shortcodes .= '[/col_inner_1]';
            $shortcodes .= '[/row_inner_1]';
            $shortcodes .= '[/col_inner]';
            $shortcodes .= '[/row_inner]';

            $shortcodes .= '[row_inner]';
            $shortcodes .= '[col_inner span__sm="12" bg_color="rgb(255,255,255)" class="special-clickable-card  red-card"]';
            $shortcodes .= '[ux_html]';
            $shortcodes .= '<div class="special-box">Sunday Deal</div>';
            $shortcodes .= '<a href="/" class="clickable-card-link"></a>';
            $shortcodes .= '[/ux_html]';
            $shortcodes .= '[ux_image id="645"]';
            $shortcodes .= '[row_inner_1]';
            $shortcodes .= '[col_inner_1 span__sm="12" padding="30px 30px 0px 30px"]';
            $shortcodes .= '<h4>Sunday Night Half Price Specials</h4>';
            $shortcodes .= '<p>Half Price Hourly Bowling, Arcade Games, and Attractions from 8pm to Close!</p>';
            $shortcodes .= '[button text="Learn More" color="alert" style="link" expand="0" icon="icon-angle-right"]';
            $shortcodes .= '[/col_inner_1]';
            $shortcodes .= '[/row_inner_1]';
            $shortcodes .= '[/col_inner]';
            $shortcodes .= '[/row_inner]';

            $shortcodes .= '[row_inner]'; 
            $shortcodes .= '[col_inner span__sm="12" bg_color="rgb(255,255,255)" class="special-clickable-card  maroon-card"]';      
            $shortcodes .= '[ux_html]';
            $shortcodes .= '<div class="special-box">Monday Deal</div>';
            $shortcodes .= '<a href="/" class="clickable-card-link"></a>';
            $shortcodes .= '[/ux_html]';
            $shortcodes .= '[ux_image id="645"]';
            $shortcodes .= '[row_inner_1]'; 
            $shortcodes .= '[col_inner_1 span__sm="12" padding="30px 30px 0px 30px"]';  
            $shortcodes .= '<h4>Monday Night Bowling</h4>';
            $shortcodes .= '<p>Enjoy $1.99 bowling and $1.99 shoe rental from open until noon.</p>';
            $shortcodes .= '[button text="Learn More" color="alert" style="link" expand="0" icon="icon-angle-right"]';  
            $shortcodes .= '[/col_inner_1]';     
            $shortcodes .= '[/row_inner_1]';    
            $shortcodes .= '[/col_inner]';
            $shortcodes .= '[/row_inner]';

            $shortcodes .= '[row_inner]';
            $shortcodes .= '[col_inner span__sm="12" bg_color="rgb(255,255,255)" class="special-clickable-card  purple-card"]';
            $shortcodes .= '[ux_html]';
            $shortcodes .= '<div class="special-box">Tuesday Deal</div>';
            $shortcodes .= '<a href="/" class="clickable-card-link"></a>';
            $shortcodes .= '[/ux_html]';
            $shortcodes .= '[ux_image id="645"]';
            $shortcodes .= '[row_inner_1]';
            $shortcodes .= '[col_inner_1 span__sm="12" padding="30px 30px 0px 30px"]';
            $shortcodes .= '<h4>Unlimited Tuesdays</h4>';
            $shortcodes .= '<p>Unlimited play lets you play all day! The best part is, you choose the activity to play for one low price.</p>';
            $shortcodes .= '[button text="Learn More" color="alert" style="link" expand="0" icon="icon-angle-right"]';
            $shortcodes .= '[/col_inner_1]';
            $shortcodes .= '[/row_inner_1]';
            $shortcodes .= '[/col_inner]';
            $shortcodes .= '[/row_inner]';

            $shortcodes .= '[row_inner]';
            $shortcodes .= '[col_inner span__sm="12" bg_color="rgb(255,255,255)" class="special-clickable-card  dark-blue-card"]';
            $shortcodes .= '[ux_html]';       
            $shortcodes .= '<div class="special-box">Wednesday Deal</div>';
            $shortcodes .= '<a href="/" class="clickable-card-link"></a>';
            $shortcodes .= '[/ux_html]';
            $shortcodes .= '[ux_image id="645"]';       
            $shortcodes .= '[row_inner_1]';      
            $shortcodes .= '[col_inner_1 span__sm="12" padding="30px 30px 0px 30px"]';       
            $shortcodes .= '<h4>Half Price Wednesdays</h4>';
            $shortcodes .= '<p>Enjoy Half Price Bowling, Arcade Games, and Attractions from Open to Close!</p>';
            $shortcodes .= '[button text="Learn More" color="alert" style="link" expand="0" icon="icon-angle-right"]';      
            $shortcodes .= '[/col_inner_1]'; 
            $shortcodes .= '[/row_inner_1]';     
            $shortcodes .= '[/col_inner]';     
            $shortcodes .= '[/row_inner]';

            $shortcodes .= '[row_inner]';
            $shortcodes .= '[col_inner span__sm="12" bg_color="rgb(255,255,255)" class="special-clickable-card  blue-card"]';
            $shortcodes .= '[ux_html]';
            $shortcodes .= '<div class="special-box">Friday Deal</div>';
            $shortcodes .= '<a href="/" class="clickable-card-link"></a>';
            $shortcodes .= '[/ux_html]';
            $shortcodes .= '[ux_image id="645"]';
            $shortcodes .= '[row_inner_1]';
            $shortcodes .= '[col_inner_1 span__sm="12" padding="30px 30px 0px 30px"]';
            $shortcodes .= '<h4>Late Night Fridays</h4>';
            $shortcodes .= '<p>$16.99 Per Person Unlimited Games of Bowling Special</p>';
            $shortcodes .= '[button text="Learn More" color="alert" style="link" expand="0" icon="icon-angle-right"]';
            $shortcodes .= '[/col_inner_1]';
            $shortcodes .= '[/row_inner_1]';
            $shortcodes .= '[/col_inner]';
            $shortcodes .= '[/row_inner]';

            $shortcodes .= '[row_inner]';
            $shortcodes .= '[col_inner span__sm="12" bg_color="rgb(255,255,255)" class="special-clickable-card  orange-card"]';
            $shortcodes .= '[ux_html]';
            $shortcodes .= '<div class="special-box">Saturday Deal</div>';
            $shortcodes .= '<a href="/" class="clickable-card-link"></a>';
            $shortcodes .= '[/ux_html]';
            $shortcodes .= '[ux_image id="645"]';
            $shortcodes .= '[row_inner_1]';
            $shortcodes .= '[col_inner_1 span__sm="12" padding="30px 30px 0px 30px"]';
            $shortcodes .= '<h4>Saturday Night Fridays</h4>';
            $shortcodes .= '<p>$16.99 Per Person Unlimited Games of Bowling Special</p>';
            $shortcodes .= '[button text="Learn More" color="alert" style="link" expand="0" icon="icon-angle-right"]';
            $shortcodes .= '[/col_inner_1]';
            $shortcodes .= '[/row_inner_1]';
            $shortcodes .= '[/col_inner]';
            $shortcodes .= '[/row_inner]';
        
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