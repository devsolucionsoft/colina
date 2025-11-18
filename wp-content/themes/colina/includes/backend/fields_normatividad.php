<?php
add_action('cmb2_admin_init', 'cmb2_fields_normatividad');
function cmb2_fields_normatividad()
{
    $normativity_page = of_get_option('normativity_page');
    $cmb = new_cmb2_box(array(
        'id'            => 'fields_normatividad',
        'title'         => __('Opciones Normatividad', 'colina'),
        'object_types'  => array('page'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
        'show_on'    => array('id' => array($normativity_page)),
    ));

    // === Banner ===
    $cmb->add_field(array(
        'name' => 'Imagen de fondo Banner',
        'id'   => 'normatividad_banner_image',
        'type' => 'file',
        'desc' => 'Imagen de fondo para el banner principal',
    ));
    $cmb->add_field(array(
        'name' => 'Título Banner',
        'id'   => 'normatividad_banner_title',
        'type' => 'text',
    ));
    $cmb->add_field(array(
        'name' => 'Subtítulo Banner',
        'id'   => 'normatividad_banner_subtitle',
        'type' => 'text',
    ));


    // === PAGOS ===
    $cmb->add_field(array(
        'name' => 'Título Pagos',
        'id'   => 'payments_title',
        'type' => 'text',
    ));
    $cmb->add_field(array(
        'name' => 'Subtítulo Pagos',
        'id'   => 'payments_subtitle',
        'type' => 'text',
    ));
    $cmb->add_field(array(
        'name' => 'Texto Pagos',
        'id'   => 'payments_text',
        'type' => 'wysiwyg',
        'options' => array(
            'media_buttons' => false,
            'teeny'         => true,
        ),
    ));
    $cmb->add_field(array(
        'name' => 'Texto Botón Pagos',
        'id'   => 'payments_btn_text',
        'type' => 'text',
    ));
    $cmb->add_field(array(
        'name' => 'Link Botón Pagos',
        'id'   => 'payments_btn_link',
        'type' => 'text_url',
    ));

    // === Imagen Diamond ===
    $cmb->add_field(array(
        'name' => 'Imagen Diamond',
        'id'   => 'diamond_image',
        'type' => 'file',
        'desc' => 'Imagen para el diamond de la sección Pagos',
    ));


    // === Normatividad y Documentos ===
    $cmb->add_field(array(
        'name' => 'Título Sección Documentos',
        'id'   => 'normatividad_section_title',
        'type' => 'text',
    ));
    $cmb->add_field(array(
        'name' => 'Subtítulo Sección Documentos',
        'id'   => 'normatividad_section_subtitle',
        'type' => 'text',
    ));
    $cmb->add_field(array(
        'name' => 'Descripción Sección Documentos',
        'id'   => 'normatividad_section_description',
        'type' => 'textarea',
    ));
}
