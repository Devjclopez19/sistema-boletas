<?php  
require_once 'conexion.php';

class LoginModel{

	public static function validarLoginModel($datosModel,$tabla){
		$stm = Conexion::conectar()->prepare("SELECT u.username,u.password, u.full_name,u.dni,u.tipo_boleta,u.tipo_usuario,u.email,u.celular,u.estado,ug.id_ugel,ug.razon_social as 'nombre_ugel',ug.logo FROM $tabla u inner join ugel ug on u.id_ugel = ug.id_ugel WHERE u.username = :usuario ");
		$stm->bindParam(":usuario",$datosModel,PDO::PARAM_STR);
		$stm->execute();
		return $stm->fetch();
	}
	public static function actualizarFechaAcceso($datosModel){
		$stm = Conexion::conectar()->prepare("UPDATE usuario SET fecha_acceso = :fecha WHERE dni = :dni");
		$stm->bindParam(":fecha",$datosModel['fecha'],PDO::PARAM_STR);
		$stm->bindParam(":dni",$datosModel['dni'],PDO::PARAM_STR);
		$stm->execute();
	}
}

?>