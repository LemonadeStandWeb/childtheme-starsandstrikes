<?php
/*
Template name: Location Page - Full Width - Transparent Header - Light Text
*/ ?>

<!DOCTYPE html>
<!--[if IE 9 ]> <html <?php language_attributes(); ?> class="ie9 <?php flatsome_html_classes(); ?>"> <![endif]-->
<!--[if IE 8 ]> <html <?php language_attributes(); ?> class="ie8 <?php flatsome_html_classes(); ?>"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?> class="<?php flatsome_html_classes(); ?>"> <!--<![endif]-->

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php do_action('flatsome_after_body_open'); ?>
    <?php wp_body_open(); ?>

    <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e('Skip to content', 'flatsome'); ?></a>

    <div id="wrapper">

        <?php do_action('flatsome_before_header'); ?>

        <header id="header" class="header header transparent has-transparent <?php flatsome_header_classes(); ?>">
            <div class="header-wrapper">
                <div id="masthead" class="header-main nav-dark toggle-nav-dark <?php header_inner_class('main'); ?>">
                    <div class="header-inner flex-row container <?php flatsome_logo_position(); ?>" role="navigation">

                        <!-- Logo -->
                        <div id="logo" class="flex-col logo">
                            <?php get_template_part('template-parts/header/partials/element', 'logo'); ?>
                        </div>

                        <!-- Mobile Left Elements -->
                        <div class="flex-col show-for-medium flex-left">
                            <ul class="mobile-nav nav nav-left <?php flatsome_nav_classes('main-mobile'); ?>">
                                <?php flatsome_header_elements('header_mobile_elements_left', 'mobile'); ?>
                            </ul>
                        </div>

                        <!-- Left Elements -->
                        <div class="flex-col hide-for-medium flex-left
