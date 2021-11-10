<?php

$servidor= "51.222.86.251";
$usuario= "informat_desarrollo";
$password = "^Kwd{PE^(L&#";
$base= "informat_desarrollo_automatizacion";

	$mysqli = new mysqli($servidor, $usuario,$password,$base);
	$connection = mysqli_connect($servidor, $usuario,$password,$base) or die("Error " . mysqli_error($connection));
	
	if($mysqli->connect_error){
		echo "Nuestro sitio presenta fallas....";
		die('Error en la conexion' . $mysqli->connect_error);
		exit();	
	}
$connect = new PDO("mysql:host=51.222.86.251;dbname=informat_desarrollo_automatizacion", "informat_desarrollo", "^Kwd{PE^(L&#");

if (!mysqli_set_charset($mysqli, "utf8")) {
        printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($mysqli));
        exit();
    } else {
        printf("");
    }

    
	

?>