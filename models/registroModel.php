<?php  
require_once 'conexion.php';

class RegistroModel{

	public static function registrarUsuario($datosModel){
        $stm = Conexion::conectar()->prepare("INSERT INTO usuario(id_ugel,full_name,dni,tipo_boleta,email,celular,username,password) values(1,:full_name,:dni,:tipo_boleta,:email,:celular,:username,:password);");
        //$stm->bindParam(':id_ugel',1,PDO::PARAM_INT);
        $stm->bindParam(':full_name',$datosModel['full_name'],PDO::PARAM_STR);
        $stm->bindParam(':dni',$datosModel['dni'],PDO::PARAM_STR);
        $stm->bindParam(':tipo_boleta',$datosModel['tipo_boleta'],PDO::PARAM_STR);
        $stm->bindParam(':email',$datosModel['email'],PDO::PARAM_STR);
        $stm->bindParam(':celular',$datosModel['celular'],PDO::PARAM_STR);
        $stm->bindParam(':username',$datosModel['username'],PDO::PARAM_STR);
        $stm->bindParam(':password',$datosModel['password'],PDO::PARAM_STR);
        if($stm->execute()){
            if($stm->rowCount() > 0) {
                return 'ok';
            }else {
                return 'error';
            }
        }else {
            return 'no se ejecutó la consulta';
        }
    }
	public static function resetPassword($datosModel){
        $stm = Conexion::conectar()->prepare("UPDATE usuario SET password = :pass WHERE email = :email AND dni = :dni AND estado = 1 ;");
        $stm->bindParam(':pass',$datosModel['encriptado'],PDO::PARAM_STR);
        $stm->bindParam(':dni',$datosModel['dni'],PDO::PARAM_STR);
        $stm->bindParam(':email',$datosModel['email'],PDO::PARAM_STR);

        $stmt = Conexion::conectar()->prepare("SELECT username FROM usuario WHERE email = :email AND dni = :dni AND estado = 1 ;");
        $stmt->bindParam(':dni',$datosModel['dni'],PDO::PARAM_STR);
        $stmt->bindParam(':email',$datosModel['email'],PDO::PARAM_STR);

        if($stm->execute()){
            if($stm->rowCount() > 0) {
                if($stmt->execute()){
                    if($stmt->rowCount() > 0){
                        return $stmt->fetch(PDO::FETCH_ASSOC);
                    }else{
                        return "error";
                    }
                }else{
                    return 'error';
                }
            }else {
                return 'error';
            }
        }else {
            return 'no se ejecutó la consulta';
        }
    }
}

?>