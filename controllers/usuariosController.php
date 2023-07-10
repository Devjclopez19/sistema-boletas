<?php
require_once "../models/usuariosModel.php";
require_once "../views/phpMailer/class.phpmailer.php";
require_once "../views/phpMailer/class.smtp.php";
# CLASES Y METODOS
#---------------------------------------------------------
class UsuariosController{
    public $username;
    public $datosAgregar;
    public $activarUser; 
    public $editarUser;
    public $datosEditar;
    public $idEliminar;
    public function verificarUsuario(){        
        $data = $this->username;
        $respuesta = UsuariosModel::verificarUsuario($data);
        echo $respuesta;
    }
    public function agregarUsuario(){        
        $data = $this->datosAgregar;
        $respuesta = UsuariosModel::agregarUsuario($data);
        if($respuesta == 'ok'){
            #Datos para enviar al correo
            $username = $this->datosAgregar['username'];
            $password = $this->datosAgregar['pass'];
            #variables para el envio 
            $smtpHost = "mail.ugelespinar.gob.pe";
            $smtpUsername = "webmastersbe@ugelespinar.gob.pe";
            $smtpPassword = "P@ssWMSBE2019";
            $address = $data['email'];
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
            $mail->Subject = "Bienvenido al Sistema de Boletas Ugel Espinar"; // Este es el titulo del email.
            #$mensajeHtml = nl2br($mensaje);
            $mail->Body = '
            <html lang="es">
                <body style="background: #fcfcfc; font-size: 15px; padding:.5rem;">
                    <div>
                        <h1 style="font-size: 18px;background: #01a9ac;color: #fff;padding: 5px;font-weight: 500;text-align:center;">Estimado usuario, la Unidad de Gestión Educativa Local de Espinar, le da la bienvenida al sistema de boletas.</h1>
                        <hr>
                        <p style="font-size: 16px;">Desde este sistema Ud. puede visualizar sus boletas de pago; sus datos de acceso al sistema:</p>   
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
                echo "ok";
            } else {
                echo "Ocurrió un error inesperado.";
            }
        }else {
            echo $respuesta;
        }
    }
    public function activarUsuario(){        
        $data = $this->activarUser;
        $respuesta = UsuariosModel::activarUsuario($data);
        
        if($respuesta != 'error'){
            #Datos para enviar al correo
            $email = $respuesta['email'];
            #variables para el envio 
            $smtpHost = "mail.ugelespinar.gob.pe";
            $smtpUsername = "webmastersbe@ugelespinar.gob.pe";
            $smtpPassword = "P@ssWMSBE2019";
            $address = $email;
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
            $mail->Subject = "Cuenta activada Sistema de Boletas"; // Este es el titulo del email.
            #$mensajeHtml = nl2br($mensaje);
            $mail->Body = '
            <html lang="es">
                <body style="background: #fcfcfc; font-size: 15px; padding:.5rem;">
                    <div>
                        <h1 style="font-size: 18px;background: #01a9ac;color: #fff;padding: 5px;font-weight: 500;text-align:center;">Estimado usuario, según su solicitud se ha procedido a la activación de su cuenta en el Sistema de Boletas Ugel Espinar.</h1>
                        <div style="margin-bottom: 20px;">
                            <p>Acceder al sistema >> <a href="boletas.ugelespinar.gob.pe" target="_blank">Iniciar Sesion</a></p>   
                        </div>
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
                echo "ok";
            } else {
                echo "Ocurrió un error inesperado.";
            }
        }else{
            echo $respuesta;
        }
    }
    public function getUser(){        
        $data = $this->editarUser;
        $respuesta = UsuariosModel::getUser($data);
        $datosUser = [];
        $res= [];
        foreach($respuesta as $key => $value){
            $datosUser[$key] = $value;
        }
        $res['user'] = $datosUser;
        header( 'Content-type: application/json' );
        echo json_encode($res);
        
    }
    public function editarUsuario(){        
        $data = $this->datosEditar;
        $respuesta = UsuariosModel::editarUsuario($data);
        echo $respuesta;
    }
    public function eliminarUsuario(){        
        $data = $this->idEliminar;
        $respuesta = UsuariosModel::eliminarUsuario($data);
        echo $respuesta;
    }
}
# OBJETOS
#---------------------------------------------------------
if(isset($_POST['nombreUsuario'])){
    $a = new UsuariosController();
    $a->username = $_POST['nombreUsuario'];
    $a->verificarUsuario();
}
if(isset($_POST['agregar'])){
    $a = new UsuariosController();
    $pass= crypt($_POST['password'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
    $data= [];
    foreach($_POST as $key => $value) {
        if($key == 'password') {
            $data[$key] = crypt($value, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
        } else {
            $data[$key] = $value;
        }
    }
    $data['pass'] = $_POST['password'];
    $a->datosAgregar= $data;
    $a->agregarUsuario();
}
if(isset($_POST['activarUser'])){
    $a = new UsuariosController();
    $a->activarUser = $_POST['activarUser'];
    $a->activarUsuario();
}
if(isset($_POST['editarUsuario'])){
    $a = new UsuariosController();
    $a->editarUser = $_POST['editarUsuario'];
    $a->getUser();
}
if(isset($_POST['id_user'])){
    $a = new UsuariosController();
    $data = [];
    if(isset($_POST['editarPass'])){
        foreach($_POST as $key => $value) {
            if($key == 'password') {
                $data[$key] = crypt($value, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
            } else {
                $data[$key] = $value;
            }
        }
    }else{
        foreach($_POST as $key => $value) {
            $data[$key] = $value;
        }
    }
    $a->datosEditar = $data;
    $a->editarUsuario();
}
if(isset($_POST['eliminar'])){
    $a = new UsuariosController();
    $a->idEliminar = $_POST['eliminar'];
    $a->eliminarUsuario();
}