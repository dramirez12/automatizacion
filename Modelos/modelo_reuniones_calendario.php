<?php

header('Content-type: application/json');

$pdo=new PDO("mysql:dbname=informat_desarrollo_automatizacion;host=167.114.169.207","informat_desarrollo","!fuRCr3XR-tz");
$sentenciaSQL = $conexion->mysqli("SELECT t1.enlace, t1.asunto,t1.agenda_propuesta, t1.id_reunion AS id, t1.fecha, t1.hora_inicio, t1.hora_final, t1.lugar, t1.nombre_reunion AS title, CONCAT(t1.fecha, ' ', t1.hora_inicio) AS start, CONCAT(t1.fecha, ' ' , t1.hora_final) AS end, GROUP_CONCAT('<br>',t3.nombres,' ', t3.apellidos) AS participantes, t4.tipo, t5.estado_reunion FROM tbl_reunion t1 INNER JOIN tbl_participantes t2 on t2.id_reunion = t1.id_reunion INNER JOIN tbl_personas t3 on t3.id_persona = t2.id_persona INNER JOIN tbl_tipo_reunion_acta t4 ON t4.id_tipo = t1.id_tipo INNER JOIN tbl_estado_reunion t5 on t5.id_estado_reunion = t1.id_estado WHERE id_estado = 1 OR id_estado = 3 GROUP BY t1.id_reunion, t1.nombre_reunion");
$sentenciaSQL->execute();

$resul= $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($resul);
?>