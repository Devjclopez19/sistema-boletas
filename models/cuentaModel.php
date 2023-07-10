<?php  
require_once 'conexion.php';

class CuentaModel{

	public static function editarCuentaModel($datosModel){
		if(!isset($datosModel['cambiarP'])) {
            $stm = Conexion::conectar()->prepare("UPDATE usuario SET full_name = :full_name, dni = :dni WHERE username = :username and password = :pass ;");
		    $stm->bindParam(":full_name",$datosModel['full_name'],PDO::PARAM_STR); 
		    $stm->bindParam(":dni",$datosModel['dni'],PDO::PARAM_STR); 
            $stm->bindParam(":username",$datosModel['username'],PDO::PARAM_STR); 
            $stm->bindParam(":pass",$datosModel['password'],PDO::PARAM_STR); 
            if($stm->execute()){
                if($stm->rowCount() > 0) {
                    return 'ok';
                }else{
                    return 'error';
                }
            }else {
                return 'error';
            }
        }else {
            $stm = Conexion::conectar()->prepare("UPDATE usuario SET full_name = :full_name, dni = :dni,password=:newP WHERE username = :username and password = :pass ;");
		    $stm->bindParam(":full_name",$datosModel['full_name'],PDO::PARAM_STR); 
		    $stm->bindParam(":dni",$datosModel['dni'],PDO::PARAM_STR); 
            $stm->bindParam(":newP",$datosModel['newP'],PDO::PARAM_STR); 
            $stm->bindParam(":username",$datosModel['username'],PDO::PARAM_STR);
            $stm->bindParam(":pass",$datosModel['password'],PDO::PARAM_STR); 
            if($stm->execute()){
                if($stm->rowCount() > 0) {
                    return 'ok';
                }else{
                    return 'error';
                }
            }else {
                return 'error';
            }
        }
	}
	public static function editarDatosModel($datosModel){
		if(!isset($datosModel['cambiarP'])) {
            $stm = Conexion::conectar()->prepare("UPDATE usuario SET full_name = :full_name, dni = :dni,email = :email, celular = :celular WHERE username = :username and password = :pass ;");
		    $stm->bindParam(":full_name",$datosModel['full_name'],PDO::PARAM_STR); 
		    $stm->bindParam(":dni",$datosModel['dni'],PDO::PARAM_STR); 
		    $stm->bindParam(":email",$datosModel['email'],PDO::PARAM_STR); 
		    $stm->bindParam(":celular",$datosModel['celular'],PDO::PARAM_STR); 
            $stm->bindParam(":username",$datosModel['username'],PDO::PARAM_STR); 
            $stm->bindParam(":pass",$datosModel['password'],PDO::PARAM_STR); 
            if($stm->execute()){
                if($stm->rowCount() > 0) {
                    return 'ok';
                }else{
                    return 'error';
                }
            }else {
                return 'error';
            }
        }else {
            $stm = Conexion::conectar()->prepare("UPDATE usuario SET full_name = :full_name, dni = :dni,password=:newP,email = :email, celular = :celular WHERE username = :username and password = :pass ;");
		    $stm->bindParam(":full_name",$datosModel['full_name'],PDO::PARAM_STR); 
            $stm->bindParam(":dni",$datosModel['dni'],PDO::PARAM_STR); 
            $stm->bindParam(":email",$datosModel['email'],PDO::PARAM_STR); 
		    $stm->bindParam(":celular",$datosModel['celular'],PDO::PARAM_STR); 
            $stm->bindParam(":newP",$datosModel['newP'],PDO::PARAM_STR); 
            $stm->bindParam(":username",$datosModel['username'],PDO::PARAM_STR);
            $stm->bindParam(":pass",$datosModel['password'],PDO::PARAM_STR); 
            if($stm->execute()){
                if($stm->rowCount() > 0) {
                    return 'ok';
                }else{
                    return 'error';
                }
            }else {
                return 'error';
            }
        }
	}
}

?>