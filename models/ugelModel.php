<?php  
require_once 'conexion.php';

class UgelModel{
	public static function mostrarInfoUgel($id){        
        $stm = Conexion::conectar()->prepare("SELECT * FROM ugel WHERE id_ugel = :id");
        $stm->bindParam(":id",$id,PDO::PARAM_INT);
        $stm->execute();
        if($stm->rowCount() > 0){
            return $stm->fetch();
        }else {
            return 'error';
        }
    }
    public static function editarUgel($datos) {
        $stm = Conexion::conectar()->prepare("UPDATE ugel SET ruc=:ruc,director=:director,email=:email,telefono=:telefono,direccion=:direccion WHERE id_ugel =:id");
        $stm->bindParam(":ruc",$datos['ruc'],PDO::PARAM_STR);
        $stm->bindParam(":director",$datos['director'],PDO::PARAM_STR);
        $stm->bindParam(":email",$datos['email'],PDO::PARAM_STR);
        $stm->bindParam(":telefono",$datos['telefono'],PDO::PARAM_STR);
        $stm->bindParam(":direccion",$datos['direccion'],PDO::PARAM_STR);
        $stm->bindParam(":id",$datos['id_ugel'],PDO::PARAM_INT);
        if($stm->execute()){
            if($stm->rowCount() > 0) {
                return 'ok';
            }else {
                return 'error';
            }
        }else {
            return 'error';
        }
    }
}
?>