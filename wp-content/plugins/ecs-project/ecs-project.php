<?php

/*
Plugin Name: ECS Project
Plugin URI: http://ecs.network
Description: Main Plugin
Author: Gabriel David Martinez
Version: 1.0
Author URI: http://ecs.network
Text Domain: ecs.network
Domain Path: /languages
*/

/**
 * Created by PhpStorm.
 * User: dev
 * Date: 9/25/15
 * Time: 9:38 AM
 */

spl_autoload_register('project_autoloader');

function project_autoloader($class_name)
{

    $class_components = explode("_", $class_name);

    if (
        isset($class_components[0]) && $class_components[0] == "Project" &&
        isset($class_components[1])
    ) {

        $class_directory = $class_components[1];

        unset($class_components[0], $class_components[1]);

        $file_name = implode("_", $class_components);

        $base_path = plugin_dir_path(__FILE__);

        switch ($class_directory) {
            case 'Model':

                $file_path = $base_path . "models/class-project-model-" . lcfirst($file_name) . '.php';
                if (file_exists($file_path) && is_readable($file_path)) {
                    include $file_path;
                }

                break;
        }
    }
}

if (!class_exists('Twig_Autoloader')) {
    $base_path_badges = plugin_dir_path(__FILE__);

    require_once $base_path_badges . 'Twig/lib/Twig/Autoloader.php';
    Twig_Autoloader::register();
}

class ECS_Project_Manager
{

    public $base_path;
    private $template_parser;


    function __construct()
    {
        global $manuelita_options;

        if (!$manuelita_options) {
            //return;
        }

        $this->base_path = plugin_dir_path(__FILE__);
        require_once $this->base_path . 'class-twig-initializer.php';
        $this->clients =  new  Project_Model_Client($this->template_parser);
        $this->bannerhome =  new  Project_Model_Banner($this->template_parser);
        $this->document = new Project_Model_Document($this->template_parser);
        //$this->package = new Project_Model_Package($this->template_parser);


        add_action('cmb2_admin_init', array($this, 'add_metaboxes'));

        #add_action( 'init', array( $this,'textdomain' ) );

    }

    // Function get id page from options project
    function get_page_id_from_manuelita_options($option = false)
    {

        global $manuelita_options;

        if ($option === false) {
            return false;
        }

        $pageID = $manuelita_options[$option] ? (int)$manuelita_options[$option] : false;

        $currentLanguagePageID = apply_filters('wpml_object_id', $pageID, 'page');

        return $currentLanguagePageID;
    }

    function get_page_contact_id()
    {

        return $this->get_page_id_from_manuelita_options('contact_page_select');
    }
    function get_page_work_id()
    {

        return $this->get_page_id_from_manuelita_options('work_page_select');
    }

