<?php
ob_start();
session_start();


require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');
require_once('../clases/funcion_permisos.php');
require_once('../clases/conexion_mantenimientos.php');
//$registro = controlador_registro_docente::ctrRegistro();
$Id_objeto = 105;


$visualizacion = permiso_ver($Id_objeto);

$nombre = $_SESSION['usuario'];
$id_usuario = $_SESSION['id_usuario'];
if ($visualizacion == 0) {
    echo '<script type="text/javascript">
                              swal({
                                   title:"",
                                   text:"Lo sentimos no tiene permiso de visualizar la pantalla",
                                   type: "error",
                                   showConfirmButton: false,
                                   timer: 3000
                                });
                           window.location = "../vistas/menu_plan_estudio_vista.php";

                            </script>';
} else {

    bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'INGRESO', 'A COMPARAR PLAN DE ESTUDIO.');


    // if (permisos::permiso_insertar($Id_objeto) == '1') {
    //   $_SESSION['btn_guardar_registro_docentes'] = "";
    // } else {
    //   $_SESSION['btn_guardar_registro_docentes'] = "disabled";
    // }
}

ob_end_flush();


?>


<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <title></title>


</head>


<body>
    <div class="content-wrapper">


        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">


                        <h1>Comparar planes</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="../vistas/menu_plan_estudio_vista.php">Menu Plan de Estudio</a></li>
                            <li class="breadcrumb-item">Comparar planes</li>
                           
                        </ol>
                    </div>

                    <div class="RespuestaAjax"></div>

                </div>
            </div><!-- /.container-fluid -->
        </section>



        <!-- /.card-header -->
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <div class="container-fluid" style="width: 100%;">
            <div class="box-body">



                <div class="card-body">
                   

                    </div>
                </div>
                <div class="card-footer">
                    <h1></h1>
                </div>
            </div>

        </div>

    </div>



 </body>


</html>




