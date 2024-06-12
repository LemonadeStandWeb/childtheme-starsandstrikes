<?php

function activities_handler( $atts, $content = null, $tag = '' ) {

    extract(shortcode_atts([], $atts));

    ob_start();

    // Query all Locations posts
    $locations_args = array(
        'post_type' => 'locations',
        'posts_per_page' => -1
    );

    $query = new WP_Query($locations_args);
    $posts = $query->get_posts();
    
    $locations = [];
    if(!empty($posts)) {

        foreach($posts as $post) {

            $location = $post->to_array();

            $locations[] = [
                'ID' => $location['ID'],
                'name' => $location['post_name'],
                'title' => $location['post_title'],
                'link' => get_permalink($location['ID']),
                'icon' => wp_get_attachment_url(1013)
            ];

        }

    }


    // Query all Attractions posts
    $attractions_args = array(
        'post_type' => 'attractions',
        'posts_per_page' => -1
    );

    $query = new WP_Query($attractions_args);
    $posts = $query->get_posts();

    $attractions = [];
    if(!empty($posts)) {

        foreach($posts as $post) {

            $post = $post->to_array();

            $attractions_post_icon = get_field('ls_attraction_icon', $post['ID']);
            $locations_availability = get_field('ls_attraction_location_availability', $post['ID']);
            
            $available_locations = [];

            foreach ($locations_availability as $key => $value) {
                $location = $value->to_array();
                
                $available_locations[] = [
                    'ID' => $location['ID'],
                    'name' => $location['post_name'],
                    'title' => $location['post_title'],
                    'link' => get_permalink($location['ID'])
                ];
            }
            $attractions[] = [
                'ID' => $post['ID'],
                'name' => $post['post_name'],
                'title' => $post['post_title'],
                'icon' => wp_get_attachment_url($attractions_post_icon),
                'locations' => $available_locations
            ];

        }
        wp_reset_postdata();
    }
    
    $stack = '[ux_stack distribute="center" align="center" gap="1.5"]';
    $stack .= '[ux_text]<p class="my-0" style=font-size:1.2em;><b>I\'m Interested In...</b><p>[/ux_text]';
    $stack .= '[button text="'.$attractions[0]['title'].'" style="link" icon="icon-angle-down" color="primary" class="select-button text-yellow btn-activity" icon_pos="right"]';
    $stack .= '[ux_text]<p class="my-0" style=font-size:1.2em;><b>in</b><p>[/ux_text]';
    $stack .= '[button text="'.$attractions[0]['locations'][0]['title'].'" style="link" icon="icon-angle-down" color="primary" class="select-button text-yellow btn-location" icon_pos="right"]';
    $stack .= '[button text="GO" color="primary" class="white btn-go" link="'.$attractions[0]['locations'][0]['link'].'"]';
    $stack .= '[/ux_stack]';
    ?>

    <?= do_shortcode($stack);?>

    <script>
        
        var activities = <?= json_encode($attractions,JSON_HEX_TAG); ?>;
        var activitySelected = activities[0].ID;

        var locations = <?= json_encode($locations,JSON_HEX_TAG); ?>;
        var locationSelected = activities[0].locations[0].ID;

        var content = '<div style="max-height:300px; overflow-y: scroll;">';
        activities.forEach(item => {
            content += '<div class="custom-radio"><input type="radio" name="activity" class="activity-radio mb-1" value="' + item.ID + '" id="activity-'+item.name+'" onchange="activityChange(this);"> <label for="activity-'+item.name+'"><img class="radio-image" src="'+item.icon+'"/> ' + item.title + '</label></div>';
        });
        content += '</div>';

        let activityTip = tippy('.btn-activity', {
            allowHTML: true,
            trigger: 'click',
            interactive: true,
            zIndex: 9999,
            theme: 'ls',
            content: content,
            onShown: (instance) => {
                let activityRadios = document.body.getElementsByClassName('activity-radio');
                let activity = activities.find(activity => activity.ID == activitySelected);
                let defaultIndex = activities.findIndex(location => location.ID == activity.ID)
                activityRadios[defaultIndex].checked = true
            }
        });

        let activityChange = (el) => {
            
            let activityButton = document.body.getElementsByClassName('btn-activity')[0];
            let activity = activities.find(activity => activity.ID == el.value);
            activitySelected = activity.ID;
            activityButton.innerText = activity.title;

            // Reset Location to first available Location in activity
            let locationButton = document.body.getElementsByClassName('btn-location')[0];
            locationButton.innerText = activity.locations[0].title;

            document.body.getElementsByClassName('btn-go')[0].href = activity.locations[0].link

            activityTip[0].hide();

        }


        content = '<div style="max-height:300px; overflow-y: scroll;">';
        locations.forEach(item => {
            content += '<div class="custom-radio"><input type="radio" name="location" class="location-radio mb-1" value="' + item.ID + '" id="location-'+item.name+'" onchange="locationChange(this);"> <label for="location-'+item.name+'"><img class="location-image" src="'+item.icon+'"/> ' + item.title + '</label></div>';
        });
        content += '</div>';

        let locationsTip = tippy('.btn-location', {
            allowHTML: true,
            trigger: 'click',
            interactive: true,
            zIndex: 9999,
            theme: 'ls',
            content: content,
            onShown: (instance) => {
                let locationRadios = document.body.getElementsByClassName('location-radio');
                let activity = activities.find(activity => activity.ID == activitySelected);
                let defaultIndex = locations.findIndex(location => location.ID == activity.locations[0].ID)
                
                for(let i = 0; i < locationRadios.length; i++) {
                    
                    locationRadios[i].checked = defaultIndex == i ? true : false;

                    locationRadios[i].disabled = true;

                    locationRadios[i].parentElement.classList.add('disabled');

                    if(activity !== undefined && activity.locations.findIndex(location => location.ID == locations[i].ID) !== -1){
                        locationRadios[i].disabled = false;
                        locationRadios[i].parentElement.classList.remove('disabled')
                    }
                    
                }
            }
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

        let locationChange = (el) => {

            let locationButton = document.body.getElementsByClassName('btn-location')[0];
            let location = locations.find(location => location.ID == el.value);
            locationButton.innerText = location.title;

            document.body.getElementsByClassName('btn-go')[0].href = location.link

            locationsTip[0].hide();

        }

    </script>

    <?php

    $content = ob_get_contents();
    ob_end_clean();
    return $content;

}

add_shortcode('activities', 'activities_handler');