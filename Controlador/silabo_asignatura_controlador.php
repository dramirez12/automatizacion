<?php
require_once "../Modelos/plan_estudio_modelo.php";
$MP = new modelo_plan();
$nombrearchivo2 = htmlspecialchars($_POST['nombrearchivo2'],ENT_QUOTES,'UIF-8');

if(is_array($_FILES) && count($_FILES)>0){

    if(move_uploaded_file($_FILES["c"]["tmp_name"], "../silabos_asignaturas/".$_FILES["c"]["name"])){
      $nombrearchivo2= '../silabos_asignaturas/'.$_FILES["c"]["name"];
      $consulta=$MP->Registrar_silabo_asignatura($nombrearchivo2);  
      echo $consulta;
    }else{
        echo 0;
    }

}else{
    echo 0;
}
