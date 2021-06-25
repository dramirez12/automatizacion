<?php
require_once('../PHPMAILER/src/PHPMailer.php');
require_once('../PHPMAILER/src/SMTP.php');
require_once('../PHPMAILER/src/Exception.php');
require_once('../PHPMAILER/src/OAuth.php');
require_once('../clases/Conexion.php');
class correo
{

	function enviarEmailPracticante($cuerpo_estudiante, $asunto_estudiante, $ecorreo, $estudiante, $cuerpo, $asunto_docente, $destino, $nombre_destino)
	{

		$mail = new PHPMailer(true);


		$mail->isSMTP();


		$correo = "vinculacionunah@informaticaunah.com";
		$Password = "N5y*%U(Ofb+T";
		$mail->SMTPDebug = 0;
		$mail->Host = 'informaticaunah.com';
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
		$mail->Send();
		// if (!$mail->send()) {
		// 	echo "Error al enviar el E-Mail: " . $mail->ErrorInfo;
		// } else {
		// 	echo "muy bien estudiante";
		// 	exit();
		// }


		$mail2 = new PHPMailer(true);
		$mail2->isSMTP();

		$correo_doc = "vinculacionunah@informaticaunah.com";
		$Password_doc = "N5y*%U(Ofb+T";
		$mail2->SMTPDebug = 0;
		$mail2->Host = 'informaticaunah.com';
		$mail2->Port = 465;
		$mail2->SMTPSecure = 'ssl';
		$mail2->SMTPAuth = true;
		$mail2->Username = $correo_doc;
		$mail2->Password = $Password_doc;
		$mail2->setFrom($correo_doc, 'Unidad de Vinculación Departamento de Informática');
		$mail2->addAddress($destino, $nombre_destino);
		$mail2->Subject = $asunto_docente;
		$mail2->Body = $cuerpo;
		$mail2->CharSet = 'UTF-8';
		$mail2->IsHTML(true);
		$mail->Send();
		// if (!$mail2->send()) {
		// 	echo "Error al enviar el E-Mail: " . $mail2->ErrorInfo;
		// } else {
		// 	echo "muy bien docente";
		// 	exit();
		// }
	}
} 

	// function enviarEmailDocente($cuerpo, $asunto_docente, $destino, $nombre_destino)
	// {

	// 	$mail = new PHPMailer\PHPMailer\PHPMailer();


	// 	$mail->isSMTP();

	// 	$correo_doc = "vinculacionunah@informaticaunah.com";
	// 	$Password_doc = "N5y*%U(Ofb+T";
	// 	$mail->SMTPDebug = 0;
	// 	$mail->Host = 'informaticaunah.com';
	// 	$mail->Port = 465;
	// 	$mail->SMTPSecure = 'ssl';
	// 	$mail->SMTPAuth = true;
	// 	$mail->Username = $correo_doc;
	// 	$mail->Password = $Password_doc;
	// 	$mail->setFrom($correo_doc, 'Unidad de Vinculación Departamento de Informática');
	// 	$mail->addAddress($destino, $nombre_destino);
	// 	$mail->Subject = $asunto_docente;
	// 	$mail->Body = $cuerpo;
	// 	$mail->CharSet = 'UTF-8';
	// 	$mail->IsHTML(true);

	// 	// if (!$mail->send()) {
	// 	// 	echo "Error al enviar el E-Mail: " . $mail->ErrorInfo;
	// 	// } else {
	// 	// 	echo "muy bien docente";
	// 	// 	exit();
	// 	// }
	// }


	

//cierre class