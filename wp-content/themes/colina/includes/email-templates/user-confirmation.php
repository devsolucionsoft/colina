<?php

/**
 * User Confirmation Email Template
 * Variables available: $name, $email, $subject, $radicado_number
 */

$site_name = get_bloginfo('name');
$site_url = home_url();
$current_year = date('Y');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de recepción - <?php echo $site_name; ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #d71f26 0%, #b91c1c 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23ffffff" fill-opacity="0.05"><circle cx="30" cy="30" r="4"/><circle cx="15" cy="15" r="2"/><circle cx="45" cy="45" r="2"/><circle cx="15" cy="45" r="2"/><circle cx="45" cy="15" r="2"/></g></svg>') repeat;
        }

        .header-content {
            position: relative;
            z-index: 1;
        }

        .header h1 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .header p {
            font-size: 16px;
            opacity: 0.9;
        }

        .content {
            padding: 40px 30px;
        }

        .welcome-message {
            text-align: center;
            margin-bottom: 30px;
        }

        .welcome-message h2 {
            color: #d71f26;
            font-size: 24px;
            margin-bottom: 12px;
        }

        .welcome-message p {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
        }

        .details-box {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
            border-left: 4px solid #d71f26;
        }

        .details-box h3 {
            color: #d71f26;
            font-size: 18px;
            margin-bottom: 15px;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 600;
            color: #555;
            font-size: 14px;
        }

        .detail-value {
            color: #333;
            font-size: 14px;
            font-weight: 500;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-card {
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .info-card:hover {
            border-color: #d71f26;
            box-shadow: 0 4px 12px rgba(215, 31, 38, 0.1);
        }

        .info-card-icon {
            font-size: 24px;
            margin-bottom: 8px;
        }

        .info-card h4 {
            color: #d71f26;
            font-size: 16px;
            margin-bottom: 8px;
        }

        .info-card p {
            color: #666;
            font-size: 14px;
            line-height: 1.4;
        }

        .next-steps {
            background: #e3f2fd;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
        }

        .next-steps h3 {
            color: #1976d2;
            font-size: 18px;
            margin-bottom: 15px;
        }

        .steps-list {
            list-style: none;
            counter-reset: steps;
        }

        .steps-list li {
            counter-increment: steps;
            margin-bottom: 12px;
            position: relative;
            padding-left: 40px;
            color: #333;
            font-size: 14px;
            line-height: 1.5;
        }

        .steps-list li::before {
            content: counter(steps);
            position: absolute;
            left: 0;
            top: 0;
            background: #1976d2;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
        }

        .contact-methods {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .contact-method {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: white;
            padding: 8px 12px;
            border-radius: 6px;
            color: #856404;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .contact-method:hover {
            background: #f5c6cb;
            color: #721c24;
        }

        .cta-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #d71f26 0%, #b91c1c 100%);
            color: white;
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(215, 31, 38, 0.3);
        }

        .footer {
            background: #f8f9fa;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }

        .footer-logo {
            margin-bottom: 15px;
        }

        .footer p {
            color: #666;
            font-size: 12px;
            margin-bottom: 8px;
        }

        .footer a {
            color: #d71f26;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .social-links {
            margin-top: 15px;
        }

        .social-link {
            display: inline-block;
            width: 32px;
            height: 32px;
            background: #d71f26;
            color: white;
            border-radius: 50%;
            margin: 0 4px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: #b91c1c;
            transform: translateY(-2px);
        }

        @media (max-width: 600px) {
            .email-container {
                margin: 10px;
                border-radius: 8px;
            }

            .header,
            .content,
            .footer {
                padding: 25px 20px;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .contact-methods {
                flex-direction: column;
                align-items: center;
            }

            .detail-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 4px;
            }

            .steps-list li {
                padding-left: 35px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <h1>¡Mensaje Recibido!</h1>
                <p>Tu consulta ha sido enviada exitosamente</p>
            </div>
        </div>

        <!-- Radicado Number -->
        <div style="background: #d71f26; color: white; padding: 20px; text-align: center; margin: 0;">
            <h2 style="margin: 0; color: white; font-size: 24px;">Tu número de radicado: <?php echo esc_html($radicado_number); ?></h2>
            <p style="margin: 5px 0 0 0; color: white; opacity: 0.9;">Guarda este número para futuras referencias</p>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Welcome Message -->
            <div class="welcome-message">
                <h2>Hola <?php echo esc_html($name); ?></h2>
                <p>Gracias por contactarnos. Hemos recibido tu consulta y nuestro equipo se pondrá en contacto contigo lo antes posible.</p>
            </div>

            <!-- Details Box -->
            <div class="details-box">
                <h3>Resumen de tu consulta</h3>

                <div class="detail-item">
                    <span class="detail-label">Número de Radicado:</span>
                    <span class="detail-value" style="font-weight: bold; color: #d71f26;"><?php echo esc_html($radicado_number); ?></span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Tema:</span>
                    <span class="detail-value"><?php echo esc_html($subject); ?></span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Email de contacto:</span>
                    <span class="detail-value"><?php echo esc_html($email); ?></span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Fecha de envío:</span>
                    <span class="detail-value"><?php echo current_time('d/m/Y H:i'); ?></span>
                </div>
            </div>

            <!-- Info Grid -->
            <div class="info-grid">
                <div class="info-card">
                    <h4>Tiempo de respuesta</h4>
                    <p>Responderemos en máximo 24-48 horas laborales</p>
                </div>

                <div class="info-card">
                    <h4>Método de contacto</h4>
                    <p>Te responderemos directamente a tu email</p>
                </div>
            </div>

            <!-- Next Steps -->
            <div class="next-steps">
                <h3>¿Qué sigue ahora?</h3>
                <ol class="steps-list">
                    <li>Nuestro equipo revisará tu consulta detalladamente</li>
                    <li>Te contactaremos por email con una respuesta personalizada</li>
                    <li>Si es necesario, programaremos una llamada o reunión</li>
                    <li>Trabajaremos juntos para resolver tu consulta</li>
                </ol>
            </div>

            <!-- CTA Section -->
            <div class="cta-section">
                <a href="<?php echo $site_url; ?>" class="cta-button">
                    Visitar nuestro sitio web
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-logo">
                <strong style="color: #d71f26; font-size: 18px;"><?php echo $site_name; ?></strong>
            </div>

            <p>Este es un email automático de confirmación.</p>
            <p>Si no esperabas este mensaje, puedes ignorarlo con seguridad.</p>

            <p style="margin-top: 15px;">
                <a href="<?php echo $site_url; ?>"><?php echo $site_url; ?></a>
            </p>

            <p style="margin-top: 20px; color: #999; font-size: 11px;">
                © <?php echo $current_year; ?> <?php echo $site_name; ?>. Todos los derechos reservados.
            </p>

            <p style="color: #999; font-size: 11px;">
                Respetamos tu privacidad. No compartimos tu información con terceros.
            </p>
        </div>
    </div>
</body>

</html>