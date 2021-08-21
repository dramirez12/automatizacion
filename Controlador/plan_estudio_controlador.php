<?php
require_once "../Modelos/plan_estudio_modelo.php";



$nombre_plan = isset($_POST["nombre"]) ? limpiarCadena1($_POST["nombre"]) : "";
$id_plan_estudio = isset($_POST["id_plan_estudio"]) ? limpiarCadena1($_POST["id_plan_estudio"]) : "";
$id_periodo_plan = isset($_POST["id_periodo_plan"]) ? limpiarCadena1($_POST["id_periodo_plan"]) : "";
$id_area = isset($_POST["id_area"]) ? limpiarCadena1($_POST["id_area"]) : "";
$uv = isset($_POST["uv"]) ? limpiarCadena1($_POST["uv"]) : "";
$codigo = isset($_POST["codigo"]) ? limpiarCadena1($_POST["codigo"]) : "";
$asignatura = isset($_POST["asignatura"]) ? limpiarCadena1($_POST["asignatura"]) : "";
$reposicion = isset($_POST["reposicion"]) ? limpiarCadena1($_POST["reposicion"]) : "";
$suficiencia = isset($_POST["suficiencia"]) ? limpiarCadena1($_POST["suficiencia"]) : "";
$id_tipo_asignatura = isset($_POST["id_tipo_asignatura"]) ? limpiarCadena1($_POST["id_tipo_asignatura"]) : "";
$id_asignatura = isset($_POST["Id_asignatura"]) ? limpiarCadena1($_POST["Id_asignatura"]) : "";
$id_equivalencias = isset($_POST["id_equivalencias"]) ? limpiarCadena1($_POST["id_equivalencias"]) : "";
$id_asignatura_requisito = isset($_POST["id_asignatura_requisito"]) ? limpiarCadena1($_POST["id_asignatura_requisito"]) : "";
$estado = isset($_POST["estado"]) ? limpiarCadena1($_POST["estado"]) : "";
$id_plan_estudio= isset($_POST["id_plan_estudio"]) ? limpiarCadena1($_POST["id_plan_estudio"]) : "";

$instancia_modelo = new modelo_plan();
switch ($_GET["op"]) {

    case 'tipo_plan':

        $data = array();
        $respuesta2 = $instancia_modelo->tipo_plan_sel();

        while ($r2 = $respuesta2->fetch_object()) {

            # code...
            echo "<option value='" . $r2->id_tipo_plan . "'> " . $r2->nombre . " </option>";
        }
        break;


    case 'verificarPlanNombre':
        $rspta = $instancia_modelo->verificarPlanNombre($nombre_plan);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);
        break;

    case 'plan':

        $data = array();
        $respuesta2 = $instancia_modelo->plan_sel();

        while ($r2 = $respuesta2->fetch_object()) {

            # code...
            echo "<option value='" . $r2->id_plan_estudio . "'> " . $r2->nombre . " </option>";
        }
        break;

    case 'area':

        $data = array();
        $respuesta2 = $instancia_modelo->area_sel();

        while ($r2 = $respuesta2->fetch_object()) {

            # code...
            echo "<option value='" . $r2->id_area . "'> " . $r2->area . " </option>";
        }
        break;

    case 'periodo':

        $data = array();
        $respuesta2 = $instancia_modelo->periodo_sel();

        while ($r2 = $respuesta2->fetch_object()) {

            # code...
            echo "<option value='" . $r2->id_periodo_plan . "'> " . $r2->periodo . " </option>";
        }
        break;

    case 'UVasignaturas':
        $rspta = $instancia_modelo->UVasignaturas($id_plan_estudio);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);
        break;

    case 'nombre_plan':

        $data = array();
        $respuesta2 = $instancia_modelo->nombre_plan_sel();

        while ($r2 = $respuesta2->fetch_object()) {

            # code...
            echo "<option value='" . $r2->id_plan_estudio . "'> " . $r2->nombre . " </option>";
        }
        break;

    case 'asignatura':

        $data = array();
        $respuesta2 = $instancia_modelo->asignatura_sel();

        while ($r2 = $respuesta2->fetch_object()) {

            # code...
            echo "<option value='" . $r2->Id_asignatura . "'> " . $r2->asignatura . " </option>";
        }
        break;
    case 'id_plan':

        $data = array();
        $respuesta2 = $instancia_modelo->plan_sel_asig($id_plan_estudio);

        while ($r2 = $respuesta2->fetch_object()) {

            # code...
            echo "<option value='" . $r2->Id_asignatura . "'> " . $r2->asignatura . " </option>";
        }
        break;
    case 'UVplan':

        $respuesta = $instancia_modelo->UVplan($id_plan_estudio);
        echo json_encode($respuesta);
        break;
    case 'contarAsignaturas':

        $respuesta = $instancia_modelo->contarAsignaturas($id_plan_estudio);
        echo json_encode($respuesta);
        break;
    case 'contarCreditosPlan':

        $respuesta = $instancia_modelo->contarCreditosPlan($id_plan_estudio);
        echo json_encode($respuesta);
        break;

        
    // case 'registrarAsignatura':
        
    //         $respuesta = $instancia_modelo->registrarAsignatura($id_plan_estudio, $id_periodo_plan, $id_area, $uv, $codigo, $estado, $asignatura, $reposicion, $suficiencia, $id_tipo_asignatura);
        
    //     break;

    case 'actualizarAsignatura':
      
            $respuesta = $instancia_modelo->ActualizarAsignatura($id_plan_estudio, $id_periodo_plan, $id_area, $uv, $codigo, $asignatura, $reposicion, $suficiencia, $id_asignatura);
       
        break;

    case 'nombreAsignatura':

        $respuesta = $instancia_modelo->nombreAsignatura($id_plan_estudio, $asignatura);
        echo json_encode($respuesta);
        break;;

        

    case 'asignaturaVigente':

        $data = array();
        $respuesta2 = $instancia_modelo->asignaturaVigente();

        while ($r2 = $respuesta2->fetch_object()) {

            # code...
            echo "<option value='" . $r2->Id_asignatura . "'> " . $r2->asignatura . " </option>";
        }
        break;
    case 'consAsigEqui':

        $respuesta = $instancia_modelo->consAsig($id_asignatura, $id_equivalencias);
        echo json_encode($respuesta);
        break;

    case 'consAsigRequ':

        $respuesta = $instancia_modelo->consAsigRequ($id_asignatura, $id_asignatura_requisito);
        echo json_encode($respuesta);
        break;

        case 'datos_plan':
            $rspta = $instancia_modelo->datos_plan($id_plan_estudio);
            //Codificar el resultado utilizando json
            echo json_encode($rspta);
            break;


    case 'nombreAsignatura_servicio':

        $respuesta = $instancia_modelo->nombreAsignaturaServicio($asignatura,$id_area);
        echo json_encode($respuesta);
        break;

        

        
        
}
