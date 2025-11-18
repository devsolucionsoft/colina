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
    $contacto_id = get_the_ID();
    $banner_img = get_post_meta($contacto_id, 'contacto_banner_image', true);
    $banner_title = get_post_meta($contacto_id, 'contacto_banner_title', true);
    $banner_subtitle = get_post_meta($contacto_id, 'contacto_banner_subtitle', true);
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
                <span class="current">Contacto</span>
            </div>
            <div class="info" data-aos="fade-up" data-aos-delay="800">
                <?php if ($banner_subtitle): ?><span class="subtitle" data-aos="fade-right" data-aos-delay="900"><?php echo esc_html($banner_subtitle); ?></span><?php endif; ?>
                <?php if ($banner_title): ?><h1 class="title lg" data-aos="fade-up" data-aos-delay="1000"><?php echo esc_html($banner_title); ?></h1><?php endif; ?>
            </div>
        </div>
    </section>

    <div data-aos="fade-up" data-aos-duration="800">
        <?php get_template_part('template-parts/contact'); ?>
    </div>

    <section class="map-section-desktop" data-aos="fade-up" data-aos-duration="800">
        <div id="leaflet-map" style="width:100%;height:400px;"></div>
    </section>

    <div data-aos="fade-up" data-aos-duration="600" data-aos-delay="200">
        <?php get_template_part('template-parts/companies-section'); ?>
    </div>

    <script>
        // Script para precargar el mensaje del formulario con la instalación seleccionada
        document.addEventListener('DOMContentLoaded', function() {
            // Verificar si hay un parámetro de instalación en la URL
            const urlParams = new URLSearchParams(window.location.search);
            const instalacion = urlParams.get('instalacion');

            if (instalacion) {
                // Función para intentar precargar el mensaje
                function precargarMensaje(intentos = 0) {
                    const messageField = document.querySelector('#contact-message');

                    if (messageField) {
                        const mensaje = `Hola, estoy interesado en la instalación: ${instalacion}. Me gustaría obtener más información sobre disponibilidad y condiciones de arriendo.`;
                        messageField.value = mensaje;

                        // Hacer scroll suave hacia el formulario
                        const contactSection = document.querySelector('#contacto');
                        if (contactSection) {
                            setTimeout(() => {
                                contactSection.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'start'
                                });
                            }, 300);
                        }
                    } else if (intentos < 10) {
                        // Reintentar si el campo aún no está disponible (máximo 10 intentos = 2 segundos)
                        setTimeout(() => precargarMensaje(intentos + 1), 200);
                    }
                }

                // Iniciar la precarga después de un pequeño delay
                setTimeout(() => precargarMensaje(), 100);
            }
        });
    </script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.innerWidth > 1024) {
                <?php
                $latitude = get_company_info('company_latitude');
                $longitude = get_company_info('company_longitude');
                ?>
                var map = L.map('leaflet-map').setView([<?php echo esc_js($latitude); ?>, <?php echo esc_js($longitude); ?>], 16);
                L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                    subdomains: 'abcd',
                    maxZoom: 19
                }).addTo(map);
                L.marker([<?php echo esc_js($latitude); ?>, <?php echo esc_js($longitude); ?>]).addTo(map)
                    .bindPopup('Ubicación Colina').openPopup();
            }
        });
    </script>
    <style>
        @media (max-width: 1024px) {
            .map-section-desktop {
                display: none !important;
            }
        }

        .map-section-desktop {
            width: 100%;
            margin: 0;
            padding: 0;
            background: #181818;
        }

        #leaflet-map {
            border-radius: 0;
        }
    </style>


    <?php get_footer(); ?>
</body>

</html>