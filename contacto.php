<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //validaciones
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $name = htmlspecialchars(trim($_POST['name']));
    $asunto = htmlspecialchars(trim($_POST['asunto']));
    $contenido = htmlspecialchars(trim($_POST['contenido']));

    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 2; // Habilita la depuración (MUY IMPORTANTE PARA VER EL ERROR EXACTO)
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';

        // Configuración SMTP (Gmail)
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hectorher149@gmail.com';
        $mail->Password = 'uroj yvft umso asbi'; // Contraseña de aplicación (NECESARIO PARA GMAIL)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Usar SMTPS (SSL/TLS) con el puerto 465
        $mail->Port = 465;

        // Configuración del correo
        $mail->setFrom($email, $name);
        $mail->addAddress('hectorher149@gmail.com');
        $mail->Subject = $asunto;
        $mail->Body = $contenido;
        $mail->AltBody = strip_tags($contenido); // Añade texto alternativo para clientes sin HTML

        if ($mail->send()) {
            header("Location: index.html?mensaje=1");
            exit; // Detiene la ejecución después de la redirección
        }else {
            echo 'Error al enviar el mensaje: ' . $mail->ErrorInfo;
        }
    
    } catch (Exception $e) {
        echo "Excepción capturada: " . $e->getMessage();
    }
}
?>