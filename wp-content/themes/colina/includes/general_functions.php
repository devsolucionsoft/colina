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

function add_meta_tags()
{
    // Solo información básica que no maneja Yoast
    $site_author = "Solucionsoft DEV";
?>

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <meta name="author" content="<?php echo esc_attr($site_author); ?>" />
    <meta name="copyright" content="2025 Colina" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=GFS+Didot&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

<?php
}
add_action('wp_head', 'add_meta_tags');

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
