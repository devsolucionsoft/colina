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
                        <?php foreach ($banners as $index => $banner):
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

                            // Get panel data for this banner
                            $description = get_post_meta($banner_id, 'banner_description', true);
                            if (empty($description)) {
                                $description = get_post_meta($banner_id, 'bannerhome_banner_description', true);
                            }
                            if (empty($description)) {
                                $description = 'Eleva tu empresa. Te esperamos en el norte de Bogotá.';
                            }

                            $panel_button_text = $button_text;
                            if (empty($panel_button_text)) {
                                $panel_button_text = 'Más información';
                            }

                            $panel_button_link = $button_link;
                            if (empty($panel_button_link)) {
                                $panel_button_link = '#';
                            }

                            // Get show logo setting for THIS banner
                            $banner_show_logo = get_post_meta($banner_id, 'banner_show_logo', true);
                            if (empty($banner_show_logo)) {
                                $banner_show_logo = get_post_meta($banner_id, 'bannerhome_banner_show_logo', true);
                            }
                            // Convert to boolean - CMB2 checkbox returns 'on' when checked
                            $banner_show_logo = ($banner_show_logo === 'on' || $banner_show_logo === '1' || $banner_show_logo === true);

                            $background_url = '';
                            if (!empty($background_image)) {
                                if (is_numeric($background_image)) {
                                    $background_url = wp_get_attachment_image_url($background_image, 'full');
                                } else {
                                    $background_url = $background_image;
                                }
                            }

                        ?>
                            <div class="swiper-slide hero-slide"
                                data-description="<?php echo esc_attr($description); ?>"
                                data-button-text="<?php echo esc_attr($panel_button_text); ?>"
                                data-button-link="<?php echo esc_attr($panel_button_link); ?>"
                                data-show-logo="<?php echo $banner_show_logo ? '1' : '0'; ?>">
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
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Pagination -->
                    <div class="hero-pagination">
                        <?php for ($i = 0; $i < count($banners); $i++): ?>
                            <span class="pagination-bullet <?php echo $i === 0 ? 'active' : ''; ?>" data-slide="<?php echo $i; ?>"></span>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>

            <!-- Logo en esquina inferior derecha - controlado dinámicamente -->
            <div class="hero-corner-logo" id="hero-corner-logo" style="display: none;">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/logo-colina.svg" alt="Colina">
            </div>

            <div class="hero-action-panel">
                <div class="action-content">
                    <div class="hero-nav-btn hero-prev desktop" aria-label="Anterior">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>

                    <div class="content">
                        <p id="hero-panel-text">
                            <?php
                            $first_banner = !empty($banners) ? $banners[0] : null;
                            if ($first_banner) {
                                $first_description = get_post_meta($first_banner->ID, 'banner_description', true);
                                if (empty($first_description)) {
                                    $first_description = get_post_meta($first_banner->ID, 'bannerhome_banner_description', true);
                                }
                                echo !empty($first_description) ? esc_html($first_description) : 'Eleva tu empresa. Te esperamos en el norte de Bogotá.';
                            } else {
                                echo 'Eleva tu empresa. Te esperamos en el norte de Bogotá.';
                            }
                            ?>
                        </p>
                        <div class="down">
                            <a href="<?php
                                        if ($first_banner) {
                                            $first_link = get_post_meta($first_banner->ID, 'banner_button_link', true);
                                            if (empty($first_link)) {
                                                $first_link = get_post_meta($first_banner->ID, 'bannerhome_banner_button_link', true);
                                            }
                                            echo !empty($first_link) ? esc_url($first_link) : '#';
                                        } else {
                                            echo '#';
                                        }
                                        ?>" id="hero-panel-button" class="btn">
                                <?php
                                if ($first_banner) {
                                    $first_button_text = get_post_meta($first_banner->ID, 'banner_button_text', true);
                                    if (empty($first_button_text)) {
                                        $first_button_text = get_post_meta($first_banner->ID, 'bannerhome_banner_button_text', true);
                                    }
                                    echo !empty($first_button_text) ? esc_html($first_button_text) : 'Más información';
                                } else {
                                    echo 'Más información';
                                }
                                ?>
                            </a>
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