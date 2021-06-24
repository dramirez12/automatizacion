<?php
require_once "../Modelos/plan_estudio_modelo.php";


$id_asignatura = isset($_POST["id_asignatura"]) ? limpiarCadena1($_POST["id_asignatura"]) : "";

$instancia_modelo = new modelo_plan();
switch ($_GET["op"]) {

    case 'id_asignatura':
        $rspta = $instancia_modelo->sel_equivalencias($id_asignatura);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);
        break;

        case 'id_asignatura':
            $rspta = $instancia_modelo->existe_equivalencia($id_asignatura);
            //Codificar el resultado utilizando json
            echo json_encode($rspta);
            break;


        

}

