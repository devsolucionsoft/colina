<?php

/**
 * Contact Form Handler
 * Handles AJAX form submissions and email sending
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class ColinaContactForm
{

    public function __construct()
    {
        add_action('wp_ajax_send_contact_email', array($this, 'handle_contact_form'));
        add_action('wp_ajax_nopriv_send_contact_email', array($this, 'handle_contact_form'));

        add_action('wp_ajax_get_contact_nonce', array($this, 'get_new_nonce'));
        add_action('wp_ajax_nopriv_get_contact_nonce', array($this, 'get_new_nonce'));
    }

    public function get_new_nonce()
    {
        wp_die(json_encode(array(
            'success' => true,
            'nonce' => wp_create_nonce('contact_form_nonce')
        )));
    }
    public function handle_contact_form()
    {
        // Verificar que tenemos los datos necesarios
        if (!isset($_POST['action']) || $_POST['action'] !== 'send_contact_email') {
            wp_die(json_encode(array(
                'success' => false,
                'data' => 'Acción inválida'
            )));
        }

        // Verify nonce
        $nonce = isset($_POST['nonce']) ? $_POST['nonce'] : '';

        if (empty($nonce) || !wp_verify_nonce($nonce, 'contact_form_nonce')) {
            wp_die(json_encode(array(
                'success' => false,
                'data' => 'Token de seguridad inválido'
            )));
        }

        // Sanitize and validate input
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $subject = sanitize_text_field($_POST['subject']);
        $message = sanitize_textarea_field($_POST['message']);

        // Validation
        $errors = array();

        if (empty($name) || strlen($name) < 2 || strlen($name) > 50) {
            $errors[] = 'El nombre debe tener entre 2 y 50 caracteres';
        }

        if (empty($email) || !is_email($email)) {
            $errors[] = 'Email inválido';
        }

        if (empty($subject)) {
            $errors[] = 'Debe seleccionar un tema';
        }

        if (empty($message) || strlen($message) < 10 || strlen($message) > 500) {
            $errors[] = 'El mensaje debe tener entre 10 y 500 caracteres';
        }

        if (!empty($errors)) {
            wp_die(json_encode(array(
                'success' => false,
                'data' => implode(', ', $errors)
            )));
        }

        // Send emails
        $admin_sent = $this->send_admin_notification($name, $email, $subject, $message);
        $user_sent = $this->send_user_confirmation($name, $email, $subject);

        if ($admin_sent && $user_sent) {
            wp_die(json_encode(array(
                'success' => true,
                'data' => 'Mensaje enviado exitosamente'
            )));
        } else {
            wp_die(json_encode(array(
                'success' => false,
                'data' => 'Error al enviar el correo'
            )));
        }
    }

    /**
     * Send admin notification email
     */
    private function send_admin_notification($name, $email, $subject, $message)
    {
        $admin_email = 'davidsantiagomanchola@gmail.com';
        $site_name = get_bloginfo('name');

        $email_subject = "[{$site_name}] Nueva consulta: {$subject}";

        // Load email template
        $template_path = get_template_directory() . '/includes/email-templates/admin-notification.php';

        if (file_exists($template_path)) {
            ob_start();
            include $template_path;
            $email_body = ob_get_clean();
        } else {
            $email_body = $this->get_admin_email_fallback($name, $email, $subject, $message);
        }

        // Headers para WP Mail SMTP
        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'From: ' . $site_name . ' <' . $admin_email . '>',
            'Reply-To: ' . $name . ' <' . $email . '>'
        );

        return wp_mail($admin_email, $email_subject, $email_body, $headers);
    }

    /**
     * Send user confirmation email
     */
    private function send_user_confirmation($name, $email, $subject)
    {
        $site_name = get_bloginfo('name');
        $admin_email = 'davidsantiagomanchola@gmail.com';

        $email_subject = "Confirmación de recepción - {$site_name}";

        // Load email template
        $template_path = get_template_directory() . '/includes/email-templates/user-confirmation.php';

        if (file_exists($template_path)) {
            ob_start();
            include $template_path;
            $email_body = ob_get_clean();
        } else {
            $email_body = $this->get_user_email_fallback($name, $subject);
        }

        // Headers para WP Mail SMTP
        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'From: ' . $site_name . ' <' . $admin_email . '>'
        );

        return wp_mail($email, $email_subject, $email_body, $headers);
    }

    /**
     * Fallback admin email template
     */
    private function get_admin_email_fallback($name, $email, $subject, $message)
    {
        $site_name = get_bloginfo('name');
        $site_url = home_url();

        return "
        <html>
        <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
            <div style='max-width: 600px; margin: 0 auto; padding: 20px;'>
                <h2 style='color: #d71f26; border-bottom: 2px solid #d71f26; padding-bottom: 10px;'>
                    Nueva consulta recibida
                </h2>
                
                <div style='background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0;'>
                    <h3>Detalles del contacto:</h3>
                    <p><strong>Nombre:</strong> {$name}</p>
                    <p><strong>Email:</strong> {$email}</p>
                    <p><strong>Tema:</strong> {$subject}</p>
                </div>
                
                <div style='background: white; padding: 20px; border: 1px solid #ddd; border-radius: 8px;'>
                    <h3>Mensaje:</h3>
                    <p>{$message}</p>
                </div>
                
                <div style='margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; font-size: 12px; color: #666;'>
                    <p>Este email fue enviado desde el formulario de contacto de <a href='{$site_url}'>{$site_name}</a></p>
                </div>
            </div>
        </body>
        </html>";
    }

    /**
     * Fallback user email template
     */
    private function get_user_email_fallback($name, $subject)
    {
        $site_name = get_bloginfo('name');
        $site_url = home_url();

        return "
        <html>
        <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
            <div style='max-width: 600px; margin: 0 auto; padding: 20px;'>
                <h2 style='color: #d71f26; border-bottom: 2px solid #d71f26; padding-bottom: 10px;'>
                    ¡Gracias por contactarnos!
                </h2>
                
                <p>Hola {$name},</p>
                
                <p>Hemos recibido tu consulta sobre <strong>{$subject}</strong> y nos pondremos en contacto contigo lo antes posible.</p>
                
                <div style='background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0;'>
                    <p><strong>Tiempo estimado de respuesta:</strong> 24-48 horas laborales</p>
                </div>
                
                <p>Mientras tanto, puedes visitar nuestro sitio web para más información:</p>
                <p><a href='{$site_url}' style='color: #d71f26; text-decoration: none;'>{$site_name}</a></p>
                
                <div style='margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; font-size: 12px; color: #666;'>
                    <p>Si no esperabas este email, puedes ignorarlo con seguridad.</p>
                </div>
            </div>
        </body>
        </html>";
    }
}

// Initialize the contact form handler
new ColinaContactForm();
