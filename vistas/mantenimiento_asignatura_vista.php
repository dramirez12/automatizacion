<?php

ob_start();


session_start();
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/Conexion.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');
require_once('../clases/funcion_permisos.php');





$Id_objeto = 108;

bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'Ingreso', 'A MANTENIMIENTO ASIGNATURA');



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
    //     $_SESSION['btn_guardar_atributo'] = "";
    // } else {
    //     $_SESSION['btn_guardar_atributo'] = "disabled";
    // }
    /*

 if (isset($_REQUEST['msj']))
 {
      $msj=$_REQUEST['msj'];
        if ($msj==1)
            {
            echo '<script> alert("Lo sentimos el rol a ingresar ya existe favor intenta con uno nuevo")</script>';
            }
   
               if ($msj==2)
                  {
                  echo '<script> alert("Rol agregado correctamente")</script>';
                  }
 }

*/
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


                        <h1>ASIGNATURAS</h1>
                    </div>



                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="../vistas/menu_mantenimiento_plan.php">Menu Mantenimiento</a></li>
                            <li class="breadcrumb-item"><a href="../vistas/mantenimiento_asignatura_vista.php"> Mantenimiento Asignaturas</a></li>
                        </ol>
                    </div>

                    <div class="RespuestaAjax"></div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid ">
                <!-- pantalla 1 -->

                <div class="box-body">



                    <div class="card-body">
                        <div class="table-responsive" style="width: 100%;">
                            <table id="tabla_asignatura" class="table table-bordered table-striped" style="width:99%">
                                <thead>
                                    <tr>
                                        <th>Acción</th>
                                        <th>Nombre</th>
                                        <th>Código</th>
                                        <th>UV</th>
                                        <th>Código de plan</th>
                                        <th>Tipo Asignatura</th>
                                        <th>área</th>
                                        <th>Periodo</th>
                                        <th>Plan de estudio</th>

                                    </tr>
                                </thead>


                            </table>
                            <br>


                        </div>
                    </div>


                </div>
        </section>

    </div>





</body>


</html>