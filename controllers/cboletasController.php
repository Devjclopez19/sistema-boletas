<?php
require_once "../models/cboletasModel.php";
# CLASES Y METODOS
#---------------------------------------------------------
class CBoletasController{
    
    public $datosAgregar;
    public $datosBusqueda; 
    public $datosVerificar;
    public $datosEditar;
    public $idEliminar;
    public function verificarBoleta(){        
        $data = $this->datosVerificar;
        $respuesta = CBoletasModel::verificarBoleta($data);
        echo $respuesta;
    }
    public function agregarBoleta(){        
        $data = $this->datosAgregar;
        $respuesta = CBoletasModel::agregarBoleta($data);
        echo $respuesta;
    }
    public function listarBoletas(){        
        $data = $this->datosBusqueda;
        $respuesta = CBoletasModel::listarBoletas($data);
        //header( 'Content-type: application/json' );
        echo json_encode($respuesta);
    }
    public function editarBoleta(){        
        $data = $this->datosEditar;
        $respuesta = CBoletasModel::editarBoleta($data);
        echo $respuesta;
    }
    public function eliminarBoleta(){        
        $data = $this->idEliminar;
        $respuesta = CBoletasModel::eliminarBoleta($data);
        echo $respuesta;
    }
}
# OBJETOS
#---------------------------------------------------------
if(isset($_POST['verificar'])){
    $a = new CBoletasController();
    $datos = [
        "anio"=>$_POST['aniov'],
        "mes"=>$_POST['mesv'],
        "tipo_boleta"=>$_POST['tipov'],
    ];    
    $a->datosVerificar= $datos;
    $a->verificarBoleta();
}
if(isset($_POST['agregar'])){
    $id_ugel=$_POST['id_ugel'];
    $anio = $_POST['anio'];
    $mes = $_POST['mes'];
    $tipo_boleta = $_POST['tipo_boleta'];
    $periodo = $_POST['periodo'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_FILES['boleta']['tmp_name'];
    $size = $_FILES['boleta']['size'];
    $type = $_FILES['boleta']['type'];
    $name = 'boleta-'.$tipo_boleta.'-'.$mes.'-'.$anio.'.txt'; 
    
    if($size > 10000000 || $type != 'text/plain'){
        echo "el archivo no cumple lo solicitado";
    }else{
        $path = 'views/boletas/'.$anio.'/'.$tipo_boleta.'/';
        $img = '../'.$path.$name;
        $link = $path.$name;
        if(move_uploaded_file($imagen,$img)){
            $datos = array(
                'id_ugel' => $id_ugel,
                'anio' => $anio,
                'mes' => $mes,
                'tipo_boleta' => $tipo_boleta,
                'periodo' => $periodo,
                'descripcion' => $descripcion,
                'link' => $link,
            );
            $a = new CBoletasController();
            $a->datosAgregar = $datos;
            $a->agregarBoleta();

        }else{
            echo "No se subio el archivo";
        }
    }
}

if(isset($_POST['aniob'])){
    $a = new CBoletasController();
    $datos = [
        "anio"=>$_POST['aniob'],
        "tipo_boleta"=>$_POST['tipob'],
    ];    
    $a->datosBusqueda = $datos;
    $a->listarBoletas();
}
if(isset($_POST['id_boleta'])){
    if(isset($_POST['editarBol'])){
        $id_boleta=$_POST['id_boleta'];
        $anio = $_POST['anio'];
        $mes = $_POST['mes'];
        $tipo_boleta = $_POST['tipo_boleta'];
        $periodo = $_POST['periodo'];
        $descripcion = $_POST['descripcion'];
        $imagen = $_FILES['boleta']['tmp_name'];
        $size = $_FILES['boleta']['size'];
        $type = $_FILES['boleta']['type'];
        $name = 'boleta-'.$tipo_boleta.'-'.$mes.'-'.$anio.'.txt'; 
        
        if($size > 10000000 || $type != 'text/plain'){
            echo "el archivo no cumple lo solicitado";
        }else{
            $path = 'views/boletas/'.$anio.'/'.$tipo_boleta.'/';
            $img = '../'.$path.$name;
            $link = $path.$name;
            if(move_uploaded_file($imagen,$img)){
                $datos = array(
                    'editarBol'=>true,
                    'id_boleta' => $id_boleta,
                    'periodo' => $periodo,
                    'descripcion' => $descripcion,
                    'link' => $link,
                );
                $a = new CBoletasController();
                $a->datosEditar = $datos;
                $a->editarBoleta();

            }else{
                echo "No se subio el archivo";
            }
        }
    }else{
        $datos = array(
                    'id_boleta'=>$_POST['id_boleta'],
                    'periodo' => $_POST['periodo'],
                    'descripcion' => $_POST['descripcion']); 
        $a = new CBoletasController();
        $a->datosEditar = $datos;
        $a->editarBoleta();          
    }
    
}
if(isset($_POST['eliminar'])){
    $a = new CBoletasController();
    $a->idEliminar = $_POST['eliminar'];
    $a->eliminarBoleta();
}