    public function custom_metaboxes()
    {

        global $manuelita_options;

        $pageContact = 869;
        $pageTalent = $this->get_page_work_id();

        if ($pageContact) {
            $cmb = new_cmb2_box(array(
                'id'           => 'contact_custom_metabox_areas',
                'title'        => __('Areas de Contacto', 'enigmind'),
                'object_types' => array('page',), // Post type
                'context'      => 'normal',
                'priority'     => 'high',
                'show_names'   => true, // Show field names on the left
                'show_on'      => array('id' => array(869, 1964)), // Specific post IDs to display this metabox
            ));
            $group_field_id = $cmb->add_field(array(
                'id'          => 'contact_custom_metabox_areas_group',
                'type'        => 'group',
                'options'     => array(
                    'group_title'   => __('Elemento {#}', 'cmb2'),
                    'add_button'    => __('Añadir', 'cmb2'),
                    'remove_button' => __('Eliminar', 'cmb2'),
                    'sortable'      => true, // beta
                ),
            ));
            $cmb->add_group_field($group_field_id, array(
                'name' => 'Titulo',
                'id'   => 'contact_custom_metabox_areas_group_title',
                'type' => 'text',
            ));
            $cmb->add_group_field($group_field_id, array(
                'name' => 'Detalle',
                'id'   => 'contact_custom_metabox_areas_group_detail',
                'type' => 'textarea'
            ));
            $cmb->add_group_field($group_field_id, array(
                'name'    => __('Imagen', 'enigmimd'),
                'desc'    => __('Las dimensiones optimas de estas imagenes son de 378px X 222px', 'enigmimd'),
                'id'      => 'contact_custom_metabox_areas_group_image',
                'type'    => 'file',
            ));
            /*$cmb->add_group_field( $group_field_id, array(
                'name' => 'Correo',
                'id'   => 'send_correo',
                'type' => 'text',
            ) );
            $cmb->add_group_field( $group_field_id, array(
                'name' => 'Link',
                'id'   => 'contact_link_external',
                'type' => 'text',
            ) );
            $cmb->add_group_field( $group_field_id, array(
                'name' => 'Link',
                'id'   => 'contact_link_external',
                'type' => 'text',
            ) );*/
            $cmb->add_group_field($group_field_id, array(
                'name' => 'Especifique el ID del formulario',
                'id'   => 'contact_id_form',
                'type' => 'text',
            ));
        }
        if ($pageTalent) {
            $prefix = 'talent_';

            $cmb = new_cmb2_box(array(
                'id'           => $prefix . 'metabox_gallery',
                'title'        => __('Galeria de imagenes', 'enigmind'),
                'object_types' => array('page',), // Post type
                'context'      => 'normal',
                'priority'     => 'high',
                'show_names'   => true, // Show field names on the left
                'show_on'      => array('id' => array($pageTalent,)), // Specific post IDs to display this metabox
            ));

            $group_field_id = $cmb->add_field(array(
                'id'          => $prefix . 'gallery_group',
                'type'        => 'group',
                'options'     => array(
                    'group_title'   => __('Elemento {#}', 'enigmind'),
                    'add_button'    => __('Añadir', 'enigmind'),
                    'remove_button' => __('Eliminar', 'enigmind'),
                    'sortable'      => true, // beta
                ),
            ));

            $cmb->add_group_field($group_field_id, array(
                'name'    => __('Imagen vista completa', 'enigmimd'),
                'id'      => $prefix . 'gallery_group_image_thumbnail',
                'type'    => 'file',
            ));
            $cmb->add_group_field($group_field_id, array(
                'name'    => __('Imagen vista detalle', 'enigmimd'),
                'id'      => $prefix . 'gallery_group_image_detail',
                'type'    => 'file',
            ));

            $cmb->add_group_field($group_field_id, array(
                'name'             => 'Imagen grande?',
                'desc'    => __('Las dimensiones optimas para las imagenes son: para imagenes grandes 877px X 503px, para imagenes pequeñas 320px X 250px', 'enigmimd'),
                'id'               => $prefix . 'gallery_group_image_type',
                'type'             => 'checkbox'
            ));

            $cmb->add_group_field($group_field_id, array(
                'name'    => 'Descripcion',
                'desc'    => 'Aqui puedes poner la descripción que va salir en el popup de la imagen',
                'id'      => $prefix . 'gallery_group_description',
                'type'    => 'textarea'
            ));
        }
    }

