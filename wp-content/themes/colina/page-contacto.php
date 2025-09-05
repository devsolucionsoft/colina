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

    <?php get_template_part('template-parts/companies-section'); ?>

    <?php get_template_part('template-parts/contact'); ?>

    <section class="map-section-desktop">
        <div id="leaflet-map" style="width:100%;height:400px;"></div>
    </section>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.innerWidth > 1024) {
                var map = L.map('leaflet-map').setView([4.710989, -74.072092], 16);
                L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                    subdomains: 'abcd',
                    maxZoom: 19
                }).addTo(map);
                L.marker([4.710989, -74.072092]).addTo(map)
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