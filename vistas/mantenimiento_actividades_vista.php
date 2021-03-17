<?php
ob_start();

session_start();

require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/Conexion.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');
require_once('../clases/funcion_permisos.php');

//Lineas de msj al cargar pagina de acuerdo a actualizar o eliminar datos
if (isset($_REQUEST['msj'])) {
  $msj = $_REQUEST['msj'];

  if ($msj == 1) {
    echo '<script type="text/javascript">
    swal({
        title: "",
        text: "Lo sentimos la actividad ya existe",
        type: "info",
        showConfirmButton: false,
        timer: 3000
    });
</script>';
  }

  if ($msj == 2) {


    echo '<script type="text/javascript">
    swal({
        title: "",
        text: "Los datos  se almacenaron correctamente",
        type: "success",
        showConfirmButton: false,
        timer: 3000
    });
</script>';


   
    $sqltabla = "select  actividad, descripcion, nombre_proyecto, horas_semanales, id_comisiones
FROM tbl_actividades";
    $resultadotabla = $mysqli->query($sqltabla);
  }
  if ($msj == 3) {


    echo '<script type="text/javascript">
    swal({
        title: "",
        text: "Error al actualizar lo sentimos,intente de nuevo.",
        type: "error",
        showConfirmButton: false,
        timer: 3000
    });
</script>';
  }
}


