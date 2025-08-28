<?php

/**
 * User: Solucionsoft DEV
 * Email: contacto@solucionsoft.com
 */
function loads_scripts()
{
    global $post;

    wp_enqueue_style('style_general', get_template_directory_uri() . '/assets/css/styles.css', array(), '1.0', 'all');
}

add_action('wp_enqueue_scripts', 'loads_scripts');
