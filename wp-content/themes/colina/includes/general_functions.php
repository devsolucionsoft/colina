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
add_image_size('og-image', 1200, 630, true); // Tamaño optimizado para Open Graph

function add_meta_tags()
{
    // Información del sitio
    $site_name = get_bloginfo('name');
    $site_description = get_bloginfo('description');
    $site_url = home_url('/');
    $site_author = "Solucionsoft DEV";

    // Variables para contenido dinámico
    $page_title = colina_generate_seo_title();
    $page_description = colina_generate_meta_description();
    $page_url = is_home() ? $site_url : get_permalink();
    $page_image = colina_get_featured_image(null, 'og-image');
    $page_type = is_single() && get_post_type() == 'post' ? 'article' : 'website';

    // Para la página principal, usar imagen por defecto si no hay destacada
    if (is_home() || is_front_page()) {
        if (!has_post_thumbnail()) {
            $page_image = get_template_directory_uri() . '/assets/images/og-default.jpg';
        }
    }

    // Limpiar descripción
    $page_description = wp_strip_all_tags($page_description);
    $page_description = str_replace(array("\r", "\n", "\t"), ' ', $page_description);
    $page_description = trim(preg_replace('/\s+/', ' ', $page_description));
?>

    <!-- Meta tags básicos -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <meta name="author" content="<?php echo esc_attr($site_author); ?>" />
    <meta name="copyright" content="2025 Colina" />
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />

    <!-- SEO Meta Tags -->
    <meta name="description" content="<?php echo esc_attr($page_description); ?>" />
    <link rel="canonical" href="<?php echo esc_url($page_url); ?>" />

    <!-- Open Graph Meta Tags -->
    <meta property="og:locale" content="es_ES" />
    <meta property="og:type" content="<?php echo esc_attr($page_type); ?>" />
    <meta property="og:title" content="<?php echo esc_attr($page_title); ?>" />
    <meta property="og:description" content="<?php echo esc_attr($page_description); ?>" />
    <meta property="og:url" content="<?php echo esc_url($page_url); ?>" />
    <meta property="og:site_name" content="<?php echo esc_attr($site_name); ?>" />
    <meta property="og:image" content="<?php echo esc_url($page_image); ?>" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:image:type" content="image/jpeg" />

    <?php if (is_single() && get_post_type() == 'post'): ?>
        <!-- Article Meta Tags para posts -->
        <meta property="article:published_time" content="<?php echo esc_attr(get_the_date('c')); ?>" />
        <meta property="article:modified_time" content="<?php echo esc_attr(get_the_modified_date('c')); ?>" />
        <meta property="article:author" content="<?php echo esc_attr(get_the_author()); ?>" />
        <meta property="article:section" content="Noticias" />
        <?php
        $tags = get_the_tags();
        if ($tags) {
            foreach ($tags as $tag) {
                echo '<meta property="article:tag" content="' . esc_attr($tag->name) . '" />' . "\n    ";
            }
        }
        ?>
    <?php endif; ?>

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@colina" />
    <meta name="twitter:creator" content="@colina" />
    <meta name="twitter:title" content="<?php echo esc_attr($page_title); ?>" />
    <meta name="twitter:description" content="<?php echo esc_attr($page_description); ?>" />
    <meta name="twitter:image" content="<?php echo esc_url($page_image); ?>" />
    <meta name="twitter:image:alt" content="<?php echo esc_attr($page_title); ?>" />

    <!-- Additional Meta Tags -->
    <meta name="theme-color" content="#1a1a1a" />
    <meta name="msapplication-TileColor" content="#1a1a1a" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />

    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/icons/logo-colina.svg" />

    <!-- Preconnect for performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=GFS+Didot&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

<?php
}
add_action('wp_head', 'add_meta_tags');

// Función para generar título optimizado para SEO
function colina_generate_seo_title()
{
    $site_name = get_bloginfo('name');
    $separator = ' | ';

    if (is_home() || is_front_page()) {
        return $site_name . $separator . get_bloginfo('description');
    }

    if (is_single() && get_post_type() == 'post') {
        return get_the_title() . $separator . 'Noticias' . $separator . $site_name;
    }

    if (is_page()) {
        $page_title = get_the_title();
        if (is_page_template('page-noticias.php')) {
            return 'Noticias' . $separator . $site_name;
        }
        if (is_page_template('page-contacto.php')) {
            return 'Contacto' . $separator . $site_name;
        }
        if (is_page_template('page-nosotros.php')) {
            return 'Nosotros' . $separator . $site_name;
        }
        return $page_title . $separator . $site_name;
    }

    return wp_get_document_title();
}

