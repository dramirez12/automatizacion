
<?php
ob_start();
session_start();
require_once("../Modelos/calculo_fecha_pps_modelos.php");
require_once('../clases/funcion_bitacora.php');
require_once('corre_supervisor.php');

$db = new pruebas();
$correo = new correo();

$cuenta_estud = $_POST['cuenta_estud'];
$obs_prac = $_POST['obs_prac'];
$empresa_prac = $_POST['empresa_prac'];
$hrs_pps = $_POST['hrs_pps'];
$fecha_inicio_prac = $_POST['fecha_inicio_prac'];
$fecha_final_prac = $_POST['fecha_final_prac'];
$horario_incio_prac = $_POST['horario_incio_prac'];
$horario_fin_prac = $_POST['horario_fin_prac'];
$dias_prac = $_POST['dias_prac'];
$id_objeto = 21;

$nombre_destino = "Luis Pacheco";

// $sql2 = $mysqli->prepare("SELECT id_persona FROM tbl_personas_extendidas WHERE valor = $cuenta_estud");
//     $sql2->execute();
//     $id_persona_estud = $sql2->get_result();
    
    
//     $rspta1 = $modelo->mostrar_datos_alumno($id_persona_estud)->fetch_all();
//     foreach ($rspta1 as $key => $value) {
    
//         $estudiante = $value[1];
//         $num_cuenta = $value[0];
//         $ecorreo = $value[6];
//         $celular = $value[7];
//         $empresa = $value[2];
//         $direccion = $value[3];
//         $fechai = $value[4];
//         $fechan = $value[5];
//         $jefe = $value[8];
//         $titulo = $value[9];
//     }
    
$consulta = $db->update_pps($cuenta_estud, $obs_prac, $empresa_prac, $hrs_pps, $fecha_inicio_prac, $fecha_final_prac, $horario_incio_prac, $horario_fin_prac, $dias_prac);
echo $consulta;

$cuerpo_aproba = "prueba cuerpo";
    $asunto_estudiante="APROBACIÓN DE PRÁCTICA PROFESIONAL SUPERVISADA";
    
    $correo->correo_aprobacion_prac($cuerpo_aproba, $asunto_estudiante, $ecorreo, $estudiante);

if ($consulta === 1) {
    bitacora::evento_bitacora($id_objeto, $_SESSION['id_usuario'], 'APROBÓ', 'UN NUEVO PRACTICANTE');

    
    
} else {
}


ob_end_flush();
?>
