<section class="contact-section" id="contacto" data-aos="fade-up">
    <div class="contact-info" data-aos="fade-right" data-aos-delay="200">
        <div class="info-header">
            <h2 class="section-title">Contáctanos</h2>
            <h3 class="section-subtitle">Estamos para ayudarte</h3>
        </div>

        <div class="contact-details">
            <a href="mailto:<?php echo esc_attr(get_company_info('company_email')); ?>" class="contact-item contact-link" data-aos="fade-up" data-aos-delay="300">
                <div class="contact-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 4H4C2.9 4 2.01 4.9 2.01 6L2 18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM20 8L12 13L4 8V6L12 11L20 6V8Z" fill="currentColor" />
                    </svg>
                </div>
                <div class="contact-text">
                    <h4>Correo electrónico</h4>
                    <p><?php echo esc_html(get_company_info('company_email')); ?></p>
                </div>
            </a>

            <a href="tel:<?php echo esc_attr(str_replace(' ', '', get_company_info('company_phone'))); ?>" class="contact-item contact-link" data-aos="fade-up" data-aos-delay="400">
                <div class="contact-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.62 10.79C8.06 13.62 10.38 15.94 13.21 17.38L15.41 15.18C15.69 14.9 16.08 14.82 16.43 14.93C17.55 15.3 18.75 15.5 20 15.5C20.55 15.5 21 15.95 21 16.5V20C21 20.55 20.55 21 20 21C10.61 21 3 13.39 3 4C3 3.45 3.45 3 4 3H7.5C8.05 3 8.5 3.45 8.5 4C8.5 5.25 8.7 6.45 9.07 7.57C9.18 7.92 9.1 8.31 8.82 8.59L6.62 10.79Z" fill="currentColor" />
                    </svg>
                </div>
                <div class="contact-text">
                    <h4>Número de teléfono</h4>
                    <p><?php echo esc_html(get_company_info('company_phone')); ?></p>
                </div>
            </a>

            <a href="<?php echo esc_url(generate_waze_link()); ?>" target="_blank" rel="noopener" class="contact-item contact-link" data-aos="fade-up" data-aos-delay="500">
                <div class="contact-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22S19 14.25 19 9C19 5.13 15.87 2 12 2ZM12 11.5C10.62 11.5 9.5 10.38 9.5 9S10.62 6.5 12 6.5S14.5 7.62 14.5 9S13.38 11.5 12 11.5Z" fill="currentColor" />
                    </svg>
                </div>
                <div class="contact-text">
                    <h4>Ubicación</h4>
                    <p><?php echo esc_html(get_company_info('company_address')); ?></p>
                </div>
            </a>

            <?php if (function_exists('is_page') && is_page('contacto')): ?>
                <a href="<?php echo esc_url(generate_waze_link()); ?>" target="_blank" rel="noopener" class="btn btn-waze" data-aos-delay="600">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/waze.png" alt="Waze">
                    <span>
                        Abrir en Waze
                    </span>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Contact Form -->
    <div class="contact-form-container" data-aos="fade-left" data-aos-delay="300">
        <h3>Formulario</h3>

        <form id="contact-form" class="contact-form" novalidate>
            <div class="form-group">
                <label for="contact-name">Nombre completo</label>
                <div class="input-container">
                    <input type="text" id="contact-name" name="name" required>
                </div>
                <span class="error-message" id="name-error"></span>
            </div>

            <div class="form-group">
                <label for="contact-email">Email</label>
                <div class="input-container">
                    <input type="email" id="contact-email" name="email" required>
                </div>
                <span class="error-message" id="email-error"></span>
            </div>

            <div class="form-group">
                <label for="contact-subject">Selecciona</label>
                <div class="select-container">
                    <select id="contact-subject" name="subject" required>
                        <option value="" disabled>Selecciona una opción</option>
                        <option value="PQR - Solicitudes" selected>PQR - Solicitudes</option>
                    </select>
                    <div class="select-arrow">
                        <svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L6 6L11 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
                <span class="error-message" id="subject-error"></span>
            </div>

            <div class="form-group">
                <label for="contact-message">Mensaje</label>
                <div class="textarea-container">
                    <textarea id="contact-message" name="message" rows="5" required></textarea>
                </div>
                <span class="error-message" id="message-error"></span>
            </div>

            <button type="submit" class="submit-btn">
                <span class="btn-text">Enviar</span>
                <div class="btn-loader">
                    <div class="loader-spinner"></div>
                </div>
            </button>
        </form>

        <!-- Success/Error Messages -->
        <div id="form-messages" class="form-messages">
            <div id="success-message" class="message success-msg">
                <div class="message-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 16.17L4.83 12L3.41 13.41L9 19L21 7L19.59 5.59L9 16.17Z" fill="currentColor" />
                    </svg>
                </div>
                <div class="message-content">
                    <h4>¡Mensaje enviado exitosamente!</h4>
                    <p>Gracias por contactarnos. Te responderemos pronto.</p>
                </div>
            </div>

            <div id="error-message" class="message error-msg">
                <div class="message-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM13 17H11V15H13V17ZM13 13H11V7H13V13Z" fill="currentColor" />
                    </svg>
                </div>
                <div class="message-content">
                    <h4>Error al enviar el mensaje</h4>
                    <p>Por favor, inténtalo de nuevo más tarde.</p>
                </div>
            </div>
        </div>
    </div>
</section>