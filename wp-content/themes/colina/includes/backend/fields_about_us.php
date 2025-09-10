<?php
add_action('cmb2_admin_init', 'cmb2_fields_about_us');
function cmb2_fields_about_us()
{
    $about_us_page = of_get_option('about_us_page');

    $cmb = new_cmb2_box(array(
        'id'            => 'fields_about_us',
        'title'         => __('Opciones Sobre Nosotros', 'colina'),
        'object_types'  => array('page'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
        'show_on'    => array('id' => array($about_us_page)),

    ));

    // === Banner ===
    $cmb->add_field(array(
        'name' => 'Imagen de fondo Banner',
        'id'   => 'about_banner_image',
        'type' => 'file',
        'desc' => 'Imagen de fondo para el banner principal',
    ));
    $cmb->add_field(array(
        'name' => 'Título Banner',
        'id'   => 'about_banner_title',
        'type' => 'text',
    ));
    $cmb->add_field(array(
        'name' => 'Subtítulo Banner',
        'id'   => 'about_banner_subtitle',
        'type' => 'text',
    ));

    // === Historia ===
    $cmb->add_field(array(
        'name' => 'Título Historia',
        'id'   => 'about_history_title',
        'type' => 'text',
    ));
    $cmb->add_field(array(
        'name' => 'Subtítulo Historia',
        'id'   => 'about_history_subtitle',
        'type' => 'text',
    ));
    $cmb->add_field(array(
        'name' => 'Texto Historia',
        'id'   => 'about_history_text',
        'type' => 'wysiwyg',
        'options' => array(
            'media_buttons' => false,
            'teeny'         => true,
        ),
    ));
    // Diamond historia
    $cmb->add_field(array(
        'name' => 'Imagen Diamond Historia',
        'id'   => 'about_history_diamond',
        'type' => 'file',
        'desc' => 'Imagen para el diamond de la sección historia',
    ));

    // === Stats ===
    $cmb->add_field(array(
        'name' => 'Título Stats',
        'id'   => 'about_stats_title',
        'type' => 'text',
    ));
    $cmb->add_field(array(
        'name' => 'Subtítulo Stats',
        'id'   => 'about_stats_subtitle',
        'type' => 'text',
    ));

    $stats_group = $cmb->add_field(array(
        'id'          => 'about_stats',
        'type'        => 'group',
        'description' => __('Estadísticas (impacto en cifras)', 'cmb2'),
        'options'     => array(
            'group_title'   => __('Estadística {#}', 'cmb2'),
            'add_button'    => __('Agregar estadística', 'cmb2'),
            'remove_button' => __('Eliminar', 'cmb2'),
            'sortable'      => true,
        ),
    ));
    $cmb->add_group_field($stats_group, array(
        'name' => 'Número',
        'id'   => 'number',
        'type' => 'text',
    ));
    $cmb->add_group_field($stats_group, array(
        'name' => 'Descripción',
        'id'   => 'label',
        'type' => 'text',
    ));

    // === Principios ===
    $cmb->add_field(array(
        'name' => 'Título Principios',
        'id'   => 'about_principles_title',
        'type' => 'text',
    ));
    $cmb->add_field(array(
        'name' => 'Subtítulo Principios',
        'id'   => 'about_principles_subtitle',
        'type' => 'text',
    ));

    // === ¿Por qué elegirnos? ===
    $cmb->add_field(array(
        'name' => 'Título Razones',
        'id'   => 'about_reasons_title',
        'type' => 'text',
    ));
    $cmb->add_field(array(
        'name' => 'Subtítulo Razones',
        'id'   => 'about_reasons_subtitle',
        'type' => 'text',
    ));
    $reasons_group = $cmb->add_field(array(
        'id'          => 'about_reasons',
        'type'        => 'group',
        'description' => __('Razones para confiar', 'cmb2'),
        'options'     => array(
            'group_title'   => __('Razón {#}', 'cmb2'),
            'add_button'    => __('Agregar razón', 'cmb2'),
            'remove_button' => __('Eliminar', 'cmb2'),
            'sortable'      => true,
        ),
    ));
    $cmb->add_group_field($reasons_group, array(
        'name' => 'Ícono',
        'id'   => 'icon',
        'type' => 'file',
    ));
    $cmb->add_group_field($reasons_group, array(
        'name' => 'Título',
        'id'   => 'title',
        'type' => 'text',
    ));

    // === FAQ ===
    $cmb->add_field(array(
        'name' => 'Título FAQ',
        'id'   => 'about_faq_title',
        'type' => 'text',
    ));
    $cmb->add_field(array(
        'name' => 'Subtítulo FAQ',
        'id'   => 'about_faq_subtitle',
        'type' => 'text',
    ));

    $faq_group = $cmb->add_field(array(
        'id'          => 'about_faq',
        'type'        => 'group',
        'description' => __('Preguntas frecuentes', 'cmb2'),
        'options'     => array(
            'group_title'   => __('Pregunta {#}', 'cmb2'),
            'add_button'    => __('Agregar pregunta', 'cmb2'),
            'remove_button' => __('Eliminar', 'cmb2'),
            'sortable'      => true,
        ),
    ));
    $cmb->add_group_field($faq_group, array(
        'name' => 'Pregunta',
        'id'   => 'q',
        'type' => 'text',
    ));
    $cmb->add_group_field($faq_group, array(
        'name' => 'Respuesta',
        'id'   => 'a',
        'type' => 'textarea',
    ));

    // === More Info ===
    $cmb->add_field(array(
        'name' => 'Título More Info',
        'id'   => 'about_more_info_title',
        'type' => 'text',
    ));
    $cmb->add_field(array(
        'name' => 'Texto More Info',
        'id'   => 'about_more_info_text',
        'type' => 'textarea',
    ));
}
