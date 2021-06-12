<?php

ob_start();


session_start();
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/Conexion.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');
require_once('../clases/funcion_permisos.php');





$Id_objeto = 118;

bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'Ingreso', 'A Mantenimiento/Crear Asignatura');



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
                           window.location = "../vistas/menu_roles_vista.php";

                            </script>';
} else {






    if (permisos::permiso_insertar($Id_objeto) == '1') {
        $_SESSION['btn_crear_asignatura'] = "";
    } else {
        $_SESSION['btn_crear_asignatura'] = "disabled";
    }
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
                            <li class="breadcrumb-item"><a href="../vistas/mantenimiento_asignatura_vista.php"> Mantenimiento Asignatura</a></li>
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
                        <h3 class="card-title">Nuevo Asignatura</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>

                        </div>

                    </div>

                    <div class="card-body" style="display: block;">
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">

                                    <label>Seleccione plan que pertenece:</label>
                                    <td><select class="form-control" style="width: 100%;" name="cbm_plan" id="cbm_plan">
                                        </select></td>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    <label>Seleccione periodo que pertenece:</label>
                                    <td><select class="form-control" style="width: 100%;" name="cbm_periodo" id="cbm_periodo">
                                        </select></td>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    <label>Código de Asignatura</label>

                                    <input class="form-control" type="text" id="txt_codigo_asignatura" name="txt_codigo_asignatura" maxlength="45" required>


                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    <label>Nombre de Asignatura</label>

                                    <input class="form-control" type="text" id="txt_nombre_asignatura" name="txt_nombre_asignatura" maxlength="45" required style="text-transform: uppercase" onkeyup="DobleEspacio(this, event); MismaLetra('txt_nombre_asignatura');" onkeypress="return sololetras(event)">


                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">

                                    <label>Unidades Valorativas</label>

                                    <input class="form-control" type="text" id="txt_uv" name="txt_uv" maxlength="45" required onkeypress="return solonumeros(event)">


                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">

                                    <label>Seleccione Área a la que pertenece:</label>
                                    <td><select class="form-control" style="width: 100%;" name="cbm_area" id="cbm_area">
                                        </select></td>
                                </div>
                            </div>




                            <div class="col-md-2">
                                <label>Reposición</label>
                                <div style="padding: 3px 5px; border: #c3c3c3  1px solid;  border-radius:5px; width:auto; height:35px;">

                                    <div class="form-group">

                                        <input type="text" name="sino_reposicion" id="sino_reposicion" readonly hidden>
                                        <span class="checkbox-inline">
                                            <label class="checkbox-inline"><input id="SI" type="checkbox" name="check1[]" class="ch1" value="SI"> SI</label>
                                            <label class="checkbox-inline"><input id="NO" type="checkbox" name="check1[]" class="ch1" value="NO"> NO</label>


                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label>Suficiencia</label>
                                <div style="padding: 3px 5px; border: #c3c3c3  1px solid;  border-radius:5px; width:auto; height:35px;">

                                    <div class="form-group">

                                        <input type="text" name="sino_suficiencia" id="sino_suficiencia" readonly hidden>
                                        <span class="checkbox-inline">
                                            <label class="checkbox-inline"><input id="SI" type="checkbox" name="check2[]" class="ch2" value="SI"> SI</label>
                                            <label class="checkbox-inline"><input id="NO" type="checkbox" name="check2[]" class="ch2" value="NO"> NO</label>


                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">

                                    <label>Sílabo</label>

                                    <input class="form-control" type="file" id="txt_silabo" name="txt_silabo" value="" required>


                                </div>
                            </div>


                            <br>
                            <p style="display: block; margin: 0 auto;">
                                <button class="btn btn-primary" <?php echo $_SESSION['btn_crear_asignatura']; ?>>Guardar</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>



        </section>

    </div>



    <script type="text/javascript" src="../js/mantenimiento_asignatura.js"></script>
    <script type="text/javascript" src="../js/validaciones_plan.js"></script>
</body>


</html>