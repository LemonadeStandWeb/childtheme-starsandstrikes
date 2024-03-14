<?php

// Custom Post Types
include('inc/ls-custom-post-types/ls-cpt-attractions.php');
include('inc/ls-custom-post-types/ls-cpt-locations.php');
include('inc/ls-custom-post-types/ls-cpt-promotions.php');
include('inc/ls-custom-post-types/ls-cpt-specials.php');

// Custom Shortcodes
include('inc/ls-shortcodes/ls-shortcode-attractions.php');
include('inc/ls-shortcodes/ls-shortcode-promotions.php');
include('inc/ls-shortcodes/ls-shortcode-specials.php');

// Disable WordPress Administration email verification prompt 
add_filter( 'admin_email_check_interval', '__return_false' );

//Remove Gravity Forms Label "* Indicates Required"
add_filter( 'gform_required_legend', '__return_empty_string' );

//Add Bootstraps
add_action( 'wp_enqueue_scripts', function(){

    wp_register_style( 'bootstrap_utils', 'https://cdn.jsdelivr.net/npm/bootstrap-utilities@4.1.3/bootstrap-utilities.min.css' );
    wp_enqueue_style( 'bootstrap_utils' );

    // wp_register_script( 'popperjs', 'https://unpkg.com/@popperjs/core@2' );
    wp_enqueue_script( 'popperjs', 'https://unpkg.com/@popperjs/core@2', '', '', FALSE );

    // wp_register_script( 'tippyjs', 'https://unpkg.com/tippy.js@6' );
    wp_enqueue_script( 'tippyjs', 'https://unpkg.com/tippy.js@6', '', '', FALSE );

}, 100 );

