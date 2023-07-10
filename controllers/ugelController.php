<?php  
class UgelController{
	public function mostrarInfoUgel($id){        
        $respuesta = UgelModel::mostrarInfoUgel($id);
        return $respuesta;
    }
    public function editarUgel() {
        if(isset($_POST['guardarInfo'])){
            $datos = [];
            foreach($_POST as $key => $value){
                $datos[$key] = $value;
            }
            $respuesta = UgelModel::editarUgel($datos);
            if($respuesta == 'ok'){
                echo '<script>
                    Swal.fire(
                        "Correcto",
                        "Datos actualizados!",
                        "success"
                    )
                    .then(function(){
                        window.location = "ugel"
                    })
                    </script>';
            }else {
                echo '<script>
                Swal.fire(
                    "Error!",
                    "No de actualizaron los datos",
                    "error"
                )
                </script>';
            }
        }
    }
}
?>