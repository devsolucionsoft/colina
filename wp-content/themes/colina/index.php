<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
</head>

<body>
    <main>
        <?php get_header(); ?>

        <?php get_template_part('template-parts/hero-banner'); ?>

        <!-- <section class="about-and-documents" data-aos="fade-up" data-aos-duration="800">
            <?php
            $home_id = of_get_option('home_page');
            $about_title = get_post_meta($home_id, 'about_title', true);
            $about_subtitle = get_post_meta($home_id, 'about_subtitle', true);
            $about_text = get_post_meta($home_id, 'about_text', true);
            $about_btn_text = get_post_meta($home_id, 'about_btn_text', true);
            $about_btn_link = get_post_meta($home_id, 'about_btn_link', true);
            ?>
            <section class="about-us" data-aos="fade-up" data-aos-duration="800">
                <div class="up" data-aos="fade-right" data-aos-delay="200">
                    <div class="message" data-aos="fade-up" data-aos-delay="300">
                        <div class="title" data-aos="fade-right" data-aos-delay="400">
                            <?php if ($about_title): ?><h3 data-aos="fade-up" data-aos-delay="500"><?php echo esc_html($about_title); ?></h3><?php endif; ?>
                            <?php if ($about_subtitle): ?><h2 data-aos="fade-up" data-aos-delay="600"><?php echo esc_html($about_subtitle); ?></h2><?php endif; ?>
                        </div>
                        <?php if ($about_text): ?><p data-aos="fade-up" data-aos-delay="700"><?php echo $about_text; ?></p><?php endif; ?>
                    </div>
                    <?php if ($about_btn_text && $about_btn_link): ?>
                        <a class="btn" href="<?php echo esc_url($about_btn_link); ?>" data-aos="zoom-in" data-aos-delay="800"><?php echo esc_html($about_btn_text); ?></a>
                    <?php endif; ?>
                    <div class="decorative-rectangles about-us" data-aos="fade-left" data-aos-delay="100" data-aos-anchor-placement="top-bottom">
                        <div class="rectangle rect-1" data-aos="fade-up" data-aos-delay="200" data-aos-anchor-placement="top-bottom"></div>
                        <div class="rectangle rect-2" data-aos="fade-up" data-aos-delay="300" data-aos-anchor-placement="top-bottom"></div>
                        <div class="rectangle rect-3" data-aos="fade-up" data-aos-delay="400" data-aos-anchor-placement="top-bottom"></div>
                    </div>
                </div>
                <?php get_template_part('template-parts/principles'); ?>
            </section>

            <?php
            $documents = get_documents();
            $documents_count = count($documents);
            $documents_title = get_post_meta($home_id, 'documents_title', true);
            $documents_subtitle = get_post_meta($home_id, 'documents_subtitle', true);
            $documents_description = get_post_meta($home_id, 'documents_description', true);
            $documents_btn_text = get_post_meta($home_id, 'documents_btn_text', true);
            $documents_btn_link = get_post_meta($home_id, 'documents_btn_link', true);
            ?>
            <?php if ($documents_count > 0): ?>
                <section class="documents-section" data-aos="fade-up" data-aos-duration="800">
                    <div class="section-header" data-aos="fade-right" data-aos-delay="200">
                        <?php if ($documents_btn_text && $documents_btn_link): ?>
                            <a href="<?php echo esc_url($documents_btn_link); ?>" class="btn-more-info btn" data-aos="flip-left" data-aos-delay="300"><?php echo esc_html($documents_btn_text); ?></a>
                        <?php else: ?>
                            <a href="#" class="btn-more-info btn" data-aos="flip-left" data-aos-delay="300">Más información</a>
                        <?php endif; ?>
                        <div class="section-title-container" data-aos="fade-up" data-aos-delay="400">
                            <?php if ($documents_title): ?><h2 class="section-title" data-aos="fade-right" data-aos-delay="500"><?php echo esc_html($documents_title); ?></h2><?php endif; ?>
                            <?php if ($documents_subtitle): ?><h3 class="section-subtitle" data-aos="fade-right" data-aos-delay="600"><?php echo esc_html($documents_subtitle); ?></h3><?php endif; ?>
                            <?php if ($documents_description): ?><p class="section-description" data-aos="fade-up" data-aos-delay="700"><?php echo esc_html($documents_description); ?></p><?php endif; ?>
                        </div>

                        <div class="decorative-rectangles documents" data-aos="fade-left" data-aos-delay="100" data-aos-anchor-placement="top-bottom">
                            <div class="rectangle rect-1" data-aos="zoom-in" data-aos-delay="200" data-aos-anchor-placement="top-bottom"></div>
                            <div class="rectangle rect-2" data-aos="zoom-in" data-aos-delay="300" data-aos-anchor-placement="top-bottom"></div>
                            <div class="rectangle rect-3" data-aos="zoom-in" data-aos-delay="400" data-aos-anchor-placement="top-bottom"></div>
                        </div>
                    </div>

                    <?php if ($documents_count > 1): ?>
                        <div class="documents-swiper-container" data-aos="fade-up" data-aos-delay="600">
                            <div class="swiper documents-swiper">
                                <div class="swiper-wrapper">
                                    <?php foreach ($documents as $index => $document): ?>
                                        <div class="swiper-slide" data-aos="fade-up" data-aos-delay="<?php echo 700 + ($index * 100); ?>">
                                            <div class="document-card" data-aos="zoom-in-up" data-aos-delay="<?php echo 800 + ($index * 100); ?>">
                                                <div class="document-icon" data-aos="bounce" data-aos-delay="<?php echo 900 + ($index * 100); ?>">
                                                    <svg width="31" height="32" viewBox="0 0 31 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.1283 17.1537H11.6025V13.8203H13.4617C13.8803 13.8203 14.2307 13.6794 14.5129 13.3974C14.7949 13.1152 14.9358 12.7648 14.9358 12.3462V10.487C14.9358 10.0684 14.7949 9.71798 14.5129 9.43575C14.2307 9.15381 13.8803 9.01284 13.4617 9.01284H10.1283V17.1537ZM11.6025 12.3462V10.487H13.4617V12.3462H11.6025ZM16.6346 17.1537H19.9038C20.3226 17.1537 20.6731 17.0127 20.955 16.7308C21.2372 16.4485 21.3783 16.0981 21.3783 15.6795V10.487C21.3783 10.0684 21.2372 9.71798 20.955 9.43575C20.6731 9.15381 20.3226 9.01284 19.9038 9.01284H16.6346V17.1537ZM18.1087 15.6795V10.487H19.9038V15.6795H18.1087ZM23.2371 17.1537H24.7117V13.8203H26.6988V12.3462H24.7117V10.487H26.6988V9.01284H23.2371V17.1537ZM8.84625 25.5833C8.00431 25.5833 7.29167 25.2916 6.70833 24.7083C6.125 24.1249 5.83333 23.4123 5.83333 22.5703V3.59617C5.83333 2.75422 6.125 2.04159 6.70833 1.45825C7.29167 0.874919 8.00431 0.583252 8.84625 0.583252H27.8204C28.6624 0.583252 29.375 0.874919 29.9583 1.45825C30.5417 2.04159 30.8333 2.75422 30.8333 3.59617V22.5703C30.8333 23.4123 30.5417 24.1249 29.9583 24.7083C29.375 25.2916 28.6624 25.5833 27.8204 25.5833H8.84625ZM8.84625 23.0833H27.8204C27.9488 23.0833 28.0663 23.0298 28.1729 22.9228C28.2799 22.8162 28.3333 22.6987 28.3333 22.5703V3.59617C28.3333 3.46784 28.2799 3.35033 28.1729 3.24367C28.0663 3.13672 27.9488 3.08325 27.8204 3.08325H8.84625C8.71792 3.08325 8.60042 3.13672 8.49375 3.24367C8.38681 3.35033 8.33333 3.46784 8.33333 3.59617V22.5703C8.33333 22.6987 8.38681 22.8162 8.49375 22.9228C8.60042 23.0298 8.71792 23.0833 8.84625 23.0833ZM3.01292 31.4166C2.17097 31.4166 1.45833 31.1249 0.875 30.5416C0.291667 29.9583 0 29.2456 0 28.4037V6.9295H2.5V28.4037C2.5 28.532 2.55347 28.6495 2.66042 28.7562C2.76708 28.8631 2.88458 28.9166 3.01292 28.9166H24.4871V31.4166H3.01292Z" fill="white" />
                                                    </svg>
                                                </div>
                                                <div class="document-content" data-aos="fade-up" data-aos-delay="<?php echo 1000 + ($index * 100); ?>">
                                                    <h4 class="document-title"><?php echo esc_html($document['title']); ?></h4>
                                                    <a href="<?php echo esc_url($document['pdf_url']); ?>"
                                                        class="download-link"
                                                        download
                                                        title="Descargar <?php echo esc_attr($document['title']); ?>"
                                                        data-aos="fade-left" data-aos-delay="<?php echo 1100 + ($index * 100); ?>">
                                                        <span class="download-text">Descargar</span>
                                                        <svg class="download-icon" width="16" height="16" viewBox="0 0 24 24" fill="none">
                                                            <path d="M21 15V19C21 20.1 20.1 21 19 21H5C3.9 21 3 20.1 3 19V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M7 10L12 15L17 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M12 15V3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="swiper-button-next documents-next" data-aos="fade-left" data-aos-delay="1000"></div>
                            <div class="swiper-button-prev documents-prev" data-aos="fade-right" data-aos-delay="1000"></div>
                        </div>

                    <?php else: ?>
                        <div class="single-document" data-aos="zoom-in" data-aos-delay="600">
                            <?php $document = $documents[0]; ?>
                            <div class="document-card" data-aos="flip-up" data-aos-delay="700">
                                <div class="document-icon" data-aos="bounce" data-aos-delay="800">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14 2H6C4.9 2 4 2.9 4 4V20C4 21.1 4.89 22 5.99 22H18C19.1 22 20 21.1 20 20V8L14 2Z" fill="#D71F26" />
                                        <path d="M14 2V8H20" stroke="white" stroke-width="1" fill="white" />
                                        <text x="12" y="16" font-family="Arial" font-size="4" fill="white" text-anchor="middle" font-weight="bold">PDF</text>
                                    </svg>
                                </div>
                                <div class="document-content" data-aos="fade-up" data-aos-delay="900">
                                    <h4 class="document-title"><?php echo esc_html($document['title']); ?></h4>
                                    <a href="<?php echo esc_url($document['pdf_url']); ?>"
                                        class="download-link"
                                        download
                                        title="Descargar <?php echo esc_attr($document['title']); ?>"
                                        data-aos="fade-left" data-aos-delay="1000">
                                        <span class="download-text">Descargar</span>
                                        <svg class="download-icon" width="16" height="16" viewBox="0 0 24 24" fill="none">
                                            <path d="M21 15V19C21 20.1 20.1 21 19 21H5C3.9 21 3 20.1 3 19V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M7 10L12 15L17 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M12 15V3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </section>
            <?php endif; ?>
        </section> -->

        <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
            <?php get_template_part('template-parts/news-section'); ?>
        </div>

        <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
            <?php get_template_part('template-parts/contact'); ?>
        </div>

        <div data-aos="fade-up" data-aos-duration="600">
            <?php get_template_part('template-parts/companies-section'); ?>
        </div>

        <?php get_footer(); ?>
    </main>
</body>

</html>