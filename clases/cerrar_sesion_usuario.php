<?php
    session_start(); 
	$_SESSION = array();
	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(
			session_name(),
			'',
			time() - 42000,
			$params["path"],
			$params["domain"],
			$params["secure"],
			$params["httponly"]
		);
		
		session_unset(); /*Elimina los valores de la sesion*/
		session_destroy();/*Elimina la ssesion*/
   	  	header('location: ../index.php');
	}
?>