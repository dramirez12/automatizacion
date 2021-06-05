<?php
session_start();

require_once('../clases/conexion_mantenimientos.php');
//require_once('../clases/');



$instancia_conexion = new conexion();

class modelo_plan{

 

    function tipo_plan_sel()
    {
        global $instancia_conexion;
        $consulta = $instancia_conexion->ejecutarConsulta('SELECT * FROM tbl_tipo_plan');

        return $consulta;
    }
    function planActivo($opcion_check)
    {
        global $instancia_conexion;

        $sql4 = "call proc_verificar_plan_activo('$opcion_check')";
        return $instancia_conexion->ejecutarConsultaSimpleFila($sql4);
    }
    function verificarPlanNombre($nombre)
    {
        global $instancia_conexion;

        $sql4 = "call proc_verificar_nombre_plan('$nombre')";
        return $instancia_conexion->ejecutarConsultaSimpleFila($sql4);
    }

    function crear_plan_estudio($nombre, $num_clases, $fecha_creacion, $codigo_plan, $plan_vigente, $id_tipo_plan, $creado_por)
    {

        global $instancia_conexion;

        $sql = "call proc_insertar_plan_estudio('$nombre','$num_clases','$fecha_creacion','$codigo_plan','$plan_vigente','$id_tipo_plan','$creado_por')";

        if ($consulta = $instancia_conexion->ejecutarConsulta($sql)) {
            return 1;
            
        } else {
            return 0;
        }
    }
    function listar_planes_estudio()
    {
        global $instancia_conexion;
        $sql = "call sel_gestion_plan_estudio()";
        $arreglo = array();
        if ($consulta = $instancia_conexion->ejecutarConsulta($sql)) {
            while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                $arreglo["data"][] = $consulta_VU;
            }
            return $arreglo;
        }
    }
    function historial_plan_estudio_datos()
    {
        global $instancia_conexion;
        $sql = "call sel_historial_plan_estudio()";
        $arreglo = array();
        if ($consulta = $instancia_conexion->ejecutarConsulta($sql)) {
            while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                $arreglo["data"][] = $consulta_VU;
            }
            return $arreglo;
        }
    }
    function buscar_historial_plan($nombre,$codigo)
    {
        global $instancia_conexion;
        $sql = "call sel_busca_historial_plan('$nombre','$codigo')";
        $arreglo = array();
        if ($consulta = $instancia_conexion->ejecutarConsulta($sql)) {
            while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                $arreglo["data"][] = $consulta_VU;
            }
            return $arreglo;
        }
    }

    function modificar_plan_estudio($nombre, $num_clases, $codigo_plan, $id_tipo_plan, $fecha_modificacion, $modificado_por, $id_plan_estudio)
    {

        //$Id_objeto=98;
        global $instancia_conexion;

        $sql = "call proc_actualizar_plan_estudio('$nombre', '$num_clases', '$codigo_plan', '$id_tipo_plan', '$fecha_modificacion', '$modificado_por', '$id_plan_estudio')";

        if ($consulta = $instancia_conexion->ejecutarConsulta($sql)) {
            return 1;
          

        } else {
            return 0;
        }
    }
    function modificar_plan_estudio_vigente($nombre, $num_clases, $codigo_plan, $id_tipo_plan, $fecha_modificacion, $modificado_por, $plan_vigente, $id_plan_estudio)
    {

        //$Id_objeto=98;
        global $instancia_conexion;

        $sql = "call proc_actualizar_plan_estudio_vigente('$nombre', '$num_clases', '$codigo_plan', '$id_tipo_plan', '$fecha_modificacion', '$modificado_por','$plan_vigente', '$id_plan_estudio')";

        if ($consulta = $instancia_conexion->ejecutarConsulta($sql)) {
            return 1;
        } else {
            return 0;
        }
    }
}
?>