<?php
add_action('cmb2_admin_init', 'cmb2_fields_home');
function cmb2_fields_home()
{
    $home_id = of_get_option('home_page');
    // Puedes cambiar esto para que solo aparezca en la página de inicio si lo deseas
    $cmb = new_cmb2_box(array(
        'id'            => 'fields_home',
        'title'         => __('Opciones Home', 'colina'),
        'object_types'  => array('page'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
        'show_on'    => array('id' => array($home_id)),
    ));

    // === SOBRE NOSOTROS ===
    $cmb->add_field(array(
        'name' => 'Título Sobre Nosotros',
        'id'   => 'about_title',
        'type' => 'text',
    ));
    $cmb->add_field(array(
        'name' => 'Subtítulo Sobre Nosotros',
        'id'   => 'about_subtitle',
        'type' => 'text',
    ));
    $cmb->add_field(array(
        'name' => 'Texto Sobre Nosotros',
        'id'   => 'about_text',
        'type' => 'wysiwyg',
        'options' => array(
            'media_buttons' => false,
            'teeny'         => true,
        ),
    ));
    $cmb->add_field(array(
        'name' => 'Texto Botón Sobre Nosotros',
        'id'   => 'about_btn_text',
        'type' => 'text',
    ));
    $cmb->add_field(array(
        'name' => 'Link Botón Sobre Nosotros',
        'id'   => 'about_btn_link',
        'type' => 'text_url',
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

    // === NORMATIVIDAD Y DOCUMENTOS ===
    $cmb->add_field(array(
        'name' => 'Título Documentos',
        'id'   => 'documents_title',
        'type' => 'text',
    ));
    $cmb->add_field(array(
        'name' => 'Subtítulo Documentos',
        'id'   => 'documents_subtitle',
        'type' => 'text',
    ));
    $cmb->add_field(array(
        'name' => 'Descripción Documentos',
        'id'   => 'documents_description',
        'type' => 'textarea',
    ));
    $cmb->add_field(array(
        'name' => 'Texto Botón Documentos',
        'id'   => 'documents_btn_text',
        'type' => 'text',
    ));
    $cmb->add_field(array(
        'name' => 'Link Botón Documentos',
        'id'   => 'documents_btn_link',
        'type' => 'text_url',
    ));
}
