<?php
mb_http_output('UTF-8');
require('fpdf.php');
include('php-barcode.php');
include('qrcode/phpqrcode/qrlib.php');
// variables
$mes=$_GET['mes'];
$anio=$_GET['anio'];
$tipoboleta=$_GET['tipo_boleta'];
$dni=$_GET['dni'];
$boleta = 'boleta-'.$tipoboleta.'-'.$mes.'-'.$anio;
$encuentra = 0;
//Generar QR
$file = 'qrcode/imgqr/'.$dni.'-'.$anio.'-'.$mes.'-'.$tipoboleta.'.png';
$size = 3;									
$data='https://boletas.ugelespinar.gob.pe/views/reportes/boleta.php?dni='.$dni.'&mes='.$mes.'&anio='.$anio.'&tipo_boleta='.$tipoboleta;
$level = QR_ECLEVEL_H;
QRcode::png($data, $file, $level, $size);
// propiedades para el codigo de barras
$fontSize = 10;
$marge    = 10;   // between barcode and hri in pixel
$x        = 200;  // barcode center
$y        = 680;  // barcode center
$height   = 50;   // barcode height in 1D ; module size in 2D
$width    = 2;    // barcode height in 1D ; not use in 2D
$angle    = 0;   // rotation in degrees

$code     = $dni.$anio; // barcode, of course ;)
$type     = 'ean13';
$black    = '000000'; // color in hexa
// Estendemos la clase FPDF
class eFPDF extends FPDF{
    function TextWithRotation($x, $y, $txt, $txt_angle, $font_angle=0)
    {
        $font_angle+=90+$txt_angle;
        $txt_angle*=M_PI/180;
        $font_angle*=M_PI/180;
    
        $txt_dx=cos($txt_angle);
        $txt_dy=sin($txt_angle);
        $font_dx=cos($font_angle);
        $font_dy=sin($font_angle);
    
        $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',$txt_dx,$txt_dy,$font_dx,$font_dy,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
        if ($this->ColorFlag)
            $s='q '.$this->TextColor.' '.$s.' Q';
        $this->_out($s);
    }
}

