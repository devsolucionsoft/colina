<?php

/**
 * Admin Notification Email Template
 * Variables available: $name, $email, $subject, $message
 */

$site_name = get_bloginfo('name');
$site_url = home_url();
$admin_url = admin_url();
$date = current_time('d/m/Y H:i');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva consulta - <?php echo $site_name; ?></title>
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
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .content {
            padding: 30px;
        }

        .alert-box {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
            border-left: 4px solid #f39c12;
        }

        .alert-box h3 {
            color: #856404;
            font-size: 16px;
            margin-bottom: 8px;
        }

        .alert-box p {
            color: #856404;
            font-size: 14px;
        }

        .contact-details {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
        }

        .contact-details h3 {
            color: #d71f26;
            font-size: 18px;
            margin-bottom: 20px;
            border-bottom: 2px solid #d71f26;
            padding-bottom: 8px;
        }

        .detail-row {
            display: flex;
            margin-bottom: 12px;
            align-items: center;
        }

        .detail-label {
            font-weight: 600;
            color: #555;
            min-width: 100px;
            font-size: 14px;
        }

        .detail-value {
            color: #333;
            font-size: 14px;
            word-break: break-word;
        }

        .message-content {
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
        }

        .message-content h3 {
            color: #d71f26;
            font-size: 18px;
            margin-bottom: 15px;
        }

        .message-text {
            color: #333;
            font-size: 15px;
            line-height: 1.6;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #d71f26 0%, #b91c1c 100%);
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            margin: 0 8px 8px 0;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(215, 31, 38, 0.3);
        }

        .btn-secondary {
            background: #6c757d;
            background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
        }

        .stats {
            background: #e3f2fd;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .stats h4 {
            color: #1976d2;
            font-size: 16px;
            margin-bottom: 12px;
        }

        .stat-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #bbdefb;
        }

        .stat-item:last-child {
            border-bottom: none;
        }

        .stat-label {
            color: #1976d2;
            font-size: 14px;
            font-weight: 500;
        }

        .stat-value {
            color: #0d47a1;
            font-size: 14px;
            font-weight: 600;
        }

        .footer {
            background: #f8f9fa;
            padding: 25px;
            text-align: center;
            border-top: 1px solid #e9ecef;
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

        .priority-high {
            background: #f8d7da;
            border-color: #f5c6cb;
            border-left-color: #dc3545;
        }

        .priority-high h3,
        .priority-high p {
            color: #721c24;
        }

        @media (max-width: 600px) {
            .email-container {
                margin: 10px;
                border-radius: 8px;
            }

            .header,
            .content,
            .footer {
                padding: 20px;
            }

            .contact-details,
            .message-content,
            .stats {
                padding: 20px;
            }

            .detail-row {
                flex-direction: column;
                align-items: flex-start;
            }

            .detail-label {
                margin-bottom: 4px;
                min-width: auto;
            }

            .btn {
                display: block;
                margin: 8px 0;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>Nueva Consulta Recibida</h1>
            <p>Formulario de contacto - <?php echo $date; ?></p>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Alert Box -->
            <div class="alert-box <?php echo ($subject === 'PQR' || $subject === 'Soporte Técnico') ? 'priority-high' : ''; ?>">
                <h3>Resumen de la consulta</h3>
                <p>Se ha recibido una nueva consulta a través del formulario de contacto del sitio web.</p>
            </div>

            <!-- Contact Details -->
            <div class="contact-details">
                <h3>Información del contacto</h3>

                <div class="detail-row">
                    <span class="detail-label">Nombre:</span>
                    <span class="detail-value"><?php echo esc_html($name); ?></span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value">
                        <a href="mailto:<?php echo esc_attr($email); ?>" style="color: #d71f26; text-decoration: none;">
                            <?php echo esc_html($email); ?>
                        </a>
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Tema:</span>
                    <span class="detail-value">
                        <span style="background: #d71f26; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px;">
                            <?php echo esc_html($subject); ?>
                        </span>
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Fecha:</span>
                    <span class="detail-value"><?php echo $date; ?></span>
                </div>
            </div>

            <!-- Message Content -->
            <div class="message-content">
                <h3>Mensaje</h3>
                <div class="message-text"><?php echo esc_html($message); ?></div>
            </div>

            <!-- Stats -->
            <div class="stats">
                <h4>Información adicional</h4>

                <div class="stat-item">
                    <span class="stat-label">IP del usuario:</span>
                    <span class="stat-value"><?php echo esc_html($_SERVER['REMOTE_ADDR']); ?></span>
                </div>

                <div class="stat-item">
                    <span class="stat-label">Navegador:</span>
                    <span class="stat-value"><?php echo esc_html(substr($_SERVER['HTTP_USER_AGENT'], 0, 50)); ?>...</span>
                </div>

                <div class="stat-item">
                    <span class="stat-label">Formulario:</span>
                    <span class="stat-value">Contacto Principal</span>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Este email fue generado automáticamente por el sistema de contacto de</p>
            <p><a href="<?php echo $site_url; ?>"><?php echo $site_name; ?></a></p>
            <p style="margin-top: 12px; font-size: 11px; color: #999;">
                Este mensaje puede contener información confidencial. Si lo recibiste por error, por favor elimínalo.
            </p>
        </div>
    </div>
</body>

</html>