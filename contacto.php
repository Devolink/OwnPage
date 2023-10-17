<?php

if (isset($_POST["name"]) && isset($_POST["lastname"]) && isset($_POST["phone"])
    && isset($_POST["email"]) && isset($_POST["message"])) {

    $nombre = $_POST["name"];
    $lastname = $_POST["lastname"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $mensaje = $_POST["message"];

    $smtpHost = "c2102232.ferozo.com";
    $smtpUsuario = "contacto@devolink.com.ar";
    $smtpClave = "FLNSoftory@2023";
    $emailDestino = "devolinkweb@gmail.com";

    require("class.phpmailer.php");
    require("class.smtp.php");

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->IsHTML(true);
    $mail->CharSet = "utf-8";

    // Mapeo //
    $mail->Host = $smtpHost;
    $mail->Username = $smtpUsuario;
    $mail->Password = $smtpClave;

    $mail->From = $email;
    $mail->FromName = "$nombre $lastname";
    $mail->AddAddress($emailDestino);

    $mail->Subject = "Devolink - Solicitud de Contacto";
    $mensajeHtml = nl2br($mensaje);
    $mail->Body = "Email: {$email} <br /><br /> Telefono: {$phone}
                    <br /><br />Mensaje: {$mensajeHtml} <br /><br />Formulario de Contacto. FLNSoftory<br />";
    $mail->AltBody = "Email: {$email} \n\n Telefono: {$phone}
                    \n\n Mensaje: {$mensaje} \n\n Formulario de Contacto. Devolink";
    // Fin Mapeo //

    $estadoEnvio = $mail->Send();

    if ($estadoEnvio) {
        // Envío exitoso
        http_response_code(200);
    } else {
        // Error en el envío
        http_response_code(500); // Puedes utilizar otro código de estado apropiado
    }
} else {
    // Datos del formulario incompletos
    http_response_code(400); // Puedes utilizar otro código de estado apropiado
}