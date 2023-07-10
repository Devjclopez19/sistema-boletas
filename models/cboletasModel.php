<?php  
require_once 'conexion.php';

class CBoletasModel{

    public static function verificarBoleta($datosModel){
        $stm = Conexion::conectar()->prepare("SELECT * FROM boleta WHERE anio = :anio AND tipo_boleta = :tipo_boleta AND mes = :mes;");
        $stm->bindParam(':anio',$datosModel['anio'],PDO::PARAM_STR);
        $stm->bindParam(':mes',$datosModel['mes'],PDO::PARAM_STR);
        $stm->bindParam(':tipo_boleta',$datosModel['tipo_boleta'],PDO::PARAM_STR);
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

	public static function agregarBoleta($datosModel){
        $stm = Conexion::conectar()->prepare("INSERT INTO boleta(id_ugel,anio,mes,tipo_boleta,periodo,descripcion,link) values(:id_ugel,:anio,:mes,:tipo_boleta,:periodo,:descripcion,:link);");
        $stm->bindParam(':id_ugel',$datosModel['id_ugel'],PDO::PARAM_INT);
        $stm->bindParam(':anio',$datosModel['anio'],PDO::PARAM_STR);
        $stm->bindParam(':mes',$datosModel['mes'],PDO::PARAM_STR);
        $stm->bindParam(':tipo_boleta',$datosModel['tipo_boleta'],PDO::PARAM_STR);
        $stm->bindParam(':periodo',$datosModel['periodo'],PDO::PARAM_STR);
        $stm->bindParam(':descripcion',$datosModel['descripcion'],PDO::PARAM_STR);
        $stm->bindParam(':link',$datosModel['link'],PDO::PARAM_STR);
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
    public static function listarBoletas($datosModel){
        $stm = Conexion::conectar()->prepare("SELECT id_boleta as id,anio,mes,tipo_boleta,periodo,descripcion,link,fecha_registro FROM boleta WHERE anio = :anio AND tipo_boleta = :tipo_boleta;");
        $stm->bindParam(':anio',$datosModel['anio'],PDO::PARAM_STR);
        $stm->bindParam(':tipo_boleta',$datosModel['tipo_boleta'],PDO::PARAM_STR);
        if($stm->execute()){
            if($stm->rowCount() > 0) {
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            }else {
                return 'error';
            }
        }else {
            return 'no se ejecutó la consulta';
        }
	}
    public static function editarBoleta($datosModel){
        if(isset($datosModel['editarBol'])){
            $stm = Conexion::conectar()->prepare("UPDATE boleta SET periodo = :periodo,descripcion = :descripcion, link = :link WHERE id_boleta = :id_boleta");
            $stm->bindParam(':periodo',$datosModel['periodo'],PDO::PARAM_STR);
            $stm->bindParam(':descripcion',$datosModel['descripcion'],PDO::PARAM_STR);
            $stm->bindParam(':link',$datosModel['link'],PDO::PARAM_STR);
            $stm->bindParam(':id_boleta',$datosModel['id_boleta'],PDO::PARAM_INT);
        }else {
            $stm = Conexion::conectar()->prepare("UPDATE boleta SET periodo = :periodo,descripcion = :descripcion WHERE id_boleta = :id_boleta");
            $stm->bindParam(':periodo',$datosModel['periodo'],PDO::PARAM_STR);
            $stm->bindParam(':descripcion',$datosModel['descripcion'],PDO::PARAM_STR);
            $stm->bindParam(':id_boleta',$datosModel['id_boleta'],PDO::PARAM_INT);
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
    public static function eliminarBoleta($datosModel){
        $stm = Conexion::conectar()->prepare("DELETE FROM boleta WHERE id_boleta = :id");
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