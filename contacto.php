<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Ruta al autoload de Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ... (obtener y validar datos como en el ejemplo anterior)
    $email = $_POST['email'];
    $name = $_POST['name'];
    $asunto = $_POST['asunto'];
    $contenido = $_POST['contenido'];

    $mail = new PHPMailer(true); // `true` habilita las excepciones
    try {
        // Configuración del servidor SMTP (reemplazar con tus credenciales)
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Servidor SMTP (ej: smtp.gmail.com)
        $mail->SMTPAuth   = true;
        $mail->Username   = 'hectorher149@gmail.com'; // Tu correo electrónico
        $mail->Password   = 'uroj yvft umso asbi'; // Tu contraseña
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        // Configuración del correo
        $mail->setFrom($email, $name);
        $mail->addAddress('hectorher149@gmail.com'); // Destinatario
        $mail->Subject = $asunto;
        $mail->Body    = $contenido;

        $mail->send();
         header("Location: index.html?mensaje=1"); // Redireccionar con un parámetro
    } catch (Exception $e) {
        echo "El mensaje no se pudo enviar. Error de Mailer: {$mail->ErrorInfo}";
    }
}
?>