// INSTANCIA DE FPDF
$pdf = new eFPDF('P','pt');
$pdf->AddPage('P','a4');
$pdf->SetFont('Courier','B',10);
// Leer el archivo 
$existe = file_exists("../boletas/".$anio."/".$tipoboleta."/".$boleta.".txt");
if($existe){
    $lineas = file("../boletas/".$anio."/".$tipoboleta."/".$boleta.".txt");					
    $palabra=" ".$dni; 
    $contador = 0;

    foreach($lineas as $linea){
        #echo "la linea numero: $contador <br>";
        if(strstr($linea,$palabra)){
            #echo $linea."<br>";
            #echo $contador."<br>";
            $flag=$contador-7;
            #echo $flag;
            $fila=$contador + 39;
            #echo "<br>";
            #echo $fila;
            // lineas nombre sistema
            $pdf->Line(10,10,585,10);
            $pdf->Line(10,25,585,25);
            // Lineas logo  y encabezado
            $pdf->Line(10,98,585,98);
            $pdf->Line(10,110,585,110);
            //lineas para separar detalle de pago superior
            $pdf->Line(10,332,585,332);
            $pdf->Line(10,334,585,334);    
            // lineas para separar detalle de pago inferior
            $pdf->Line(10,482,585,482);
            $pdf->Line(10,484,585,484);
            // Colocando el nombre del sistema
            $pdf->Cell(0,-20,utf8_decode('Sistema de Boletas SBE ').$anio,0,1,'R');
            // nombre de la Ugel
            $pdf->Ln(35);
            $pdf->Cell(0,12,utf8_decode('DIRECCIÓN REGIONAL DE EDUCACIÓN CUSCO'),0,1,'C');
            $pdf->Cell(0,12,utf8_decode('UNIDAD DE GESTIÓN EDUCATIVA LOCAL ESPINAR'),0,2,'C');  
            $pdf->Cell(0,12,utf8_decode('UNIDAD EJECUTORA 310'),0,3,'C');
            // información de la boleta
            $pdf->Ln(20);
            $pdf->Cell(0,10,utf8_decode('BOLETA DE PAGO AÑO:').$anio,0,3,'L');	
            $pdf->Cell(0,-10,utf8_decode('BOLETA DE PAGO MES:').strtoupper($mes),0,3,'R');	
            $pdf->Ln(10);
            //LOGO DE ENCABEZADO
            $pdf->Image('../images/logo_espinar.png',25,28,50);
            $pdf->Ln(0);
            //imagen fondo boleta
            $pdf->Image('../images/logo_espinar_bg.png',100,170,400);
            $pdf->Ln(8);
            // buscar y mostrar boletas de pago
            for ( $i = $flag; $i <= $fila; $i++) {
                $linea = $lineas[$i];
                #echo $linea."<br>";
                $pdf->Multicell(0,10,$linea,0,'J');
                $encuentra=1;									
            }
            // TEXTO SOBRE EL CODIGO DE BARRAS
            $pdf->Ln();
            $pdf->Multicell(0,10,utf8_decode('COPIA VÁLIDA PARA FINES INFORMATIVOS'),0,'C');
            $pdf->Multicell(0,10,utf8_decode('La presentación impresa de la boleta de pago electrónica puede ser verificada en:'),0,'C');
            $pdf->Multicell(0,10,utf8_decode('www.ugelespinar.gob.pe o a través de la lectura del codigo QR'),0,'C');
            $pdf->Multicell(0,10,utf8_decode('aprobado según R.D.R. Nro 0000-2018'),0,'C');
            /* CODIGO DE BARRAS */
            // $data = Barcode::fpdf($pdf, $black, $x, $y, $angle, $type, array('code'=>$code), $width, $height);
            // $len = $pdf->GetStringWidth($data['hri']);
            // Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
            // $pdf->TextWithRotation($x + $xt, $y + $yt, $data['hri'], $angle);
            //imagen codigo qr 
            $pdf->Image('qrcode/imgqr/'.$dni.'-'.$anio.'-'.$mes.'-'.$tipoboleta.'.png',250,640,110);
            $pdf->Image('images/verificar.png',253,747,100);
            // LINEA DE PIE DE PAGINA Y TEXTO
            $pdf->Ln(120);
            $pdf->Line(10,758,590,758);
            $pdf->Line(10,770,590,770);
            $pdf->Line(10,782,590,782);
            $pdf->Multicell(0,12,utf8_decode('Unidad de Gestion Educativa Local Espinar - Unidad de Informática y Remuneraciones - Telefono: 084-011101 - Email: webmastersbe@ugelespinar.gob.pe	 www.ugelespinar.gob.pe'),0,'C');
            //GENERAMOS UNA PAGINA EN CADA ITERACION
            $pdf->AddPage();
        }
        $contador++;
        // Si no se encuentran las boletas
        
    }
    if ($encuentra == 0){
        echo '</pre>';
        echo"<script type=\"text/javascript\">alert('DNI no encontrado; Ud. no ha sido remunerado este mes; Consulte en la oficina de informatica; o puede enviarnos un correo a traves del menu contactenos, Usted sera redireccionado a la pagina principal'); window.location='../../inicio';</script>";  

    }
}else{
    echo"<script type=\"text/javascript\">alert('Archivo no encontrado; Ud. no ha sido remunerado este mes; Consulte en la oficina de informatica; o puede enviarnos un correo a traves del menu contactenos, Usted sera redireccionado a la pagina principal'); window.location='../../inicio';</script>";
}
#$pdf->Cell(100,10,'Hello World!','T',2,'C');
#$pdf->Cell(100,10,'Linea 2','T',0);
$pdf->Output();
?>