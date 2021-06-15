<?php

session_start();
require ('../Modelos/tabla_carga_modelo.php');
require_once('../clases/funcion_bitacora.php');
include "../clases/class.upload.php";

$Id_objeto = 104;
$MU = new modeloCarga();

if(isset($_FILES["archivo_excel"])){
	$up = new Upload($_FILES["archivo_excel"]);
	if($up->uploaded){
		$up->Process("../clases/uploads/");
		if($up->processed){
            /// leer el archivo excel
            require_once '../clases/PHPExcel/Classes/PHPExcel.php';
            $archivo = "../clases/uploads/".$up->file_dst_name;
            $inputFileType = PHPExcel_IOFactory::identify($archivo);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($archivo);
            $sheet = $objPHPExcel->getSheet(0); 
            $highestRow = $sheet->getHighestRow(); 
            $highestColumn = $sheet->getHighestColumn();
            for ($row = 2; $row <= $highestRow; $row++){ 
                
                $control = $sheet->getCell("B".$row)->getValue();
                $cod_asignatura = $sheet->getCell("C".$row)->getValue();
                $asignatura = $sheet->getCell("D".$row)->getValue();
                $seccion = $sheet->getCell("E".$row)->getValue();
                $hra_inicio = $sheet->getCell("F".$row)->getValue();
                $hra_final = $sheet->getCell("G".$row)->getValue();
                $dias = $sheet->getCell("H".$row)->getValue();
                $aula = $sheet->getCell("I".$row)->getValue();
                $profesor = $sheet->getCell("L".$row)->getValue();
                $cupos = $sheet->getCell("M".$row)->getValue();

                // $sql = "insert into person (no, name, lastname, address1, email1, phone1, created_at) value ";
                // $sql .= " (\"$x_no\",\"$x_name\",\"$x_lastname\",\"$x_address1\",\"$x_email\",\"$x_phone1\", NOW())";

                // $consulta = $MU->insertar_import_carga($id_persona, $id_aula, $id_asignatura, $id_modalidad, $control, $seccion, $num_alumnos, $dias, $hora_inicial, $hora_final);
                // echo $consulta;
                
                // if ($consulta === 1) {
                //     bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'INSERTO', 'UNA NUEVA CARGA ACADÉMICA');
                
                // } else {
                
                // }

                echo $control;
                echo $cod_asignatura;
                echo $asignatura;
                echo $seccion;
                echo $hra_inicio;
                echo $hra_final;
                echo $dias;
                echo $aula;
                echo $profesor;
                echo $cupos;

            }
    	unlink($archivo);
        }	

}
}




?>
