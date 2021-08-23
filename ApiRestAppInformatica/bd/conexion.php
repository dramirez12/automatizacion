<?php 

ob_start();

class Conexion{

    public function conexion_bd(){

        $server = "167.114.169.207";
        $user = "informat_desarrollo";
        $password = "!fuRCr3XR-tz";
        $dataBase = "informat_desarrollo_automatizacion";
        $port = 3306;

        $conexion = @mysqli_connect($server, $user, $password, $dataBase, $port);

        if(!empty($conexion))
        {
            return $conexion;
        }else
        {
            return null; //"Error, no se pudo conectar con la base de datos";
        }
    }
}

ob_end_flush();
//$conexion = new conexion;
//echo $conexion->conexion_bd();
