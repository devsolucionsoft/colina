<?php

/**
 * User: Solucionsoft DEV
 * Email: contacto@solucionsoft.com
 */

// Registro de menús
function nav_menus()
{
    register_nav_menus(array(
        'main' => __('Primary', 'translate-ss'),
        'footer' => __('Footer', 'translate-ss'),
        'legal' => __('Legal', 'translate-ss'),
    ));
}
add_action('after_setup_theme', 'nav_menus');

// Soporte para imágenes destacadas
add_theme_support('post-thumbnails');
add_image_size('og-image', 1200, 630, true);

add_action('wp_head', 'add_meta_tags');
function add_meta_tags()
{
    $page_title = colina_get_page_title();
    $page_description = colina_get_page_description();
    $page_image = colina_get_featured_image();
?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo esc_attr($page_title); ?></title>
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon" />

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo esc_attr(colina_get_og_title()); ?>">
    <meta property="og:description" content="<?php echo esc_attr($page_description); ?>">
    <meta property="og:type" content="<?php echo is_single() ? 'article' : 'website'; ?>">
    <meta property="og:url" content="<?php echo esc_url(is_home() ? home_url() : get_permalink()); ?>">
    <meta property="og:image" content="<?php echo esc_url($page_image); ?>">
    <meta property="og:image:secure_url" content="<?php echo esc_url($page_image); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="<?php echo esc_attr(colina_get_og_title()); ?>">
    <meta property="og:site_name" content="Colina">
    <meta property="og:locale" content="es_ES">

    <?php if (is_single() && get_post_type() == 'post'): ?>
        <!-- Article Meta Tags -->
        <meta property="article:published_time" content="<?php echo esc_attr(get_the_date('c')); ?>">
        <meta property="article:modified_time" content="<?php echo esc_attr(get_the_modified_date('c')); ?>">
        <meta property="article:author" content="<?php echo esc_attr(get_the_author()); ?>">
        <meta property="article:section" content="Noticias">
    <?php endif; ?>

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr(colina_get_og_title()); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr($page_description); ?>">
    <meta name="twitter:image" content="<?php echo esc_url($page_image); ?>">

    <!-- SEO Meta Tags -->
    <meta name="description" content="<?php echo esc_attr($page_description); ?>">
    <meta name="keywords" content="Colina, centro empresarial, oficinas, espacios de trabajo, empresas, negocios">
    <meta name="author" content="Solucionsoft DEV">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo esc_url(is_home() ? home_url() : get_permalink()); ?>">
<?php
}

function colina_get_page_title()
{
    if (is_home() || is_front_page()) {
        return 'Colina - Centro empresarial moderno';
    }

    if (is_single() && get_post_type() == 'post') {
        return get_the_title() . ' - Noticias - Colina';
    }

    if (is_page()) {
        if (is_page_template('page-noticias.php')) {
            return 'Noticias - Colina';
        }
        if (is_page_template('page-contacto.php')) {
            return 'Contacto - Colina';
        }
        if (is_page_template('page-nosotros.php')) {
            return 'Nosotros - Colina';
        }
        return get_the_title() . ' - Colina';
    }

    return 'Colina';
}

function colina_get_og_title()
{
    if (is_home() || is_front_page()) {
        return 'Colina';
    }

    if (is_single() && get_post_type() == 'post') {
        return get_the_title();
    }

    if (is_page()) {
        if (is_page_template('page-noticias.php')) {
            return 'Noticias';
        }
        if (is_page_template('page-contacto.php')) {
            return 'Contacto';
        }
        if (is_page_template('page-nosotros.php')) {
            return 'Nosotros';
        }
        return get_the_title();
    }

    return get_the_title() ?: 'Colina';
}

function colina_get_page_description()
{
    if (is_home() || is_front_page()) {
        return 'Colina es un centro empresarial moderno ubicado en una zona estratégica. Ofrecemos espacios de trabajo, oficinas y servicios empresariales de alta calidad para hacer crecer tu negocio.';
    }

    if (is_page_template('page-noticias.php')) {
        return 'Mantente al día con las últimas novedades y anuncios importantes de Colina. Descubre noticias relevantes sobre nuestro centro empresarial y servicios.';
    }

    if (is_page_template('page-contacto.php')) {
        return 'Contáctanos para conocer más sobre nuestros servicios empresariales en Colina. Estamos aquí para ayudarte a hacer crecer tu negocio.';
    }

    if (is_page_template('page-nosotros.php')) {
        return 'Conoce más sobre Colina, un entorno empresarial pensado para crecer juntos. Más de 30 empresas confían en nosotros con 10,000 m² de infraestructura moderna.';
    }

    if (is_single() && get_post_type() == 'post') {
        $excerpt = get_the_excerpt();
        if ($excerpt) {
            return wp_strip_all_tags($excerpt);
        }
        $content = get_the_content();
        return wp_trim_words(wp_strip_all_tags($content), 30, '...');
    }

    if (is_page()) {
        $excerpt = get_the_excerpt();
        if ($excerpt) {
            return wp_strip_all_tags($excerpt);
        }
    }

    return 'Colina - Centro empresarial moderno ubicado en una zona estratégica';
}

function colina_get_featured_image()
{
    if (has_post_thumbnail()) {
        return get_the_post_thumbnail_url(null, 'og-image');
    }

    $default_image = get_template_directory_uri() . '/assets/images/og-default-2.jpg';
    return $default_image;
}

add_action('wp_head', 'pluginname_ajaxurl');
function pluginname_ajaxurl()
{
?>
    <script type="text/javascript">
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
        var baseurl = '<?php echo site_url(); ?>';
    </script>
<?php
}

function add_scripts()
{
    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js');
    wp_enqueue_script('aos-js', 'https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js');
    wp_enqueue_style('aos-css', 'https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css');
}
add_action('wp_enqueue_scripts', 'add_scripts');
