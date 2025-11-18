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
    $noticias_id = get_the_ID();
    $banner_img = get_post_meta($noticias_id, 'noticias_banner_image', true);
    $banner_title = get_post_meta($noticias_id, 'noticias_banner_title', true);
    $banner_subtitle = get_post_meta($noticias_id, 'noticias_banner_subtitle', true);
    if (!$banner_img) {
        $banner_img = get_template_directory_uri() . '/assets/images/news-banner.jpg';
    }
    ?>

    <section class="banner" style="background-image: url('<?php echo esc_url($banner_img); ?>');" data-aos="fade-in" data-aos-duration="1000">
        <div class="overlay light" data-aos="fade-in" data-aos-delay="300"></div>
        <div class="content" data-aos="fade-up" data-aos-delay="500">
            <div class="route" data-aos="fade-right" data-aos-delay="700">
                <div class="parent">
                    <span>Inicio</span>
                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.08398 3.75L8.08398 6.75L5.08398 9.75" stroke="black" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <span class="current">Noticias</span>
            </div>
            <div class="info" data-aos="fade-up" data-aos-delay="800">
                <?php if ($banner_subtitle): ?><span class="subtitle" data-aos="fade-right" data-aos-delay="900"><?php echo esc_html($banner_subtitle); ?></span><?php endif; ?>
                <?php if ($banner_title): ?><h1 class="title lg" data-aos="fade-up" data-aos-delay="1000"><?php echo esc_html($banner_title); ?></h1><?php endif; ?>
            </div>
        </div>
    </section>

    <?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $news_query = new WP_Query([
        'post_type'      => 'post',
        'posts_per_page' => 6,
        'post_status'    => 'publish',
        'paged'          => $paged,
    ]);
    $default_img = get_template_directory_uri() . '/assets/images/news-default.jpg';
    ?>
    <?php if ($news_query->have_posts()): ?>
        <section class="news-section--grid" data-aos="fade-up" data-aos-duration="800">
            <div id="news-grid" class="news-grid" data-aos="fade-up" data-aos-delay="300">
                <?php
                $delay = 400;
                while ($news_query->have_posts()): $news_query->the_post(); ?>
                    <div class="news-card" data-aos="zoom-in-up" data-aos-delay="<?php echo $delay; ?>">
                        <div class="news-image" data-aos="fade-in" data-aos-delay="<?php echo $delay + 100; ?>">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('large'); ?>
                            <?php else: ?>
                                <img src="<?php echo esc_url($default_img); ?>" alt="Noticia">
                            <?php endif; ?>
                            <div class="news-overlay" data-aos="fade-in" data-aos-delay="<?php echo $delay + 200; ?>">
                                <a href="<?php the_permalink(); ?>" class="btn news-btn" data-aos="zoom-in" data-aos-delay="<?php echo $delay + 300; ?>">Ver más</a>
                            </div>
                        </div>
                        <div class="news-content" data-aos="fade-up" data-aos-delay="<?php echo $delay + 200; ?>">
                            <span class="news-date" data-aos="fade-right" data-aos-delay="<?php echo $delay + 300; ?>"><?php echo get_the_date('d/m/Y'); ?></span>
                            <h4 class="news-title" data-aos="fade-up" data-aos-delay="<?php echo $delay + 400; ?>"><?php the_title(); ?></h4>
                        </div>
                    </div>
                <?php
                    $delay += 150;
                endwhile;
                wp_reset_postdata(); ?>
            </div>
            <?php if ($news_query->max_num_pages > 1): ?>
                <div class="news-load-more-container" data-aos="zoom-in" data-aos-delay="800">
                    <button id="news-load-more" class="btn news-load-more" data-paged="<?php echo esc_attr($paged); ?>" data-aos="bounce" data-aos-delay="900">Cargar más</button>
                </div>
            <?php endif; ?>
        </section>
    <?php endif; ?>

    <div data-aos="fade-up" data-aos-duration="800">
        <?php get_template_part('template-parts/contact'); ?>
    </div>

    <div data-aos="fade-up" data-aos-duration="600" data-aos-delay="200">
        <?php get_template_part('template-parts/companies-section'); ?>
    </div>

    <?php get_footer(); ?>
</body>

</html>