// Función para obtener imagen destacada optimizada
function colina_get_featured_image($post_id = null, $size = 'full')
{
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    if (has_post_thumbnail($post_id)) {
        return get_the_post_thumbnail_url($post_id, $size);
    }

    $post_type = get_post_type($post_id);
    return isset($default_images[$post_type]) ? $default_images[$post_type] : $default_images['default'];
}

// Filtro para el título del documento
add_filter('wp_title', 'colina_generate_seo_title');
add_filter('pre_get_document_title', 'colina_generate_seo_title');

// Función para generar descripción meta optimizada
function colina_generate_meta_description($post_id = null)
{
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    // Descripciones por defecto para páginas específicas
    $default_descriptions = array(
        'home' => 'Colina es un centro empresarial moderno ubicado en una zona estratégica. Ofrecemos espacios de trabajo, oficinas y servicios empresariales de alta calidad para hacer crecer tu negocio.',
        'noticias' => 'Mantente al día con las últimas novedades y anuncios importantes de Colina. Descubre noticias relevantes sobre nuestro centro empresarial y servicios.',
        'contacto' => 'Contáctanos para conocer más sobre nuestros servicios empresariales en Colina. Estamos aquí para ayudarte a hacer crecer tu negocio.',
        'nosotros' => 'Conoce más sobre Colina, un entorno empresarial pensado para crecer juntos. Más de 30 empresas confían en nosotros con 10,000 m² de infraestructura moderna.'
    );

    if (is_home() || is_front_page()) {
        return $default_descriptions['home'];
    }

    if (is_page_template('page-noticias.php')) {
        return $default_descriptions['noticias'];
    }

    if (is_page_template('page-contacto.php')) {
        return $default_descriptions['contacto'];
    }

    if (is_page_template('page-nosotros.php')) {
        return $default_descriptions['nosotros'];
    }

    // Para posts individuales
    if (is_single() && get_post_type() == 'post') {
        $excerpt = get_the_excerpt($post_id);
        if ($excerpt) {
            return wp_strip_all_tags($excerpt);
        }

        $content = get_the_content(null, false, $post_id);
        $content = wp_strip_all_tags($content);
        return wp_trim_words($content, 30, '...');
    }

    // Para páginas
    if (is_page()) {
        $excerpt = get_the_excerpt($post_id);
        if ($excerpt) {
            return wp_strip_all_tags($excerpt);
        }
    }

    return get_bloginfo('description');
}

// Mejorar los excerpts automáticos
function colina_custom_excerpt_length($length)
{
    return 30;
}
add_filter('excerpt_length', 'colina_custom_excerpt_length');

function colina_custom_excerpt_more($more)
{
    return '...';
}
add_filter('excerpt_more', 'colina_custom_excerpt_more');

// Función para generar breadcrumbs JSON-LD
function colina_breadcrumbs_json_ld()
{
    if (is_home() || is_front_page()) {
        return '';
    }

    $breadcrumbs = array();
    $position = 1;

    // Inicio
    $breadcrumbs[] = array(
        "@type" => "ListItem",
        "position" => $position++,
        "name" => "Inicio",
        "item" => home_url('/')
    );

    if (is_single() && get_post_type() == 'post') {
        // Para posts: Inicio > Noticias > Post Title
        $breadcrumbs[] = array(
            "@type" => "ListItem",
            "position" => $position++,
            "name" => "Noticias",
            "item" => get_permalink(get_option('page_for_posts'))
        );

        $breadcrumbs[] = array(
            "@type" => "ListItem",
            "position" => $position++,
            "name" => get_the_title(),
            "item" => get_permalink()
        );
    } elseif (is_page()) {
        $breadcrumbs[] = array(
            "@type" => "ListItem",
            "position" => $position++,
            "name" => get_the_title(),
            "item" => get_permalink()
        );
    }

    if (!empty($breadcrumbs)) {
        $json_ld = array(
            "@context" => "https://schema.org",
            "@type" => "BreadcrumbList",
            "itemListElement" => $breadcrumbs
        );

        return '<script type="application/ld+json">' . json_encode($json_ld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
    }

    return '';
}

// Función para agregar breadcrumbs al head
function colina_add_breadcrumbs_json()
{
    echo colina_breadcrumbs_json_ld();
}
add_action('wp_head', 'colina_add_breadcrumbs_json', 20);

// Mejorar el sitemap XML (si no usas un plugin de SEO)
function colina_add_sitemap_meta()
{
    if (!is_home() && !is_front_page()) {
        return;
    }

    echo '<link rel="sitemap" type="application/xml" title="Sitemap" href="' . home_url('/sitemap.xml') . '" />' . "\n";
}
add_action('wp_head', 'colina_add_sitemap_meta');

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
