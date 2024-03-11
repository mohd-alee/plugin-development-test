<?php
// This file contains all the code related to custom post type + meta registered for events
function event_post_type()
{

    $labels = array(
        'name' => _x('Events', 'Post Type General Name', 'event-master'),
        'singular_name' => _x('Event', 'Post Type Singular Name', 'event-master'),
        'menu_name' => __('Events', 'event-master'),
        'name_admin_bar' => __('Events', 'event-master'),
        'archives' => __('Event Archives', 'event-master'),
        'attributes' => __('Item Attributes', 'event-master'),
        'parent_item_colon' => __('Parent Event:', 'event-master'),
        'all_items' => __('All Events', 'event-master'),
        'add_new_item' => __('Add New Event', 'event-master'),
        'add_new' => __('Add New', 'event-master'),
        'new_item' => __('New Event', 'event-master'),
        'edit_item' => __('Edit Event', 'event-master'),
        'update_item' => __('Update Event', 'event-master'),
        'view_item' => __('View Event', 'event-master'),
        'view_items' => __('View Events', 'event-master'),
        'search_items' => __('Search Event', 'event-master'),
        'not_found' => __('Not found', 'event-master'),
        'not_found_in_trash' => __('Not found in Trash', 'event-master'),
        'featured_image' => __('Featured Image', 'event-master'),
        'set_featured_image' => __('Set featured image', 'event-master'),
        'remove_featured_image' => __('Remove featured image', 'event-master'),
        'use_featured_image' => __('Use as featured image', 'event-master'),
        'insert_into_item' => __('Insert into Event', 'event-master'),
        'uploaded_to_this_item' => __('Uploaded to this Event', 'event-master'),
        'items_list' => __('Events list', 'event-master'),
        'items_list_navigation' => __('Events list navigation', 'event-master'),
        'filter_items_list' => __('Filter Events list', 'event-master'),
    );
    $args = array(
        'label' => __('Event', 'event-master'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-tickets-alt',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type('events', $args);

}
add_action('init', 'event_post_type');

// Register Custom Meta boxes for custom fields
function events_custom_metabox()
{
    $screens = ['events'];
    foreach ($screens as $screen) {
        add_meta_box(
            'event_box_id',                 // Unique ID
            'Events Additional Details',    // Box title
            'event_custom_box_html',        // Content callback, must be of type callable
            $screen                         // Post type
        );
    }
}
add_action('add_meta_boxes', 'events_custom_metabox');
function event_custom_box_html($post)
{
    $event_loation = get_post_meta($post->ID, '_event_location', true);
    $event_date = get_post_meta($post->ID, '_event_date', true);
    ?>
    <div class="custom-fields-wrapper">
        <div>
            <label for="event_location">Event Location: </label>
            <input value="<?php echo $event_loation; ?>" name="event_location" id="event_location"
                class="postbox custom-fieldgroup" type="text" placeholder="3335 Victor Hollow, South Anthony, NC 29174">
        </div>
        <div>
            <label for="event_date">Event Date: </label>
            <input value="<?php echo $event_date; ?>" name="event_date" id="event_date" class="postbox custom-fieldgroup"
                type="date">
        </div>

    </div>
    <?php
}
// Saving Custom meta values
function events_save_postdata($post_id)
{
    if (array_key_exists('event_location', $_POST)) {
        update_post_meta(
            $post_id,
            '_event_location',
            $_POST['event_location']
        );
    }

    if (array_key_exists('event_date', $_POST)) {
        update_post_meta(
            $post_id,
            '_event_date',
            $_POST['event_date']
        );
    }
}
add_action('save_post', 'events_save_postdata');
?>