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
    $banner_img = get_template_directory_uri() . '/assets/images/news-banner.jpg';
    ?>

    <section class="banner" style="background-image: url('<?php echo esc_url($banner_img); ?>');">
        <div class="overlay"></div>
        <div class="content">
            <div class="route">
                <div class="parent">
                    <span>Inicio</span>
                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.08398 3.75L8.08398 6.75L5.08398 9.75" stroke="black" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <span class="current">Noticias</span>
            </div>
            <div class="info">
                <span class="subtitle">
                    Noticias
                </span>
                <h1 class="title lg">Novedades y anuncios importantes</h1>
            </div>
        </div>
    </section>


    <?php get_template_part('template-parts/companies-section'); ?>

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
        <section class="news-section--grid">
            <div id="news-grid" class="news-grid">
                <?php while ($news_query->have_posts()): $news_query->the_post(); ?>
                    <div class="news-card">
                        <div class="news-image">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('large'); ?>
                            <?php else: ?>
                                <img src="<?php echo esc_url($default_img); ?>" alt="Noticia">
                            <?php endif; ?>
                            <div class="news-overlay">
                                <a href="<?php the_permalink(); ?>" class="btn news-btn">Ver más</a>
                            </div>
                        </div>
                        <div class="news-content">
                            <span class="news-date"><?php echo get_the_date('d/m/Y'); ?></span>
                            <h4 class="news-title"><?php the_title(); ?></h4>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
            <?php if ($news_query->max_num_pages > 1): ?>
                <div class="news-load-more-container">
                    <button id="news-load-more" class="btn news-load-more" data-paged="<?php echo esc_attr($paged); ?>">Cargar más</button>
                </div>
            <?php endif; ?>
        </section>
    <?php endif; ?>



    <?php get_template_part('template-parts/contact'); ?>
    <?php get_footer(); ?>
</body>

</html>