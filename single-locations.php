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

                    <?php

                    // Declare variables
                    $ls_location_name = get_the_title();
                    $ls_location_image = get_the_post_thumbnail_url();
                    $ls_location_address = esc_attr( get_field( 'ls_locations_location_address' ) );
                    $ls_location_phone = get_field( 'ls_locations_phone_number' );
                    $ls_location_phone = preg_replace('/[^0-9]/', '', $ls_location_phone);
                    $ls_location_event_link = get_field( 'ls_locations_plan_an_event_link' );
                    $ls_location_lane_link = get_field( 'ls_locations_reserve_a_lane_link' );
                    $ls_location_hours = get_field( 'ls_locations_hours' );
                    $ls_attraction_availability = get_field( 'ls_attraction_location_availability' );

                    $shortcodes = '';

                    $shortcodes .= '[section bg="' . $ls_location_image . '" bg_size="original" bg_overlay="rgba(29, 68, 122, 0.5)" padding="100px" class="stars-bg"]';
                    $shortcodes .= '[row]';
                    $shortcodes .= '[col span="8" span__sm="12" margin="200px 0px 0px 0px" margin__sm="50px 0px 0px 0px" align="left" color="light" animate="fadeInLeft"]';
                    $shortcodes .= '[ux_text font_size="2.4" font_size__sm="1.15"]';
                    $shortcodes .= '<h1 class="mb-0 uppercase">' . $ls_location_name . '</h1>';
                    $shortcodes .= '[/ux_text]';
                    $shortcodes .= '[button text="Map Location" style="link" size="large" icon="icon-map-pin-fill" icon_pos="left" link="' . $ls_location_address . '" target="_blank" class="text-yellow"]';
                    $shortcodes .= '[button text="Call Us" style="link" size="large" icon="icon-phone" icon_pos="left" link="tel:+1' . $ls_location_phone . '" class="text-yellow"]';
                    $shortcodes .= '[gap height="20px"]';
                    $shortcodes .= '[row_inner style="small"]';
                    $shortcodes .= '[col_inner span="4" span__sm="12" span__md="12"]';
                    $shortcodes .= '[button text="Plan An Event" size="large" expand="true" class="gradient-blue" link="' . $ls_location_event_link . '"]';
                    $shortcodes .= '[/col_inner]';
                    $shortcodes .= '[col_inner span="4" span__sm="12" span__md="12"]';
                    $shortcodes .= '[button text="Reserve a Lane" size="large" expand="true" class="gradient-blue" link="' . $ls_location_lane_link . '"]';
                    $shortcodes .= '[/col_inner]';
                    $shortcodes .= '[/row_inner]';
                    $shortcodes .= '[/col]';
                    $shortcodes .= '[col span="4" span__sm="12" margin="200px 0px 0px 0px" margin__sm="0px 0px 0px 0px" color="light" animate="fadeInRight"]';
                    $shortcodes .= '[title style="center" text="Hours" tag_name="h4" class="mb-0"]';
                    $shortcodes .= '[row_inner]';
                    $shortcodes .= '[col_inner span__sm="12" padding="10px 20px 10px 20px" align="center" bg_color="rgba(0, 0, 0, 0.5)" bg_radius="10" color="light" class="box-glow"]';

                    // Display Hours Table
                    if ( have_rows( 'ls_locations_hours' ) ) {

                        $shortcodes .= '<table class="hours__table">';
                        $shortcodes .= '<tbody>';

                        while ( have_rows( 'ls_locations_hours' ) ) {

                            the_row();

                            // Grab subfields
                            $day = get_sub_field( 'ls_locations_repeater_title' );
                            $hours = get_sub_field( 'ls_locations_repeater_hours' );

                            $shortcodes .= '<tr>';
                            $shortcodes .= '<td><strong>' . $day . '</strong></td>';
                            $shortcodes .= '<td>' . $hours . '</td>';
                            $shortcodes .= '</tr>';
                        }
                    } else {
                        $shortcodes .= '<p>No hours available. Please call us for availability!</p>';
                    }

                    // Close the table
                    $shortcodes .= '</tbody>';
                    $shortcodes .= '</table>';
                    $shortcodes .= '[/col_inner]';

                    // Follow icons
                    $shortcodes .= '[col_inner span__sm="12" align="center"]';
                    $shortcodes .= '[follow]';
                    $shortcodes .= '[/col_inner]';

                    // Close Hours row
                    $shortcodes .= '[/row_inner]';
                    $shortcodes .= '[/col]';
                    $shortcodes .= '[/row]';

                    $shortcodes .= '[gap height="0px"]';

                    // Attractions Row
                    $shortcodes .= '[row style="collapse" class="z1 relative"]';
                    $shortcodes .= '[col span__sm="12" bg_radius="12" animate="fadeInUp"]';
                    $shortcodes .= '[ux_stack direction__sm="col" distribute="center" align="center" align__sm="stretch" class="mb-0"]';

                    $current_location = get_the_ID();

                    $args = array(
                        'post_type' => 'attractions',
                        'posts_per_page' => -1,
                        'meta_query' => array(
                            array(
                                'key' => 'ls_attraction_location_availability', // name of custom field
                                'value' => '"' . $current_location . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
                                'compare' => 'LIKE'
                            )
                        )
                    );

                    $attractions_query = new WP_Query( $args );

                    if ( $attractions_query->have_posts() ) {

                        while ( $attractions_query->have_posts() ) {
                            $attractions_query->the_post();

                            $ls_attraction_name = get_the_title();
                            $ls_attraction_icon = get_field( 'ls_attraction_icon' );
                            $ls_attraction_link = get_the_permalink();

                            $shortcodes .= '[row_inner]';

                            $shortcodes .= '[col_inner span__sm="12" padding="10px 10px 10px 10px" bg_color="rgba(0, 0, 0, 0.5)" bg_radius="12" class="box-glow"]';
                            $shortcodes .= '[featured_box img="' . $ls_attraction_icon . '" pos="center" tooltip="' . $ls_attraction_name . '" font_size="xsmall" icon_color="rgb(247, 213, 77)" class="simple"]';
                            $shortcodes .= '[/featured_box]';
                            $shortcodes .= '[/col_inner]';

                            $shortcodes .= '[/row_inner]';
                        }
                    } else {
                        $shortcodes .= '<p>Please call us to ask about all available attractions!</p>';
                    }

                    $shortcodes .= '[/ux_stack]';

                    // 'Activities Available' Text
                    $shortcodes .= '[row_inner style="collapse" class="my-0"]';
                    $shortcodes .= '[col_inner span__sm="12" margin="-24px 0px 0px 0px"]';
                    $shortcodes .= '[ux_text font_size="0.85" text_align="center" text_color="rgb(255,255,255)"]';
                    $shortcodes .= '<p class="my-0">Activities Available</p>';
                    $shortcodes .= '[/ux_text]';
                    $shortcodes .= '[/col_inner]';
                    $shortcodes .= '[/row_inner]';

                    // Close Attractions Row
                    $shortcodes .= '[/col]';
                    $shortcodes .= '[/row]';

                    $shortcodes .= '[gap height="75px"]';

                    // Daily Specials
                    $shortcodes .= '[row style="collapse"]';

                    $shortcodes .= '[col span__sm="12" padding__sm="0px 10px 0px 10px" padding__md="0px 10px 0px 10px" margin="0px 0px -250px 0px" align="center" color="light" animate="fadeInUp"]';

                    $shortcodes .= '<h2>Daily Specials</h2>';
                    $shortcodes .= '[row_inner]';

                    $shortcodes .= '[col_inner span__sm="12" padding="30px 30px 30px 30px" align="center" bg_radius="12" color="light" animate="fadeInUp" depth="5" class="gradient-blue-col"]';

                    $shortcodes .= '[tabgroup style="pills" nav_size="xlarge" align="center" class="custom-tabs"]';

                    $shortcodes .= '[tab title="Sunday"]';

                    $shortcodes .= '[row_inner_1]';

                    $shortcodes .= '[col_inner_1 span__sm="12" bg_radius="10" color="light"]';

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