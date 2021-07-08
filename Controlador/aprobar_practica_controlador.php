
<?php
session_start();
require_once ("../Modelos/calculo_fecha_pps_modelos.php");

$db = new pruebas();

$cuenta_estud=$_POST['cuenta_estud'];
$obs_prac = $_POST['obs_prac'];
$empresa_prac = $_POST['empresa_prac'];
$hrs_pps = $_POST['hrs_pps'];
$fecha_inicio_prac = $_POST['fecha_inicio_prac'];
$fecha_final_prac = $_POST['fecha_final_prac'];



$consulta = $db->update_pps($cuenta_estud, $obs_prac, $empresa_prac, $hrs_pps, $fecha_inicio_prac, $fecha_final_prac);
echo $consulta;

// if ($consulta === 1) {
//     bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'INGRESÓ', 'UNA NUEVA CARGA ACADÉMICA');

// } else {

// }



?>
