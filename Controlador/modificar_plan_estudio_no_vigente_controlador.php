<?php
require '../Modelos/plan_estudio_modelo.php';
// require_once('../clases/funcion_bitacora.php');
// $Id_objeto = 98;
$MU = new modelo_plan();

$vigencia_si = $_POST['vigencia_si'];
$vigencia_no = $_POST['vigencia_no'];
$activo_plan_pasado = $_POST['activo_plan_pasado'];

$estado_inactivo_asig = $_POST['estado_inactivo_asig'];
$estado_activo_asig = $_POST['estado_activo_asig'];
$id_plan = $_POST['id_plan'];
$modificado_por = $_POST['modificado_por'];
$fecha_primer_vigencia= $_POST['fecha_primer_vigencia'];
$fecha_modificacion = $_POST['fecha_modificacion'];
//$usuario = $_POST['usuario'];


$consulta = $MU->modificar_plan_estudio_no($vigencia_si, $id_plan, $vigencia_no, $estado_activo_asig, $estado_inactivo_asig, $activo_plan_pasado, $modificado_por, $fecha_primer_vigencia, $fecha_modificacion);
echo $consulta;

// if ($consulta == 1) {
//     # code...
//     bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'MODIFICO', 'UN PLAN DE ESTUDIO' . $nombre . '');
// }
