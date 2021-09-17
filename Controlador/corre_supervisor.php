<?php
require_once('../PHPMAILER/PHPMailer.php');
require_once('../PHPMAILER/SMTP.php');
require_once('../PHPMAILER/Exception.php');
require_once('../clases/Conexion.php');
class correo
{


	function enviarEmailPracticante($cuerpo_estudiante, $asunto_estudiante, $ecorreo, $estudiante)
	{

		$mail = new PHPMailer\PHPMailer\PHPMailer();
		$mail->isSMTP();

		$correo = "secreto-secreto02@hotmail.com";
		$Password = "pokemon123";
		$mail->SMTPDebug = 0;
		$mail->Host = "smtp.live.com";
		$mail->Port = 465;
		$mail->SMTPSecure = 'ssl';
		$mail->SMTPAuth = true;
		$mail->Username = $correo;
		$mail->Password = $Password;
		$mail->setFrom($correo, 'Unidad de Vinculación Departamento de Informática');
		$mail->addAddress($ecorreo, $estudiante);
		$mail->Subject = $asunto_estudiante;
		$mail->Body = $cuerpo_estudiante;
		$mail->CharSet = 'UTF-8';
		$mail->IsHTML(true);

		if (!$mail->send()) {
			echo "Error al enviar el E-Mail: " . $mail->ErrorInfo;
		} else {
			echo "Correos enviados correctamente";
			
		}

		
	}

	function enviarEmailDocente($cuerpo, $asunto_docente, $destino, $nombre_destino)
	{
		
		$mail =new PHPMailer\PHPMailer\PHPMailer();
		$mail->issMTP();

		$correo_doc = "secreto-secreto02@hotmail.com";
		$Password_doc = "pokemon123";
		$mail->SMTPDebug = 0;
		$mail->Host = "smtp.live.com";
		$mail->Port = 465;
		$mail->SMTPSecure = 'ssl';
		$mail->SMTPAuth = true;
		$mail->Username = $correo_doc;
		$mail->Password = $Password_doc;
		$mail->setFrom($correo_doc, 'Unidad de Vinculación Departamento de Informática');
		$mail->addAddress($destino, $nombre_destino);
		$mail->Subject = $asunto_docente;
		$mail->Body = $cuerpo;
		$mail->CharSet = 'UTF-8';
		$mail->IsHTML(true);

		if (!$mail->send()) {
			echo "Error al enviar el E-Mail: " . $mail->ErrorInfo;
		} else {
			// echo "muy bien docente";
			
		}
	}

	function correo_aprobacion_prac($cuerpo_aprobacion, $asunto_aprobacion, $correo_aprobacion, $estudiante_aprobacion)
	{

		$mail = new PHPMailer\PHPMailer\PHPMailer();
		$mail->isSMTP();

		$correo_aproba = "luisdavidpacheco123@gmail.com";
		$password_aproba = "osopolar123";
		$mail->SMTPDebug = 0;
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
		$mail->SMTPSecure = 'tls';
		$mail->SMTPAuth = true;
		$mail->Username = $correo_aproba;
		$mail->Password = $password_aproba;
		$mail->setFrom($correo_aproba, 'Unidad de Vinculación Departamento de Informática');
		$mail->addAddress($correo_aprobacion, $estudiante_aprobacion);
		$mail->Subject = $asunto_aprobacion;
		$mail->Body = $cuerpo_aprobacion;
		$mail->CharSet = 'UTF-8';
		$mail->IsHTML(true);

		if (!$mail->send()) {
			echo "Error al enviar el E-Mail: " . $mail->ErrorInfo;
		} else {
			// echo "correo enviado correctamente";
		}

		
	}

}//cierre class