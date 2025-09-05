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

    <section class="stats">
        <div class="up">
            <h3>Nuestro impacto en cifras</h3>
            <h2>Datos que inspiran confianza</h2>
        </div>
        <div class="stats-container">
            <?php
            $stats = [
                ['number' => '+30', 'label' => 'Empresas confían en nosotros'],
                ['number' => '+10.000 m²', 'label' => 'Infraestructura empresarial'],
                ['number' => '5 años', 'label' => 'Creando entornos seguros y modernos']
            ];
            foreach ($stats as $stat): ?>
                <div class="stat-card">
                    <span class="number"><?php echo $stat['number']; ?></span>
                    <span class="label"><?php echo $stat['label']; ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

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

    <section class="select-us">
        <div class="up">
            <h3>¿Por qué elegirnos?</h3>
            <h2>Razones para confiar en Colina Office Park</h2>
        </div>
        <div class="cards">
            <?php
            $reasons = [
                ['icon' => '1.svg', 'title' => 'Ubicación estratégica en el norte de Bogotá'],
                ['icon' => '2.svg', 'title' => 'Oficinas modernas y sostenibles'],
                ['icon' => '3.svg', 'title' => 'Seguridad y monitoreo 24/7'],
                ['icon' => '4.svg', 'title' => 'Flexibilidad en espacios y servicios'],
                ['icon' => '5.svg', 'title' => 'Comunidad empresarial conectada'],

            ];
            foreach ($reasons as $reason): ?>
                <div class="card">
                    <div class="icon">
                        <img src="<?php echo get_template_directory_uri() . '/assets/icons/' . $reason['icon']; ?>" alt="<?php echo esc_attr($reason['title']); ?>">
                    </div>
                    <h4 class="title"><?php echo $reason['title']; ?></h4>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <?php get_template_part('template-parts/companies-section'); ?>

    <section class="faq">
        <div class="up">
            <h3>Sobre nosotros</h3>
            <h2>Preguntas frecuentes</h2>
        </div>
        <div class="items">
            <?php
            $faqs = [
                [
                    'q' => '¿Qué servicios ofrece Colina Office Park?',
                    'a' => 'Ofrecemos oficinas modernas, espacios flexibles, seguridad 24/7, parqueaderos, zonas comunes y servicios empresariales integrales.'
                ],
                [
                    'q' => '¿Cómo puedo consultar la normatividad interna?',
                    'a' => 'Puedes consultar la normatividad interna en la sección de documentos o solicitándola en la administración.'
                ],
                [
                    'q' => '¿Qué métodos de pago aceptan?',
                    'a' => 'Aceptamos transferencias bancarias, pagos en línea y otros métodos según acuerdo.'
                ],
                [
                    'q' => '¿Colina Office Park cuenta con parqueadero?',
                    'a' => 'Sí, contamos con parqueaderos para visitantes y arrendatarios.'
                ],
                [
                    'q' => '¿Cómo puedo reportar una novedad o incidente?',
                    'a' => 'Puedes reportar novedades o incidentes a través de la administración o el formulario de contacto.'
                ],
                [
                    'q' => '¿El centro empresarial tiene vigilancia y cámaras de seguridad?',
                    'a' => 'Sí, contamos con vigilancia privada y monitoreo por cámaras las 24 horas.'
                ],
                [
                    'q' => '¿Qué debo hacer si quiero arrendar un espacio en Colina Office Park?',
                    'a' => 'Contáctanos a través del formulario o por teléfono para recibir asesoría personalizada.'
                ],
            ];
            foreach ($faqs as $faq): ?>
                <div class="item">
                    <div class="item-title">
                        <span><?php echo $faq['q']; ?></span>
                        <button class="item-toggle" aria-label="Mostrar respuesta"><span>+</span></button>
                    </div>
                    <div class="item-content">
                        <?php echo $faq['a']; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="more-info">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/logo-colina-black.svg" alt="Colina">
            <div class="text">
                <h2>¿Tienes alguna pregunta?</h2>
                <h3>Si necesita ayuda, visite nuestra página de contacto o llame a nuestra línea de atención al cliente al (000) 000 0000. Nuestro equipo especializado está listo para ayudarle en lo que necesite.</h3>
            </div>
        </div>
    </section>

    </section>

    <?php get_template_part('template-parts/contact'); ?>
    <?php get_footer(); ?>
</body>

</html>