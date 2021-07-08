<?php
ob_start();
session_start();


require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');
require_once('../clases/funcion_permisos.php');
require_once('../clases/conexion_mantenimientos.php');
//$registro = controlador_registro_docente::ctrRegistro();
$Id_objeto = 112;


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

    bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'INGRESO', 'A REQUISITO DE PLAN DE ESTUDIO.');


    if (permisos::permiso_insertar($Id_objeto) == '1') {
        $_SESSION['btn_guardar_cambio_requisito'] = "";
    } else {
        $_SESSION['btn_guardar_cambio_requisito'] = "disabled";
    }
    if (permisos::permiso_insertar($Id_objeto) == '1') {
        $_SESSION['btn_guardar_nuevo_requisito'] = "";
    } else {
        $_SESSION['btn_guardar_nuevo_requisito'] = "disabled";
    }
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
    <!--  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
 -->
    <title></title>


</head>

<body>


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">


                        <h1>Requisitos</h1>
                    </div>



                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="../vistas/menu_plan_estudio_vista.php">Menu Plan de Estudio</a></li>
                        </ol>
                    </div>

                    <div class="RespuestaAjax"></div>

                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid ">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">DATOS GENERALES</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>

                        </div>

                    </div>

                    <div class="card-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">

                                    <button type="" class="btn btn-warning btn" id="nuevo_requisito">Agregar Nuevo Requisito <i class="fas fa-plus"></i></button>
                                </div>

                            </div>
                        </div>





                        <div class="table-responsive" style="width: 100%;">
                            <table id="tabla_requisitos" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Editar Requisito</th>
                                        <th>Asignatura</th>
                                        <th>Requisito</th>


                                    </tr>
                                </thead>


                            </table>
                            <br>


                        </div>
                        <!-- modales -->
                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_editar">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title">Editar Requisitos</h5>
                                        <button onclick="limpiar(); actualizar_tabla();" class="close" data-dismiss="modal">
                                            &times;
                                        </button>
                                    </div>


                                    <div class="modal-body">

                                        <div class="row">
                                            <input type="hidden">
                                            <div class="col-sm-10">
                                                <div class="form-group">
                                                    <input hidden type="text" id="txt_id_asignatura" readonly>
                                                    <label> Asignatura </label>
                                                    <input class="form-control" type="text" id="txt_asignatura" name="txt_asignatura" readonly>


                                                </div>
                                            </div>


                                        </div>
                                        <div>

                                            <!--comisiones-->
                                            <div class="card-body">
                                                <button type="submit" class="btn btn-primary btn" data-toggle="modal" data-target="#ModalTask2" id="agregarotra" name="agregarotra" onclick="id_asignatura()">Agregar Requisitos</button>

                                                <br>

                                                <div class="card-text">
                                                    <table class="table table-bordered table-striped m-0">
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th>Requisitos</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody id="tbl_requisitos"></tbody>
                                                    </table>
                                                </div>
                                            </div>


                                        </div>





                                        <div class="modal-footer">
                                            <!-- <button class="btn btn-danger" name="cambiar_vigencia1" id="cambiar_vigencia1">Guardar Vigencia</button> -->
                                            <!--                                     <button class="btn btn-primary" id="guardar" name="guardar" <?php echo $_SESSION['btn_guardar_cambio_equivalencia']; ?>>Guardar</button>
 --> <button class="btn btn-secondary" data-dismiss="modal" onclick="limpiar(); actualizar_tabla();">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" tabindex="-1" role="dialog" id="ModalTask2">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Datos</h5>
                                        <button class="close" data-dismiss="modal">
                                            &times;
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="form-group">
                                                <input hidden type="text" id="txt_id_asignatura1" readonly>
                                                <label> Plan de Requisito </label>
                                                <select class="form-control" type="text" id="cbm_plan1" name="cbm_plan1"></select>




                                                <label>Requisitos</label>

                                                <select class="form-control" name="cbm_asignaturas" id="cbm_asignaturas"></select>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-success" onclick="saveAll3();addTask3(); limpiar() ">Agregar</button>
                                        <button class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- modal para nueva requisito -->
                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_nueva_requi">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Nuevo requisito</h5>
                                        <button class="close" data-dismiss="modal">
                                            &times;
                                        </button>
                                    </div>
                                    <div class="modal-body">


                                        <div class=" row">
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <label>Asignatura:</label>
                                                    <td><select class="form-control" style="width: 100%;" name="cbm_asignaturas_vigentes" id="cbm_asignaturas_vigentes">
                                                        </select></td>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <label>Plan para requisito:</label>
                                                    <td><select class="form-control" style="width: 100%;" name="cbm_plan_crear" id="cbm_plan_crear">
                                                        </select></td>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Requisito</label>
                                                    <select class="form-control"  style="width: 100%;" id="cbm_asignaturas_requisito">

                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" id="guardar_nueva_requi" name="guardar_nueva_requi" <?php echo $_SESSION['btn_guardar_nuevo_requisito']; ?> >Guardar</button>
                                        <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>




    <script type="text/javascript" src="../js/requisitos_plan.js"></script>
    <script type="text/javascript" src="../js/validaciones_plan.js"></script>
</body>




</html>
<script>
    var idioma_espanol = {
        select: {
            rows: "%d fila seleccionada"
        },
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ning&uacute;n dato disponible en esta tabla",
        "sInfo": "Registros del (_START_ al _END_) total de _TOTAL_ registros",
        "sInfoEmpty": "Registros del (0 al 0) total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "<b>No se encontrarón datos</b>",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

    }
</script>
<script>
    $(document).ready(function() {
        TablaPlanEstudio();

    });
</script>
<script>
    $(document).ready(function() {
        $(".mul-select").select2({
            placeholder: "SELECCIONE ASIGNATURAS", //placeholder
            tags: true,
            tokenSeparators: ['/', ',', ';', " "]
        });
    })
</script>