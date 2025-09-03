<?php

/**
 * Template part for displaying the hero banner with swiper
 */

// Get all published banners
$banners = get_posts(array(
    'post_type' => 'ss-banner-home',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'menu_order',
    'order' => 'ASC'
));

if ($banners): ?>
    <section class="hero-banner" id="hero-banner">
        <div class="hero-container">
            <div class="hero-swiper-container">
                <div class="swiper hero-swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($banners as $banner):
                            $banner_id = $banner->ID;

                            $background_image = get_post_meta($banner_id, 'banner_background', true);

                            if (empty($background_image)) {
                                $background_image = get_post_meta($banner_id, 'bannerhome_banner_background', true);
                            }

                            if (empty($background_image)) {
                                $background_image = get_post_thumbnail_id($banner_id);
                            }

                            $subtitle = get_post_meta($banner_id, 'banner_subtitle', true);
                            if (empty($subtitle)) {
                                $subtitle = get_post_meta($banner_id, 'bannerhome_banner_subtitle', true);
                            }

                            $title = get_post_meta($banner_id, 'banner_title', true);
                            if (empty($title)) {
                                $title = get_post_meta($banner_id, 'bannerhome_banner_title', true);
                            }

                            $button_text = get_post_meta($banner_id, 'banner_button_text', true);
                            if (empty($button_text)) {
                                $button_text = get_post_meta($banner_id, 'bannerhome_banner_button_text', true);
                            }

                            $button_link = get_post_meta($banner_id, 'banner_button_link', true);
                            if (empty($button_link)) {
                                $button_link = get_post_meta($banner_id, 'bannerhome_banner_button_link', true);
                            }

                            if (empty($title)) {
                                $title = get_the_title($banner_id);
                            }

                            $background_url = '';
                            if (!empty($background_image)) {
                                if (is_numeric($background_image)) {
                                    $background_url = wp_get_attachment_image_url($background_image, 'full');
                                } else {
                                    $background_url = $background_image;
                                }
                            }

                        ?>
                            <div class="swiper-slide hero-slide">
                                <div class="slide-background" style="background-image: url('<?php echo esc_url($background_url); ?>');" data-bg="<?php echo esc_attr($background_url); ?>">
                                    <div class="slide-overlay"></div>
                                </div>
                                <div class="slide-content">
                                    <div class="content-container">
                                        <?php if ($subtitle): ?>
                                            <p class="slide-subtitle"><?php echo esc_html($subtitle); ?></p>
                                        <?php endif; ?>

                                        <?php if ($title): ?>
                                            <h1 class="slide-title"><?php echo esc_html($title); ?></h1>
                                        <?php endif; ?>

                                        <?php if ($button_text && $button_link): ?>
                                            <a href="<?php echo esc_url($button_link); ?>" class="btn slide-btn">
                                                <?php echo esc_html($button_text); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="hero-action-panel">
                <div class="action-content">
                    <div class="hero-nav-btn hero-prev desktop" aria-label="Anterior">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>

                    <div class="content">
                        <p>Eleva tu empresa. Te esperamos en el norte de Bogotá.</p>
                        <div class="down">
                            <a href="#" class="btn">Más información</a>
                            <div class="navigation">
                                <div class="hero-nav-btn hero-prev" aria-label="Anterior">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="hero-nav-btn hero-next" aria-label="Siguiente">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="hero-nav-btn hero-next desktop" aria-label="Siguiente">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>