$Id_objeto = 79;
$visualizacion = permiso_ver($Id_objeto);



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
                           window.location = "../vistas/menu_roles_vista.php";

                            </script>';
} else {

  bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'Ingreso', 'A Mantenimiento Actividades');


  if (permisos::permiso_modificar($Id_objeto) == '1') {
    $_SESSION['btn_modificar_actividad'] = "";
  } else {
    $_SESSION['btn_modificar_actividad'] = "disabled";
  }
  

  /* Manda a llamar todos las datos de la tabla para llenar el gridview  */
  $sqltabla = "select  actividad, descripcion, nombre_proyecto, horas_semanales, id_comisiones FROM tbl_actividades";
  $resultadotabla = $mysqli->query($sqltabla);



  /* Esta condicion sirve para  verificar el valor que se esta enviando al momento de dar click en el icono modicar */
  if (isset($_GET['id_actividad'])) {
    $sqltabla = "select  actividad, descripcion, nombre_proyecto, horas_semanales, id_comisiones
    FROM tbl_actividades";
    $resultadotabla = $mysqli->query($sqltabla);

    /* Esta variable recibe el estado de modificar */
    $actividad = $_GET['id_actividad'];

    /* Iniciar la variable de sesion y la crea */
    /* Hace un select para mandar a traer todos los datos de la 
 tabla donde rol sea igual al que se ingreso en el input */
    $sql = "select * FROM tbl_actividades WHERE actividad = '$actividad'";
    $resultado = $mysqli->query($sql);
    /* Manda a llamar la fila */
    $row = $resultado->fetch_array(MYSQLI_ASSOC);

    /* Aqui obtengo el id_actividad de la tabla de la base el cual me sirve para enviarla a la pagina actualizar.php para usarla en el where del update   */
    $_SESSION['id_actividad'] = $row['id_actividad'];
    $_SESSION['actividad'] = $row['actividad'];
    $_SESSION['descripcion'] = $row['descripcion'];
    $_SESSION['nombre_proyecto'] = $row['nombre_proyecto'];
    $_SESSION['horas_semanales'] = $row['horas_semanales'];
    $_SESSION['id_comisiones'] = $row['id_comisiones'];
    /*Aqui levanto el modal*/

    if (isset($_SESSION['id_actividad'])) {


?>
      <script>
        $(function() {
          $('#modal_modificar_actividad').modal('toggle')

        })
      </script>;
      
      <?php
      ?>

<?php


    }
  }
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


            <h1>ACTIVIDADES
            </h1>
          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
              <li class="breadcrumb-item active"><a href="../vistas/menu_mantenimiento.php">Menu Mantenimiento</a></li>
              <li class="breadcrumb-item active"><a href="../vistas/mantenimiento_crear_actividades_vista.php">Nueva Actividad</a></li>
            </ol>
          </div>

          <div class="RespuestaAjax"></div>

        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!--Pantalla 2-->

    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Actividades Existentes</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        </div>
      </div>
      <div class="card-body">

        <table id="tabla" class="table table-bordered table-striped">



          <thead>
            <tr>
              <th>ACTIVIDADES</th>
              <th>DESCRIPCION </th>
              <th>NOMBRE PROYECTO </th>
              <th>HORAS SEMANALES</th>
              <th>TIPO COMISION </th>
              <th>MODIFICAR</th>
              <th>ELIMINAR</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $resultadotabla->fetch_array(MYSQLI_ASSOC)) { ?>
              <tr>
                <td><?php echo $row['actividad']; ?></td>
                <td><?php echo $row['descripcion']; ?></td>
                <td><?php echo $row['nombre_proyecto']; ?></td>
                <td><?php echo $row['horas_semanales']; ?></td>
                <td><?php echo $row['id_comisiones']; ?></td>


                <td style="text-align: center;">

                  <a href="../vistas/mantenimiento_actividades_vista.php?actividad=<?php echo $row['actividad']; ?>" class="btn btn-primary btn-raised btn-xs">
                    <i class="far fa-edit" style="display:<?php echo $_SESSION['modificar_actividad'] ?> "></i>
                  </a>
                </td>

                <td style="text-align: center;">

                  <form action="../Controlador/eliminar_actividad_controlador.php?actividad=<?php echo $row['actividad']; ?>" method="POST" class="FormularioAjax" data-form="delete" autocomplete="off">
                    <button type="submit" class="btn btn-danger btn-raised btn-xs">

                      <i class="far fa-trash-alt" style="display:<?php echo $_SESSION['eliminar_actividad'] ?> "></i>
                    </button>
                    <div class="RespuestaAjax"></div>
                  </form>
                </td>

              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>


    <!-- /.card-body -->
    <div class="card-footer">

    </div>
  </div>





  <!-- *********************Creacion del modal 

-->

  <form action="../Controlador/actualizar_actividad_controlador.php?id_actividad=<?php echo $_SESSION['id_actividad']; ?>" method="post" data-form="update" autocomplete="off">



    <div class="modal fade" id="modal_modificar_actividad">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"> Actualizar Actividad</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>


          <!--Cuerpo del modal-->
          <div class="modal-body">





            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">

                    <label>Modificar Actividad</label>


                    <input class="form-control" type="text" id="txt_actividad" name="txt_actividad" value="<?php echo $_SESSION['actividad']; ?>" required style="text-transform: uppercase" onkeyup="DobleEspacio(this, event)" onkeypress="return LetrasyNumeros(event)" maxlength="30">

                  </div>


                  <div class="form-group">
                    <label class="control-label">Descripcion</label>

                    <input class="form-control" type="text" id="txt_descripcion" name="txt_descripcion" value="<?php echo $_SESSION['descripcion']; ?>" required style="text-transform: uppercase" onkeypress="return Letras(event)" onkeyup="DobleEspacio(this, event)" maxlength="30" onkeypress="return comprobar(this.value, event, this.id)">

                  </div>

                  <div class="form-group">
                    <label class="control-label">Nombre proyecto</label>

                    <input class="form-control" type="text" id="txt_proyecto" name="txt_proyecto" value="<?php echo $_SESSION['nombre_proyecto']; ?>" required style="text-transform: uppercase" onkeypress="return Letras(event)" onkeyup="DobleEspacio(this, event)" maxlength="30" onkeypress="return comprobar(this.value, event, this.id)">

                  </div>

                  <div class="form-group">
                    <label class="control-label">Horas semanales</label>

                    <input class="form-control" type="text" id="txt_horas" name="txt_horas" value="<?php echo $_SESSION['horas_semanales']; ?>" required style="text-transform: uppercase" onkeypress="return Numeros(event)" onkeyup="DobleEspacio(this, event)" maxlength="30" onkeypress="return comprobar(this.value, event, this.id)">

                  </div>

                  <div class="form-group">
                                        <label>Tipo Comision</label>
                                        <select class="form-control-lg select2" type="text" id="cbm_comision1" name="cbm_comision1" style="width: 100%;" >
                                        <option value="">Seleccione una opción</option>
                                        </select>
                  </div>
                  <input class="form-control"  id="comision1"  name="comision1" value="<?php echo $_SESSION['id_comisiones']; ?>" hidden>

                </div>
              </div>
            </div>

          </div>




          <!--Footer del modal-->
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" id="btn_modificar_actividad" name="btn_modificar_actividad" <?php echo $_SESSION['btn_modificar_actividad']; ?>>Guardar Cambios</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <!-- /.  finaldel modal -->

    <!--mosdal crear -->



  </form>




  <script type="text/javascript">
    $(function() {

      $('#tabla').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
      });
    });
  </script>


</body>

</html>

<script type="text/javascript" src="../js/funciones_mantenimientos.js"></script>
<script type="text/javascript" language="javascript">
    $(document).ready(function() {

        $('.select2').select2({
            placeholder: 'Seleccione una opcion',
            theme: 'bootstrap4',
            tags: true,
        });

    });
</script>