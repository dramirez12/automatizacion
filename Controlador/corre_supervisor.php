<?php
ob_start();
require('../PHPMAILER/PHPMailer.php');
require('../PHPMAILER/SMTP.php');
require('../PHPMAILER/Exception.php');
// require ('OAuth.php');
require_once('../clases/Conexion.php');
class correo
{

	function enviarEmailDocente($cuerpo, $asunto_docente, $destino, $nombre_destino)
	{



		$mail = new PHPMailer\PHPMailer\PHPMailer();


		$mail->isSMTP();

		$correo = "luisdavidpacheco123@gmail.com";
		$Password = "osopolar123";
		$mail->SMTPDebug = 0;
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 465;
		$mail->SMTPSecure = 'ssl';
		$mail->SMTPAuth = true;
		$mail->Username = $correo;
		$mail->Password = $Password;
		$mail->setFrom($correo, 'Unidad de Vinculación depto Informática');
		$mail->addAddress($destino, $nombre_destino);
		$mail->Subject = $asunto_docente;
		$mail->Body = $cuerpo;
		$mail->CharSet = 'UTF-8'; // Con esto ya funcionan los acentos
		$mail->IsHTML(true);

		if (!$mail->send()) {
			echo "Error al enviar el E-Mail: " . $mail->ErrorInfo;
		} else {
			echo "muy bien docente";
		}
	} //cierre de la funcion


	function enviarEmailPracticante($cuerpo_estudiante, $asunto_estudiante, $ecorreo, $estudiante)
	{



		$mail = new PHPMailer\PHPMailer\PHPMailer();


		$mail->isSMTP();


		$correo = "luisdavidpacheco123@gmail.com";
		$Password = "osopolar123";
		$mail->SMTPDebug = 0;
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 465;
		$mail->SMTPSecure = "ssl";
		$mail->SMTPAuth = true;
		$mail->Username = $correo;
		$mail->Password = $Password;
		$mail->setFrom($correo, 'Unidad de Vinculación Departamento de Informática');
		$mail->addAddress($ecorreo, $estudiante);
		$mail->Subject = $asunto_estudiante;
		$mail->Body = $cuerpo_estudiante;
		$mail->CharSet = 'UTF-8'; // Con esto ya funcionan los acentos
		$mail->IsHTML(true);

		if (!$mail->send()) {
			echo "Error al enviar el E-Mail: " . $mail->ErrorInfo;
		} else {
			echo "muy bien estudiante";
		}
	} //cierre de la funcion

}//cierre class


ob_end_flush();