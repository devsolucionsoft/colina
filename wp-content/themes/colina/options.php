<?php

function optionsframework_option_name()
{
    // This gets the theme name from the stylesheet (lowercase and without spaces)
    $themename = get_option('stylesheet');
    $themename = preg_replace("/\W/", "_", strtolower($themename));
    $optionsframework_settings = get_option('optionsframework');
    $optionsframework_settings['id'] = $themename;
    update_option('optionsframework', $optionsframework_settings);
    // echo $themename;
}

function optionsframework_options()
{
    // Pull all the categories into an array
    $options_categories = array();
    $options_categories_obj = get_categories();
    foreach ($options_categories_obj as $category) {
        $options_categories[$category->cat_ID] = $category->cat_name;
    }

    // Pull all tags into an array
    $options_tags = array();
    $options_tags_obj = get_tags();
    foreach ($options_tags_obj as $tag) {
        $options_tags[$tag->term_id] = $tag->name;
    }

    // Pull all the pages into an array
    $options_pages = array();
    $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
    $options_pages[''] = 'Select a page:';
    foreach ($options_pages_obj as $page) {
        $options_pages[$page->ID] = $page->post_title;
    }

    /**
     *Configuraciones paginas
     **/

    $options[] = array(
        'name' => __('Configuración Paginas', 'options_check'),
        'type' => 'heading'
    );

    $options[] = array(
        'name' => __('Seleccione la página de Inicio', 'ss-translate'),
        'desc' => __('Con esto agregaremos los campos en el administrador y el front de la página de Inicio', 'ss-translate'),
        'id' => 'home_page',
        'type' => 'select',
        'options' => $options_pages
    );

    $options[] = array(
        'name' => __('Seleccione la página de Noticias', 'ss-translate'),
        'desc' => __('Con esto agregaremos los campos en el administrador y el front de la página de Noticias', 'ss-translate'),
        'id' => 'news_page',
        'type' => 'select',
        'options' => $options_pages
    );

    $options[] = array(
        'name' => __('Seleccione la página de Contacto', 'ss-translate'),
        'desc' => __('Con esto agregaremos los campos en el administrador y el front de la página de Contacto', 'ss-translate'),
        'id' => 'contact_page',
        'type' => 'select',
        'options' => $options_pages
    );

    $options[] = array(
        'name' => __('Seleccione la página de Normatividad', 'ss-translate'),
        'desc' => __('Con esto agregaremos los campos en el administrador y el front de la página de Normatividad', 'ss-translate'),
        'id' => 'normativity_page',
        'type' => 'select',
        'options' => $options_pages
    );

    $options[] = array(
        'name' => __('Seleccione la página de Nosotros', 'ss-translate'),
        'desc' => __('Con esto agregaremos los campos en el administrador y el front de la página de Nosotros', 'ss-translate'),
        'id' => 'about_us_page',
        'type' => 'select',
        'options' => $options_pages
    );

    /**
     * Información de la Empresa
     */
    $options[] = array(
        'name' => __('Información de la Empresa', 'options_check'),
        'type' => 'heading'
    );

    // === INFORMACIÓN DE CONTACTO ===
    $options[] = array(
        'name' => __('Correo Electrónico', 'ss-translate'),
        'desc' => __('Email principal de la empresa', 'ss-translate'),
        'id' => 'company_email',
        'type' => 'text',
    );

    $options[] = array(
        'name' => __('Teléfono', 'ss-translate'),
        'desc' => __('Número de teléfono principal', 'ss-translate'),
        'id' => 'company_phone',
        'type' => 'text',
    );

    $options[] = array(
        'name' => __('Dirección', 'ss-translate'),
        'desc' => __('Dirección física de la empresa', 'ss-translate'),
        'id' => 'company_address',
        'type' => 'text',
    );

    $options[] = array(
        'name' => __('Horario de Atención', 'ss-translate'),
        'desc' => __('Horario de atención al cliente', 'ss-translate'),
        'id' => 'company_hours',
        'type' => 'text',
    );

    $options[] = array(
        'name' => __('Latitud', 'ss-translate'),
        'desc' => __('Coordenada de latitud para ubicación en mapas', 'ss-translate'),
        'id' => 'company_latitude',
        'type' => 'text',
    );

    $options[] = array(
        'name' => __('Longitud', 'ss-translate'),
        'desc' => __('Coordenada de longitud para ubicación en mapas', 'ss-translate'),
        'id' => 'company_longitude',
        'type' => 'text',
    );

    // === REDES SOCIALES ===
    $options[] = array(
        'name' => __('Facebook', 'ss-translate'),
        'desc' => __('URL completa del perfil de Facebook', 'ss-translate'),
        'id' => 'company_facebook',
        'type' => 'text',
    );

    $options[] = array(
        'name' => __('Instagram', 'ss-translate'),
        'desc' => __('URL completa del perfil de Instagram', 'ss-translate'),
        'id' => 'company_instagram',
        'type' => 'text',
    );

    $options[] = array(
        'name' => __('Twitter/X', 'ss-translate'),
        'desc' => __('URL completa del perfil de Twitter/X', 'ss-translate'),
        'id' => 'company_twitter',
        'type' => 'text',
    );

    $options[] = array(
        'name' => __('LinkedIn', 'ss-translate'),
        'desc' => __('URL completa del perfil de LinkedIn', 'ss-translate'),
        'id' => 'company_linkedin',
        'type' => 'text',
    );

    $options[] = array(
        'name' => __('YouTube', 'ss-translate'),
        'desc' => __('URL completa del canal de YouTube', 'ss-translate'),
        'id' => 'company_youtube',
        'type' => 'text',
    );

    // === INFORMACIÓN DEL FOOTER ===
    $options[] = array(
        'name' => __('Descripción de la Empresa', 'ss-translate'),
        'desc' => __('Texto descriptivo que aparece en el footer', 'ss-translate'),
        'id' => 'company_description',
        'type' => 'textarea',
    );

    return $options;
}
