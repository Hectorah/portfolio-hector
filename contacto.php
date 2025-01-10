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
        $mail->SMTPDebug = 0; // Habilita la depuración (MUY IMPORTANTE PARA VER EL ERROR EXACTO)
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
        $mail->isHTML(true); // Importante: Indica que el cuerpo del mensaje es HTML
        $mail->AddEmbeddedImage('img/logo_h.jpeg', 'logo'); // Adjunta la imagen y le asigna un CID 'logo'
		$mail->Body = '
		<!DOCTYPE html>
		<html lang="es">
		<head>
		    <meta charset="UTF-8">
		    <title>Nuevo Mensaje de Contacto</title>
		</head>
		<body style="font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f4f4f4;">
		    <div style="background-color: #ffffff; padding: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
		        <h2 style="color: #333;">Nuevo Mensaje de Contacto</h2>
		        <p><strong>Nombre:</strong> ' . $name . '</p>
		        <p><strong>Email:</strong> ' . $email . '</p>
		        <p><strong>Asunto:</strong> ' . $asunto . '</p>
		        <p><strong>Mensaje:</strong><br>' . nl2br($contenido) . '</p>
		        <img src="cid:logo" alt="Logo">
		    </div>
		    <div style="text-align: center; margin-top: 20px; font-size: small; color: #777;">
		        Este correo fue enviado desde el formulario de contacto de Hector.
		    </div>
		</body>
		</html>
		';
		$mail->AltBody = "Nombre: " . $name . "\nEmail: " . $email . "\nAsunto: " . $asunto . "\nMensaje:\n" . $contenido;

        if ($mail->send()) {
            header("Location: index.html?mensaje=1");
        }else {
            echo 'Error al enviar el mensaje: ' . $mail->ErrorInfo;
        }
            exit; // Detiene la ejecución después de la redirección
    
    } catch (Exception $e) {
        echo "Excepción capturada: " . $e->getMessage();
        exit; 
    }
}
?>