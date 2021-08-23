<?PHP



//Inlcuímos a la clase PDF_MC_Table
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
$pdf->Cell(100,8,utf8_decode('REPORTE DE ASIGNACIÓN'),1,0,'C'); 
$pdf->Ln(20);
//$pdf->Cell(40,10,utf8_decode('Fecha de reporte'),1,0,'C'); 

//Creamos las celdas para los títulos de cada columna y le asignamos un fondo gris y el tipo de letra




// $pdf->Cell(40,10,utf8_decode('Fecha de reporte'),1,0,'C'); 

//Creamos las celdas para los títulos de cada columna y le asignamos un fondo gris y el tipo de letra
$pdf->SetFillColor(232,232,232); 
$pdf->SetFont('Arial','B',10);
$pdf->Cell(1,6,'',0,0,'C');//mk
 

$pdf->Ln(7);

// $pdf->Cell(100,8,utf8_decode('FICHA DE ADQUISICION NO. 1'),1,0,'C'); 
// $pdf->Ln(15);
// $pdf->Ln(7);

//Comenzamos a crear las filas de los registros según la consulta mysql
require_once "../Modelos/gestion_lab_modelo.php";
$reportes = new reportes();

$id_asignacion1=$_GET['id_asignacion'];
$id_asignacion=intval($id_asignacion1);
$rspta0 = $reportes->reportes_asignacion($id_asignacion);
$acum=0;
while($reg= $rspta0->fetch_object())
{  
    $pdf->Cell(100,8,utf8_decode('FICHA DE ASIGNACIÓN NO. '.$reg->id),1,0,'C'); 
    $pdf->Ln(15);
    $pdf->Ln(10);
    // $reportes_inv = $reg->numero_inventario;
    $inventario =$reg->inventario;
    $producto = $reg->producto;
    $fecha = $reg->fecha;
    $nombre = $reg->nombre;
    // $reportes_caracteristicas = strtolower($reg->caracteristicas);
    // $caracteristicas = $reg->ubicacion;
    // $ubicacion = $reg->caracteristicas;
    $pdf->SetFont('Arial','',13);
    $pdf->Cell(20,6,'',0,0,'C');
  
   
    // $pdf->Cell(20,6,'',0,0,'C');
    $pdf->Cell(35,8,'',0,0,'C');
	$pdf->Cell(20,7 ,utf8_decode(('Número de inventario: '.$inventario)),0,0,'L'); 
	$pdf->Ln(6);
    $pdf->Cell(55,8,'',0,0,'C');
    $pdf->Cell(20,9,utf8_decode(('Descripción: '.$producto)),0,0,'L'); 
	$pdf->Ln(6);
    $pdf->Cell(55,8,'',0,0,'C');
    $pdf->Cell(20,10,utf8_decode('Persona responsable: '.$nombre),0,0,'L'); 
    $pdf->Ln(7);
    $pdf->Cell(55,8,'',0,0,'C');
    $pdf->Cell(20,10,utf8_decode('Fecha de asignacion: '.$fecha),0,0,'L'); 
    $pdf->Ln(7);
    // $pdf->Cell(20,6,'',0,0,'C');
    $pdf->Ln(15);
    // $pdf->Cell(20,6,'',0,0,'C');
    // $pdf->Cell(30,4,utf8_decode('Caracteristicas: '.utf8_decode($reportes_caracteristicas)),0,0,'L'); 

}
$rspta = $reportes->reportes_adquisicion($id_asignacion);

//Implementamos las celdas de la tabla con los registros a mostrar

$pdf->SetWidths(array(26,26,25,70));

//57,46,45



// $acum=0;
while($reg= $rspta->fetch_object())
{  
  $acum=$acum+1;
    // $reportes_inv = $reg->numero_inventario;
    $reportes_nombre = $reg->nombre_producto;
    $reportes_descripcion = $reg->numero_inventario;
    $id_detalle=$reg->id_detalle;
    // $reportes_caracteristicas = strtolower($reg->caracteristicas);
    // $caracteristicas = $reg->ubicacion;
    // $ubicacion = $reg->caracteristicas;
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(56,6,'',0,0,'C');
  
    $pdf->Cell(30,6,utf8_decode('Detalle No.'.$acum),1,1,'C'); 
    
    // $pdf->Cell(20,6,'',0,0,'C');
    $pdf->Ln(3);
    
    $pdf->Cell(55,6,'',0,0,'C');
    // $pdf->Row(array(utf8_decode($reportes_inv),utf8_decode($reportes_nombre),utf8_decode($caracteristicas),utf8_decode($ubicacion)));
    $pdf->Cell(30,6,utf8_decode('No. Inventario: '.utf8_decode($reportes_descripcion)),0,0,'L'); 
    $pdf->Ln(7);
    $pdf->Cell(55,6,'',0,0,'C');

    $pdf->Cell(30,6,utf8_decode('Nombre del producto: '.utf8_decode($reportes_nombre)),0,0,'L'); 
    $pdf->Ln(7);
    $pdf->Cell(55,6,'',0,0,'C');
   
    // $pdf->Ln(3);
    $rspta1 = $reportes->reportes_adquisicion_caracteristicas($id_detalle);
    $pdf->Cell(7,6,'',0,0,'C');
    $pdf->Cell(19,6,utf8_decode('Características: '),0,0,'C'); 
    $pdf->Ln(7);
    while($reg= $rspta1->fetch_object())
{  
    
    // $reportes_inv = $reg->numero_inventario;
    $reportes_caracteristica = $reg->caracteristica;
    $reportes_valor = $reg->valor;
    // $reportes_caracteristicas = strtolower($reg->caracteristicas);
    // $caracteristicas = $reg->ubicacion;
    // $ubicacion = $reg->caracteristicas;
    $pdf->SetFont('Arial','',13);
    $pdf->Cell(45,6,'',0,0,'C');
  
   
    // $pdf->Cell(20,6,'',0,0,'C');
    $pdf->Cell(10,6,'',0,0,'C');
    // $pdf->Row(array(utf8_decode($reportes_caracteristica),utf8_decode($reportes_valor)));
	$pdf->Cell(30,6,utf8_decode(utf8_decode($reportes_caracteristica.': '.$reportes_valor)),0,0,'L'); 
    // $pdf->Ln(7);
    // $pdf->Cell(30,6,'',0,0,'C');
    // $pdf->Cell(30,6,utf8_decode(utf8_decode($reportes_descripcion)),0,0,'L'); 
    // $pdf->Ln(7);
    $pdf->Cell(20,6,'',0,0,'C');
    $pdf->Ln(7);
    // $pdf->Cell(20,6,'',0,0,'C');
    // $pdf->Cell(30,4,utf8_decode('Caracteristicas: '.utf8_decode($reportes_caracteristicas)),0,0,'L'); 

}
    $pdf->Ln(23);
    // $pdf->Cell(20,6,'',0,0,'C');
    // $pdf->Cell(30,4,utf8_decode('Caracteristicas: '.utf8_decode($reportes_caracteristicas)),0,0,'L'); 

}


//Mostramos el documento pdf
$pdf->Output();
// $nombre_producto='';
require_once('../clases/funcion_bitacora.php');

bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'Reporte', 'Genero un reporte de los datos de asignacion.');

?>