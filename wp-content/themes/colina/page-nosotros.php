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
    $about_id = get_the_ID();
    $banner_img = get_post_meta($about_id, 'about_banner_image', true);
    $banner_title = get_post_meta($about_id, 'about_banner_title', true);
    $banner_subtitle = get_post_meta($about_id, 'about_banner_subtitle', true);
    ?>
    <section class="banner" <?php if ($banner_img): ?> style="background-image: url('<?php echo esc_url($banner_img); ?>');" <?php endif; ?> data-aos="fade-in" data-aos-duration="1000">
        <div class="overlay light" data-aos="fade-in" data-aos-delay="300"></div>
        <div class="content" data-aos="fade-up" data-aos-delay="500">
            <div class="route" data-aos="fade-right" data-aos-delay="700">
                <div class="parent">
                    <span>Inicio</span>
                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.08398 3.75L8.08398 6.75L5.08398 9.75" stroke="black" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <span class="current">Sobre nosotros</span>
            </div>
            <div class="info" data-aos="fade-up" data-aos-delay="800">
                <?php if ($banner_subtitle): ?><span class="subtitle" data-aos="fade-right" data-aos-delay="900"><?php echo esc_html($banner_subtitle); ?></span><?php endif; ?>
                <?php if ($banner_title): ?><h1 class="title lg" data-aos="fade-up" data-aos-delay="1000"><?php echo esc_html($banner_title); ?></h1><?php endif; ?>
            </div>
        </div>
    </section>

    <?php
    $history_title = get_post_meta($about_id, 'about_history_title', true);
    $history_subtitle = get_post_meta($about_id, 'about_history_subtitle', true);
    $history_text = get_post_meta($about_id, 'about_history_text', true);
    $history_diamond = get_post_meta($about_id, 'about_history_diamond', true);
    ?>
    <section class="history" data-aos="fade-up" data-aos-duration="800">
        <div class="information" data-aos="fade-right" data-aos-delay="200">
            <div class="text" data-aos="fade-up" data-aos-delay="300">
                <?php if ($history_subtitle): ?><h3 data-aos="fade-right" data-aos-delay="400"><?php echo esc_html($history_subtitle); ?></h3><?php endif; ?>
                <?php if ($history_title): ?><h2 data-aos="fade-right" data-aos-delay="500"><?php echo esc_html($history_title); ?></h2><?php endif; ?>
                <?php if ($history_text): ?><p data-aos="fade-up" data-aos-delay="600"><?php echo $history_text; ?></p><?php endif; ?>
            </div>
        </div>
        <figure class="diamond" data-aos="fade-left" data-aos-delay="400">
            <div class="diamond-shape" data-aos="flip-right" data-aos-delay="600">
                <div class="left" <?php if ($history_diamond): ?> style="background-image: url('<?php echo esc_url($history_diamond); ?>'); background-size: cover; background-position: right center; background-repeat: no-repeat;" <?php endif; ?> data-aos="slide-right" data-aos-delay="800"></div>
                <div class="right" data-aos="slide-left" data-aos-delay="900"></div>
            </div>
        </figure>
    </section>

    <?php
    $stats = get_post_meta($about_id, 'about_stats', true);
    $stats_title = get_post_meta($about_id, 'about_stats_title', true);
    $stats_subtitle = get_post_meta($about_id, 'about_stats_subtitle', true);
    ?>
    <section class="stats" data-aos="fade-up" data-aos-duration="800">
        <div class="up" data-aos="fade-down" data-aos-delay="200">
            <div class="decorative-rectangles stats-rectangles" data-aos="fade-right" data-aos-delay="100" data-aos-anchor-placement="top-bottom">
                <div class="rectangle rect-1" data-aos="zoom-in" data-aos-delay="200" data-aos-anchor-placement="top-bottom"></div>
                <div class="rectangle rect-2" data-aos="zoom-in" data-aos-delay="300" data-aos-anchor-placement="top-bottom"></div>
                <div class="rectangle rect-3" data-aos="zoom-in" data-aos-delay="400" data-aos-anchor-placement="top-bottom"></div>
            </div>
            <?php if ($stats_title): ?><h3 data-aos="fade-up" data-aos-delay="500"><?php echo esc_html($stats_title); ?></h3><?php endif; ?>
            <?php if ($stats_subtitle): ?><h2 data-aos="fade-up" data-aos-delay="600"><?php echo esc_html($stats_subtitle); ?></h2><?php endif; ?>
        </div>
        <div class="stats-container" data-aos="fade-up" data-aos-delay="700">
            <?php
            if (!empty($stats) && is_array($stats)) {
                $delay = 800;
                foreach ($stats as $stat) {
                    $number = isset($stat['number']) ? $stat['number'] : '';
                    $label = isset($stat['label']) ? $stat['label'] : '';
                    if ($number || $label): ?>
                        <div class="stat-card" data-aos="zoom-in-up" data-aos-delay="<?php echo $delay; ?>">
                            <?php if ($number): ?><span class="number" data-aos="fade-up" data-aos-delay="<?php echo $delay + 100; ?>"><?php echo esc_html($number); ?></span><?php endif; ?>
                            <?php if ($label): ?><span class="label" data-aos="fade-up" data-aos-delay="<?php echo $delay + 200; ?>"><?php echo esc_html($label); ?></span><?php endif; ?>
                        </div>
            <?php
                        $delay += 150;
                    endif;
                }
            }
            ?>
        </div>
    </section>

    <?php
    $reasons_title = get_post_meta($about_id, 'about_reasons_title', true);
    $reasons_subtitle = get_post_meta($about_id, 'about_reasons_subtitle', true);
    $reasons = get_post_meta($about_id, 'about_reasons', true);
    $principles_title = get_post_meta($about_id, 'about_principles_title', true);
    $principles_subtitle = get_post_meta($about_id, 'about_principles_subtitle', true);
    ?>
    <section class="about-and-reasons" data-aos="fade-up" data-aos-duration="800">
        <section class="about-us" data-aos="fade-right" data-aos-delay="200">
            <div class="up" data-aos="fade-up" data-aos-delay="300">
                <div class="message" data-aos="fade-right" data-aos-delay="400">
                    <div class="title" data-aos="fade-up" data-aos-delay="500">
                        <?php if ($principles_subtitle): ?><h3 data-aos="fade-right" data-aos-delay="600"><?php echo esc_html($principles_subtitle); ?></h3><?php endif; ?>
                        <?php if ($principles_title): ?><h2 data-aos="fade-right" data-aos-delay="700"><?php echo esc_html($principles_title); ?></h2><?php endif; ?>
                    </div>
                </div>
                <div class="decorative-rectangles about-us-rectangles" data-aos="fade-left" data-aos-delay="100" data-aos-anchor-placement="top-bottom">
                    <div class="rectangle rect-1" data-aos="zoom-in" data-aos-delay="200" data-aos-anchor-placement="top-bottom"></div>
                    <div class="rectangle rect-2" data-aos="zoom-in" data-aos-delay="300" data-aos-anchor-placement="top-bottom"></div>
                    <div class="rectangle rect-3" data-aos="zoom-in" data-aos-delay="400" data-aos-anchor-placement="top-bottom"></div>
                </div>
            </div>
            <div data-aos="fade-up" data-aos-delay="600">
                <?php get_template_part('template-parts/principles'); ?>
            </div>
        </section>
        <section class="select-us" data-aos="fade-left" data-aos-delay="400">
            <div class="up" data-aos="fade-up" data-aos-delay="500">
                <?php if ($reasons_subtitle): ?><h3 data-aos="fade-left" data-aos-delay="600"><?php echo esc_html($reasons_subtitle); ?></h3><?php endif; ?>
                <?php if ($reasons_title): ?><h2 data-aos="fade-left" data-aos-delay="700"><?php echo esc_html($reasons_title); ?></h2><?php endif; ?>
            </div>
            <div class="cards" data-aos="fade-up" data-aos-delay="800">
                <?php
                if (!empty($reasons) && is_array($reasons)) {
                    $delay = 900;
                    foreach ($reasons as $reason) {
                        $icon = isset($reason['icon']) ? $reason['icon'] : '';
                        $title = isset($reason['title']) ? $reason['title'] : '';
                        if ($icon || $title): ?>
                            <div class="card" data-aos="flip-up" data-aos-delay="<?php echo $delay; ?>">
                                <div class="icon" data-aos="bounce" data-aos-delay="<?php echo $delay + 100; ?>">
                                    <?php if ($icon): ?><img src="<?php echo esc_url($icon); ?>" alt="<?php echo esc_attr($title); ?>"><?php endif; ?>
                                </div>
                                <?php if ($title): ?><h4 class="title" data-aos="fade-up" data-aos-delay="<?php echo $delay + 200; ?>"><?php echo esc_html($title); ?></h4><?php endif; ?>
                            </div>
                <?php
                            $delay += 150;
                        endif;
                    }
                }
                ?>
            </div>
        </section>
    </section>

    <?php $faqs = get_post_meta($about_id, 'about_faq', true);
    $faq_title = get_post_meta($about_id, 'about_faq_title', true);
    $faq_subtitle = get_post_meta($about_id, 'about_faq_subtitle', true);
    ?>
    <section class="faq" data-aos="fade-up" data-aos-duration="800">
        <div class="up" data-aos="fade-down" data-aos-delay="200">
            <?php if ($faq_title): ?><h3 data-aos="fade-up" data-aos-delay="300"><?php echo esc_html($faq_title); ?></h3><?php endif; ?>
            <?php if ($faq_subtitle): ?><h2 data-aos="fade-up" data-aos-delay="400"><?php echo esc_html($faq_subtitle); ?></h2><?php endif; ?>
        </div>
        <div class="items" data-aos="fade-up" data-aos-delay="500">
            <div class="decorative-rectangles items-rectangles" data-aos-delay="100" data-aos-anchor-placement="top-bottom">
                <div class="rectangle rect-1" data-aos="zoom-in" data-aos-delay="200" data-aos-anchor-placement="top-bottom"></div>
                <div class="rectangle rect-2" data-aos="zoom-in" data-aos-delay="300" data-aos-anchor-placement="top-bottom"></div>
                <div class="rectangle rect-3" data-aos="zoom-in" data-aos-delay="400" data-aos-anchor-placement="top-bottom"></div>
            </div>
            <?php
            if (!empty($faqs) && is_array($faqs)) {
                $delay = 800;
                foreach ($faqs as $faq) {
                    $q = isset($faq['q']) ? $faq['q'] : '';
                    $a = isset($faq['a']) ? $faq['a'] : '';
                    if ($q || $a): ?>
                        <div class="item" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                            <div class="item-title" data-aos="fade-right" data-aos-delay="<?php echo $delay + 100; ?>">
                                <?php if ($q): ?><span><?php echo esc_html($q); ?></span><?php endif; ?>
                                <button class="item-toggle" aria-label="Mostrar respuesta" data-aos="zoom-in" data-aos-delay="<?php echo $delay + 200; ?>"><span>+</span></button>
                            </div>
                            <div class="item-content">
                                <?php if ($a): ?><?php echo esc_html($a); ?><?php endif; ?>
                            </div>
                        </div>
            <?php
                        $delay += 150;
                    endif;
                }
            }
            ?>
        </div>
        <?php
        $more_info_title = get_post_meta($about_id, 'about_more_info_title', true);
        $more_info_text = get_post_meta($about_id, 'about_more_info_text', true);
        ?>
        <div class="more-info" data-aos="zoom-in" data-aos-delay="1000">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/logo-colina-black.svg" alt="Colina" data-aos="flip-up" data-aos-delay="1100">
            <div class="text" data-aos="fade-up" data-aos-delay="1200">
                <?php if ($more_info_title): ?><h2 data-aos="fade-right" data-aos-delay="1300"><?php echo esc_html($more_info_title); ?></h2><?php endif; ?>
                <?php if ($more_info_text): ?><h3 data-aos="fade-right" data-aos-delay="1400"><?php echo esc_html($more_info_text); ?></h3><?php endif; ?>
            </div>
        </div>
    </section>

    </section>

    <div data-aos="fade-up" data-aos-duration="800">
        <?php get_template_part('template-parts/contact'); ?>
    </div>

    <div data-aos="fade-up" data-aos-duration="800">
        <?php get_template_part('template-parts/companies-section'); ?>
    </div>

    <?php get_footer(); ?>
</body>

</html>