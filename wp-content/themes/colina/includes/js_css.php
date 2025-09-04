<?php

/**
 * User: Solucionsoft DEV
 * Email: contacto@solucionsoft.com
 */
function loads_scripts()
{
    global $post;

    wp_enqueue_style('style_general', get_template_directory_uri() . '/assets/css/styles.css', array(), '1.0', 'all');

    // Enqueue main JavaScript (sin jQuery) - cargar en header con defer
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0', false);
    wp_script_add_data('main-js', 'defer', true);

    // Localizar el script para contactFormAjax
    wp_localize_script('main-js', 'contactFormAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('contact_form_nonce'),
        'siteUrl' => get_site_url(),
        'homeUrl' => get_home_url()
    ));
}

add_action('wp_enqueue_scripts', 'loads_scripts');
