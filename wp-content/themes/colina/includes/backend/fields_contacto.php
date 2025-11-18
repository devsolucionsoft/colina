<?php
add_action('cmb2_admin_init', 'cmb2_fields_contacto');
function cmb2_fields_contacto()
{
    $contact_page = of_get_option('contact_page');
    $cmb = new_cmb2_box(array(
        'id'            => 'fields_contacto',
        'title'         => __('Opciones Contacto', 'colina'),
        'object_types'  => array('page'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
        'show_on'    => array('id' => array($contact_page)),
    ));

    // === Banner ===
    $cmb->add_field(array(
        'name' => 'Imagen de fondo Banner',
        'id'   => 'contacto_banner_image',
        'type' => 'file',
        'desc' => 'Imagen de fondo para el banner principal',
    ));
    $cmb->add_field(array(
        'name' => 'Título Banner',
        'id'   => 'contacto_banner_title',
        'type' => 'text',
    ));
    $cmb->add_field(array(
        'name' => 'Subtítulo Banner',
        'id'   => 'contacto_banner_subtitle',
        'type' => 'text',
    ));
}
