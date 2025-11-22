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
    $instalaciones_id = get_the_ID();
    $banner_img = get_post_meta($instalaciones_id, 'instalaciones_banner_image', true);
    $banner_title = get_post_meta($instalaciones_id, 'instalaciones_banner_title', true);
    $banner_subtitle = get_post_meta($instalaciones_id, 'instalaciones_banner_subtitle', true);
    ?>

    <!-- BANNER -->
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
                <span class="current">Instalaciones</span>
            </div>
            <div class="info" data-aos="fade-up" data-aos-delay="800">
                <?php if ($banner_subtitle): ?><span class="subtitle" data-aos="fade-right" data-aos-delay="900"><?php echo esc_html($banner_subtitle); ?></span><?php endif; ?>
                <?php if ($banner_title): ?><h1 class="title lg" data-aos="fade-up" data-aos-delay="1000"><?php echo esc_html($banner_title); ?></h1><?php endif; ?>
            </div>
        </div>
    </section>

    <?php
    // Obtener instalaciones fijas desde group field
    $instalaciones_fijas = get_post_meta($instalaciones_id, 'instalaciones_fijas_group', true);

    $fijas_title = get_post_meta($instalaciones_id, 'instalaciones_fijas_title', true);
    $fijas_subtitle = get_post_meta($instalaciones_id, 'instalaciones_fijas_subtitle', true);
    $fijas_description = get_post_meta($instalaciones_id, 'instalaciones_fijas_description', true);
    ?>

    <!-- SECCIÓN INSTALACIONES FIJAS -->
    <?php if (!empty($instalaciones_fijas)): ?>
        <section class="instalaciones-fijas-section" data-aos="fade-up" data-aos-duration="800">
            <div class="instalaciones-wrapper">
                <div class="section-header" data-aos="fade-up" data-aos-delay="200">
                    <?php if ($fijas_title): ?><h3 class="section-title" data-aos="fade-right" data-aos-delay="300"><?php echo esc_html($fijas_title); ?></h3><?php endif; ?>
                    <?php if ($fijas_subtitle): ?><h2 class="section-subtitle" data-aos="fade-right" data-aos-delay="400"><?php echo esc_html($fijas_subtitle); ?></h2><?php endif; ?>
                    <?php if ($fijas_description): ?><p class="section-description" data-aos="fade-up" data-aos-delay="500"><?php echo esc_html($fijas_description); ?></p><?php endif; ?>
                </div>

                <div class="instalaciones-grid" data-aos="fade-up" data-aos-delay="600">
                    <?php
                    $delay = 700;
                    foreach ($instalaciones_fijas as $instalacion):
                        $nombre = isset($instalacion['nombre']) ? $instalacion['nombre'] : '';
                        $detalle = isset($instalacion['detalle']) ? $instalacion['detalle'] : '';
                        $imagen = isset($instalacion['imagen']) ? $instalacion['imagen'] : '';
                    ?>
                        <div class="instalacion-card instalacion-fija" data-aos="zoom-in" data-aos-delay="<?php echo $delay; ?>">
                            <?php if ($imagen): ?>
                                <div class="instalacion-image" style="background-image: url('<?php echo esc_url($imagen); ?>');" data-aos="fade-in" data-aos-delay="<?php echo $delay + 100; ?>"></div>
                            <?php endif; ?>
                            <div class="instalacion-content" data-aos="fade-up" data-aos-delay="<?php echo $delay + 200; ?>">
                                <h3 class="instalacion-title" data-aos="fade-right" data-aos-delay="<?php echo $delay + 300; ?>"><?php echo esc_html($nombre); ?></h3>
                                <?php if ($detalle): ?>
                                    <div class="instalacion-detalle" data-aos="fade-up" data-aos-delay="<?php echo $delay + 400; ?>">
                                        <?php echo wpautop($detalle); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php
                        $delay += 100;
                    endforeach;
                    ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php
    // Obtener instalaciones disponibles desde group field
    $instalaciones_disponibles = get_post_meta($instalaciones_id, 'instalaciones_disponibles_group', true);

    $disp_title = get_post_meta($instalaciones_id, 'instalaciones_disponibles_title', true);
    $disp_subtitle = get_post_meta($instalaciones_id, 'instalaciones_disponibles_subtitle', true);
    $disp_description = get_post_meta($instalaciones_id, 'instalaciones_disponibles_description', true);
    $btn_contacto_text = get_post_meta($instalaciones_id, 'instalaciones_btn_contacto_text', true);
    $contact_page_id = of_get_option('contact_page');
    $contact_page_url = get_permalink($contact_page_id);
    ?>

    <!-- SECCIÓN INSTALACIONES DISPONIBLES -->
    <?php if (!empty($instalaciones_disponibles)): ?>
        <section class="instalaciones-disponibles-section" data-aos="fade-up" data-aos-duration="800">
            <div class="instalaciones-wrapper">
                <div class="section-header" data-aos="fade-up" data-aos-delay="200">
                    <?php if ($disp_title): ?><h3 class="section-title" data-aos="fade-right" data-aos-delay="300"><?php echo esc_html($disp_title); ?></h3><?php endif; ?>
                    <?php if ($disp_subtitle): ?><h2 class="section-subtitle" data-aos="fade-right" data-aos-delay="400"><?php echo esc_html($disp_subtitle); ?></h2><?php endif; ?>
                    <?php if ($disp_description): ?><p class="section-description" data-aos="fade-up" data-aos-delay="500"><?php echo esc_html($disp_description); ?></p><?php endif; ?>
                </div>

                <div class="instalaciones-grid instalaciones-disponibles-grid" data-aos="fade-up" data-aos-delay="600">
                    <?php
                    $delay = 700;
                    foreach ($instalaciones_disponibles as $instalacion):
                        $nombre = isset($instalacion['nombre']) ? $instalacion['nombre'] : '';
                        $descripcion = isset($instalacion['descripcion']) ? $instalacion['descripcion'] : '';
                        $precio = isset($instalacion['precio']) ? $instalacion['precio'] : '';
                        $imagen = isset($instalacion['imagen']) ? $instalacion['imagen'] : '';
                    ?>
                        <div class="instalacion-card instalacion-disponible" data-aos="zoom-in-up" data-aos-delay="<?php echo $delay; ?>">
                            <?php if ($imagen): ?>
                                <div class="instalacion-image" style="background-image: url('<?php echo esc_url($imagen); ?>');" data-aos="fade-in" data-aos-delay="<?php echo $delay + 100; ?>">
                                    <?php if ($precio): ?>
                                        <div class="instalacion-precio" data-aos="fade-down" data-aos-delay="<?php echo $delay + 200; ?>">
                                            <span><?php echo esc_html($precio); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <div class="instalacion-content" data-aos="fade-up" data-aos-delay="<?php echo $delay + 300; ?>">
                                <h3 class="instalacion-title" data-aos="fade-right" data-aos-delay="<?php echo $delay + 400; ?>"><?php echo esc_html($nombre); ?></h3>
                                <?php if ($descripcion): ?>
                                    <div class="instalacion-descripcion" data-aos="fade-up" data-aos-delay="<?php echo $delay + 500; ?>">
                                        <?php echo wpautop($descripcion); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($btn_contacto_text && $contact_page_url): ?>
                                    <a href="<?php echo esc_url($contact_page_url); ?>?instalacion=<?php echo urlencode($nombre); ?>#contact-form" class="btn btn-instalacion" data-instalacion="<?php echo esc_attr($nombre); ?>" data-aos="zoom-in" data-aos-delay="<?php echo $delay + 600; ?>">
                                        <?php echo esc_html($btn_contacto_text); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php
                        $delay += 150;
                    endforeach;
                    ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <div data-aos="fade-up" data-aos-duration="600" data-aos-delay="200">
        <?php get_template_part('template-parts/companies-section'); ?>
    </div>

    <?php get_footer(); ?>

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
</body>

</html>