<?php

/**
 * User: Solucionsoft DEV
 * Email: contacto@solucionsoft.com
 */

require get_template_directory() . '/includes/general_functions.php';
require get_template_directory() . '/includes/js_css.php';
require get_template_directory() . '/includes/class-wp-nav-menu-link-class.php';

function remove_editor()
{
    remove_post_type_support('ss-banner-home', 'editor');
    remove_post_type_support('ss-banner-home', 'excerpt');
    remove_post_type_support('ss-client', 'editor');
    remove_post_type_support('ss-client', 'excerpt');
}
add_action('admin_menu', 'remove_editor');

function get_companies_clients()
{
    $clients = get_posts(array(
        'post_type' => 'ss-client',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
    ));

    $clients_data = array();

    foreach ($clients as $client) {
        $client_image = get_post_meta($client->ID, 'client_images', true);
        $image_url = '';

        if ($client_image) {
            if (is_numeric($client_image)) {
                $image_url = wp_get_attachment_image_url($client_image, 'medium');
            } else {
                $image_url = $client_image;
            }
        }

        $clients_data[] = array(
            'id' => $client->ID,
            'title' => $client->post_title,
            'image' => $image_url,
            'excerpt' => $client->post_excerpt,
            'content' => $client->post_content
        );
    }

    return $clients_data;
}
