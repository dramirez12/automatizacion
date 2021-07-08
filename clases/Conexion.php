<?php



    $servidor= "167.114.169.207";
    $usuario= "informat_informaticaunah2";
    $password = "dF%&(M6tJL?P";
    $base= "informat_automatizacion";

	$mysqli = new mysqli($servidor, $usuario,$password,$base);
	$connection = mysqli_connect($servidor, $usuario,$password,$base) or die("Error " . mysqli_error($connection));
	
	if($mysqli->connect_error){
		echo "Nuestro sitio presenta fallas....";
		die('Error en la conexion' . $mysqli->connect_error);
		exit();	
	}
 $connect = new PDO("mysql:host=167.114.169.207;dbname=informat_automatizacion", "informat_informaticaunah2", "dF%&(M6tJL?P");

if (!mysqli_set_charset($mysqli, "utf8")) {
        printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($mysqli));
        exit();
    } else {
        printf("");
    }

    
	

?>