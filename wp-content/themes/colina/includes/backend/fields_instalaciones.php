<?php
add_action('cmb2_admin_init', 'cmb2_fields_instalaciones');
function cmb2_fields_instalaciones()
{
    $instalaciones_page = of_get_option('instalaciones_page');
    $cmb = new_cmb2_box(array(
        'id'            => 'fields_instalaciones',
        'title'         => __('Opciones Instalaciones', 'colina'),
        'object_types'  => array('page'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
        'show_on'    => array('id' => array($instalaciones_page)),
    ));

    // === BANNER ===
    $cmb->add_field(array(
        'name' => 'Imagen de fondo Banner',
        'id'   => 'instalaciones_banner_image',
        'type' => 'file',
        'desc' => 'Imagen de fondo para el banner principal',
    ));
    $cmb->add_field(array(
        'name' => 'Título Banner',
        'id'   => 'instalaciones_banner_title',
        'type' => 'text',
    ));
    $cmb->add_field(array(
        'name' => 'Subtítulo Banner',
        'id'   => 'instalaciones_banner_subtitle',
        'type' => 'text',
    ));

    // === SECCIÓN INSTALACIONES FIJAS ===
    $cmb->add_field(array(
        'name' => 'Título Sección Instalaciones Fijas',
        'id'   => 'instalaciones_fijas_title',
        'type' => 'text',
    ));
    $cmb->add_field(array(
        'name' => 'Subtítulo Sección Instalaciones Fijas',
        'id'   => 'instalaciones_fijas_subtitle',
        'type' => 'text',
    ));
    $cmb->add_field(array(
        'name' => 'Descripción Sección Instalaciones Fijas',
        'id'   => 'instalaciones_fijas_description',
        'type' => 'textarea',
    ));

    // === INSTALACIONES FIJAS - GROUP FIELD ===
    $group_fijas = $cmb->add_field(array(
        'id'          => 'instalaciones_fijas_group',
        'type'        => 'group',
        'description' => __('Instalaciones fijas de la empresa', 'colina'),
        'options'     => array(
            'group_title'   => __('Instalación {#}', 'colina'),
            'add_button'    => __('Agregar Instalación Fija', 'colina'),
            'remove_button' => __('Eliminar Instalación', 'colina'),
            'sortable'      => true,
        ),
    ));

    $cmb->add_group_field($group_fijas, array(
        'name' => 'Nombre de la Instalación',
        'id'   => 'nombre',
        'type' => 'text',
    ));

    $cmb->add_group_field($group_fijas, array(
        'name' => 'Detalle',
        'desc' => 'Descripción detallada de la instalación',
        'id'   => 'detalle',
        'type' => 'wysiwyg',
        'options' => array(
            'textarea_rows' => 8,
            'media_buttons' => false,
        ),
    ));

    $cmb->add_group_field($group_fijas, array(
        'name' => 'Imagen',
        'id'   => 'imagen',
        'type' => 'file',
    ));

    // === SECCIÓN INSTALACIONES DISPONIBLES ===
    $cmb->add_field(array(
        'name' => 'Título Sección Instalaciones Disponibles',
        'id'   => 'instalaciones_disponibles_title',
        'type' => 'text',
    ));
    $cmb->add_field(array(
        'name' => 'Subtítulo Sección Instalaciones Disponibles',
        'id'   => 'instalaciones_disponibles_subtitle',
        'type' => 'text',
    ));
    $cmb->add_field(array(
        'name' => 'Descripción Sección Instalaciones Disponibles',
        'id'   => 'instalaciones_disponibles_description',
        'type' => 'textarea',
    ));
    $cmb->add_field(array(
        'name' => 'Texto Botón Contacto',
        'desc' => 'Texto que aparecerá en el botón para contactar (ej: "Consultar Disponibilidad")',
        'id'   => 'instalaciones_btn_contacto_text',
        'type' => 'text',
    ));

    // === INSTALACIONES DISPONIBLES - GROUP FIELD ===
    $group_disponibles = $cmb->add_field(array(
        'id'          => 'instalaciones_disponibles_group',
        'type'        => 'group',
        'description' => __('Instalaciones disponibles para arriendo', 'colina'),
        'options'     => array(
            'group_title'   => __('Instalación Disponible {#}', 'colina'),
            'add_button'    => __('Agregar Instalación Disponible', 'colina'),
            'remove_button' => __('Eliminar Instalación', 'colina'),
            'sortable'      => true,
        ),
    ));

    $cmb->add_group_field($group_disponibles, array(
        'name' => 'Nombre de la Instalación',
        'id'   => 'nombre',
        'type' => 'text',
    ));

    $cmb->add_group_field($group_disponibles, array(
        'name' => 'Descripción',
        'desc' => 'Descripción de la instalación disponible',
        'id'   => 'descripcion',
        'type' => 'wysiwyg',
        'options' => array(
            'textarea_rows' => 8,
            'media_buttons' => false,
        ),
    ));

    $cmb->add_group_field($group_disponibles, array(
        'name' => 'Precio',
        'desc' => 'Precio de arriendo (ej: $500.000/mes)',
        'id'   => 'precio',
        'type' => 'text',
    ));

    $cmb->add_group_field($group_disponibles, array(
        'name' => 'Imagen',
        'id'   => 'imagen',
        'type' => 'file',
    ));
}