    public function add_metabox_post_modals()
    {
        $cmb = new_cmb2_box(array(
            'id'           => 'cmb2_postwp_metabox',
            'title'        => 'Items con modal',
            'object_types' => array('post', 'page'),
        ));
        $cmb->add_field(array(
            'name' => __('Icono', 'enigmind'),
            'desc' => __('Seleccione el icono que va en el header', 'enigmind'),
            'id' => 'icono_header',
            'type' => 'file',
        ));
        $cmb->add_field(array(
            'name' => 'Galeria',
            'desc' => '',
            'id'   => 'galeria',
            'type' => 'file_list',
            // 'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
            // 'query_args' => array( 'type' => 'image' ), // Only images attachment
            // Optional, override default text strings
            'text' => array(
                'add_upload_files_text' => 'Agregar', // default: "Add or Upload Files"
                'remove_image_text' => 'Eliminar', // default: "Remove Image"
                'file_text' => 'Archivo', // default: "File:"
                'file_download_text' => 'Descargar', // default: "Download"
                'remove_text' => 'Eliminar', // default: "Remove"
            ),
        ));
        $group_field_id = $cmb->add_field(array(
            'id'          => 'tambien_te_puede_interesar',
            'type'        => 'group',
            'description' => __('Entradas relacionadas', 'cmb2'),
            // 'repeatable'  => false, // use false if you want non-repeatable group
            'options'     => array(
                'group_title'   => __('Entrada {#}', 'cmb2'), // since version 1.1.4, {#} gets replaced by row number
                'add_button'    => __('Agregar', 'cmb2'),
                'remove_button' => __('Eliminar', 'cmb2'),
                'sortable'      => true, // beta
                // 'closed'     => true, // true to have the groups closed by default
            ),
        ));
        $cmb->add_group_field($group_field_id, array(
            'name'    => 'Entrada',
            'desc'    => 'Aqui selecciona la entrada relacionada',
            'id'      => 'entrada',
            'type'    => 'select',
            'show_option_none' => true,
            'options' => get_myposttype_options(array('post', 'page', 'ecs-centros')),
        ));
        /*
         * Categoria Diviosiones - Noticias
         * Post Centros de convservación
         *
         * */
        $group_field_id = $cmb->add_field(array(
            'id'          => 'tambien_te_puede_interesar_categorias',
            'type'        => 'group',
            'description' => __('Categorias relacionadas', 'cmb2'),
            // 'repeatable'  => false, // use false if you want non-repeatable group
            'options'     => array(
                'group_title'   => __('Entrada {#}', 'cmb2'), // since version 1.1.4, {#} gets replaced by row number
                'add_button'    => __('Agregar', 'cmb2'),
                'remove_button' => __('Eliminar', 'cmb2'),
                'sortable'      => true, // beta
                // 'closed'     => true, // true to have the groups closed by default
            ),
        ));
        $cmb->add_group_field($group_field_id, array(
            'name'    => 'Entrada',
            'desc'    => 'Aqui selecciona la categoria relacionada',
            'id'      => 'entrada_tax',
            'type'    => 'select',
            'show_option_none' => true,
            'options' => get_mytaxonomy_options(array('not_categorias', 'divisiones')),
        ));


        $cmb->add_field(array(
            'name'    => 'Volver',
            'desc'    => 'Aqui selecciona a el centro que quiere volver',
            'id'      => 'boton_volver',
            'type'    => 'select',
            'show_option_none' => true,
            'options' => get_myposttype_options(array('ecs-artinicio')),
        ));
    }

    /*public function add_metabox_sidebar(){
        $cmb = new_cmb2_box( array(
            'id'           => 'cmb2_text_email_metabox',
            'title'        => 'Información Barra Lateral',
            'object_types' => array( 'post','page','manuelita-noticias' ),
        ) );

        $cmb->add_field( array(
            'name' => __( 'Barra Lateral', 'enigmind' ),
            'desc' => __( 'Seleccione los items que quiere para este articulo', 'enigmind' ),
            'id'   =>   'sidebar_data',
            'options' => get_sitebar_array(),
            'type' => 'multicheck',
        ) );
    }*/


