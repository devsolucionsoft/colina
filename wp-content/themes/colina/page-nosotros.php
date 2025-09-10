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
    <section class="banner" <?php if ($banner_img): ?> style="background-image: url('<?php echo esc_url($banner_img); ?>');" <?php endif; ?>>
        <div class="overlay light"></div>
        <div class="content">
            <div class="route">
                <div class="parent">
                    <span>Inicio</span>
                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.08398 3.75L8.08398 6.75L5.08398 9.75" stroke="black" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <span class="current">Sobre nosotros</span>
            </div>
            <div class="info">
                <?php if ($banner_subtitle): ?><span class="subtitle"><?php echo esc_html($banner_subtitle); ?></span><?php endif; ?>
                <?php if ($banner_title): ?><h1 class="title lg"><?php echo esc_html($banner_title); ?></h1><?php endif; ?>
            </div>
        </div>
    </section>

    <?php
    $history_title = get_post_meta($about_id, 'about_history_title', true);
    $history_subtitle = get_post_meta($about_id, 'about_history_subtitle', true);
    $history_text = get_post_meta($about_id, 'about_history_text', true);
    $history_diamond = get_post_meta($about_id, 'about_history_diamond', true);
    ?>
    <section class="history">
        <div class="information">
            <div class="text">
                <?php if ($history_subtitle): ?><h3><?php echo esc_html($history_subtitle); ?></h3><?php endif; ?>
                <?php if ($history_title): ?><h2><?php echo esc_html($history_title); ?></h2><?php endif; ?>
                <?php if ($history_text): ?><p><?php echo $history_text; ?></p><?php endif; ?>
            </div>
        </div>
        <figure class="diamond">
            <div class="diamond-shape">
                <div class="left" <?php if ($history_diamond): ?> style="background-image: url('<?php echo esc_url($history_diamond); ?>'); background-size: cover; background-position: right center; background-repeat: no-repeat;" <?php endif; ?>></div>
                <div class="right"></div>
            </div>
        </figure>
    </section>

    <?php
    $stats = get_post_meta($about_id, 'about_stats', true);
    $stats_title = get_post_meta($about_id, 'about_stats_title', true);
    $stats_subtitle = get_post_meta($about_id, 'about_stats_subtitle', true);
    ?>
    <section class="stats">
        <div class="up">
            <div class="decorative-rectangles stats-rectangles">
                <div class="rectangle rect-1"></div>
                <div class="rectangle rect-2"></div>
                <div class="rectangle rect-3"></div>
            </div>
            <?php if ($stats_title): ?><h3><?php echo esc_html($stats_title); ?></h3><?php endif; ?>
            <?php if ($stats_subtitle): ?><h2><?php echo esc_html($stats_subtitle); ?></h2><?php endif; ?>
        </div>
        <div class="stats-container">
            <?php
            if (!empty($stats) && is_array($stats)) {
                foreach ($stats as $stat) {
                    $number = isset($stat['number']) ? $stat['number'] : '';
                    $label = isset($stat['label']) ? $stat['label'] : '';
                    if ($number || $label): ?>
                        <div class="stat-card">
                            <?php if ($number): ?><span class="number"><?php echo esc_html($number); ?></span><?php endif; ?>
                            <?php if ($label): ?><span class="label"><?php echo esc_html($label); ?></span><?php endif; ?>
                        </div>
            <?php endif;
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
    <section class="about-and-reasons">
        <section class="about-us">
            <div class="up">
                <div class="message">
                    <div class="title">
                        <?php if ($principles_subtitle): ?><h3><?php echo esc_html($principles_subtitle); ?></h3><?php endif; ?>
                        <?php if ($principles_title): ?><h2><?php echo esc_html($principles_title); ?></h2><?php endif; ?>
                    </div>
                </div>
                <div class="decorative-rectangles about-us-rectangles">
                    <div class="rectangle rect-1"></div>
                    <div class="rectangle rect-2"></div>
                    <div class="rectangle rect-3"></div>
                </div>
            </div>
            <?php get_template_part('template-parts/principles'); ?>
        </section>
        <section class="select-us">
            <div class="up">
                <?php if ($reasons_subtitle): ?><h3><?php echo esc_html($reasons_subtitle); ?></h3><?php endif; ?>
                <?php if ($reasons_title): ?><h2><?php echo esc_html($reasons_title); ?></h2><?php endif; ?>
            </div>
            <div class="cards">
                <?php
                if (!empty($reasons) && is_array($reasons)) {
                    foreach ($reasons as $reason) {
                        $icon = isset($reason['icon']) ? $reason['icon'] : '';
                        $title = isset($reason['title']) ? $reason['title'] : '';
                        if ($icon || $title): ?>
                            <div class="card">
                                <div class="icon">
                                    <?php if ($icon): ?><img src="<?php echo esc_url($icon); ?>" alt="<?php echo esc_attr($title); ?>"><?php endif; ?>
                                </div>
                                <?php if ($title): ?><h4 class="title"><?php echo esc_html($title); ?></h4><?php endif; ?>
                            </div>
                <?php endif;
                    }
                }
                ?>
            </div>
        </section>
    </section>


    <?php get_template_part('template-parts/companies-section'); ?>

    <?php $faqs = get_post_meta($about_id, 'about_faq', true);
    $faq_title = get_post_meta($about_id, 'about_faq_title', true);
    $faq_subtitle = get_post_meta($about_id, 'about_faq_subtitle', true);
    ?>
    <section class="faq">
        <div class="up">
            <?php if ($faq_title): ?><h3><?php echo esc_html($faq_title); ?></h3><?php endif; ?>
            <?php if ($faq_subtitle): ?><h2><?php echo esc_html($faq_subtitle); ?></h2><?php endif; ?>
        </div>
        <div class="items">
            <div class="decorative-rectangles items-rectangles">
                <div class="rectangle rect-1"></div>
                <div class="rectangle rect-2"></div>
                <div class="rectangle rect-3"></div>
            </div>
            <?php
            if (!empty($faqs) && is_array($faqs)) {
                foreach ($faqs as $faq) {
                    $q = isset($faq['q']) ? $faq['q'] : '';
                    $a = isset($faq['a']) ? $faq['a'] : '';
                    if ($q || $a): ?>
                        <div class="item">
                            <div class="item-title">
                                <?php if ($q): ?><span><?php echo esc_html($q); ?></span><?php endif; ?>
                                <button class="item-toggle" aria-label="Mostrar respuesta"><span>+</span></button>
                            </div>
                            <div class="item-content">
                                <?php if ($a): ?><?php echo esc_html($a); ?><?php endif; ?>
                            </div>
                        </div>
            <?php endif;
                }
            }
            ?>
        </div>
        <?php
        $more_info_title = get_post_meta($about_id, 'about_more_info_title', true);
        $more_info_text = get_post_meta($about_id, 'about_more_info_text', true);
        ?>
        <div class="more-info">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/logo-colina-black.svg" alt="Colina">
            <div class="text">
                <?php if ($more_info_title): ?><h2><?php echo esc_html($more_info_title); ?></h2><?php endif; ?>
                <?php if ($more_info_text): ?><h3><?php echo esc_html($more_info_text); ?></h3><?php endif; ?>
            </div>
        </div>
    </section>

    </section>

    <?php get_template_part('template-parts/contact'); ?>
    <?php get_footer(); ?>
</body>

</html>