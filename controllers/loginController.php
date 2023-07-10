<?php  
session_start();
class LoginController{
	public function validarLogin(){        
		if(isset($_POST['ingresar'])){            
			if(preg_match('/^[a-zA-Z0-9\-\_]+$/', $_POST["username"]) &&
                preg_match('/^[a-zA-Z0-9\-\_]+$/', $_POST["password"])){                    
                    $encriptado = crypt($_POST['password'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');                    
                    $respuesta = LoginModel::validarLoginModel(strtolower($_POST['username']),'usuario');                   
                    if(strtolower($_POST['username']) == strtolower($respuesta['username']) && $encriptado == $respuesta['password']){
                        if($respuesta['estado'] == 1){
                            #session_start();
                            $_SESSION['validar'] = true;
                            $_SESSION['username'] = $respuesta['username'];
                            $_SESSION['full_name'] = $respuesta['full_name'];
                            $_SESSION['dni'] = $respuesta['dni'];
                            $_SESSION['tipo_boleta'] = $respuesta['tipo_boleta']; 
                            $_SESSION['tipo_usuario'] = $respuesta['tipo_usuario']; 
                            $_SESSION['id_ugel'] = $respuesta['id_ugel'];
                            $_SESSION['nombre_ugel'] = $respuesta['nombre_ugel'];                        
                            $_SESSION['logo'] = $respuesta['logo'];
                            $_SESSION['email'] = $respuesta['email'];
                            $_SESSION['celular'] = $respuesta['celular']; 
                            $_SESSION['last_login'] = time();

                            date_default_timezone_set('America/Lima');
                            $fecha = date("Y-m-d H:i:s");
                            $datos = array(
                                'fecha' => $fecha,
                                'dni' => $respuesta['dni']
                            );
                            LoginModel::actualizarFechaAcceso($datos);
                            
                            //header('Location:inicio');
                            print "<meta http-equiv=Refresh content=\"0 ; url=inicio\">"; 
                        }else{
                            echo '<div class="alert alert-danger background-danger m-t-20">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="icofont icofont-close-line-circled"></i>
                                    </button>
                                    <strong>Error!</strong> Pendiente de activación! revise su correo para verificar si ya está activo en el sistema.
                                </div>';
                        } 
                        
                    }else{
                        echo '<div class="alert alert-danger background-danger m-t-20">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="icofont icofont-close-line-circled"></i>
                                </button>
                                <strong>Error!</strong> Datos incorrectos, vuelva a intentarlo o haga click en ¿Recuperar Contraseña? para reestablecerla.
                            </div>';
                    }
			} else {
                echo '<div class="alert alert-danger background-danger m-t-20">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled"></i>
                            </button>
                            <strong>Error!</strong> Los datos contienen caracteres no válidos
                        </div>';
            }
		}
	}
}
?>