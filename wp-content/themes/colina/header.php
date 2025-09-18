<header class="main-header">
    <a class="header-icon mobile" href="<?php echo esc_url(home_url('/')); ?>">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/logo-colina.svg" alt="Colina">
    </a>
    <button class="hamburger-menu mobile">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/hamburger.svg" alt="Hamburguer menu">
    </button>
    <div class="nav-menu">
        <a class="header-icon" href="<?php echo esc_url(home_url('/')); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/logo-colina.svg" alt="Colina">
        </a>
        <div class="navigation">
            <?php
            if (has_nav_menu('main')) {
                wp_nav_menu(array(
                    'container'         => false,
                    'theme_location'    => 'main',
                    'menu_class'        => 'navbar-menu',
                    'fallback_cb'       => 'wp_page_menu',
                    'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
                    'depth'             => 1,
                    'link_class'        => 'underline-anim',
                ));
            } else {
                echo '<p>Menu no asignado para esta zona.</p>';
            }
            ?>
        </div>
    </div>

    <div class="side-menu" id="side-menu">
        <div class="side-menu-content">
            <?php
            if (has_nav_menu('main')) {
                wp_nav_menu(array(
                    'container'         => false,
                    'theme_location'    => 'main',
                    'menu_class'        => 'navbar-menu',
                    'fallback_cb'       => 'wp_page_menu',
                    'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
                    'depth'             => 1,
                    'link_class'        => 'underline-anim',
                ));
            } else {
                echo '<p>Menu no asignado para esta zona.</p>';
            }
            ?>
        </div>
    </div>
    <?php wp_head(); ?>

    <!-- Variables JavaScript para contactFormAjax -->
    <script>
        window.contactFormAjax = {
            ajaxurl: '<?php echo admin_url('admin-ajax.php'); ?>',
            nonce: '<?php echo wp_create_nonce('contact_form_nonce'); ?>',
            siteUrl: '<?php echo get_site_url(); ?>',
            homeUrl: '<?php echo get_home_url(); ?>'
        };
    </script>
</header>

<a class="whatsapp-link" href="https://wa.me/<?php echo esc_attr(str_replace(['+', ' ', '-'], '', get_company_info('company_phone'))); ?>" target="_blank" rel="noopener noreferrer">
    <div id="whatsapp-button">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/whatsapp.png" alt="Habla con nosotros por WhatsApp" />
        <span class="tooltip">¡Hola! Estamos aquí para ayudarte 👉🏻</span>
    </div>
</a>