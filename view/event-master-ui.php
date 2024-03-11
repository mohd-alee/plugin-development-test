<?php
// Adding Shortcodes to display events on frontend
add_shortcode('all_events', 'all_events_callback');
if (!function_exists('all_events_callback')) {
    function all_events_callback()
    {
        $args = [
            'post_type' => 'events',
            'posts_per_page' => -1,
            'post_status' => 'publish',
        ];
        $query = new WP_Query($args);
        if ($query->have_posts()):
            $html = ' <div class="container"><div class="row">';
            while ($query->have_posts()):
                $query->the_post();
                $html .= '
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                        <h5 class="card-title">' . get_the_title() . '</h5>
                        <p class="card-text">' . get_the_excerpt() . '</p>
                        <a href="' . get_the_permalink() . '" class="btn btn-primary">Learn More</a>
                        </div>
                    </div>
                </div>
                ';
            endwhile;
            wp_reset_postdata();
        else:
            $html = 'No custom posts found.';
        endif;
        return $html;
    }
}

// Set up single post templates for events
function custom_event_template($single_template)
{
    global $post;
    if ($post->post_type == 'events') {
        $single_template = MY_PLUGIN_PATH . '/view/single-events.php';
    }
    return $single_template;
}
add_filter('single_template', 'custom_event_template');

?>