<?php
require_once "../Modelos/ajustes_perfil_usuario_modelo.php";

$id_persona = isset($_POST["id_persona"]) ? limpiarCadena1($_POST["id_persona"]) : "";


$instancia_modelo = new ajustes_perfil_modelo();

if (isset($_GET['op'])) {

    switch ($_GET['op']) {
        case 'CargarDatos':
            $rspta = $instancia_modelo->mostrar($id_persona);
            //echo '<pre>';print_r($rspta);echo'</pre>';
            //Codificar el resultado utilizando json
            echo json_encode($rspta);
            break;

        case 'Cargartelefono':
            $rspta = $instancia_modelo->mostrarTelefono($id_persona);
            //echo '<pre>';print_r($rspta);echo'</pre>';
            //Codificar el resultado utilizando json
            echo json_encode($rspta);
            break;

        case 'CargarCorreo':
            $rspta = $instancia_modelo->mostrarCorreo($id_persona);
            //echo '<pre>';print_r($rspta);echo'</pre>';
            //Codificar el resultado utilizando json
            echo json_encode($rspta);
            break;


    }
}

?>