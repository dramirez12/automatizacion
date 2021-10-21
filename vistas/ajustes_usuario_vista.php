<?php

ob_start();

session_start();

require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/Conexion.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');
require_once('../clases/funcion_permisos.php');
require_once('../clases/conexion_mantenimientos.php');






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

    <div class="full-box text-center">
       
        <h1>Pérfil de Usuario</h1>


    </div>


</head>


<body>

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">



                    </div>

                    <div class="col-sm-6">

                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
                            <li class="breadcrumb-item">Pérfil
                            </li>

                        </ol>
                    </div>

                    <div class="RespuestaAjax"></div>

                </div>
            </div><!-- /.container-fluid -->
        </section>


        <!--Pantalla 2-->



        <!--  <input type="datetime" name="fecha" value="<?php echo date("Y-m-d"); ?>"> -->

        <div class="card card-default">
            <div class="card-header">
                <!-- <h1>Actividad Docente: </h1> -->
                <!-- <h1>// echo $nombre ?></h1>-->
                <?php while ($row = $resultado3->fetch_array(MYSQLI_ASSOC)) { ?>
                    <h1><?php echo $row['nombres'], ' ', $row['apellidos']; ?></h1>
                <?php }  ?>
            </div>
        </div>






    </div>






</body>
<html>