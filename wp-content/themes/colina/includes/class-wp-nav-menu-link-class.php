<?php

class WP_Nav_Menu_Link_Class
{
    public function __construct()
    {
        add_filter('nav_menu_link_attributes', array($this, 'add_link_class'), 10, 4);
    }

    public function add_link_class($atts, $item, $args, $depth)
    {
        if (!empty($args->link_class)) {
            if (empty($atts['class'])) {
                $atts['class'] = $args->link_class;
            } else {
                $atts['class'] .= ' ' . $args->link_class;
            }
        }
        return $atts;
    }
}

new WP_Nav_Menu_Link_Class();
