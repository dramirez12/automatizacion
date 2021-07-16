<?php



$servidor= "167.114.169.207";
$usuario= "informat_desarrollo";
$password = "!fuRCr3XR-tz";
$base= "informat_desarrollo_automatizacion";

	$mysqli = new mysqli($servidor, $usuario,$password,$base);
	$connection = mysqli_connect($servidor, $usuario,$password,$base) or die("Error " . mysqli_error($connection));
	
	if($mysqli->connect_error){
		echo "Nuestro sitio presenta fallas....";
		die('Error en la conexion' . $mysqli->connect_error);
		exit();	
	}
 $connect = new PDO("mysql:host=167.114.169.207;dbname=informat_desarrollo_automatizacion", "informat_desarrollo", "!fuRCr3XR-tz");

if (!mysqli_set_charset($mysqli, "utf8")) {
        printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($mysqli));
        exit();
    } else {
        printf("");
    }

    
	

?>