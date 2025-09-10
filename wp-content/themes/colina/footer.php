<footer class="footer">
    <div class="up">
        <div class="col">
            <a class="footer-icon" href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/logo-colina-black.svg" alt="Colina">
            </a>
            <p class="paragraph"><?php echo esc_html(get_company_info('company_description')); ?></p>
            <div class="rrss-container">
                <span>Síguenos en:</span>
                <div class="rsss">
                    <?php
                    $facebook = get_company_info('company_facebook');
                    $instagram = get_company_info('company_instagram');
                    if ($facebook && $facebook !== '#'): ?>
                        <a target="_blank" href="<?php echo esc_url($facebook); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/fb.svg" alt="Facebook">
                        </a>
                    <?php endif; ?>
                    <?php if ($instagram && $instagram !== '#'): ?>
                        <a target="_blank" href="<?php echo esc_url($instagram); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/ig.svg" alt="Instagram">
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col">
            <span class="title">Menu</span>
            <?php
            if (has_nav_menu('footer')) {
                wp_nav_menu(array(
                    'container'         => false,
                    'theme_location'    => 'footer',
                    'menu_class'        => 'footer-menu',
                    'fallback_cb'       => 'wp_page_menu',
                    'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
                    'depth'             => 1,
                    'link_class'        => 'underline-anim',
                ));
            } else {
                echo '<p>No menu assigned to this location.</p>';
            }
            ?>
        </div>
        <div class="col">
            <span class="title">Información de contacto</span>
            <ul>
                <li>
                    <span>Dirección:</span>
                    <p><?php echo esc_html(get_company_info('company_address')); ?></p>
                </li>
                <li>
                    <span>Horario:</span>
                    <p><?php echo esc_html(get_company_info('company_hours')); ?></p>
                </li>
                <li>
                    <span>Teléfono:</span>
                    <p><?php echo esc_html(get_company_info('company_phone')); ?></p>
                </li>
                <li>
                    <span>Correo electrónico:</span>
                    <p><?php echo esc_html(get_company_info('company_email')); ?></p>
                </li>

                <a href="<?php echo esc_url(generate_maps_link()); ?>" target="_blank" rel="noopener">
                    <p>Como llegar</p>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/right-arrow.svg" alt="Right Arrow">
                </a>
            </ul>
        </div>
        <div class="col">
            <span class="title">Legal</span>
            <?php
            if (has_nav_menu('legal')) {
                wp_nav_menu(array(
                    'container'         => false,
                    'theme_location'    => 'legal',
                    'menu_class'        => 'legal-menu',
                    'fallback_cb'       => false,
                    'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
                    'depth'             => 1,
                    'link_class'        => 'underline-anim',
                ));
            } else {
                echo '<p>No menu assigned to this location.</p>';
            }
            ?>
        </div>
    </div>
    <div class="down">
        <span>Powered by <a href="https://solucionsoft.com" target="_blank">SolucionSoft 2025</a></span>
    </div>
</footer>