<?php  
class ConsultaController{
	
    public function cargarBoleta() {
        if(isset($_POST['cargarBoleta'])){
            $mes=$_POST['mesb'];
            $anio=$_POST['aniob'];
            $tipoboleta=$_POST['tipob'];
            $dni=$_POST['dnib'];
            $boleta = 'boleta-'.$tipoboleta.'-'.$mes.'-'.$anio;
            $encuentra = 0;
            // Buscar Boleta
            $existe = file_exists("views/boletas/".$anio."/".$tipoboleta."/".$boleta.".txt");
            if($existe){
                $lineas = file("views/boletas/".$anio."/".$tipoboleta."/".$boleta.".txt");
                $palabra=" ".$dni; 
                $contador = 0;
                foreach($lineas as $linea){
                    #echo "la linea numero: $contador <br>";
                    if(strstr($linea,$palabra)){
                        $flag=$contador-7;
                        $fila=$contador + 39;
                        // buscar y mostrar boletas de pago
                        for ( $i = $flag; $i <= $fila; $i++) {
                            $linea = $lineas[$i];
                            echo $linea;
                            $encuentra=1;									
                        }
                    }
                    $contador++;
                    // Si no se encuentran las boletas
                    
                }
                if ($encuentra == 0){
                    echo "</pre>";
                    echo "No se encontraron resultados de su busqueda, verifique los datos y vuelva a intentarlo"; 
                
                }else{
                    echo '<div class="d-flex justify-content-center">
                    <a href="views/reportes/boleta.php?dni='.$dni.'&mes='.$mes.'&anio='.$anio.'&tipo_boleta='.$tipoboleta.'" class="btn btn-primary" target="_blank">
                        <i class="icofont icofont-printer"></i>
                        Imprimir Boleta
                    </a>
                </div>';
                }
            }else{
                echo "<h4>No existen boletas con el criterio de busqueda</h4>";
            }				
            
        }
    }
}
?>