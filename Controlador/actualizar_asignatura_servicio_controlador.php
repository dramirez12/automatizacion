<?php
ob_start();
session_start();
require '../Modelos/plan_estudio_modelo.php';
require_once('../clases/funcion_bitacora.php');
$Id_objeto = 110;
$MU = new modelo_plan();


$id_area = $_POST["id_area"];
$uv = $_POST["uv"];
$codigo = strtoupper($_POST["codigo"]);
$asignatura = $_POST["asignatura"];
$reposicion = $_POST["reposicion"];
$suficiencia = $_POST["suficiencia"];
$id_asignatura = $_POST["Id_asignatura"];

$consulta = $MU->ActualizarAsignaturaServicio($id_area, $uv, $codigo, $asignatura, $reposicion, $suficiencia, $id_asignatura);
echo $consulta;

if ($consulta == 1) {
    # code...
    bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'INSERTO', 'UNA NUEVA ASIGNATURA DE SERVICIO: ' . $asignatura . '');
}
