<?php
include_once '../../models/conexion.php';

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value

$searchArray = array();

## Search 
$searchQuery = " ";
if($searchValue != ''){
	$searchQuery = " AND (full_name LIKE :full_name or 
        dni LIKE :dni OR
        email LIKE :email ) ";
    $searchArray = array( 
        'full_name'=>"%$searchValue%",
        'dni'=>"%$searchValue%", 
        'email'=>"%$searchValue%"
    );
}

## Total number of records without filtering
$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) AS allcount FROM usuario ");
$stmt->execute();
$records = $stmt->fetch();
$totalRecords = $records['allcount'];

## Total number of records with filtering
$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) AS allcount FROM usuario WHERE estado <> 0 ".$searchQuery);
$stmt->execute($searchArray);
$records = $stmt->fetch();
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$stmt = Conexion::conectar()->prepare("SELECT * FROM usuario WHERE estado <> 0 AND tipo_usuario = 3  ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

// Bind values
foreach($searchArray as $key=>$search){
    $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
}

$stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
$stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
$stmt->execute();
$empRecords = $stmt->fetchAll();

$data = array();

foreach($empRecords as $row){
    $data[] = array(
            "id_usuario"=>$row['id_usuario'],
            "full_name"=>$row['full_name'],
            "dni"=>$row['dni'],
            "tipo_boleta"=>$row['tipo_boleta'],
            "email"=>$row['email'],
            "celular"=>$row['celular'],
            "estado"=>$row['estado'],
            "fecha_registro"=>$row['fecha_registro'],
            "fecha_acceso"=>$row['fecha_acceso']
        );
}

## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);
