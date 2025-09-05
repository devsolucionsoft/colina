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
    $banner_img = '';
    if (has_post_thumbnail()) {
        $banner_img = get_the_post_thumbnail_url(get_the_ID(), 'full');
    } else {
        $banner_img = get_template_directory_uri() . '/assets/images/news-default.jpg';
    }
    ?>
    <section class="banner" style="background-image: url('<?php echo esc_url($banner_img); ?>');">
        <div class="overlay"></div>
        <div class="content">
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="back">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/back-arrow.svg" alt="Volver">
                <span>Volver</span>
            </a>
            <div class="info">
                <span class="date">
                    <?php echo get_the_date('d/m/Y'); ?>
                </span>
                <h1 class="title"><?php the_title(); ?></h1>
            </div>
        </div>
    </section>

    <?php get_template_part('template-parts/companies-section'); ?>

    <div class="text-container">
        <div class="content-body ">
            <?php the_content(); ?>
        </div>
        <div class="navigation-container" style="display: flex; justify-content: space-between; align-items: center;">
            <?php
            $prev_post = get_previous_post();
            $next_post = get_next_post();
            ?>
            <div>
                <?php if ($prev_post): ?>
                    <a class="post-nav" href="<?php echo get_permalink($prev_post->ID); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/back-arrow.svg" alt="Atrás">
                        <span>Atrás</span>
                    </a>
                <?php endif; ?>
            </div>
            <div>
                <?php if ($next_post): ?>
                    <a class="post-nav" href="<?php echo get_permalink($next_post->ID); ?>">
                        <span>Siguiente</span>
                        <img style="transform: rotate(180deg); vertical-align: middle;" src="<?php echo get_template_directory_uri(); ?>/assets/icons/back-arrow.svg" alt="Siguiente" style="vertical-align: middle;">
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php get_template_part('template-parts/news-section'); ?>

    <?php get_footer(); ?>
</body>

</html>