    public function custom_metaboxes_carrers()
    {
        $workwithusPageID = of_get_option('work_with_us_page_id');
        /****
         *
         * FIELD FOR PAGE WORK WITH US
         *
         *
         */
        if ($workwithusPageID) {
            $cmb = new_cmb2_box(array(
                'id'           => 'fields_work_with_us',
                'title'        => __('Información Adicional', 'enigmind'),
                'object_types' => array('page',), // Post type
                'context'      => 'normal',
                'priority'     => 'high',
                'show_names'   => true, // Show field names on the left
                'show_on'      => array('id' => array($workwithusPageID)), // Specific post IDs to display this metabox
            ));


            $cmb->add_field(array(
                'name'    => 'Titulo Modulo 1',
                'desc'    => '',
                'id'      => 'titlemod1',
                'type'    => 'text',
            ));

            $cmb->add_field(array(
                'name'    => 'Titulo Modulo 2',
                'desc'    => '',
                'id'      => 'titlemod2',
                'type'    => 'text',
            ));

            $cmb->add_field(array(
                'name'    => 'Titulo Modulo 3',
                'desc'    => '',
                'id'      => 'titlemod3',
                'type'    => 'text',
            ));

            $cmb->add_field(array(
                'name'    => 'Titulo Modulo 4',
                'desc'    => '',
                'id'      => 'titlemod4',
                'type'    => 'text',
            ));

            $cmb->add_field(array(
                'name'    => 'Titulo Modulo 5',
                'desc'    => '',
                'id'      => 'titlemod5',
                'type'    => 'text',
            ));

            $cmb->add_field(array(
                'name'    => 'Titulo Modulo 6',
                'desc'    => '',
                'id'      => 'titlemod6',
                'type'    => 'text',
            ));



            $cmb->add_field(array(
                'name'    => 'Texto parte de nuestra familia',
                'desc'    => '',
                'id'      => 'textfamily',
                'type'    => 'textarea',
            ));

            $group_field_id = $cmb->add_field(array(
                'id'          => 'items_family',
                'type'        => 'group',
                'description' => __('Items parte nuestra familia', 'cmb2'),
                // 'repeatable'  => false, // use false if you want non-repeatable group
                'options'     => array(
                    'group_title'       => __('Entrada {#}', 'cmb2'), // since version 1.1.4, {#} gets replaced by row number
                    'add_button'        => __('Agregar', 'cmb2'),
                    'remove_button'     => __('Eliminar', 'cmb2'),
                    'sortable'          => true,
                    // 'closed'         => true, // true to have the groups closed by default
                    // 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
                ),
            ));

            // Id's for group's fields only need to be unique for the group. Prefix is not needed.
            $cmb->add_group_field($group_field_id, array(
                'name' => 'Titulo',
                'id'   => 'title',
                'type' => 'text',
            ));
            $cmb->add_group_field($group_field_id, array(
                'name' => 'Texto',
                'id'   => 'text',
                'type' => 'textarea',
            ));
            $cmb->add_group_field($group_field_id, array(
                'name' => 'Imagen',
                'id'   => 'image',
                'type' => 'file',
            ));


            $group_field_id = $cmb->add_field(array(
                'id'          => 'items_presence',
                'type'        => 'group',
                'description' => __('Items parte presencia regional', 'cmb2'),
                // 'repeatable'  => false, // use false if you want non-repeatable group
                'options'     => array(
                    'group_title'       => __('Entrada {#}', 'cmb2'), // since version 1.1.4, {#} gets replaced by row number
                    'add_button'        => __('Agregar', 'cmb2'),
                    'remove_button'     => __('Eliminar', 'cmb2'),
                    'sortable'          => true,
                    // 'closed'         => true, // true to have the groups closed by default
                    // 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
                ),
            ));
            $cmb->add_group_field($group_field_id, array(
                'name' => 'Pais',
                'id'   => 'country',
                'type' => 'text',
            ));

            $cmb->add_group_field($group_field_id, array(
                'name' => 'Galeria',
                'id'   => 'gallery',
                'type' => 'file_list',
                'text' => array(
                    'add_upload_files_text' => 'Agregar', // default: "Add or Upload Files"
                    'remove_image_text' => 'Eliminar', // default: "Remove Image"
                    'file_text' => 'Archivo', // default: "File:"
                    'file_download_text' => 'Descargar', // default: "Download"
                    'remove_text' => 'Eliminar', // default: "Remove"
                ),
            ));

            $cmb->add_field(array(
                'name'    => 'Texto Beneficios',
                'desc'    => '',
                'id'      => 'textbenefit',
                'type'    => 'textarea',
            ));


            $group_field_id = $cmb->add_field(array(
                'id'          => 'items_benefit',
                'type'        => 'group',
                'description' => __('Items parte Beneficios', 'cmb2'),
                // 'repeatable'  => false, // use false if you want non-repeatable group
                'options'     => array(
                    'group_title'       => __('Entrada {#}', 'cmb2'), // since version 1.1.4, {#} gets replaced by row number
                    'add_button'        => __('Agregar', 'cmb2'),
                    'remove_button'     => __('Eliminar', 'cmb2'),
                    'sortable'          => true,
                    // 'closed'         => true, // true to have the groups closed by default
                    // 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
                ),
            ));

            // Id's for group's fields only need to be unique for the group. Prefix is not needed.
            $cmb->add_group_field($group_field_id, array(
                'name' => 'Titulo',
                'id'   => 'title',
                'type' => 'text',
            ));
            $cmb->add_group_field($group_field_id, array(
                'name' => 'Texto',
                'id'   => 'text',
                'type' => 'textarea',
            ));
            $cmb->add_group_field($group_field_id, array(
                'name' => 'Texto PopUp',
                'id'   => 'text_popup',
                'type' => 'textarea',
            ));
            $cmb->add_group_field($group_field_id, array(
                'name' => 'Imagen',
                'id'   => 'image',
                'type' => 'file',
            ));

            $group_field_id = $cmb->add_field(array(
                'id'          => 'items_certification',
                'type'        => 'group',
                'description' => __('Items De certificaciones', 'cmb2'),
                // 'repeatable'  => false, // use false if you want non-repeatable group
                'options'     => array(
                    'group_title'       => __('Entrada {#}', 'cmb2'), // since version 1.1.4, {#} gets replaced by row number
                    'add_button'        => __('Agregar', 'cmb2'),
                    'remove_button'     => __('Eliminar', 'cmb2'),
                    'sortable'          => true,
                    // 'closed'         => true, // true to have the groups closed by default
                    // 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
                ),
            ));

            // Id's for group's fields only need to be unique for the group. Prefix is not needed.
            $cmb->add_group_field($group_field_id, array(
                'name' => 'Titulo',
                'id'   => 'title',
                'type' => 'text',
            ));
            $cmb->add_group_field($group_field_id, array(
                'name' => 'Texto',
                'id'   => 'text',
                'type' => 'textarea',
            ));
            $cmb->add_group_field($group_field_id, array(
                'name' => 'Imagen',
                'id'   => 'image',
                'type' => 'file',
            ));


            $cmb->add_field(array(
                'name'    => 'Texto Testimonios',
                'desc'    => '',
                'id'      => 'texttestimonials',
                'type'    => 'textarea',
            ));



            $group_field_id = $cmb->add_field(array(
                'id'          => 'items_testimonials',
                'type'        => 'group',
                'description' => __('Items De Testimonios', 'cmb2'),
                // 'repeatable'  => false, // use false if you want non-repeatable group
                'options'     => array(
                    'group_title'       => __('Entrada {#}', 'cmb2'), // since version 1.1.4, {#} gets replaced by row number
                    'add_button'        => __('Agregar', 'cmb2'),
                    'remove_button'     => __('Eliminar', 'cmb2'),
                    'sortable'          => true,
                    // 'closed'         => true, // true to have the groups closed by default
                    // 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
                ),
            ));

            // Id's for group's fields only need to be unique for the group. Prefix is not needed.
            $cmb->add_group_field($group_field_id, array(
                'name' => 'Titulo',
                'id'   => 'title',
                'type' => 'text',
            ));
            $cmb->add_group_field($group_field_id, array(
                'name' => 'Link Youtube',
                'id'   => 'linkyoutube',
                'type' => 'text',
            ));
            $cmb->add_group_field($group_field_id, array(
                'name' => 'Imagen',
                'id'   => 'image',
                'type' => 'file',
            ));
        }
    }



