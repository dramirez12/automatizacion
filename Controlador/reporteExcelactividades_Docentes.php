<?php
//BA5A41
session_start();
require_once('../clases/conexion_mantenimientos.php');
require_once "../Modelos/reporte_docentes_modelo.php";
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=reporteact-docente.xls");
header("Pragma: no-cache");
header("Expires: 0");
$instancia_conexion = new conexion();
?>

<table>

    <tr>
        <td style="font-weight: bold;text-align: center; background-color:#fff; color:black;" colspan="10"><?php echo utf8_decode("UNIVERSIDAD NACIONAL AUTÓNOMA DE HONDURAS"); ?> </td>
    </tr>
    <tr>
        <td style="font-weight: bold;text-align: center; background-color:#fff; color: black;" colspan="10"><?php echo utf8_decode("FACULTAD DE CIENCIAS ECONÓMICAS, ADMINISTRATIVAS Y CONTABLES"); ?></td>
    </tr>
    <tr>
        <td style="font-weight: bold;text-align: center; background-color:#fff; color: black;" colspan="10"><?php echo utf8_decode("DEPARTAMENTO DE INFORMÁTICA "); ?></td>
    </tr>
    <tr>
        <td style="font-weight: bold;text-align: center; background-color:#fff; color: black;" colspan="10"><?php echo utf8_decode("REPORTE DE CARGA ACADÉMICA DOCENTE"); ?></td>
    </tr>
    <tr>
        <td colspan="5"></td>
    </tr>
     <tr>
        <?php global $mysqli;
        $sql2 = $mysqli->prepare("SELECT tbl_periodo.id_periodo AS id_periodo, tbl_periodo.num_periodo AS num_periodo, tbl_periodo.num_anno AS num_anno, tbl_periodo.fecha_adic_canc AS fecha_adic_canc, tbl_periodo.fecha_desbloqueo AS fecha_desbloqueo,
(SELECT tp.descripcion FROM tbl_tipo_periodo AS tp INNER JOIN tbl_periodo AS pdo ON tp.id_tipo_periodo=pdo.id_tipo_periodo
			WHERE tp.id_tipo_periodo= tbl_periodo.id_tipo_periodo LIMIT 1) AS tipo_periodo,
			(SELECT tp.horas_validas FROM tbl_tipo_periodo AS tp INNER JOIN tbl_periodo AS pdo ON tp.id_tipo_periodo=pdo.id_tipo_periodo
			WHERE tp.id_tipo_periodo= tbl_periodo.id_tipo_periodo LIMIT 1) AS horas_validas
FROM tbl_periodo
ORDER BY id_periodo DESC LIMIT 1;");
        $sql2->execute();
        $resultado2 = $sql2->get_result();
        $row2 = $resultado2->fetch_array(MYSQLI_ASSOC); ?>
        <td style="font-weight: bold; text-align: center; " colspan="10"><?php echo utf8_decode(" PERIODO: "), $row2['num_periodo'], utf8_decode("  AÑO "), $row2['num_anno']; ?></td>




    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>


        <?php
        date_default_timezone_set("America/Tegucigalpa");
        $fecha = date('d-m-Y h:i:s'); ?>
        <td style="font-weight: bold;">FECHA:</td>
        <td><?php echo $fecha ?> </td>
    </tr>
    <tr>
        <td colspan="10"></td>
    </tr>
</table>
<table border="1" >

    <thead>

        <tr>

        </tr>
        <tr>

            <th colspan=" 3" style="text-align: center;"><?php echo utf8_decode("COMISIÓN"); ?></th>
            <th colspan="3" style="text-align: center;">ACTIVIDADES</th>
            <th colspan="3" style="text-align: center;">HORAS SEMANALES</th>

        </tr>
    </thead>
    <tbody>
        <?php global $instancia_conexion;
        $id = $_SESSION['id_usuario'];
        $sql = "call sel_comisiones_reporte($id)";
        $stmt = $instancia_conexion->ejecutarConsulta($sql);
        while ($reg = mysqli_fetch_assoc($stmt)) {
        ?>


            <tr>


                <td colspan="3" style="text-align: center;"><?php echo utf8_decode($reg['comision']); ?></td>
                <td colspan="3" style="text-align: center;"><?php echo utf8_decode($reg['actividad']); ?></td>
                <td colspan="3" style="text-align: center;"><?php echo $reg['horas_semanales']; ?></td>

            </tr>
        <?php }
        mysqli_free_result($stmt); ?>


    </tbody>
</table>