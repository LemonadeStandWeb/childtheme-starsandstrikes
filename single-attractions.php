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
                    $ls_attraction_availability = get_field('ls_attraction_location_availability');
                    $ls_attraction_image = get_the_post_thumbnail_url();
                    $ls_attraction_name = get_the_title();
                    $current_attraction = get_the_ID();
                    $shortcodes = '';

                    $shortcodes .= '[section bg="'. $ls_attraction_image .'" bg_size="original" bg_color="#1c457a" bg_overlay="rgba(0,0,0,.5)" dark="true" padding="125px" padding__sm="57px" divider="triangle-invert" divider_height="90px" divider_height__sm="40px" divider_height__md="60px" divider_fill="#fcfbfc"]';
                    $shortcodes .= '[gap height="155px" height__md="116px"]';
                    $shortcodes .= '[row]';
                    $shortcodes .= '[col span__sm="12" align="center"]';
                    $shortcodes .= '[ux_text font_size="1.85" font_size__sm="1.2" font_size__md="1.6"]';
                    $shortcodes .= '<h1 class="mb-0 uppercase">'. $ls_attraction_name .'</h1>';
                    $shortcodes .= '[/ux_text]';
                    $shortcodes .= '[/col]';
                    $shortcodes .= '[/row]';
                    $shortcodes .= '[/section]';

                    $shortcodes .= '[section bg="694" bg_size="original" bg_overlay="rgba(255, 255, 255, 0.291)" bg_pos="81% 0%" padding="80px" padding__md="49px"]';
                    $shortcodes .= '[row h_align="center"]';

                    $shortcodes .= '[col span="8" span__sm="12" span__md="10" padding="0px 50px 0px 0px" padding__md="0px 0px 0px 0px"]';

                    $shortcodes .= '[ux_text font_size="1.05" line_height="1.85"]';
                    $shortcodes .= '<h2>This is a simple headline</h2>';
                    $shortcodes .= '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy</p>';
                    $shortcodes .= '<p>nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat v</p>';
                    $shortcodes .= '<p>olutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Lorem ipsum dolor sit amet, consecte</p>';
                    $shortcodes .= '<p>tuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>';
                    $shortcodes .= '[/ux_text]';

                    $shortcodes .= '[/col]';

                    $shortcodes .= '[col span="4" span__sm="12" span__md="10" sticky="true"]';
                    $shortcodes .= '[row_inner]';
                    $shortcodes .= '[col_inner span__sm="12" padding="30px 30px 20px 30px" bg_color="#f0f0f0" bg_radius="10"]';

                    $shortcodes .= '[ux_text text_align="center"]';
                    $shortcodes .= '<h2>All Attractions</h2>';
                    $shortcodes .= '[/ux_text]';

                    $shortcodes .= '[row_inner_1 style="small" col_bg_radius="10" v_align="equal" depth="5"]';

                    $attractions_args = array(
                        'post_type' => 'attractions',
                        'posts_per_page' => -1
                    );

                    $attractions_query = new WP_Query($attractions_args);

                    if ($attractions_query->have_posts()) {
                        while ($attractions_query->have_posts()) {
                            $attractions_query->the_post();
                            $attractions_post_link = get_the_permalink();
                            $attractions_post_title = get_the_title();
                            $attractions_post_icon = get_field('ls_attraction_gradient_icon');
                            $attractions_post_image = get_the_post_thumbnail_url();


                            $shortcodes .= '[col_inner_1 span="6" span__sm="12" span__md="4" padding="20px 0px 20px 0px" bg_color="rgb(59, 45, 116)" class="show-radius clickable-card"]';
                            $shortcodes .= '[ux_image id="'. $attractions_post_image . '" class="fill"]';
                            $shortcodes .= '[ux_html]';
                            $shortcodes .= '<a href="' . $attractions_post_link . '" class="clickable-card-link"></a>';
                            $shortcodes .= '[/ux_html]';
                            $shortcodes .= '[featured_box img="'. $attractions_post_icon .'" inline_svg="0" img_width="40" pos="center"]';
                            $shortcodes .= '[ux_text font_size="0.9" text_align="center" text_color="rgb(255,255,255)" class="relative"]';
                            $shortcodes .= '<p class="mb-0"><strong>' . $attractions_post_title . '</strong></p>';
                            $shortcodes .= '[/ux_text]';
                            $shortcodes .= '[/featured_box]';
                            $shortcodes .= '[/col_inner_1]';
                        }
                    }

                    wp_reset_postdata();

                    $shortcodes .= '[/row_inner_1]';

                    $shortcodes .= '[/col_inner]';
                    $shortcodes .= '[/row_inner]';
                    $shortcodes .= '[/col]';
                    $shortcodes .= '[/row]';
                    $shortcodes .= '[/section]';
                    $shortcodes .= '[block id="35"]';
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