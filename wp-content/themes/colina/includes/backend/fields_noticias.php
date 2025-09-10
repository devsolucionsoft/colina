<?php
add_action('cmb2_admin_init', 'cmb2_fields_noticias');
function cmb2_fields_noticias()
{
    $cmb = new_cmb2_box(array(
        'id'            => 'fields_noticias',
        'title'         => __('Opciones Noticias', 'colina'),
        'object_types'  => array('page'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
    ));

    // === Banner ===
    $cmb->add_field(array(
        'name' => 'Imagen de fondo Banner',
        'id'   => 'noticias_banner_image',
        'type' => 'file',
        'desc' => 'Imagen de fondo para el banner principal',
    ));
    $cmb->add_field(array(
        'name' => 'Título Banner',
        'id'   => 'noticias_banner_title',
        'type' => 'text',
    ));
    $cmb->add_field(array(
        'name' => 'Subtítulo Banner',
        'id'   => 'noticias_banner_subtitle',
        'type' => 'text',
    ));
}
