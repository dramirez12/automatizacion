<?php
// session_start();
require_once('../clases/conexion_mantenimientos.php');

//require_once "../clases/Conexion.php";

$instancia_conexion = new conexion();



class ajustes_perfil_modelo
{
    public function mostrar($id_persona)
    {
        global $instancia_conexion;
        $sql = "SELECT PEX.valor AS foto

FROM tbl_personas AS PER 
   
   JOIN tbl_personas_extendidas AS PEX ON PEX.id_persona=PER.id_persona
  
WHERE PER.id_persona= $id_persona AND PEX.id_atributo = 16;
";
        $result = $instancia_conexion->ejecutarConsulta($sql);

        $userData = array();

        while ($row = $result->fetch_assoc()) {

            $userData['all'][] = $row;
        }

        //echo '<pre>';print_r($userData);echo'</pre>';
        return $userData;
    }

    


    function mostrarTelefono($id_persona)
    {
        global $instancia_conexion;
        $consulta = $instancia_conexion->ejecutarConsultaSimpleFila("SELECT valor FROM tbl_contactos WHERE id_tipo_contacto=1 AND id_persona=$id_persona LIMIT 1");

        return $consulta;
    }

    function mostrarCorreo($id_persona)
    {
        global $instancia_conexion;
        $consulta = $instancia_conexion->ejecutarConsultaSimpleFila("SELECT valor FROM tbl_contactos WHERE id_tipo_contacto=4 AND id_persona=$id_persona LIMIT 1");

        return $consulta;
    }

}