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
    $banner_img = get_template_directory_uri() . '/assets/images/about-banner.jpg';
    ?>

    <section class="banner" style="background-image: url('<?php echo esc_url($banner_img); ?>');">
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
                <span class="subtitle">
                    Sobre nosotros
                </span>
                <h1 class="title lg">Un entorno pensado para crecer juntos</h1>
            </div>
        </div>
    </section>

    <section class="history">
        <div class="information">
            <div class="text">
                <h3>Descubre nuestra historia y propósito</h3>
                <h2>Un proyecto diseñado para empresas que buscan más.</h2>
                <p>Colina Office Park nació con la misión de ofrecer espacios corporativos de primer nivel en el norte de Bogotá, integrando infraestructura moderna, servicios de calidad y prácticas sostenibles. Nuestro objetivo es crear un entorno conectado donde las empresas crezcan y prosperen..</p>
            </div>
        </div>
        <figure class="diamond">
            <div class="diamond-shape">
                <div class="left"></div>
                <div class="right"></div>
            </div>
        </figure>
    </section>
    <!-- 2 -->

    <section class="about-us">
        <div class="up">
            <div class="message">
                <div class="title">
                    <h3>Sobre nosotros</h3>
                    <h2>Creemos en relaciones transparentes y un entorno responsable</h2>
                </div>
            </div>
        </div>
        <?php get_template_part('template-parts/principles'); ?>
    </section>

    <!-- 3 -->

    <?php get_template_part('template-parts/companies-section'); ?>

    <!-- 4 -->
    <!-- 5 -->

    <?php get_template_part('template-parts/contact'); ?>
    <?php get_footer(); ?>
</body>

</html>