<?php

/**
 * User: Solucionsoft DEV
 * Email: contacto@solucionsoft.com
 */

add_theme_support('post-thumbnails');
require get_template_directory() . '/includes/general_functions.php';
require get_template_directory() . '/includes/js_css.php';
require get_template_directory() . '/includes/class-wp-nav-menu-link-class.php';
require get_template_directory() . '/includes/contact-form-handler.php';

function remove_editor()
{
    remove_post_type_support('ss-banner-home', 'editor');
    remove_post_type_support('ss-banner-home', 'excerpt');
    remove_post_type_support('ss-client', 'editor');
    remove_post_type_support('ss-client', 'excerpt');
    remove_post_type_support('ss-document', 'editor');
    remove_post_type_support('ss-document', 'excerpt');
}
add_action('admin_menu', 'remove_editor');

function get_companies_clients()
{
    $clients = get_posts(array(
        'post_type' => 'ss-client',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
    ));

    $clients_data = array();

    foreach ($clients as $client) {
        $client_image = get_post_meta($client->ID, 'client_images', true);
        $image_url = '';

        if ($client_image) {
            if (is_numeric($client_image)) {
                $image_url = wp_get_attachment_image_url($client_image, 'medium');
            } else {
                $image_url = $client_image;
            }
        }

        $clients_data[] = array(
            'id' => $client->ID,
            'title' => $client->post_title,
            'image' => $image_url,
            'excerpt' => $client->post_excerpt,
            'content' => $client->post_content
        );
    }

    return $clients_data;
}

function get_documents()
{
    $documents = get_posts(array(
        'post_type' => 'ss-document',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
    ));

    $documents_data = array();

    foreach ($documents as $document) {
        // Obtener metadatos del documento
        $identifier = get_post_meta($document->ID, 'document_identifier', true);
        $pdf_file = get_post_meta($document->ID, 'document_pdf_file', true);
        $description = get_post_meta($document->ID, 'document_description', true);
        $date = get_post_meta($document->ID, 'document_date', true);

        // Obtener URL del PDF
        $pdf_url = '';
        if ($pdf_file) {
            if (is_numeric($pdf_file)) {
                $pdf_url = wp_get_attachment_url($pdf_file);
            } else {
                $pdf_url = $pdf_file;
            }
        }

        // Obtener imagen destacada (thumbnail)
        $thumbnail_url = '';
        if (has_post_thumbnail($document->ID)) {
            $thumbnail_url = get_the_post_thumbnail_url($document->ID, 'medium');
        }

        $documents_data[] = array(
            'id' => $document->ID,
            'title' => $document->post_title,
            'identifier' => $identifier,
            'description' => $description,
            'date' => $date,
            'pdf_url' => $pdf_url,
            'thumbnail_url' => $thumbnail_url,
            'excerpt' => $document->post_excerpt,
            'content' => $document->post_content
        );
    }

    return $documents_data;
}


add_action('wp_ajax_load_more_news', 'colina_load_more_news');
add_action('wp_ajax_nopriv_load_more_news', 'colina_load_more_news');
function colina_load_more_news()
{
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
    $news_query = new WP_Query([
        'post_type'      => 'post',
        'posts_per_page' => 6,
        'post_status'    => 'publish',
        'paged'          => $paged,
    ]);
    $default_img = get_template_directory_uri() . '/assets/images/news-default.jpg';
    ob_start();
    if ($news_query->have_posts()) {
        while ($news_query->have_posts()) {
            $news_query->the_post();
            echo '<div class="news-card">';
            echo '  <div class="news-image">';
            if (has_post_thumbnail()) {
                the_post_thumbnail('large');
            } else {
                echo '<img src="' . esc_url($default_img) . '" alt="Noticia">';
            }
            echo '    <div class="news-overlay">';
            echo '      <a href="' . get_the_permalink() . '" class="btn news-btn">Ver más</a>';
            echo '    </div>';
            echo '  </div>';
            echo '  <div class="news-content">';
            echo '    <span class="news-date">' . get_the_date('d/m/Y') . '</span>';
            echo '    <h4 class="news-title">' . get_the_title() . '</h4>';
            echo '  </div>';
            echo '</div>';
        }
        wp_reset_postdata();
    }
    $html = ob_get_clean();
    $has_more = ($news_query->max_num_pages > $paged);
    wp_send_json_success(['html' => $html, 'has_more' => $has_more, 'next_paged' => $paged + 1]);
    wp_die();
}
