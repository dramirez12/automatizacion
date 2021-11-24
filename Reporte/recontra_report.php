<?php
require '../vendor/autoload.php';


$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'informat_desarrollo_automatizacion';

$db = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($db->connect_error) {
    die("Unable to connect database: " . $db->connect_error);
}

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


if (isset($_GET['enviar'])) {
    // window.location.href = "../Reporte/report_poa.php?enviar=enviar&id_planificacion=" + id_planificacion + "";
    $nombre_docente = $_GET['nombre_docente_send'];
    $id_craed = $_GET['id_craed'];

    $spreadsheet = new Spreadsheet();
    $Excel_writer = new Xlsx($spreadsheet);

    $fecha = date('d-m-Y');
    $spreadsheet->setActiveSheetIndex(0);

    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    // $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    // $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    // $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
    // $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
    // $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);

    $activeSheet = $spreadsheet->getActiveSheet();

    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);

    $spreadsheet->getActiveSheet()->getCell('B10')->setValue($nombre_docente); //!setea el nombre del docente obtenido del modal y el boton generar informe
    $spreadsheet->getActiveSheet()->getStyle('B10')->getAlignment()->setHorizontal('center');

    $spreadsheet->getActiveSheet()->getCell('A7')->setValue('I.-');
    $spreadsheet->getActiveSheet()->getCell('B7')->setValue('DATOS GENERALES');
    $spreadsheet->getActiveSheet()->getCell('A8')->setValue('NO. DE EMPLEADO');

    $spreadsheet->getActiveSheet(1)->mergeCells('B9:F9');
    $spreadsheet->getActiveSheet()->getStyle('B9')->getAlignment()->setHorizontal('center');
    $spreadsheet->getActiveSheet()->getCell('A9')->setValue('SOLICITUD DE:');
    $spreadsheet->getActiveSheet()->getCell('B9')->setValue('RECONTRATACIÓN');

    $spreadsheet->getActiveSheet()->getCell('A10')->setValue('NOMBRE COMPLETO:');
    $spreadsheet->getActiveSheet(1)->mergeCells('B10:F10');

    $spreadsheet->getActiveSheet()->getCell('A11')->setValue('NOMBRE DEL PUESTO Y UNIDAD EJECUTORA:');
    $spreadsheet->getActiveSheet()->getCell('B11')->setValue('Profesor por Hora/Departamento de Informàtica /Facultad de Ciencias Economicas');
    $spreadsheet->getActiveSheet(1)->mergeCells('B11:F11');

    $spreadsheet->getActiveSheet()->getCell('A12')->setValue('DURACIÓN DE LA ACCIÓN PERSONAL:');
    $spreadsheet->getActiveSheet()->getCell('A13')->setValue('II.-');
    $spreadsheet->getActiveSheet()->getCell('B13')->setValue('JUSTIFICACIÓN:');
    $spreadsheet->getActiveSheet()->getCell('A14')->setValue('DESCRIPCIÓN DE LABORATORIOS Y ACTIVIDADES ACADEMICAS');

    $spreadsheet->getActiveSheet()->getCell('B14')->setValue('DÍAS QUE SE IMPARTE');


    $spreadsheet->getActiveSheet()->getCell('C14')->setValue('SECCIÓN');
    $spreadsheet->getActiveSheet()->getCell('D14')->setValue('UV');
    $spreadsheet->getActiveSheet()->getCell('E14')->setValue('OBSERVACIONES');

    $query_planificacion = $db->query("SELECT * FROM tbl_carga_craed WHERE Profesor  = '" . $nombre_docente . "' and id_craed_jefa = '" . $id_craed . "'");
    $i = 15; //? numero de la celda donde queremos que el while empieze a escribir
    //$activeSheet->setCellValue('B1', 'Nombre POA: ' . $fila_plan['Asignatura_cr'] . $fecha);
    while ($fila_plan = $query_planificacion->fetch_assoc()) {
        $spreadsheet->getActiveSheet()->getCell('A' . $i)->setValue($fila_plan['Asignatura_cr']);
        $spreadsheet->getActiveSheet()->getCell('B' . $i)->setValue($fila_plan['Dias_cr']);
        $spreadsheet->getActiveSheet()->getCell('C' . $i)->setValue($fila_plan['Seccion_cr']);
        $i++;
    }

    $spreadsheet->getActiveSheet(1)->mergeCells('E14:F14');
    $spreadsheet->getActiveSheet()->getStyle('E14')->getAlignment()->setHorizontal('center');

    ///!creacion de insercion de la imagen
    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
    $drawing->setName('blue_unah');
    $drawing->setDescription('blue_unah');
    $drawing->setPath('image.png');
    $drawing->setCoordinates('A1');
    //$drawing->setOffsetX(10);
    $drawing->setHeight(200);
    $drawing->setWidth(200);
    $drawing->setRotation(0);
    $drawing->getShadow()->setVisible(true);
    $drawing->getShadow()->setDirection(0);
    $drawing->setWorksheet($spreadsheet->getActiveSheet());


    $dibujo = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
    $dibujo->setName('blue_unah');
    $dibujo->setDescription('blue_unah');
    $dibujo->setPath('sedp2.png');
    $dibujo->setCoordinates('B2');
    $dibujo->setHeight(200);
    $dibujo->setWidth(200);
    $dibujo->setRotation(0);
    $dibujo->getShadow()->setVisible(true);
    $dibujo->getShadow()->setDirection(0);
    $dibujo->setWorksheet($spreadsheet->getActiveSheet());

    $filename = 'recontratacion.xlsx';

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename=' . $filename);
    header('Cache-Control: max-age=0');
    $Excel_writer->save('php://output');
}
