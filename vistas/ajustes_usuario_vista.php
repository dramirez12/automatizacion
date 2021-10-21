<?php

ob_start();

session_start();

require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/Conexion.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');
require_once('../clases/funcion_permisos.php');
require_once('../clases/conexion_mantenimientos.php');



$Id_objeto = 290;
$visualizacion = permiso_ver($Id_objeto);
$usuario = $_SESSION['id_persona'];



if ($visualizacion == 0) {
    // header('location:  ../vistas/menu_roles_vista.php');
    echo '<script type="text/javascript">
                              swal({
                                   title:"",
                                   text:"Lo sentimos no tiene permiso de visualizar la pantalla",
                                   type: "error",
                                   showConfirmButton: false,
                                   timer: 3000
                                });
                           window.location = "../vistas/pagina_principal_vista.php";

                            </script>';
} else {

    bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'Ingreso', 'A perfil admin-estudiante');


    // if (permisos::permiso_modificar($Id_objeto) == '1') {
    //     $_SESSION['btn_modificar_roles'] = "";
    // } else {
    //     $_SESSION['btn_modificar_roles'] = "disabled";
    // }
}


$nombre = $_SESSION['usuario'];
$id = $_SESSION['id_usuario'];
$id_persona = $_SESSION['id_persona'];

$sql = "SELECT tp.nombres, tp.apellidos FROM tbl_personas tp INNER JOIN tbl_usuarios us ON us.id_persona=tp.id_persona WHERE us.Id_usuario= $id";
$resultado3 = $mysqli->query($sql);


ob_end_flush();




?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   <!--  <style >
    #parrafo_comisiones{
        opacity: 0.5;
    }
  
    </style>
 -->




</head>


<body>

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Área Personal-Pérfil de Usuario</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Perfil </li>
                        </ol>
                    </div>

                    <div class="RespuestaAjax"></div>

                </div>
            </div><!-- /.container-fluid -->
        </section>


        <!--Pantalla 2-->



        <!--  <input type="datetime" name="fecha" value="<?php echo date("Y-m-d"); ?>"> -->

        <div class="card card-default">
            <div class="card-body" style="display: block;">
                <div class="row">

                    <img src="../Imagenes_Perfil_Docente/default-avatar.png" class="brand-image img-circle elevation-3" id="mostrarimagen" height="65" width="65">

                    &nbsp;
                    &nbsp;
                    &nbsp;


                    <?php while ($row = $resultado3->fetch_array(MYSQLI_ASSOC)) { ?>
                        <h1><?php echo $row['nombres'], ' ', $row['apellidos']; ?>




                        <?php }  ?>






                </div>
                <hr>




            </div>
            <div class="d-flex justify-content-around flex-row bd-highlight row">


                <div class="card " style="width:500px;border-color:gray; background-color:paleturquoise;" id="parrafo_comisiones">
                    <!--comisiones-->
                    <div class="card-body">
                        <h4 class="card-title"></h4>
                        <div class="card-body">
                            <div class=" col-sm-12" style="text-align: center">
                            <div class="form-group">
                                    <!-- FOTOGRAFIA  -->
                                    <input hidden >
                                </div>
                                <div class="btn-group">
                               
                                    <button style="color:white;font-weight: bold;" class="btn btn-info" onclick="habilitar_editar();" id="editar_info" name="editar_info">Editar Información</button>

                                    <button hidden type="button" style="color:white;font-weight: bold;" class="btn btn-dark" onclick="desabilitar();" id="btn_editar" name="btn_editar"><i class="fas fa-user-edit"></i>Cancelar</button>




                                    &nbsp;&nbsp;
                                    <!-- <p class="text-center" style="margin-top: 20px;"> -->
                                    <button hidden type="button" class="btn btn-info" id="btn_guardar_edicion" name="btn_guardar_edicion" onclick="EditarPerfil($('#Nombre').val(),$('#txt_apellido').val(),$('#identidad').val(),$('#estado_civil_text').val()); ver_estado_civil();"><i class="fas fa-user-edit"></i>Guardar Información</button>
                                    <!-- </p> -->


                                </div>

                            </div>


                        </div>
                    </div>


                </div>
                <div class="card " style="width:500px;border-color:gray; background-color:paleturquoise; " id="parrafo_comisiones">
                    <!--comisiones-->
                    <div class="card-body">
                        <h4 class="card-title"></h4>
                        <div class="card-body">
                            <div class="col-sm-12" style="text-align: center">
                                <p class="text-center" style="margin-top: 20px;" id="parrafo_boton_editar">


                                    <button style="color:white;font-weight: bold;" type="button" id="btn_mostrar" class="btn btn-warning" onclick="MostrarBoton();"></i>Cambiar foto de Perfil</button>

                                    <button style="color:white;font-weight: bold;" hidden type="submit" id="btn_foto" class="btn btn-info btn_foto"><i class="fas fa-user-edit"></i>Guardar foto de Perfil</button>
                                    <button hidden id="btn_foto_cancelar" class="btn btn-dark btn_foto_cancelar"></i>Cancelar</button>
                                    <input class="form-control" hidden value="<?php echo $usuario ?>" type="text" name="id_persona" id="id_persona">
                                    <!-- <form action="" method="POST" role="form" enctype="multipart/form-data" id="frmimagen"> -->
                                <div class="form-group">
                                    <!-- FOTOGRAFIA  -->
                                    <input hidden type="file" accept=".png, .jpg, .JPG, .jpeg" maxlength="8388608" name="imagen" id="imagen" style="text-transform: uppercase">
                                </div>

                                <!-- </form> -->
                                </p>

                            </div>



                        </div>
                    </div>


                </div>

            </div>

        </div>







    </div>






</body>
<html>
<script type="text/javascript" src="../js/ajustes_perfil_usuario.js"></script>