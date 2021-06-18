<?php

ob_start();


session_start();
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/Conexion.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');
require_once('../clases/funcion_permisos.php');





$Id_objeto = 110;

bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'Ingreso', 'A MANTENIMIENTO/ASIGNATURA DE SERVICIO');



$visualizacion = permiso_ver($Id_objeto);



if ($visualizacion == 0) {
    //header('location:  ../vistas/menu_roles_vista.php');

    echo '<script type="text/javascript">
                              swal({
                                   title:"",
                                   text:"Lo sentimos no tiene permiso de visualizar la pantalla",
                                   type: "error",
                                   showConfirmButton: false,
                                   timer: 3000
                                });
                           window.location = "../vistas/menu_mantenimiento_plan.php";

                            </script>';
} else {






    // if (permisos::permiso_insertar($Id_objeto) == '1') {
    //     $_SESSION['btn_crear_asignatura'] = "";
    // } else {
    //     $_SESSION['btn_crear_asignatura'] = "disabled";
    // }
}


ob_end_flush();


?>


<!DOCTYPE html>
<html>

<head>
    <title></title>



</head>

<body>


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">


                        <h1>ASIGNATURAS DE SERVICIO</h1>
                    </div>



                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="../vistas/menu_mantenimiento_plan.php">Menu Mantenimiento</a></li>
                            <li class="breadcrumb-item"><a href="../vistas/mantenimiento_crear_asignatura_servicio_vista.php"> Mantenimiento crear Asignatura de servicio</a></li>
                        </ol>
                    </div>

                    <div class="RespuestaAjax"></div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid ">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">MANTENIMIENTO DE ASIGNATURAS DE SERVICIO</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>

                        </div>

                    </div>

                    <div class="card-body" style="display: block;">

                    </div>
                </div>
            </div>



        </section>

    </div>



</body>


</html>