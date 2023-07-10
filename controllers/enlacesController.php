<?php
class EnlacesController{

    public function enlacesControllers(){
        if (isset($_GET["action"])){
            $enlaces = $_GET["action"];
        }
        else{
            $enlaces = "index";
        }
        $respuesta = EnlacesModel::enlacesModels($enlaces);

        include $respuesta;
    }

}