function activities_handler($atts, $content = null, $tag = '' ) {

    extract(shortcode_atts([], $atts));

    ob_start();

    $activities = '<select class="custom">';
    $activities .= '<option class="option">BOWLING</option>';
    // $activities .= '<option class="option">ARCADE</option>';
    // $activities .= '<option class="option">AXE THROWING</option>';
    // $activities .= '<option class="option">LASER TAG</option>';
    // $activities .= '<option class="option">ESCAPOLOGY</option>';
    // $activities .= '<option class="option">BUMPER CARS</option>';
    // $activities .= '<option class="option">AUGMENTED REALITY BOWLING</option>';
    // $activities .= '<option class="option">VIRTUAL REALITY</option>';
    $activities .= '</select>';

    $locations = '<select class="custom">';
    $locations .= '<option class="option">AUGUSTA, GA</option>';
    $locations .= '</select>';

    $stack = '[ux_stack distribute="center" align="center" gap="1.5"]';
    $stack .= '[ux_text]<p class="my-0" style=font-size:1.2em;><b>I want to do...</b><p>[/ux_text]';
    $stack .= '[button text="BOWLING" style="link" icon="icon-angle-down" color="primary" class="select-button text-yellow activity" icon_pos="right"]';
    $stack .= '[ux_text]<p class="my-0" style=font-size:1.2em;><b>at</b><p>[/ux_text]';
    $stack .= '[button text="AUGUSTA, GA" style="link" icon="icon-angle-down" color="primary" class="select-button text-yellow location" icon_pos="right"]';
    $stack .= '[button text="GO" color="primary" class="white"]';
    $stack .= '[/ux_stack]';
    ?>

    <?= do_shortcode($stack);?>

    <script>
        var selectedActivity = 'bowling';
        var selectedLocation = 1;
        var locations = [
            {id: 1, name: 'Augusta, GA', link: ''},
            {id: 2, name: 'Buford, GA', link: ''},
            {id: 3, name: 'Columbus, GA', link: ''},
            {id: 4, name: 'Concord, NC', link: ''},
            {id: 5, name: 'Cumming, GA', link: ''},
            {id: 6, name: 'Dacula, GA', link: ''},
            {id: 7, name: 'Dallas, GA', link: ''},
            {id: 8, name: 'Huntsville, AL', link: ''},
            {id: 9, name: 'Irmo, SC', link: ''},
            {id: 10, name: 'Lawrenceville, GA', link: ''},
            {id: 11, name: 'Loganville, GA', link: ''},
            {id: 12, name: 'Myrtle Beach, SC', link: ''},
            {id: 13, name: 'Raleigh, NC', link: ''},
            {id: 14, name: 'Rock Hill, SC', link: ''},
            {id: 15, name: 'Smyrna, TN', link: ''},
            {id: 16, name: 'Stone Mountain, GA', link: ''},
            {id: 17, name: 'Summerville, SC', link: ''},
            {id: 18, name: 'Woodstock, GA', link: ''}
        ];
        var locationsMap = {
            'bowling': {label: 'Bowling', locations: [0]},
            'arcade': {label: 'Arcade', locations: [0]},
            'axe-throw': {label: 'Axe Throwing', locations: [8,11,12,14,15,18]},
            'laser-tag': {label: 'Laser Tag', locations: [1,3,4,5,6,7,8,9,10,12,13,14,15,16,17,18]},
            'escape-room': {label: 'Escape Room', locations: [8,17]},
            'bumper-cars': {label: 'Bumper Cars', locations: [1,3,4,6,9,10,13,15,16,18]},
            'ar': {label: 'Augmented Reality', locations: [1,3,4,8,9,12,13,15,17]},
            'vr': {label: 'Virtual Reality', locations: [0]},
            'vip-lanes': {label: 'VIP Lanes', locations: [1,3,4,5,6,7,8,9,10,12,13,15,16,17,18]}
        };
        var content = '<div style="max-height:250px; overflow-y: scroll;">';
        Object.keys(locationsMap).forEach(element => {
            content += '<div><input type="radio" name="activity" class="activity-radio mb-1" value="' + element + '" id="'+element+'"> <label for="'+element+'">' + locationsMap[element].label + '</label></div>';
        });
        content += '</div>';
        tippy('.activity', {
            allowHTML: true,
            trigger: 'click',
            interactive: true,
            zIndex: 9999,
            content: content,
            // onCreate(instance) {
            //     instance._isFetching = false;
            //     instance._src = null;
            //     instance._error = null;
            // },
            onShown(instance) {
                
                var userSelection = document.body.getElementsByClassName('activity-radio');
                console.log(userSelection.length)
                for(let i = 0; i < userSelection.length; i++) {
                    userSelection[i].addEventListener('change', function() {
                        console.log("Clicked index: " + i);
                    })
                }

            },
            // onHidden(instance) {
            //     instance.setContent('Loading...');
            //     instance._src = null;
            //     instance._error = null;
            // }
        });

        

        content = '<div style="max-height:250px; overflow-y: scroll;">';
        content += '</div>';
        tippy('.location', {
            allowHTML: true,
            trigger: 'click',
            interactive: true,
            zIndex: 9999,
            content: ''
            // onCreate(instance) {
            //     instance._isFetching = false;
            //     instance._src = null;
            //     instance._error = null;
            // },
            // onShow(instance) {
            //     if (instance._isFetching || instance._src || instance._error) {
            //         return;
            //     }

            //     instance._isFetching = true;

            //     fetch('https://unsplash.it/200/?random')
            //     .then((response) => response.blob())
            //     .then((blob) => {
            //         const src = URL.createObjectURL(blob);
            //         instance._src = src;
            //     })
            //     .catch((error) => {
            //         instance._error = error;
            //         instance.setContent(`Request failed. ${error}`);
            //     })
            //     .finally(() => {
            //         instance._isFetching = false;
            //     });
            // },
            // onHidden(instance) {
            //     instance.setContent('Loading...');
            //     instance._src = null;
            //     instance._error = null;
            // }
        });
    </script>

    <?php

    $content = ob_get_contents();
    ob_end_clean();
    return $content;

}

add_shortcode('activities', 'activities_handler');