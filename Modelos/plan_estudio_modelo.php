<?php
session_start();

require_once('../clases/conexion_mantenimientos.php');



$instancia_conexion = new conexion();

class modelo_plan{

 

    function tipo_plan_sel()
    {
        global $instancia_conexion;
        $consulta = $instancia_conexion->ejecutarConsulta('SELECT * FROM tbl_tipo_plan');

        return $consulta;
    }
  
    function verificarPlanNombre($nombre)
    {
        global $instancia_conexion;

        $sql4 = "call proc_verificar_nombre_plan('$nombre')";
        return $instancia_conexion->ejecutarConsultaSimpleFila($sql4);
    }

    function crear_plan_estudio($nombre, $num_clases, $fecha_creacion, $codigo_plan, $plan_vigente, $id_tipo_plan,$creado_por, $numero_acta, $fecha_acta, $fecha_emision,$creditos)
    {

        global $instancia_conexion;

        $sql = "call proc_insertar_plan_estudio('$nombre','$num_clases','$fecha_creacion','$codigo_plan','$plan_vigente','$id_tipo_plan','$creado_por','$numero_acta','$fecha_acta','$fecha_emision','$creditos')";

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
    function listar_historial_plan_vigente()
    {
        global $instancia_conexion;
        $sql = " call sel_historial_plan_vigente()";
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
    function plan_sel()
    {
        global $instancia_conexion;
        $consulta = $instancia_conexion->ejecutarConsulta('SELECT id_plan_estudio,nombre FROM tbl_plan_estudio');

        return $consulta;
    }
    function area_sel()
    {
        global $instancia_conexion;
        $consulta = $instancia_conexion->ejecutarConsulta('SELECT id_area,area FROM tbl_areas');

        return $consulta;
    }
    function periodo_sel()
    {
        global $instancia_conexion;
        $consulta = $instancia_conexion->ejecutarConsulta('SELECT id_periodo_plan,periodo FROM tbl_periodo_plan');

        return $consulta;
    }
  
  
  
}
?>