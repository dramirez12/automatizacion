<?php
session_start();
require_once('../clases/funcion_bitacora.php');


if (isset($_GET['op'])) {

    switch ($_GET['op']) {

        case 'cargarExcel':

            if (is_array($_FILES["archivoExcel"]) && count($_FILES["archivoExcel"]) > 0) {

                //SE LLAMA A LA LIBRERIA
                require_once('../PHPExcel/Classes/PHPExcel.php');

                $tmpfname = $_FILES['archivoExcel']['tmp_name'];

                //CREAR EL EXCEL PARA LUEGO LEERLO
                $leer_excel = PHPExcel_IOFactory::createReaderForFile($tmpfname);

                //CARGAR NUESTRO EXCELL
                $excel_obj = $leer_excel->load($tmpfname);

                //CARGAR EN QUE HOJA TRABAJAREMOS DEL EXCEL
                $hoja = $excel_obj->getSheet(0);
                $filas = $hoja->getHighestRow();
                echo "<table id='tabla_detalle' class='table' style='width: 100%; table-layout:fixed'>
                <thead>
                    <tr bgcolor ='black' style='color: #FFFFFF'> 
                        <td>Control</td>
                        <td>Cod</td>
                        <td>Asignatura</td>
                        <td>Seccion</td>
                        <td>Hra Inicio</td>
                        <td>Hra Final</td>
                        <td>Dias</td>
                        <td>Aulas</td>
                        <td>Profesor</td>
                        <td>Matriculados</td>
            
                    </tr>
                </thead>
                <tbody id='tbody_tabla_detalle'>
                ";


                for ($row = 3; $row <= $filas; $row++) {

                    $control = $hoja->getCell('D'.$row);
                    $cod_asig = $hoja->getCell('E'.$row);
                    $asignatura = $hoja->getCell('F'.$row);
                    $seccion = $hoja->getCell('G'.$row);
                    $hora_inicio = $hoja->getCell('H'.$row);
                    $hora_final = $hoja->getCell('I'.$row);
                    $dias = $hoja->getCell('J'.$row);
                    $aula = $hoja->getCell('K'.$row);
                    $profesor = $hoja->getCell('N'.$row);
                    $matriculados = $hoja->getCell('R'.$row);

                    if ($control =="") {
                        
                    }else{
                        echo "<tr>";
                        echo "<td>" . $control . "</td>";
                        echo "<td>" . $cod_asig . "</td>";
                        echo "<td>" . $asignatura . "</td>";
                        echo "<td>" . $seccion . "</td>";
                        echo "<td>" . $hora_inicio . "</td>";
                        echo "<td>" . $hora_final . "</td>";
                        echo "<td>" . $dias . "</td>";
                        echo "<td>" . $aula . "</td>";
                        echo "<td>" . $profesor . "</td>";
                        echo "<td>" . $matriculados . "</td>";
                        echo "</tr>";

                    }
                }

                echo "</tbody></table>";
                
            } else {
                return 0;
            }



            break;
    }
};
