<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct( $email, $nombre, $token ) {
        $this->email  = $email;
        $this->nombre = $nombre;
        $this->token  = $token;
    }

    public function enviarConfirmacion() {
        // Crear una instancia de PHPMailer
        $mail = new PHPMailer();

        // Configurar SMTP
        $mail->isSMTP();
        $mail->Host       = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['EMAIL_USER'];
        $mail->Password   = $_ENV['EMAIL_PASS'];
        $mail->Port       = $_ENV['EMAIL_PORT'];

        // Configurar el contenido del email
        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress($this->email, $this->email);
        $mail->Subject = 'Confirma tu cuenta';

        // Habilitar HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        // Definir el contenido
        $contenido = '<html>';
        $contenido .= '<p><strong>Hola '. $this->nombre .'</strong> Has creado tu cuenta en App Salon, solo debes confirmarla presionando el siguiente enlace</p>';
        $contenido .= '<p>Presiona aquí: <a href="'. $_ENV['APP_URL'] .'/confirmar-cuenta?token='. $this->token .'">Confirmar Cuenta</a></p>';
        $contenido .= '<p>Si tú no solicitaste esta cuenta, puedes ignorar el mensaje</p>';
        $contenido .= '</html>';

        $mail->Body = $contenido;

        // Enviar el email
        if( $mail->send() ) {
            // echo 'Mensaje Enviado';
        }else {
            // echo 'El mensaje no se pudo enviar: ' . $mail->ErrorInfo;
        }
    }

    public function enviarInstrucciones() {
        // Crear una instancia de PHPMailer
        $mail = new PHPMailer();

        // Configurar SMTP
        $mail->isSMTP();
        $mail->Host       = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['EMAIL_USER'];
        $mail->Password   = $_ENV['EMAIL_PASS'];
        $mail->Port       = $_ENV['EMAIL_PORT'];

        // Configurar el contenido del email
        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress($this->email, $this->email);
        $mail->Subject = 'Reestablece tu password';

        // Habilitar HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        // Definir el contenido
        $contenido = '<html>';
        $contenido .= '<p><strong>Hola '. $this->nombre .'</strong> Has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo.</p>';
        $contenido .= '<p>Presiona aquí: <a href="'. $_ENV['APP_URL'] .'/recuperar?token='. $this->token .'">Reestablecer Password</a></p>';
        $contenido .= '<p>Si tú no solicitaste esta cuenta, puedes ignorar el mensaje</p>';
        $contenido .= '</html>';

        $mail->Body = $contenido;

        // Enviar el email
        if( $mail->send() ) {
            // echo 'Mensaje Enviado';
        }else {
            // echo 'El mensaje no se pudo enviar: ' . $mail->ErrorInfo;
        }
    }

}