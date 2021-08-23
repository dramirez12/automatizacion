<?php
require('PDF_MC_TableGESTIONLAB.php');
$fecha = new DateTime(null, new DateTimeZone('America/Tegucigalpa'));
$hora = $fecha->format("H:i:s");

//Instanciamos la clase para generar el documento pdf
$pdf=new PDF_MC_Table();

//Agregamos la primera página al documento pdf
$pdf->AddPage();

//Seteamos el inicio del margen superior en 25 pixeles 
$y_axis_initial = 25;
$pdf->Ln(10);

//Seteamos el tipo de letra y creamos el título de la página. No es un encabezado no se repetirá
$pdf->SetFont('Arial','B',12);

$pdf->Cell(60,6,'',0,0,'C');
$pdf->Cell(78,9,utf8_decode('UNIVERSIDAD NACIONAL AUTÓNOMA DE HONDURAS'),0,0,'C'); 
$pdf->Ln(10);
$pdf->Cell(60,6,'',0,0,'C');
$pdf->Cell(80,9,utf8_decode('FACULTAD DE CIENCIAS ECONÓMICAS'),0,0,'C'); 
$pdf->Ln(10);
$pdf->Cell(40,6,'',0,0,'C');
$pdf->Cell(120,9,utf8_decode('DEPARTAMENTO DE INFORMÁTICA'),0,0,'C'); 
// $pdf->Cell(40,10,utf8_decode('Fecha de reporte'),1,0,'C'); 
$pdf->Ln(10);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(1,6,'',0,0,'C');

$pdf->Cell(40,5,date('d/m/Y').' '.$hora,1,0,'C');
$pdf->Ln(20);
$pdf->Cell(45,6,'',0,0,'C');
$pdf->Cell(100,8,utf8_decode('REPORTE DE SALIDA PRODUCTOS'),1,0,'C'); 
$pdf->Ln(20);
//$pdf->Cell(40,10,utf8_decode('Fecha de reporte'),1,0,'C'); 

//Creamos las celdas para los títulos de cada columna y le asignamos un fondo gris y el tipo de letra




// $pdf->Cell(40,10,utf8_decode('Fecha de reporte'),1,0,'C'); 

//Creamos las celdas para los títulos de cada columna y le asignamos un fondo gris y el tipo de letra
$pdf->SetFillColor(232,232,232); 
$pdf->SetFont('Arial','B',10);
$pdf->Cell(1,6,'',0,0,'C');//mk
 

$pdf->Ln(7);


//Comenzamos a crear las filas de los registros según la consulta mysql
require_once "../Modelos/gestion_lab_modelo.php";
$reportes = new reportes();

$num_inventario=$_GET['inventario'];
// $nombre_producto=intval($nombre_producto1);

 
$rspta = $reportes->reportes_salida($num_inventario);

//Implementamos las celdas de la tabla con los registros a mostrar

$pdf->SetWidths(array(26,26,25,70));

//57,46,45
while($reg= $rspta->fetch_object())
{  
    
    // $reportes_inv = $reg->numero_inventario;
    $reportes_nombre = $reg->producto;
    $reportes_inventario = $reg->inventario;
    $reportes_descripcion = $reg->descripcion;
    $reportes_fecha = $reg->fecha;
    $reportes_caracteristicas = $reg->caracteristicas;
    
    $pdf->SetFont('Arial','',10);

    $pdf->Cell(45,6,'',0,0,'C');
	$pdf->Cell(30,6,utf8_decode('NOMBRE DEL PRODUCTO: '.utf8_decode($reportes_nombre)),0,0,'L'); 
    $pdf->Ln(7);

    $pdf->Cell(45,6,'',0,0,'C');
    $pdf->Cell(30,6,utf8_decode('NÚMERO DE INVENTARIO: '.utf8_decode($reportes_inventario)),0,0,'L'); 
    $pdf->Ln(7);

    $pdf->Cell(45,6,'',0,0,'C');
    $pdf->Cell(30,6,utf8_decode('MOTIVO SALIDA: '.utf8_decode($reportes_descripcion)),0,0,'L'); 
    $pdf->Ln(7);

    $pdf->Cell(45,6,'',0,0,'C');
    $pdf->Cell(30,6,utf8_decode('FECHA: '.utf8_decode($reportes_fecha)),0,0,'L'); 
    $pdf->Ln(7);

    $pdf->Cell(45,6,'',0,0,'C');
    $pdf->Cell(30,6,utf8_decode('CARACTERÍSTICAS: '.utf8_decode($reportes_caracteristicas)),0,0,'L'); 
    $pdf->Ln(7);


}
ob_start();

session_start();




//Mostramos el documento pdf
$pdf->Output();
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/Conexion.php');
require_once('../clases/funcion_bitacora.php');
// require_once('../clases/funcion_visualizar.php');
// require_once('../clases/funcion_permisos.php');


$Id_objeto = 208;
bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'Reporte', 'Genero un reporte de salida con no. inventario '.$reportes_inventario);

?>