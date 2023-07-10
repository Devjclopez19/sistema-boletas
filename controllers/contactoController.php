<?php
require_once "../views/phpMailer/class.phpmailer.php";
require_once "../views/phpMailer/class.smtp.php";
# CLASES Y METODOS
#---------------------------------------------------------
class ContactoController{
    public $datosContacto;

    public function enviarMensaje(){        
        #Datos para enviar al correo
        $full_name = $this->datosContacto['full_name'];
        $email = $this->datosContacto['email'];
        $asunto = $this->datosContacto['asunto'];
        $mensaje = $this->datosContacto['mensaje'];
        #variables para el envio 
        $smtpHost = "mail.ugelespinar.gob.pe";
        $smtpUsername = "webmastersbe@ugelespinar.gob.pe";
        $smtpPassword = "P@ssWMSBE2019";
        $address = "webmastersbe@ugelespinar.gob.pe";
        #Instanciamos la clase para el envio de correos
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Port = 587; 
        $mail->IsHTML(true); 
        $mail->CharSet = "utf-8";
        $mail->Host = $smtpHost; 
        $mail->Username = $smtpUsername; 
        $mail->Password = $smtpPassword;
        $mail->From = $email; // Email desde donde envío el correo.
        $mail->FromName = $full_name;
        $mail->AddAddress($address); // Esta es la dirección a donde enviamos los datos del formulario
        $mail->Subject = "Mensaje pagina de contacto Sistema"; // Este es el titulo del email.
        #$mensajeHtml = nl2br($mensaje);
        $mail->Body = '
        <html lang="es">
            <body style="background: #fcfcfc; font-size: 15px;">
                <div style="margin: auto;width: 90%; padding: 16px;">
                    <h1 style="font-size: 20px;">Mensaje de Usuario en el Sistema de Boletas</h1>
                    <hr>
                    <p style="font-size: 16px;">Este es un mensaje enviado por un usuario del sistema, <b>responda en la brevedad posible.</b></p>
                    <p>Informaci&oacute;n enviada por el usuario:</p>
                    <div>
                        <p>Nombres: <strong>'.$full_name.'</strong></p>
                        <p>Email: <strong>'.$email.'</strong></p>
                        <p>Asunto: <strong>'.$asunto.'</strong></p>
                        <p>Mensaje: <strong>'.$mensaje.'</strong></p>
                    </div>
                    <hr>
                    <h4>Sistema de Boletas SBE 2019</h4>
                </div>
            </body>
        </html>
        ';
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        
        $estadoEnvio = $mail->Send(); 
        if($estadoEnvio){
            echo "enviado";
        } else {
            echo "Ocurrió un error inesperado.";
        }
    }

}
# OBJETOS
#---------------------------------------------------------

if(isset($_POST['contacto'])){
    $a = new ContactoController();
    $data= [];
    foreach($_POST as $key => $value) {
        $data[$key] = $value;
    }
    $a->datosContacto= $data;
    $a->enviarMensaje();
}
