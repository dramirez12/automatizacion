<?php

include_once '../clases/Conexion.php';
require '../plugins/phpmailer/Exception.php';
require '../plugins/phpmailer/PHPMailer.php';
require '../plugins/phpmailer/SMTP.php';
$enlace = $_POST['enlace'];
if ($_POST['enlace'] == '') {
    $enlace = $_POST['NULL'];
}else{
    $enlace = $_POST['enlace'];
}
$enlace = $_POST['NULL'];
$agenda = $_POST['agenda'];
$asunto = $_POST['asunto'];
$enlace = $_POST['enlace'];
$estado = $_POST['estado'];
$fecha = $_POST['fecha'];
$fecha_formateada = date('Y-m-d', strtotime($fecha));
$horafinal = $_POST['horafinal'];
$horainicio = $_POST['horainicio'];
$horainiciof = date('H:i;s', strtotime($horainicio));
$lugar = $_POST['lugar'];
$nombre = $_POST['nombre'];
$tipo = $_POST['tipo'];
$participante = $_POST['chk'];
$invitados = $_POST['invitados'];
$id_registro = $_POST['id_registro'];
$anio_formateada = date('Y', strtotime($fecha));
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;





if ($_POST['reunion'] == 'nuevo') {
    $mail = new PHPMailer(true);
    try {
        $stmt = $mysqli->prepare("INSERT INTO tbl_reunion (id_tipo, id_estado, fecha, nombre_reunion, lugar, enlace, hora_inicio, hora_final, asunto, agenda_propuesta) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("iissssssss", $tipo, $estado, $fecha_formateada, $nombre, $lugar, $enlace, $horainicio, $horafinal, $asunto, $agenda);
        $stmt->execute();
        $id_registro = $stmt->insert_id;
        $id_reunion = $id_registro;
        foreach ($participante as $par) {
            $stmt = $mysqli->prepare("INSERT INTO tbl_participantes (id_reunion, id_persona) VALUES (?,?)");
            $stmt->bind_param("ii", $id_reunion, $par);
            $stmt->execute();
        }
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
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'informaticaunah21@gmail.com';                     //SMTP username
        $mail->Password   = 'informaticaunah2021';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;
        //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        //Recipients

        $stmt->close();
        $mail->setFrom('informaticaunah21@gmail.com', 'Jefatura Depto. Informatica Administrativa');
        $sql = "SELECT t1.valor AS participantes FROM tbl_contactos t1 INNER JOIN tbl_personas t2 ON t2.id_persona = t1.id_persona INNER JOIN tbl_participantes t3 ON t3.id_persona = t2.id_persona WHERE t1.id_tipo_contacto = 4 and t3.id_reunion = $id_reunion";
        $res = $mysqli->query($sql);
        while ($destino = $res->fetch_assoc()) {
            $email = $destino['participantes'];
            $mail->addAddress($email);
        }
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "$asunto";
        $body  = "<h1><b>MEMORÁNDUM IA-$id_registro/$anio_formateada</b></h1><br>";
        $body .= "Nombre Reunión: <strong>$nombre</strong><br>";
        $body .= "Lugar: <strong>$lugar</strong><br>";
        $body .= "Fecha: <strong>$fecha</strong><br>";
        $body .= "Hora de Inicio: <strong>$horainicio</strong><br>";
        $body .= "Hora Final: <strong>$horafinal</strong><br>";
        $body .= "Asunto: <strong>$asunto</strong><br>";
        $body .= "Enlace: <strong>$enlace</strong><br>";
        $body .= "<br>";
        $body .= "Por medio de la presente se notifica que el <strong>$fecha</strong>";
        $body .= " se realizará la reunión con asunto <strong>$asunto</strong>,";
        $body .= " lugar: <strong>$lugar</strong><br>";
        $body .= " en el horario de <strong>$horainicio</strong>";
        $body .= " a <strong>$horafinal</strong> con los siguientes puntos a tratar: <br><br>";
        $body .= "<strong>$agenda</strong><br>";
        $body .= "<br>";
        $body .= "<br>";
        $body .= "<h3>Este es un correo automático favor no responder a esta dirección, si quiere contactarse con nosotros por algún motivo escribanos a:</h3>";
        $body .= "iaunah@unah.edu.hn";
        $body .= "<br>";
        $body .= "<br>";
        $body .= "<h3>Saludos Cordiales, <strong>Depto. IA</strong></h3><br>";
        $mail->Body = $body;
        $mail->CharSet = 'UTF-8';
        $mail->send();
        $mysqli->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    die(json_encode($respuesta));
}

if ($_POST['reunion'] == 'actualizar') {
    $mail = new PHPMailer(true);

    try {
        $stmt = $mysqli->prepare('UPDATE tbl_reunion SET nombre_reunion=?,lugar=?,hora_inicio=?,hora_final=?,fecha=?,asunto=?,agenda_propuesta=?,enlace=?,id_tipo =? WHERE id_reunion=?');
        $stmt->bind_param("ssssssssii", $nombre, $lugar, $horainicio, $horafinal, $fecha_formateada, $asunto, $agenda, $enlace, $tipo, $id_registro);
        $stmt->execute();
        $id_reunion = $id_registro;
        foreach ($participante as $par) {
            $stmt = $mysqli->prepare("INSERT INTO tbl_participantes (id_reunion, id_persona) VALUES (?,?)");
            $stmt->bind_param("ii", $id_reunion, $par);
            $stmt->execute();
        }
        foreach ($invitados as $inv) {
            $stmt = $mysqli->prepare("DELETE FROM tbl_participantes WHERE id_reunion=? and id_persona=?");
            $stmt->bind_param("ii", $id_reunion, $inv);
            $stmt->execute();
        }
        if ($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_actualizado' => $id_registro
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'informaticaunah21@gmail.com';                     //SMTP username
        $mail->Password   = 'informaticaunah2021';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;
        //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        //Recipients

        $stmt->close();
        $mail->setFrom('informaticaunah21@gmail.com', 'Jefatura Depto. Informatica Administrativa');
        $sql = "SELECT t1.valor AS participantes FROM tbl_contactos t1 INNER JOIN tbl_personas t2 ON t2.id_persona = t1.id_persona INNER JOIN tbl_participantes t3 ON t3.id_persona = t2.id_persona WHERE t1.id_tipo_contacto = 4 and t3.id_reunion = $id_reunion";
        $res = $mysqli->query($sql);
        while ($destino = $res->fetch_assoc()) {
            $email = $destino['participantes'];
            $mail->addAddress($email);
        }
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Modificación de la reunión';
        $body  = "<h3>Por medio de la presente se le notifica que la reunión $nombre";
        $body .= " ha recibido cambios por favor verificar las nuevas modificaciones.</h3><br>";
        $body .= "<h2><b>MEMORÁNDUM IA-$id_registro/$anio_formateada</b></h2><br>";
        $body .= "Nombre Reunión: <strong>$nombre</strong><br>";
        $body .= "Lugar: <strong>$lugar</strong><br>";
        $body .= "Fecha: <strong>$fecha</strong><br>";
        $body .= "Hora de Inicio: <strong>$horainicio</strong><br>";
        $body .= "Hora Final: <strong>$horafinal</strong><br>";
        $body .= "Asunto: <strong>$asunto</strong><br>";
        $body .= "Enlace: <strong>$enlace</strong><br>";
        $body .= "<br>";
        $body .= "Por medio de la presente se notifica que el <strong>$fecha</strong>";
        $body .= " se realizará la reunión con asunto <strong>$asunto</strong>,";
        $body .= " lugar: <strong>$lugar</strong><br>";
        $body .= " en el horario de <strong>$horainicio</strong>";
        $body .= " a <strong>$horafinal</strong> con los siguientes puntos a tratar: <br><br>";
        $body .= "<strong>$agenda</strong><br>";
        $body .= "<br>";
        $body .= "<h3>Este es un correo automático favor no responder a esta dirección, si quiere contactarse con nosotros por algún motivo escribanos a:</h3>";
        $body .= "iaunah@unah.edu.hn";
        $body .= "<br>";
        $body .= "<br>";
        $body .= "<h3>Saludos Cordiales, <strong>Depto. IA</strong></h3><br>";
        $mail->Body = $body;
        $mail->CharSet = 'UTF-8';
        $mail->send();
        $mysqli->close();
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => 'error'
        );
    }
    die(json_encode($respuesta));
}

/* ----------------------------------------------- */
if ($_POST['invitados']) {
    $mail = new PHPMailer(true);
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'informaticaunah21@gmail.com';                     //SMTP username
    $mail->Password   = 'informaticaunah2021';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;
    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    //Recipients
    $mail->setFrom('informaticaunah21@gmail.com', 'Jefatura Depto. Informatica Administrativa');
    foreach($_POST['invitados'] as $inv) {
        $sql = "SELECT t1.valor FROM tbl_contactos t1 WHERE t1.id_tipo_contacto = 4 AND t1.id_persona = $inv";
        $res = $mysqli->query($sql);
        while ($destino = $res->fetch_assoc()) {
            $email = $destino['valor'];
            $mail->addAddress($email);
        }
    }
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Modificacion de la reunión';
    $body  = "Por medio de la presente se le notifica que la reunion $nombre";
    $body .= "<strong> ha recibido cambios por favor verificar las nuevas modificaciones.</strong><br>";
    $body .= "<br>";
    $body .= "Nombre de la Reunión: <strong>$nombre</strong><br>";
    $body .= "Lugar: <strong>$lugar</strong><br>";
    $body .= "Fecha: <strong>$fecha</strong><br>";
    $body .= "Hora de Inicio: <strong>$horainicio</strong><br>";
    $body .= "Hora Final: <strong>$horafinal</strong><br>";
    $body .= "Enlace: <strong>$enlace</strong><br>";
    $body .= "<br>";
    $body .= "Por medio de la presente se notifica que el <strong>$fecha</strong>";
    $body .= " se realizará la reunión con asunto <strong>$asunto</strong>,";
    $body .= " lugar: <strong>$lugar</strong><br>";
    $body .= " en el horario de <strong>$horainicio</strong>";
    $body .= " a <strong>$horafinal</strong> con los siguientes puntos a tratar: <br><br>";
    $body .= "<strong>$agenda</strong><br>";
    $body .= "<br>";
    $body .= "Este es un correo automático favor no responder a esta dirección<br> si quiere contactarse con nosotros por algún motivo escribanos a:<br>";
    $body .= "iaunah@unah.edu.hn";
    $body .= "<br>";
    $body .= "<br>";
    $body .= "Saludos, <strong>Depto. IA</strong><br>";
    $mail->Body = $body;
    $mail->CharSet = 'UTF-8';
    $mail->send();
}
/* ----------------------------------------------- */

if ($_POST['reunion'] == 'cancelar') {
    $estadocancelar = 2;
    $id_cancelar = $_POST['id'];
    $mensaje = $_POST['mensaje'];
    $motivo = ' -- motivo: '.$_POST['mensaje'];
    $mail = new PHPMailer(true);
    try {
        $stmt = $mysqli->prepare('UPDATE tbl_reunion SET id_estado = ?, mensaje =? WHERE id_reunion = ?');
        $stmt->bind_param('isi', $estadocancelar,$motivo, $id_cancelar);
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
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'informaticaunah21@gmail.com';                     //SMTP username
        $mail->Password   = 'informaticaunah2021';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;
        //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        //Recipients
        $mail->setFrom('informaticaunah21@gmail.com', 'Jefatura Depto. Informática Administrativa');
        $sql = "SELECT t1.valor AS participantes FROM tbl_contactos t1 INNER JOIN tbl_personas t2 ON t2.id_persona = t1.id_persona INNER JOIN tbl_participantes t3 ON t3.id_persona = t2.id_persona WHERE t1.id_tipo_contacto = 4 and t3.id_reunion = $id_cancelar";
        $res = $mysqli->query($sql);
        while ($destino = $res->fetch_assoc()) {
            $email = $destino['participantes'];
            $mail->addAddress($email);
        }
        $sql = "SELECT nombre_reunion,lugar,hora_inicio,hora_final FROM tbl_reunion where id_reunion = $id_cancelar";
        $datosreunion = $mysqli->query($sql);
        while ($datos = $datosreunion->fetch_assoc()) {
            $nom = $datos['nombre_reunion'];
            $lugar = $datos['lugar'];
            $inicio = $datos['hora_inicio'];
            $final = $datos['hora_final'];
        }
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'CANCELACIÓN reunión';
        $body .= "<br>";
        $body .= "Por medio de la presente se notifica que la Reunión: <strong>$nom</strong>";
        $body .= " lugar en que se iba a realizar: <strong>$lugar</strong><br>";
        $body .= " en el horario de <strong>$inicio</strong>";
        $body .= " a <strong>$final</strong>";
        $body .= " HA SIDO <strong>CANCELADA</strong> por el siguiente motivo: <strong>$mensaje</strong>.<br><br>";
        $body .= "<b>Este es un correo automático favor no responder a esta dirección, si quiere contactarse con nosotros por algún motivo escribanos a:</b><br>";
        $body .= "<b>iaunah@unah.edu.hn</b>";
        $body .= "<br>";
        $body .= "<br>";
        $body .= "Saludos, <strong>Jefatura Depto. IA</strong><br>";
        $mail->Body = $body;
        $mail->CharSet = 'UTF-8';
        $mail->send();
        $stmt->close();
        $mysqli->close();
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
}
