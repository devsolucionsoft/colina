<?php

class Project_Model_Banner
{

    private $post_type_name;
    private $post_type_singular;
    private $post_type_plural;
    private $template_parser;
    private $menu_icon;

    function __construct($template_parser)
    {
        $this->template_parser = $template_parser;
        $this->post_type_name = 'ss-banner-home';
        $this->post_type_singular = __('Banner Inicio', 'enigmind');
        $this->post_type_plural = __('Banners Inicio', 'enigmind');

        $this->menu_icon = 'dashicons-format-aside';

        add_action('init', array($this, 'create_post_type'));
        add_action('cmb2_admin_init', array($this, 'add_meta_boxes'));

        add_action('wp_enqueue_scripts', array($this, 'load_frontend_scripts'));
        add_action('wp_enqueue_scripts', array($this, 'load_frontend_styles'));

        add_action('admin_print_styles-post.php', array($this, 'load_admin_styles'), 1000);
        add_action('admin_print_styles-post-new.php', array($this, 'load_admin_styles'), 1000);

        add_action('admin_print_scripts-post.php', array($this, 'load_admin_scripts'), 1000);
        add_action('admin_print_scripts-post-new.php', array($this, 'load_admin_scripts'), 1000);
    }

    function create_post_type()
    {

        $labels = array(
            'name' => sprintf(_x('%s', 'post type general name', 'enigmind'), $this->post_type_plural),
            'singular_name' => sprintf(_x('%s', 'post type singular name', 'enigmind'), $this->post_type_singular),
            'add_new' => _x('Agregar Nueva', $this->post_type_singular, ''),
            'add_new_item' => sprintf(__('Nueva %s', 'enigmind'), $this->post_type_singular),
            'edit_item' => sprintf(__('Editar %s', 'enigmind'), $this->post_type_singular),
            'new_item' => sprintf(__('Agregar %s', 'enigmind'), $this->post_type_singular),
            'all_items' => sprintf(__('%s', 'enigmind'), $this->post_type_plural),
            'view_item' => sprintf(__('Ver %s', 'enigmind'), $this->post_type_singular),
            'search_items' => sprintf(__('Buscar', 'enigmind'), $this->post_type_plural),
            'not_found' => sprintf(__('No %s Encontrados', 'enigmind'), $this->post_type_plural),
            'not_found_in_trash' => sprintf(__('No %s Encontrados en la Papelera', 'enigmind'), $this->post_type_plural),
            'parent_item_colon' => '',
            'menu_name' => $this->post_type_plural,
        );

        $args = array(
            'labels' => $labels,
            'description'         => __('Articulos', 'enigmind'),
            'supports'            => array('title', 'thumbnail', 'excerpt', 'editor'),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 4,
            'menu_icon'           =>  $this->menu_icon,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
        );

        register_post_type($this->post_type_name, $args);
    }

    function metabox_general()
    {
        $prefix = 'bannerhome_';

        $cmb = new_cmb2_box(array(
            'id'           => $prefix . 'general',
            'title'        => __('Información del Banner', 'enigmind'),
            'object_types' => array($this->post_type_name,),
            'context'      => 'normal',
            'priority'     => 'high',
            'show_names'   => true,
        ));

        $cmb->add_field(array(
            'name'    => 'Imagen de Fondo',
            'desc'    => 'Selecciona la imagen de fondo del banner (recomendado: 1920x1080px)',
            'id'      => 'banner_background',
            'type'    => 'file'
        ));

        $cmb->add_field(array(
            'name'    => 'Subtítulo',
            'desc'    => 'Texto descriptivo que aparecerá sobre el título',
            'id'      => 'banner_subtitle',
            'type'    => 'textarea_small',
        ));

        $cmb->add_field(array(
            'name'    => 'Título Principal',
            'desc'    => 'Título principal que se mostrará en el banner',
            'id'      => 'banner_title',
            'type'    => 'text',
        ));

        $cmb->add_field(array(
            'name'    => 'Texto del Botón',
            'desc'    => 'Texto que aparecerá en el botón de llamada a la acción',
            'id'      => 'banner_button_text',
            'type'    => 'text',
        ));

        $cmb->add_field(array(
            'name'    => 'Enlace del Botón',
            'desc'    => 'URL a la que dirigirá el botón (opcional)',
            'id'      => 'banner_button_link',
            'type'    => 'text_url',
        ));
    }

    function add_meta_boxes()
    {
        $this->metabox_general();
    }

    function load_admin_styles()
    {

        global $post_type;

        if ($this->post_type_name != $post_type) {
            return;
        }

        //wp_enqueue_style('bootstrap-css', plugins_url('../js/pqrs/bootstrap.min.css', __FILE__));
    }

    function load_frontend_styles()
    {

        global $post_type;

        if ($this->post_type_name != $post_type) {
            return;
        }

        // wp_enqueue_style('dugalu-logos-css', plugins_url('../css/style.css', __FILE__));

    }

    function load_admin_scripts()
    {

        global $post_type;

        if ($this->post_type_name != $post_type) {
            return;
        }

        //wp_enqueue_script('pqrs-backend-js', plugins_url('../js/pqrs/pqrs-backend.js', __FILE__), array('jquery'), '1.0', true);
        // wp_enqueue_script('enig-comp-admin-js', plugins_url('../js/admin.js', __FILE__), array('jquery'), '1.0', true);

    }

    function load_frontend_scripts()
    {

        global $post_type;

        if ($this->post_type_name != $post_type) {
            return;
        }

        // wp_enqueue_script('indupalma-pqrs-parsley-js', plugins_url('../js/pqrs/parsley.js', __FILE__), array('jquery'), '1.0', true);
        // wp_enqueue_script('indupalma-pqrs-frontend-js', plugins_url('../js/pqrs/pqrs-frontend.js', __FILE__), array('jquery','indupalma-pqrs-parsley-js'), '1.0', true);

    }
}
