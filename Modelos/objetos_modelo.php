<?php
require_once('../clases/conexion_mantenimientos.php');
$instancia_conexion = new conexion();


class objetos{
    function registrar_objeto($objeto,$descripcion,$id_modulo)
    {
        global $instancia_conexion;
		$sql="call proc_insertar_actualizar_objetos('".$objeto."','".$descripcion."',".$id_modulo.",0,1)";
		return $instancia_conexion->ejecutarConsulta($sql);
        # code...
    }
    function listar(){

        global $instancia_conexion;
		$sql="
        select ob.Id_objeto,ob.objeto,ob.descripcion,m.nombre from tbl_objetos ob, tbl_modulo_objetos mob,tbl_modulos m where ob.Id_objeto=mob.id_objeto and mob.id_modulo=m.id_modulo;";
		return $instancia_conexion->ejecutarConsulta($sql);
    }
    function seleccionar_objeto($id_objeto){

        global $instancia_conexion;
        $sql='';
		return $instancia_conexion->ejecutarConsultaSimpleFila($sql);
    }
    
    function actualizar_objeto($id_objeto,$objeto,$descripcion,$id_modulo){
        global $instancia_conexion;
		$sql="call proc_insertar_actualizar_objetos('".$objeto."','".$descripcion."',".$id_modulo.",".$id_objeto.",2)";
		return $instancia_conexion->ejecutarConsulta($sql);
    }
    function listar_select_modulos(){
        global $instancia_conexion;
        $consulta=$instancia_conexion->ejecutarConsulta('select * from tbl_modulos');

        return $consulta;

    }
    function listar_objeto_modulos(){
        global $instancia_conexion;
        $consulta=$instancia_conexion->ejecutarConsulta('select * from tbl_objetos o, tbl_modulo_objetos mo where o.Id_objeto=mo.Id_objeto');

        return $consulta;

    }
    function mostrar($id_objeto){
        global $instancia_conexion;
        $sql='select ob.Id_objeto,ob.objeto,ob.descripcion,m.id_modulo from tbl_objetos ob, tbl_modulo_objetos mob,tbl_modulos m where ob.Id_objeto='.$id_objeto.' and ob.Id_objeto=mob.id_objeto and mob.id_modulo=m.id_modulo;';
        return $instancia_conexion->ejecutarConsultaSimpleFila($sql);
    }
}

?>