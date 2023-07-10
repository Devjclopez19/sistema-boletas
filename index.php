<?php 
#Modelos
require_once 'models/enlacesModel.php'; 
require_once 'models/loginModel.php';
require_once 'models/ugelModel.php';
#Controladores
require_once 'controllers/templateController.php';
require_once "controllers/enlacesController.php";
require_once 'controllers/loginController.php';
require_once 'controllers/ugelController.php';
require_once 'controllers/consultaController.php';

$template = new TemplateController();
$template->template();
?>