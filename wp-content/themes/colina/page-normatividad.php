<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
    <?php wp_head(); ?>
</head>

<body>
    <?php get_header(); ?>

    <?php
    $normatividad_id = get_the_ID();
    $banner_img = get_post_meta($normatividad_id, 'normatividad_banner_image', true);
    $banner_title = get_post_meta($normatividad_id, 'normatividad_banner_title', true);
    $banner_subtitle = get_post_meta($normatividad_id, 'normatividad_banner_subtitle', true);
    ?>

    <section class="banner" style="background-image: url('<?php echo esc_url($banner_img); ?>');" data-aos="fade-in" data-aos-duration="1000">
        <div class="overlay light" data-aos="fade-in" data-aos-delay="300"></div>
        <div class="content" data-aos="fade-up" data-aos-delay="500">
            <div class="route" data-aos="fade-right" data-aos-delay="700">
                <div class="parent">
                    <span>Inicio</span>
                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.08398 3.75L8.08398 6.75L5.08398 9.75" stroke="#ffffff" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <span class="current">Normatividad y documentos </span>
            </div>
            <div class="info" data-aos="fade-up" data-aos-delay="800">
                <?php if ($banner_subtitle): ?><span class="subtitle" data-aos="fade-right" data-aos-delay="900"><?php echo esc_html($banner_subtitle); ?></span><?php endif; ?>
                <?php if ($banner_title): ?><h1 class="title lg" data-aos="fade-up" data-aos-delay="1000"><?php echo esc_html($banner_title); ?></h1><?php endif; ?>
            </div>
        </div>
    </section>

    <?php
    $documents = get_documents();
    ?>
    <?php if (!empty($documents)): ?>
        <section class="normatividad-documents-section" data-aos="fade-up" data-aos-duration="800">
            <div class="normatividad-documents-wrapper" data-aos="fade-up" data-aos-delay="200">
                <!-- (Desktop) -->
                <div class="decorative-rectangles items-preview-1" data-aos="fade-right" data-aos-delay="100" data-aos-anchor-placement="top-bottom">
                    <div class="rectangle rect-1" data-aos="zoom-in" data-aos-delay="200" data-aos-anchor-placement="top-bottom"></div>
                    <div class="rectangle rect-2" data-aos="zoom-in" data-aos-delay="300" data-aos-anchor-placement="top-bottom"></div>
                    <div class="rectangle rect-3" data-aos="zoom-in" data-aos-delay="400" data-aos-anchor-placement="top-bottom"></div>
                </div>
                <div class="document-preview-container" data-aos="fade-in" data-aos-delay="500">

                    <div class="document-preview-message" id="document-preview-message" data-aos="fade-up" data-aos-delay="600">
                        Selecciona un documento para previsualizarlo
                    </div>
                    <iframe id="document-preview-frame" class="document-preview-frame" src="" style="display:none;" frameborder="0"></iframe>
                </div>
                <div class="decorative-rectangles items-preview-2" data-aos="fade-left" data-aos-delay="100" data-aos-anchor-placement="top-bottom">
                    <div class="rectangle rect-1" data-aos="zoom-in" data-aos-delay="200" data-aos-anchor-placement="top-bottom"></div>
                    <div class="rectangle rect-2" data-aos="zoom-in" data-aos-delay="300" data-aos-anchor-placement="top-bottom"></div>
                    <div class="rectangle rect-3" data-aos="zoom-in" data-aos-delay="400" data-aos-anchor-placement="top-bottom"></div>
                </div>

                <!-- Listado de documentos -->
                <div class="normatividad-documents-list-container" data-aos="fade-up" data-aos-delay="400">
                    <?php
                    $section_title = get_post_meta($normatividad_id, 'normatividad_section_title', true);
                    $section_subtitle = get_post_meta($normatividad_id, 'normatividad_section_subtitle', true);
                    $section_description = get_post_meta($normatividad_id, 'normatividad_section_description', true);
                    ?>
                    <div class="section-header" data-aos="fade-right" data-aos-delay="500">
                        <?php if ($section_title): ?><h2 class="section-title" data-aos="fade-up" data-aos-delay="600"><?php echo esc_html($section_title); ?></h2><?php endif; ?>
                        <?php if ($section_subtitle): ?><h3 class="section-subtitle" data-aos="fade-up" data-aos-delay="700"><?php echo esc_html($section_subtitle); ?></h3><?php endif; ?>
                        <?php if ($section_description): ?><p class="section-description" data-aos="fade-up" data-aos-delay="800"><?php echo esc_html($section_description); ?></p><?php endif; ?>
                    </div>
                    <div class="normatividad-documents-list" data-aos="fade-up" data-aos-delay="600">
                        <?php
                        $delay = 700;
                        foreach ($documents as $i => $document): ?>
                            <div class="document-card normatividad-document-card" data-pdf-url="<?php echo esc_url($document['pdf_url']); ?>" data-title="<?php echo esc_attr($document['title']); ?>" tabindex="0" role="button" aria-label="Previsualizar <?php echo esc_attr($document['title']); ?>" data-aos="zoom-in-up" data-aos-delay="<?php echo $delay; ?>">
                                <div class="document-icon" data-aos="bounce" data-aos-delay="<?php echo $delay + 100; ?>">
                                    <svg width="31" height="32" viewBox="0 0 31 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.1283 17.1537H11.6025V13.8203H13.4617C13.8803 13.8203 14.2307 13.6794 14.5129 13.3974C14.7949 13.1152 14.9358 12.7648 14.9358 12.3462V10.487C14.9358 10.0684 14.7949 9.71798 14.5129 9.43575C14.2307 9.15381 13.8803 9.01284 13.4617 9.01284H10.1283V17.1537ZM11.6025 12.3462V10.487H13.4617V12.3462H11.6025ZM16.6346 17.1537H19.9038C20.3226 17.1537 20.6731 17.0127 20.955 16.7308C21.2372 16.4485 21.3783 16.0981 21.3783 15.6795V10.487C21.3783 10.0684 21.2372 9.71798 20.955 9.43575C20.6731 9.15381 20.3226 9.01284 19.9038 9.01284H16.6346V17.1537ZM18.1087 15.6795V10.487H19.9038V15.6795H18.1087ZM23.2371 17.1537H24.7117V13.8203H26.6988V12.3462H24.7117V10.487H26.6988V9.01284H23.2371V17.1537ZM8.84625 25.5833C8.00431 25.5833 7.29167 25.2916 6.70833 24.7083C6.125 24.1249 5.83333 23.4123 5.83333 22.5703V3.59617C5.83333 2.75422 6.125 2.04159 6.70833 1.45825C7.29167 0.874919 8.00431 0.583252 8.84625 0.583252H27.8204C28.6624 0.583252 29.375 0.874919 29.9583 1.45825C30.5417 2.04159 30.8333 2.75422 30.8333 3.59617V22.5703C30.8333 23.4123 30.5417 24.1249 29.9583 24.7083C29.375 25.2916 28.6624 25.5833 27.8204 25.5833H8.84625ZM8.84625 23.0833H27.8204C27.9488 23.0833 28.0663 23.0298 28.1729 22.9228C28.2799 22.8162 28.3333 22.6987 28.3333 22.5703V3.59617C28.3333 3.46784 28.2799 3.35033 28.1729 3.24367C28.0663 3.13672 27.9488 3.08325 27.8204 3.08325H8.84625C8.71792 3.08325 8.60042 3.13672 8.49375 3.24367C8.38681 3.35033 8.33333 3.46784 8.33333 3.59617V22.5703C8.33333 22.6987 8.38681 22.8162 8.49375 22.9228C8.60042 23.0298 8.71792 23.0833 8.84625 23.0833ZM3.01292 31.4166C2.17097 31.4166 1.45833 31.1249 0.875 30.5416C0.291667 29.9583 0 29.2456 0 28.4037V6.9295H2.5V28.4037C2.5 28.532 2.55347 28.6495 2.66042 28.7562C2.76708 28.8631 2.88458 28.9166 3.01292 28.9166H24.4871V31.4166H3.01292Z" fill="white" />
                                    </svg>
                                </div>
                                <div class="document-content" data-aos="fade-up" data-aos-delay="<?php echo $delay + 150; ?>">
                                    <h4 class="document-title"><?php echo esc_html($document['title']); ?></h4>
                                    <a href="<?php echo esc_url($document['pdf_url']); ?>" class="download-link" download title="Descargar <?php echo esc_attr($document['title']); ?>" onclick="event.stopPropagation();" data-aos="fade-left" data-aos-delay="<?php echo $delay + 200; ?>">
                                        <span class="download-text">Descargar</span>
                                        <svg class="download-icon" width="16" height="16" viewBox="0 0 24 24" fill="none">
                                            <path d="M21 15V19C21 20.1 20.1 21 19 21H5C3.9 21 3 20.1 3 19V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M7 10L12 15L17 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M12 15V3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        <?php
                            $delay += 100;
                        endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Popup para mobile -->
            <div class="document-popup-overlay" id="document-popup-overlay" data-aos="fade-in" data-aos-duration="300">
                <div class="document-popup-modal" data-aos="zoom-in" data-aos-delay="100">
                    <button class="document-popup-close" id="document-popup-close" aria-label="Cerrar" data-aos="fade-in" data-aos-delay="200">&times;</button>
                    <div class="document-popup-title" id="document-popup-title" data-aos="fade-up" data-aos-delay="300"></div>
                    <iframe id="document-popup-frame" class="document-popup-frame" src="" frameborder="0" data-aos="fade-in" data-aos-delay="400"></iframe>
                    <a href="#" class="download-link document-popup-download" id="document-popup-download" download target="_blank" data-aos="fade-up" data-aos-delay="500">
                        <span class="download-text">Descargar</span>
                        <svg class="download-icon" width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path d="M21 15V19C21 20.1 20.1 21 19 21H5C3.9 21 3 20.1 3 19V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M7 10L12 15L17 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 15V3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>
    <?php endif; ?>


    <?php
    $payments_title = get_post_meta($normatividad_id, 'payments_title', true);
    $payments_subtitle = get_post_meta($normatividad_id, 'payments_subtitle', true);
    $payments_text = get_post_meta($normatividad_id, 'payments_text', true);
    $payments_btn_text = get_post_meta($normatividad_id, 'payments_btn_text', true);
    $payments_btn_link = get_post_meta($normatividad_id, 'payments_btn_link', true);
    $diamond_image = get_post_meta($normatividad_id, 'diamond_image', true);
    ?>
    <?php
    // Preparar background dinámico para la sección payments
    $payments_bg_style = '';
    if ($diamond_image) {
        $payments_bg_style = "background-image: url('" . esc_url($diamond_image) . "'); background-repeat: no-repeat; background-position: top left; background-size: cover;";
    }
    ?>
    <?php if ($diamond_image): ?>
        <style>
            @media (max-width: 768px) {
                .payments::after {
                    background-image: url('<?php echo esc_url($diamond_image); ?>') !important;
                }
            }
        </style>
    <?php endif; ?>
    <section class="payments" <?php if ($payments_bg_style): ?> style="<?php echo $payments_bg_style; ?>" <?php endif; ?> data-aos="fade-up" data-aos-duration="800">
        <div class="information" data-aos="fade-right" data-aos-delay="200">
            <div class="text" data-aos="fade-up" data-aos-delay="300">
                <?php if ($payments_title): ?><h3 data-aos="fade-right" data-aos-delay="400"><?php echo esc_html($payments_title); ?></h3><?php endif; ?>
                <?php if ($payments_subtitle): ?><h2 data-aos="fade-right" data-aos-delay="500"><?php echo esc_html($payments_subtitle); ?></h2><?php endif; ?>
                <?php if ($payments_text): ?><p data-aos="fade-up" data-aos-delay="600"><?php echo $payments_text; ?></p><?php endif; ?>
            </div>
            <?php if ($payments_btn_text): ?>
                <a class="btn" <?php echo $payments_btn_link ? 'href="' . esc_url($payments_btn_link) . '"' : 'onclick="return false;" style="cursor: default;"'; ?> data-aos="zoom-in" data-aos-delay="700"><?php echo esc_html($payments_btn_text); ?></a>
            <?php endif; ?>
        </div>
        <figure class="diamond" data-aos="fade-left" data-aos-delay="400">
            <div class="diamond-shape" data-aos="flip-right" data-aos-delay="600">
                <div class="left" <?php if ($diamond_image): ?> style="background-image: url('<?php echo esc_url($diamond_image); ?>'); background-size: cover; background-position: right center; background-repeat: no-repeat;" <?php endif; ?> data-aos="slide-right" data-aos-delay="800"></div>
                <div class="right" data-aos="slide-left" data-aos-delay="900"></div>
            </div>
        </figure>
    </section>

    <div data-aos="fade-up" data-aos-duration="600" data-aos-delay="200">
        <?php get_template_part('template-parts/companies-section'); ?>
    </div>

    <?php get_footer(); ?>
</body>

</html>