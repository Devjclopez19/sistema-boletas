<?php  

class Conexion {
	
	#METODOS
	#=====================================
	# CONECTAR
	public static function conectar(){
		$conexion_db = new PDO("mysql:host=localhost;dbname=ugelespinar_dbboletas","ugelespinar_dbadmin","P@ssWSBE2021");
		return $conexion_db;
	}
	#DESCONECTAR
	#=====================================
	public static function cerrar_conexion($conexion){
		if($conexion){
			mysql_close();
		}
	}
}
?>