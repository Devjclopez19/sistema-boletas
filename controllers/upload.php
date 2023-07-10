<?php
$target_dir = "../views/boletas/";
$param = $_POST['nameFile'];
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$parametros = explode('-',$param);
$name1 = $parametros[0];
$tipoboleta=$parametros[1];
$mes=$parametros[2];
$anio=$parametros[3];
$dir = $target_dir.$anio."/".$tipoboleta."/";
$name = $dir.$param.".txt";
$path = 'views/boletas/'.$anio."/".$tipoboleta."/".$param.".txt";
if (move_uploaded_file($_FILES["file"]["tmp_name"], $name)) {
    header('Content-type: application/json');
    echo json_encode(['path' => $path]);
}else{
    header('Content-type: application/json');
    echo json_encode(['path' => null]);
}