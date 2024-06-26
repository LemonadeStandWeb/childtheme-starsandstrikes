<?php
/*
Template name: Attractions Single
*/ ?>

<!-- Bring in the transparent header with light text -->
<?php get_template_part('templates/parts/ls-cpt-header'); ?>

<?php do_action('flatsome_after_header'); ?>

<main id="main" class="<?php flatsome_main_classes(); ?>">

    <?php do_action('flatsome_before_page'); ?>

    <div id="content" role="main">

        <?php while (have_posts()) : the_post(); ?>

            <?php
            // Capture the content from the editor
            ob_start();
            the_content();
            $content = ob_get_clean();

            // Declare variables
            $ls_attraction_availability = get_field('ls_attraction_location_availability');
            $ls_attraction_image = get_the_post_thumbnail_url();
            $ls_attraction_name = get_the_title();
            $current_attraction = get_the_ID();
            $shortcodes = '';

            // Header Section
            $shortcodes .= '[section bg="' . $ls_attraction_image . '" bg_size="original" bg_color="#1c457a" bg_overlay="rgba(0,0,0,.5)" dark="true" padding="125px" padding__sm="57px" divider="triangle-invert" divider_height="90px" divider_height__sm="40px" divider_height__md="60px" divider_fill="#fcfbfc"]';
            $shortcodes .= '[gap height="155px" height__md="116px"]';
            $shortcodes .= '[row]';
            $shortcodes .= '[col span__sm="12" align="center"]';
            $shortcodes .= '[ux_text font_size="1.85" font_size__sm="1.2" font_size__md="1.6"]';
            $shortcodes .= '<h1 class="mb-0 uppercase">' . $ls_attraction_name . '</h1>';
            $shortcodes .= '[/ux_text]';
            $shortcodes .= '[/col]';
            $shortcodes .= '[/row]';
            $shortcodes .= '[/section]';

            // Content Section
            $shortcodes .= '[section class="background-repeat" bg_overlay="rgba(255, 255, 255, 0.291)" padding="80px" padding__md="49px"]';
            $shortcodes .= '[row h_align="center"]';

            // Display Specials content
            $shortcodes .= '[col span="8" span__sm="12" span__md="10" padding="0px 50px 0px 0px" padding__md="0px 0px 0px 0px"]';
            $shortcodes .= $content;
            $shortcodes .= '[/col]';

            // Sticky column to the right
            $shortcodes .= '[col span="4" span__sm="12" span__md="10" sticky="true" sticky_mode="javascript"]';
            $shortcodes .= '[row_inner]';
            $shortcodes .= '[col_inner span__sm="12" padding="30px 30px 20px 30px" bg_color="#f0f0f0" bg_radius="10"]';

            $shortcodes .= '[ux_text text_align="center"]';
            $shortcodes .= '<h2>All Attractions</h2>';
            $shortcodes .= '[/ux_text]';

            $shortcodes .= '[row_inner_1 style="small" col_bg_radius="10" v_align="equal" depth="5"]';

            // Query all Attractions posts
            $attractions_args = array(
                'post_type' => 'attractions',
                'posts_per_page' => -1
            );

            $attractions_query = new WP_Query($attractions_args);

            if ($attractions_query->have_posts()) {
                while ($attractions_query->have_posts()) {
                    // Grab post data  
                    $attractions_query->the_post();
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
            }

            wp_reset_postdata();

            // Close out opening tags
            $shortcodes .= '[/row_inner_1]';
            $shortcodes .= '[/col_inner]';
            $shortcodes .= '[/row_inner]';
            $shortcodes .= '[/col]';

            $shortcodes .= '[/row]';
            $shortcodes .= '[/section]';

            // Display CTA
            $shortcodes .= '[block id="35"]';
            ?>

            <?php
            echo do_shortcode($shortcodes);
            ?>

        <?php endwhile;?>
    </div>

    <?php do_action('flatsome_after_page'); ?>

    <?php get_footer(); ?>