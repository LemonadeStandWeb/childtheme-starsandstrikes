<?php
/*
Template name: Promotions single.php
*/ ?>

<?php get_template_part('templates/parts/ls-cpt-header'); ?>

<main id="main" class="<?php flatsome_main_classes(); ?>">

    <?php do_action('flatsome_before_page'); ?>

    <div id="content" role="main">

        <?php while (have_posts()) : the_post(); ?>
            
            <?php

            /**
             * Declare variables
             * 
             * @var array  $ls_promotions_locations          Relationship  The locations where the promotion is available
             * @var string $ls_promotions_title              Text          The title of the special
             * @var string $ls_promotions_hero_image                       The hero image of the promotion
             * @var string $ls_promotions_the_content                      The editor content of the promotion
             */

            $ls_promotions_locations         = get_field( 'ls_promotions_locations' );
            $ls_promotions_title             = get_the_title();
            $ls_promotions_hero_image        = get_the_post_thumbnail_url();
            $ls_promotions_the_content       = '';

            $shortcodes = '';

            // Build the hero section shortcodes
            $shortcodes .= '[section bg="' . $ls_promotions_hero_image . '" bg_size="original" bg_color="#1c457a" bg_overlay="rgba(0,0,0,.5)" dark="true" padding="125px" padding__sm="57px" divider="triangle-invert" divider_height="90px" divider_height__sm="40px" divider_height__md="60px" divider_fill="#fcfbfc"]';
            $shortcodes .= '[gap height="155px" height__md="116px"]';
            $shortcodes .= '[row]';
            $shortcodes .= '[col span__sm="12" align="center"]';
            $shortcodes .= '[ux_text font_size="1.85" font_size__sm="1.2" font_size__md="1.6"]';
            $shortcodes .= '<h1 class="mb-0 uppercase">' . $ls_promotions_title . '</h1>';
            $shortcodes .= '[/ux_text]';
            $shortcodes .= '[/col]';
            $shortcodes .= '[/row]';
            $shortcodes .= '[/section]';

            // Build the promotions section shortcodes
            $shortcodes .= '[section class="background-repeat" bg_overlay="rgba(255, 255, 255, 0.291)" padding="80px" padding__md="49px"]';
            $shortcodes .= '[row h_align="center"]';

            // Fetch the post content and display within the column
            $shortcodes .= '[col span="8" span__sm="12" span__md="10" padding="0px 50px 0px 0px" padding__md="0px 0px 0px 0px"]';
            ob_start();
            the_content();
            $ls_promotions_the_content = ob_get_clean();
            $shortcodes .= $ls_promotions_the_content;
            $shortcodes .= '[/col]';

            // Build the sidebar section shortcodes
            $shortcodes .= '[col span="4" span__sm="12" span__md="10" sticky="true" sticky_mode="javascript"]';
            $shortcodes .= '[row_inner]';
            $shortcodes .= '[col_inner span__sm="12" padding="30px 30px 20px 30px" bg_color="#f0f0f0" bg_radius="10"]';
            $shortcodes .= '[ux_text text_align="left"]';
            $shortcodes .= '<h3>Available At:</h3>';
            $shortcodes .= '[/ux_text]';


            // If the promotion is available at a location, display the location
            if( $ls_promotions_locations ) {

                // Add the ux_menu if a location is available
                $shortcodes .= '[ux_menu divider="solid" class="small sidebar-menu"]';

                foreach( $ls_promotions_locations as $location ) {
                    // Display the title of the location and link to the location
                    $shortcodes .= '[ux_menu_link text="' . get_the_title( $location ) . '" link="' . get_the_permalink( $location ) . '"]';
                }

                // Close the ux_menu
                $shortcodes .= '[/ux_menu]';

            } else {
                // If no locations are available, display a message
                $shortcodes .= '<p>No locations available at this time. Please call for more information.</p>';
            }

            // Close the inner column and row
            $shortcodes .= '[/col_inner]';
            $shortcodes .= '[/row_inner]';

            // Display Join the VIP Club ux_block
            $shortcodes .= '[block id="998"]';

            // Close out the rest of the section
            $shortcodes .= '[/col]';
            $shortcodes .= '[/row]';
            $shortcodes .= '[/section]';

            // Display the CTA ux_block
            $shortcodes .= '[block id="35"]';
            ?>

            <?php
            // Display the shortcodes
            echo do_shortcode($shortcodes);
            ?>

        <?php endwhile;

        ?>
    </div>

    <?php do_action('flatsome_after_page'); ?>
    

    <?php get_footer(); ?>

    

  