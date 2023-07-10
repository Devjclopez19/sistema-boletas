<?php
require_once "../models/registroModel.php";
require_once "../views/phpMailer/class.phpmailer.php";
require_once "../views/phpMailer/class.smtp.php";
# CLASES Y METODOS
#---------------------------------------------------------
class RegistroController{
    public $datosRegistro;
    public $datosReset;

    public function registrarUsuario(){        
        $data = $this->datosRegistro;
        $respuesta = RegistroModel::registrarUsuario($data);
        if($respuesta == 'ok'){
            #Datos para enviar al correo
            $full_name = $this->datosRegistro['full_name'];
            $dni = $this->datosRegistro['dni'];
            $tipo_boleta = $this->datosRegistro['tipo_boleta'];
            $email = $this->datosRegistro['email'];
            $celular = $this->datosRegistro['celular'];
            $username = $this->datosRegistro['username'];
            $password = $this->datosRegistro['pass'];
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
            $mail->Subject = "Registro de Usuario Sistema Boletas"; // Este es el titulo del email.
            #$mensajeHtml = nl2br($mensaje);
            $mail->Body = '
            <html lang="es">
                <body style="background: #fcfcfc; font-size: 15px;">
                    <div style="margin: auto;width: 90%; padding: 16px;">
                        <h1 style="font-size: 20px;">Registro de Usuario en el Sistema de Boletas</h1>
                        <hr>
                        <p style="font-size: 16px;">Los datos del docente registrado se muestran a continuaci&oacute;n, <b>valide la informaci&oacute;n y proceda con la activaci&oacute;n del usuario en el sistema de boletas.</b></p>
                        <p>Informaci&oacute;n enviada por el usuario:</p>
                        <div>
                            <p>Nombres: <strong>'.$full_name.'</strong></p>
                            <p>DNI: <strong>'.$dni.'</strong></p>
                            <p>Tipo: <strong>'.$tipo_boleta.'</strong></p>
                            <p>Email: <strong>'.$email.'</strong></p>
                            <p>Celular: <strong>'.$celular.'</strong></p>
                            <p>Usuario: <strong>'.$username.'</strong></p>
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
            // Enviar email de bienvenida con datos de usuario y contraseña
            $mail2 = new PHPMailer();
            $mail2->IsSMTP();
            $mail2->SMTPAuth = true;
            $mail2->Port = 587; 
            $mail2->IsHTML(true); 
            $mail2->CharSet = "utf-8";
            $mail2->Host = $smtpHost; 
            $mail2->Username = $smtpUsername; 
            $mail2->Password = $smtpPassword;
            $mail2->From = "webmastersbe@ugelespinar.gob.pe"; // Email desde donde envío el correo.
            $mail2->FromName = "Administración Sistema de Boletas";
            $mail2->AddAddress($email); // Esta es la dirección a donde enviamos los datos del formulario
            $mail2->Subject = "Bienvenido al Sistema de Boletas Ugel Espinar"; // Este es el titulo del email.
            $mail2->Body = '
            <html lang="es">
                <body style="background: #fcfcfc; font-size: 15px;padding:.5rem;">
                    <div>
                        <h1 style="font-size: 20px;background: #01a9ac;color: #fff;padding: 5px;font-weight: 500;text-align:center;">Estimado usuario, la Unidad de Gestión Educativa Local de Espinar, le da la bienvenida al sistema de boletas.</h1>
                        <p>Su registro está pendiente de aprobación, se le enviará un correo confirmando su activación, <b>recuerde guardar estos datos para su posterior acceso al sistema</b>.</p>
                        <div style="margin-bottom: 20px;">
                            <p>Usuario: <strong>'.$username.'</strong></p>
                            <p>Contraseña: <strong>'.$password.'</strong></p>  
                        </div>
                        <p>Atentamente,</p>
                        <p>Administración del Sistema de Boletas SBE 2019</p>
                    </div>
                </body>
            </html>
            ';
            $estadoEnvio2 = $mail2->Send(); 

            if($estadoEnvio && $estadoEnvio2){
                echo "enviado";
            } else {
                echo "Ocurrió un error inesperado.";
            }
        }else{
            echo $respuesta;
        }
    }
    public function resetPassword(){        
        $data = $this->datosReset;
        $respuesta = RegistroModel::resetPassword($data);
        if($respuesta != 'error'){
            #Datos para enviar al correo
            $username = $respuesta['username'];
            $password = $this->datosReset['nuevoPass'];
            #variables para el envio 
            $smtpHost = "mail.ugelespinar.gob.pe";
            $smtpUsername = "webmastersbe@ugelespinar.gob.pe";
            $smtpPassword = "P@ssWMSBE2019";
            $address = $this->datosReset['email'];
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
            $mail->From = 'webmastersbe@ugelespinar.gob.pe'; // Email desde donde envío el correo.
            $mail->FromName = 'Webmaster Sistema Boletas Ugel Espinar';
            $mail->AddAddress($address); // Esta es la dirección a donde enviamos los datos del formulario
            $mail->Subject = "¿Ha olvidado su contraseña?"; // Este es el titulo del email.
            #$mensajeHtml = nl2br($mensaje);
            $mail->Body = '
            <html lang="es">
                <body style="background: #fcfcfc; font-size: 15px; padding:.5rem;">
                    <div>
                        <h1 style="font-size: 18px;background: #01a9ac;color: #fff;padding: 5px;font-weight: 500;text-align:center;">Estimado usuario, según su solicitud se ha generado nueva contraseña en el Sistema de Boletas Ugel Espinar.</h1>
                        <p style="font-size: 16px;">Para entrar al sistema utilice los siguientes datos:</p>
                        <div style="margin-bottom: 20px;">
                            <p>Usuario: <strong>'.$username.'</strong></p>
                            <p>Contraseña: <strong>'.$password.'</strong></p>
                            <p>Acceder al sistema >> <a href="boletas.ugelespinar.gob.pe" target="_blank">Iniciar Sesion</a></p>   
                        </div>
                        <p>Después del acceso al sistema, se sugiere cambiar la contraseña por una que recuerde mejor.</p>
                        <p>Atentamente,</p>
                        <p>Administración del Sistema de Boletas SBE 2019</p>
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
        }else{
            echo $respuesta;
        }
    }

}
# OBJETOS
#---------------------------------------------------------

if(isset($_POST['registrar'])){
    $a = new RegistroController();
    $data= [];
    foreach($_POST as $key => $value) {
        if($key == 'password') {
            $data[$key] = crypt($value, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
        } else {
            $data[$key] = $value;
        }
    }
    $data['pass'] = $_POST['password'];
    $a->datosRegistro= $data;
    $a->registrarUsuario();
}
if(isset($_POST['reestablecer'])){
    $a = new RegistroController();
    $encriptado = crypt($_POST['nuevoPass'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
    $data= array(
        'email' => $_POST['email'],    
        'dni' => $_POST['dni'],    
        'nuevoPass' => $_POST['nuevoPass'],    
        'encriptado' => $encriptado   
    );
    $a->datosReset= $data;
    $a->resetPassword();
}
