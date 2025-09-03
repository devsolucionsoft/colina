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

        <?php get_template_part('template-parts/companies-section'); ?>

        <section class="about-us">
            <div class="up">
                <div class="message">
                    <div class="title">
                        <h3>Sobre nosotros</h3>
                        <h2>Un entorno pensado para crecer juntos</h2>
                    </div>
                    <p>En Colina Office Park brindamos espacios corporativos de primer nivel en el noroccidente de Bogotá. Nuestro centro empresarial integra oficinas, comercio y servicios en una infraestructura moderna, segura y sostenible, ideal para empresas, profesionales y emprendimientos que buscan crecer en un entorno conectado y dinámico.</p>
                </div>
                <a class="btn" href="#">Más información</a>
            </div>
            <?php get_template_part('template-parts/principles'); ?>
        </section>

        <section class="payments">
            <div class="information">
                <div class="text">
                    <h3>Pagos</h3>
                    <h2>Realiza tus pagos en línea, fácil y seguro</h2>
                    <p>Consulta y paga tu cuota de administración o reserva de espacios desde aquí.</p>
                </div>
                <a class="btn" href="#">Ver más</a>
            </div>
            <figure class="diamond">
                <div class="diamond-shape">
                    <div class="left"></div>
                    <div class="right"></div>
                </div>
            </figure>
        </section>

        <?php get_footer(); ?>
    </main>
</body>

</html>