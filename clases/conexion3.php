<?php
//CONEXION DE LUIS
//generando la conexion a la base de datos
function conexion(){ 
	$servidor= "51.222.86.251";
	$usuario= "informat_desarrollo";
	$password = "^Kwd{PE^(L&#";
	$base= "informat_desarrollo_automatizacion";

 	$conexion = mysqli_connect($servidor, $usuario,$password,$base);

 	//error al buscar la direccion del host
 	if(mysqli_connect_errno()){
 		echo "Fallo al conectar con la Base de datos";
 		exit();
 	}

	 
 	//Error al conectar con la base de datos
 	mysqli_select_db($conexion,$base) or die("No se encuentra la base de datos");

 	mysqli_set_charset($conexion, "utf8");

 	return $conexion;
	
}
/*
	if (conexion()){
		echo "conectado new";

	}else{
		echo "No conectado new";
	}
*/
  
?>