<?php

include_once '../clases/Conexion.php';
require '../plugins/phpmailer/Exception.php';
require '../plugins/phpmailer/PHPMailer.php';
require '../plugins/phpmailer/SMTP.php';
$acta = $_POST['acta'];
$responsable = $_POST['responsable'];
$estado = $_POST['estado'];
$nombre_acuerdo = $_POST['nombre_acuerdo'];
$descripcion = $_POST['descripcion'];
$fecha_res = 'PENDIENTE';
$fecha_exp = $_POST['fecha_exp'];
$fecha_formato = date('Y-m-d', strtotime($fecha_exp));
$id_registro = $_POST['id_registro'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_POST['acuerdo'] == 'nuevo') {
    $mail = new PHPMailer(true);
    $estado = 1;
    try {
        $stmt = $mysqli->prepare("INSERT INTO tbl_acuerdos (id_acta, id_participante, id_estado, nombre_acuerdo, descripcion, resolucion, fecha_expiracion) VALUES (?,?,?,?,?,?,?)");
        $stmt->bind_param("iiissss", $acta, $responsable, $estado, $nombre_acuerdo, $descripcion, $fecha_res, $fecha_exp);
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
        $sql = "SELECT
                t5.num_acta,
                t4.nombre_reunion,
                CONCAT_WS(' ', t2.nombres, t2.apellidos) AS nombre,
                t1.valor AS correo
                FROM
                    tbl_contactos t1
                INNER JOIN tbl_personas t2 ON
                    t2.id_persona = t1.id_persona
                INNER JOIN tbl_participantes t3 ON
                    t3.id_persona = t1.id_persona
                INNER JOIN tbl_reunion t4 ON
                    t4.id_reunion = t3.id_reunion
                INNER JOIN tbl_acta t5 ON t5.id_reunion = t4.id_reunion
                WHERE
                    t1.id_tipo_contacto = 4 AND t2.id_persona = $responsable AND t5.id_acta = $acta";
        $res = $mysqli->query($sql);
        while ($destino = $res->fetch_assoc()) {
            $nombrepersona = $destino['nombre'];
            $email = $destino['correo'];
            $nombreacta = $destino['num_acta'];
            $nombrereu = $destino['nombre_reunion'];
            $mail->addAddress($email, $nombrepersona);
        }
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "Responsable de un nuevo acuerdo";
        $body .= "Buenas estimado: <strong>$nombrepersona</strong> por medio de la presente se le comunica ";
        $body .= "que a la reunion <b>$nombrereu</b> a la que asistio se le asigno un acuerdo ";
        $body .= "con nombre <strong>$nombre_acuerdo</strong> ";
        $body .= " la cual tiene fecha de vencimiento para el: <strong>$fecha_exp</strong>, con la siguiente descripcion: <br><br>";
        $body .= "<strong>$descripcion</strong>";
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

if ($_POST['acuerdo'] == 'actualizar') {
    $mail = new PHPMailer(true);
    $estado = 1;
    try {
        $stmt = $mysqli->prepare('UPDATE tbl_acuerdos SET id_acta=?,id_participante=?,id_estado=?,nombre_acuerdo=?,descripcion=?,resolucion=?,fecha_expiracion=? WHERE id_acuerdo=?');
        $stmt->bind_param("iiissssi", $acta, $responsable, $estado, $nombre_acuerdo, $descripcion, $fecha_res, $fecha_exp, $id_registro);
        $stmt->execute();
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
        $sql = "SELECT
                 t5.num_acta,
                 t4.nombre_reunion,
                 CONCAT_WS(' ', t2.nombres, t2.apellidos) AS nombre,
                 t1.valor AS correo
                 FROM
                     tbl_contactos t1
                 INNER JOIN tbl_personas t2 ON
                     t2.id_persona = t1.id_persona
                 INNER JOIN tbl_participantes t3 ON
                     t3.id_persona = t1.id_persona
                 INNER JOIN tbl_reunion t4 ON
                     t4.id_reunion = t3.id_reunion
                 INNER JOIN tbl_acta t5 ON t5.id_reunion = t4.id_reunion
                 WHERE
                     t1.id_tipo_contacto = 4 AND t2.id_persona = $responsable AND t5.id_acta = $acta";
        $res = $mysqli->query($sql);
        while ($destino = $res->fetch_assoc()) {
            $nombrepersona = $destino['nombre'];
            $email = $destino['correo'];
            $nombreacta = $destino['num_acta'];
            $nombrereu = $destino['nombre_reunion'];
            $mail->addAddress($email, $nombrepersona);
        }
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "Modificación de un acuerdo";
        $body .= "Buenas estimado: <strong>$nombrepersona</strong> por medio de la presente se le comunica ";
        $body .= "que el acuerdo de la reunión <b>$nombrereu</b> a la que asistió tuvo una modificación";
        $body .= "<b> Por favor tomar nota de las nuevas modificaciones</b>";
        $body .= " con nombre <strong>$nombre_acuerdo</strong> ";
        $body .= " la cual tiene fecha de vencimiento para el: <strong>$fecha_exp</strong>, con la siguiente descripción: <br><br>";
        $body .= "<strong>$descripcion</strong>";
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
        $respuesta = array(
            'respuesta' => 'error'
        );
    }
    die(json_encode($respuesta));
}

if ($_POST['acuerdos'] == 'finalizar') {
    $mail = new PHPMailer(true);
    $estadofinalizar = 2;
    $fecha_res = 'FINALIZADO';
    $id_registrof = $_POST['id'];
    try {
        $stmt = $mysqli->prepare('UPDATE tbl_acuerdos SET id_estado = ?, resolucion = ? WHERE id_acuerdo = ?');
        $stmt->bind_param("isi", $estadofinalizar, $fecha_res, $id_registrof);
        $stmt->execute();
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
        $sql = "SELECT
        t6.num_acta,
        t5.nombre_reunion,
        CONCAT_WS(' ', t2.nombres, t2.apellidos) AS nombre,
        t3.valor as correo,
        t1.nombre_acuerdo,
        t1.descripcion,
        t1.fecha_expiracion
    FROM
        tbl_acuerdos t1
    INNER JOIN tbl_personas t2 ON
        t2.id_persona = t1.id_participante
    INNER JOIN tbl_contactos t3 ON
        t3.id_persona = t2.id_persona
    INNER JOIN tbl_participantes t4 ON
        t4.id_persona = t3.id_persona
    INNER JOIN tbl_reunion t5 ON
        t5.id_reunion = t4.id_reunion
    INNER JOIN tbl_acta t6 ON
        t6.id_reunion = t5.id_reunion
    WHERE
        t3.id_tipo_contacto = 4  AND t1.id_acuerdo = $id_registrof
        LIMIT 1";
        $res = $mysqli->query($sql);
        while ($destino = $res->fetch_assoc()) {
            $nombrepersona = $destino['nombre'];
            $email = $destino['correo'];
            $nombreacta = $destino['num_acta'];
            $nombrereu = $destino['nombre_reunion'];
            $mail->addAddress($email, $nombrepersona);
        }
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "Finalización de un acuerdo";
        $body .= "Buenas estimado: <strong>$nombrepersona</strong> por medio de la presente se le comunica ";
        $body .= "que el acuerdo de la reunión <b>$nombrereu</b> a la que asistió se dio por finalizado";
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
        $respuesta = array(
            'respuesta' => 'error'
        );
    }
    die(json_encode($respuesta));
}

if ($_POST['acuerdo'] == 'cancelar') {
    $mail = new PHPMailer(true);
    $id_registroc = $_POST['id'];
    $estadocancelar = 3;
    $fecha_res = 'CANCELADO';
    $mensaje = $_POST['mensaje'];
    $motivo = ' -- motivo: ' . $_POST['mensaje'];
    try {
        $stmt = $mysqli->prepare('UPDATE tbl_acuerdos SET id_estado = ?, resolucion = ?, mensaje =? WHERE id_acuerdo = ?');
        $stmt->bind_param("issi", $estadocancelar, $fecha_res, $motivo, $id_registroc);
        $stmt->execute();
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
        $sql = "SELECT
         t6.num_acta,
         t5.nombre_reunion,
         CONCAT_WS(' ', t2.nombres, t2.apellidos) AS nombre,
         t3.valor as correo,
         t1.nombre_acuerdo,
         t1.descripcion,
         t1.fecha_expiracion
     FROM
         tbl_acuerdos t1
     INNER JOIN tbl_personas t2 ON
         t2.id_persona = t1.id_participante
     INNER JOIN tbl_contactos t3 ON
         t3.id_persona = t2.id_persona
     INNER JOIN tbl_participantes t4 ON
         t4.id_persona = t3.id_persona
     INNER JOIN tbl_reunion t5 ON
         t5.id_reunion = t4.id_reunion
     INNER JOIN tbl_acta t6 ON
         t6.id_reunion = t5.id_reunion
     WHERE
         t3.id_tipo_contacto = 4  AND t1.id_acuerdo = $id_registroc
         LIMIT 1";
        $res = $mysqli->query($sql);
        while ($destino = $res->fetch_assoc()) {
            $nombrepersona = $destino['nombre'];
            $email = $destino['correo'];
            $nombreacta = $destino['num_acta'];
            $nombrereu = $destino['nombre_reunion'];
            $mail->addAddress($email, $nombrepersona);
        }
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "Cancelación de un acuerdo";
        $body .= "Buenas estimado: <strong>$nombrepersona</strong> por medio de la presente se le comunica ";
        $body .= "que el acuerdo de la reunión <b>$nombrereu</b> a la que asistió se dio por Cancelado";
        $body .= " por el siguiente motivo: <b>$mensaje</b>";
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
        $respuesta = array(
            'respuesta' => 'error'
        );
    }
    die(json_encode($respuesta));
}