<?php if (get_theme_mod('logo_position', 'left') == 'left') echo 'flex-grow'; ?>">
                            <ul class="header-nav header-nav-main nav nav-left <?php flatsome_nav_classes('main'); ?>">
                                <?php flatsome_header_elements('header_elements_left'); ?>
                            </ul>
                        </div>

                        <!-- Right Elements -->
                        <div class="flex-col hide-for-medium flex-right">
                            <ul class="header-nav header-nav-main nav nav-right <?php flatsome_nav_classes('main'); ?>">
                                <?php flatsome_header_elements('header_elements_right'); ?>
                            </ul>
                        </div>

                        <!-- Mobile Right Elements -->
                        <div class="flex-col show-for-medium flex-right">
                            <ul class="mobile-nav nav nav-right <?php flatsome_nav_classes('main-mobile'); ?>">
                                <?php flatsome_header_elements('header_mobile_elements_right', 'mobile'); ?>
                            </ul>
                        </div>

                    </div><!-- .header-inner -->

                    <?php if (get_theme_mod('header_divider', 1)) { ?>
                        <!-- Header divider -->
                        <div class="container">
                            <div class="top-divider full-width"></div>
                        </div>
                    <?php } ?>
                </div><!-- .header-main -->
            </div><!-- header-wrapper-->
        </header>

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
                    $ls_location_address = esc_attr(get_field('ls_locations_location_address'));
                    $ls_location_phone = get_field('ls_locations_phone_number');
                    $ls_location_phone = preg_replace('/[^0-9]/', '', $ls_location_phone);
                    $ls_location_event_link = get_field('ls_locations_plan_an_event_link');
                    $ls_location_lane_link = get_field('ls_locations_reserve_a_lane_link');
                    $ls_location_hours = get_field('ls_locations_hours');
                    $ls_attraction_availability = get_field('ls_attraction_location_availability');
                    $current_location = get_the_ID();

                    $shortcodes = '';

                    $shortcodes .= '[section bg="164" bg_size="original" bg_overlay="rgba(12, 35, 66, 0.797)" padding="100px" video_mp4="/wp-content/uploads/2024/02/placeholder.mp4"]';
                    $shortcodes .= '[gap height="164px" height__md="108px"]';
                    $shortcodes .= '[row h_align="center"]';
                    $shortcodes .= '[col span="8" span__sm="12" span__md="10" padding="0px 50px 0px 0px" padding__sm="0px 0px 0px 0px" padding__md="0px 0px 0px 0px" align="left" color="light" animate="fadeInLeft"]';
                    $shortcodes .= '[ux_text font_size="2.4" font_size__sm="1.15"]';
                    $shortcodes .= '<h1 class="mb-0 uppercase">' . $ls_location_name . '</h1>';
                    $shortcodes .= '[/ux_text]';

                    $shortcodes .= '[gap height="20px"]';

                    $shortcodes .= '[row_inner style="small"]';
                    $shortcodes .= '[col_inner span="4" span__sm="12" span__md="12"]';
                    $shortcodes .= '[button text="Book a Party" color="alert" size="large" expand="true"]';
                    $shortcodes .= '[/col_inner]';
                    $shortcodes .= '[col_inner span="4" span__sm="12" span__md="12"]';
                    $shortcodes .= '[button text="Reserve a Lane" color="success" size="large" expand="true"]';
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
                        $shortcodes .= '<p>Please call us to ask about all available attractions!</p>';
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

                    $shortcodes .= '[featured_box img="849" img_width="25" pos="left" tooltip="Please note: Due to a private event on February 7th (Wednesday), our center will close to the public at 5pm. We apologize for any invonvenience." icon_color="#f04c36" class="align-icons"]';
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
                    $shortcodes .= '[row_inner]';
                    $shortcodes .= '[col_inner span__sm="12" padding="30px 30px 30px 30px" align="center" bg_color="rgb(255,255,255)" bg_radius="12" animate="fadeInUp" depth="5"]';
                    $shortcodes .= '[tabgroup style="bold" nav_style="normal" nav_size="large" align="center" class="custom-tabs"]';

                    $shortcodes .= '[tab title="Sunday"]';
                    $shortcodes .= '[row_inner_1]';
                    $shortcodes .= '[col_inner_1 span__sm="12" bg_radius="10"]';
                    $shortcodes .= '<p>Sunday: Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>';
                    $shortcodes .= '[/col_inner_1]';
                    $shortcodes .= '[/row_inner_1]';
                    $shortcodes .= '[/tab]';

                    $shortcodes .= '[tab title="Monday"]';
                    $shortcodes .= '[row_inner_1]';
                    $shortcodes .= '[col_inner_1 span__sm="12" bg_radius="10"]';
                    $shortcodes .= '<p>Monday: Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>';
                    $shortcodes .= '[/col_inner_1]';
                    $shortcodes .= '[/row_inner_1]';
                    $shortcodes .= '[/tab]';

                    $shortcodes .= '[tab title="Tuesday"]';
                    $shortcodes .= '[row_inner_1]';
                    $shortcodes .= '[col_inner_1 span__sm="12" bg_radius="10"]';
                    $shortcodes .= '<p>Tuesday: Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>';
                    $shortcodes .= '[/col_inner_1]';
                    $shortcodes .= '[/row_inner_1]';
                    $shortcodes .= '[/tab]';

                    $shortcodes .= '[tab title="Wednesday"]';
                    $shortcodes .= '[row_inner_1]';
                    $shortcodes .= '[col_inner_1 span__sm="12" bg_radius="10"]';
                    $shortcodes .= '<p>Wednesday: Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>';
                    $shortcodes .= '[/col_inner_1]';
                    $shortcodes .= '[/row_inner_1]';
                    $shortcodes .= '[/tab]';

                    $shortcodes .= '[tab title="Thursday"]';
                    $shortcodes .= '[row_inner_1]';
                    $shortcodes .= '[col_inner_1 span__sm="12" bg_radius="10"]';
                    $shortcodes .= '<p>Thursday: Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>';
                    $shortcodes .= '[/col_inner_1]';
                    $shortcodes .= '[/row_inner_1]';
                    $shortcodes .= '[/tab]';

                    $shortcodes .= '[tab title="Friday"]';
                    $shortcodes .= '[row_inner_1]';
                    $shortcodes .= '[col_inner_1 span__sm="12" bg_radius="10"]';
                    $shortcodes .= '<p>Friday: Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>';
                    $shortcodes .= '[/col_inner_1]';
                    $shortcodes .= '[/row_inner_1]';
                    $shortcodes .= '[/tab]';

                    $shortcodes .= '[tab title="Saturday"]';
                    $shortcodes .= '[row_inner_1]';
                    $shortcodes .= '[col_inner_1 span__sm="12" bg_radius="10"]';
                    $shortcodes .= '<p>Saturday: Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>';
                    $shortcodes .= '[/col_inner_1]';
                    $shortcodes .= '[/row_inner_1]';
                    $shortcodes .= '[/tab]';

                    $shortcodes .= '[/tabgroup]';
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