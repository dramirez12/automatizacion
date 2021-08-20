<?php
include_once '../clases/Conexion.php';
$estado = $_POST['estado'];
$id_estado = $_POST['id_estado'];
if ($_POST['estado-acuerdo'] == 'nuevo') {
    try {
        $stmt = $mysqli->prepare("INSERT INTO tbl_estado_acuerdo (estado_acuerdo) VALUES (?)");
        $stmt->bind_param("s", $estado);
        $stmt->execute();
        $id_registro = $stmt->insert_id;
        if ($id_registro > 0) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_registro' => $id_registro
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $mysqli->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    die(json_encode($respuesta));
}

if ($_POST['estado-acuerdo'] == 'actualizar') {
    try {
        $stmt = $mysqli->prepare('UPDATE tbl_estado_acuerdo SET estado_acuerdo = ? WHERE id_estado = ?');
        $stmt->bind_param("si", $estado, $id_estado);
        $stmt->execute();
        if ($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_actualizado' => $stmt->insert_id
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $mysqli->close();
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => 'error'
        );
    }
    die(json_encode($respuesta));
}



if ($_POST['estado-acuerdo'] == 'eliminar') {
    $id_borrar = $_POST['id'];

    try {
        $stmt = $mysqli->prepare('DELETE FROM tbl_estado_acuerdo WHERE id_estado = ? ');
        $stmt->bind_param('i', $id_borrar);
        $stmt->execute();
        if ($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_eliminado' => $id_borrar
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $mysqli->close();
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
}
