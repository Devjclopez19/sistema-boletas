<?php
class EnlacesModel{

    public static function enlacesModels($enlaces){

        if( $enlaces == 'login' || 
            $enlaces == 'registro'||
            $enlaces == 'reestablecer' ||
            $enlaces == 'inicio' ||
            $enlaces == 'salir' ||
            $enlaces == 'cuenta' ||
            $enlaces == 'ugel' ||
            $enlaces == 'usuarios' ||
            $enlaces == 'cargar_boletas' ||
            $enlaces == 'boletas' ||
            $enlaces == 'datos' ||
            $enlaces == 'contacto' ||
            $enlaces == 'consulta'
            ){

            $module = "views/modules/".$enlaces.".php";
        }
        elseif($enlaces="index"){
            $module = "views/modules/login.php";
        }
        else {
            $module = "views/modules/login.php";
        }
        return $module;
    }
}
?>