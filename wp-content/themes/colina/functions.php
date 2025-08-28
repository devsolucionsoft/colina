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
}
add_action('admin_menu', 'remove_editor');
