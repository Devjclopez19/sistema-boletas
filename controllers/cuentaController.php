<?php
session_start();
require_once "../models/cuentaModel.php";
# CLASES Y METODOS
#---------------------------------------------------------
class CuentaController{
    public $datos;
    public $datosP;
    public function editarCuentaController(){
        $data = $this->datos;
        $respuesta = CuentaModel::editarCuentaModel($data);
        if($respuesta == 'ok'){
            $_SESSION['full_name'] = $data['full_name'];
            $_SESSION['dni'] = $data['dni'];
        }
        echo $respuesta;
    }
    public function editarDatosController(){
        $data = $this->datosP;
        $respuesta = CuentaModel::editarDatosModel($data);
        if($respuesta == 'ok'){
            $_SESSION['full_name'] = $data['full_name'];
            $_SESSION['dni'] = $data['dni'];
        }
        echo $respuesta;
    }
}
# OBJETOS
#---------------------------------------------------------
if(isset($_POST['cuenta'])){
    $a = new CuentaController();
    $data = [];
    foreach ( $_POST as $key => $value ) {
        if($key == 'password') {
            $data[$key] = crypt($value, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
        } elseif($key == 'newP') {
            $data[$key] = crypt($value, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
        } else {
            $data[$key] = $value;
        }

    }
    $a->datos = $data;
    $a->editarCuentaController();
}
if(isset($_POST['datosP'])){
    $a = new CuentaController();
    $data = [];
    foreach ( $_POST as $key => $value ) {
        if($key == 'password') {
            $data[$key] = crypt($value, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
        } elseif($key == 'newP') {
            $data[$key] = crypt($value, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
        } else {
            $data[$key] = $value;
        }

    }
    $a->datosP = $data;
    $a->editarDatosController();
}