<?php
require_once('../clases/Conexion.php');


    $estado = 'Activo';
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha_recurso'];
    $nombre_recurso = $_POST['nombre_recurso'];
    
    $respuesta = $mysqli->query("INSERT INTO tbl_recursos_tipo (descripcion,fecha, nombre_recurso,estado) VALUES ('$descripcion', '$fecha', '$nombre_recurso', '$estado')");
    var_dump($respuesta);
    if ($respuesta == true) {
        echo json_encode('exito');
    } else {
        echo json_encode('error');
    }