    public function custom_metaboxes_sostenibilidad()
    {

        global $manuelita_options;
        $pageHomeReporteSostenibilidad = 73439;
        $pageSostenibilidad = 73666;

        if ($pageSostenibilidad) {
            $cmb = new_cmb2_box(array(
                'id'           => 'sost_custom_metabox_areas',
                'title'        => __('Información Pagina', 'enigmind'),
                'object_types' => array('page',), // Post type
                'context'      => 'normal',
                'priority'     => 'high',
                'show_names'   => true, // Show field names on the left
                'show_on'      => array('id' => array($pageSostenibilidad)), // Specific post IDs to display this metabox
            ));

            $cmb->add_field(array(
                'name'    => 'Texto Icono',
                'id'      => 'description_icon',
                'type'    => 'textarea_small',
            ));

            $cmb->add_field(array(
                'name'    => 'Icono',
                'id'      => 'path_icon',
                'type'    => 'file',
            ));

            $cmb->add_field(array(
                'name'    => 'Mapa',
                'id'      => 'path_map',
                'type'    => 'file',
            ));

            $cmb->add_field(array(
                'name'    => 'Texto Mapa',
                'id'      => 'description_map',
                'type'    => 'textarea_small',
            ));

            $cmb->add_field(array(
                'name'    => 'Datos contacto',
                'id'      => 'contact_info',
                'type'    => 'wysiwyg',
            ));

            $cmb->add_field(array(
                'name'    => 'Titulo presidente',
                'id'      => 'title_president',
                'type'    => 'text',
            ));
            $cmb->add_field(array(
                'name'    => 'Foto presidente',
                'id'      => 'image_president',
                'type'    => 'file',
            ));

            $cmb->add_field(array(
                'name'    => 'Pie de  pagina  foto',
                'id'      => 'text_footer_image',
                'type'    => 'textarea_small',
            ));

            $cmb->add_field(array(
                'name'    => 'Texto 2 Pie de  pagina  foto',
                'id'      => 'text_footer_2_image',
                'type'    => 'textarea_small',
            ));

            $cmb->add_field(array(
                'name'    => 'Texto Derecha presidente',
                'id'      => 'text_large_president',
                'type'    => 'wysiwyg',
            ));

            $cmb->add_field(array(
                'name'    => 'PDF',
                'id'      => 'pdf_file',
                'type'    => 'file',
            ));
        }

        if ($pageHomeReporteSostenibilidad) {
            $cmb = new_cmb2_box(array(
                'id'           => 'sost_rep_custom_metabox_areas',
                'title'        => __('Información Pagina', 'enigmind'),
                'object_types' => array('page',), // Post type
                'context'      => 'normal',
                'priority'     => 'high',
                'show_names'   => true, // Show field names on the left
                'show_on'      => array('id' => array($pageHomeReporteSostenibilidad)), // Specific post IDs to display this metabox
            ));
            $cmb->add_field(array(
                'name'    => 'Image  footer',
                'id'      => 'image_footer',
                'type'    => 'file',
            ));
            $cmb->add_field(array(
                'name'    => 'PDF',
                'id'      => 'pdf_file',
                'type'    => 'file',
            ));
        }
    }

    public function add_metaboxes()
    {
        //$this->custom_metaboxes_carrers();
        //$this->add_metabox_post_modals();
        //$this->add_metabox_sidebar();
        //$this->custom_metaboxes();
        //$this->custom_metaboxes_sostenibilidad();
    }

    public function textdomain()
    {
        load_plugin_textdomain('ecs', false, dirname(plugin_basename(__FILE__)) . '/languages/');
    }
}
global $ecsProject;

$ecsProject = new ECS_Project_Manager();

do_action('ecs_project_initialized');
