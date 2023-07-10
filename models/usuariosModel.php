<?php  
require_once 'conexion.php';

class UsuariosModel{

	public static function verificarUsuario($datosModel){
        $stm = Conexion::conectar()->prepare("SELECT username FROM usuario WHERE username = :username;");
        $stm->bindParam(':username',$datosModel,PDO::PARAM_STR);
        if($stm->execute()){
            if($stm->rowCount() > 0) {
                return 'existe';
            }else {
                return 'no existe';
            }
        }else {
            return 'no se ejecutó la consulta';
        }
	}
	public static function agregarUsuario($datosModel){
        $stm = Conexion::conectar()->prepare("INSERT INTO usuario(id_ugel,full_name,dni,tipo_boleta,email,celular,username,password) values(:id_ugel,:full_name,:dni,:tipo_boleta,:email,:celular,:username,:password);");
        $stm->bindParam(':id_ugel',$datosModel['id_ugel'],PDO::PARAM_INT);
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
    public static function activarUsuario($datosModel){
        $stm = Conexion::conectar()->prepare("UPDATE usuario SET estado = 1 WHERE id_usuario = :id");
        $stm->bindParam(':id',$datosModel,PDO::PARAM_STR);
        $stmt = Conexion::conectar()->prepare("SELECT email FROM usuario WHERE id_usuario = :id");
        $stmt->bindParam(':id',$datosModel,PDO::PARAM_STR);
        if($stm->execute()){
            if($stm->rowCount() > 0) {
                if($stmt->execute()){
                    if($stmt->rowCount() > 0) {
                        return $stmt->fetch(PDO::FETCH_ASSOC); 
                    } else {
                        return "error";
                    }
                }else{
                    return "error";
                }
            }else {
                return 'error';
            }
        }else {
            return 'no se ejecutó la consulta';
        }
	}
    public static function getUser($datosModel){
        $stm = Conexion::conectar()->prepare("SELECT full_name,dni,tipo_boleta,email,celular,username  FROM usuario WHERE id_usuario = :id");
        $stm->bindParam(':id',$datosModel,PDO::PARAM_STR);
        if($stm->execute()){
            if($stm->rowCount() > 0) {
                return $stm->fetch(PDO::FETCH_ASSOC);
            }else {
                return 'error';
            }
        }else {
            return 'no se ejecutó la consulta';
        }
    }
    public static function editarUsuario($datosModel){
        if(isset($datosModel['editarPass'])){
            $stm = Conexion::conectar()->prepare("UPDATE usuario SET full_name = :full_name,dni = :dni,tipo_boleta = :tipo_boleta,email = :email,celular = :celular,password = :password WHERE id_usuario = :id_user");
            $stm->bindParam(':full_name',$datosModel['full_name'],PDO::PARAM_STR);
            $stm->bindParam(':dni',$datosModel['dni'],PDO::PARAM_STR);
            $stm->bindParam(':tipo_boleta',$datosModel['tipo_boleta'],PDO::PARAM_STR);
            $stm->bindParam(':email',$datosModel['email'],PDO::PARAM_STR);
            $stm->bindParam(':celular',$datosModel['celular'],PDO::PARAM_STR);
            $stm->bindParam(':password',$datosModel['password'],PDO::PARAM_STR);
            $stm->bindParam(':id_user',$datosModel['id_user'],PDO::PARAM_INT);
        }else {
            $stm = Conexion::conectar()->prepare("UPDATE usuario SET full_name = :full_name,dni = :dni,tipo_boleta = :tipo_boleta,email = :email,celular = :celular WHERE id_usuario = :id_user");
            $stm->bindParam(':full_name',$datosModel['full_name'],PDO::PARAM_STR);
            $stm->bindParam(':dni',$datosModel['dni'],PDO::PARAM_STR);
            $stm->bindParam(':tipo_boleta',$datosModel['tipo_boleta'],PDO::PARAM_STR);
            $stm->bindParam(':email',$datosModel['email'],PDO::PARAM_STR);
            $stm->bindParam(':celular',$datosModel['celular'],PDO::PARAM_STR);
            $stm->bindParam(':id_user',$datosModel['id_user'],PDO::PARAM_INT);
        }
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
    public static function eliminarUsuario($datosModel){
        $stm = Conexion::conectar()->prepare("DELETE FROM usuario WHERE id_usuario = :id");
        $stm->bindParam(':id',$datosModel,PDO::PARAM_STR);
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
}

?>