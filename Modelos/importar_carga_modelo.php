<?php

class modelo_excel{

    private $conexion;
    function __construct()
    {
        require_once ('../clases/modelo_conexion.php');
        $this->conexion = new conexion();
        $this->conexion->conectar();
    }


    function registrar_excel($profesor, $aula, $cod, $control, $seccion, $matri, $dias, $hr_inicio, $hr_final)
    {
        $modalidad = "1";
        $sql = "call proc_insert_import_carga('$profesor', '$aula', '$cod', '$modalidad', '$control', '$seccion','$matri', '$dias', '$hr_inicio', '$hr_final')";

        if ($resultado = $this->conexion->conexion->query($sql)){

            $id_retornado= mysqli_insert_id($this->conexion->conexion);
            return 1;
        }else{
            return $sql;
        }

        $this->conexion->cerrar();
    }
}
