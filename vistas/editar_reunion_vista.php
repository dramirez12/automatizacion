<?php
ob_start();
session_start();
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/Conexion.php');
$id = $_GET['id'];
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');
require_once('../clases/funcion_permisos.php');
$dtz = new DateTimeZone("America/Tegucigalpa");
$dt = new DateTime("now", $dtz);
$hoy = $dt->format("Y-m-d");
$Id_objeto = 144;

bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'Ingreso', 'A crear Reunion');

$visualizacion = permiso_ver($Id_objeto);



if ($visualizacion == 0) {
    echo '<script type="text/javascript">
                              swal({
                                   title:"",
                                   text:"Lo sentimos no tiene permiso de visualizar la pantalla",
                                   type: "error",
                                   showConfirmButton: false,
                                   timer: 3000
                                });
                           window.location = "../vistas/menu_reunion_vista.php";

                            </script>';
    // header('location:  ../vistas/menu_usuarios_vista.php');
} else {


    if (permisos::permiso_insertar($Id_objeto) == '1') {
        $_SESSION['btn_crear'] = "";
    } else {
        $_SESSION['btn_crear'] = "disabled='disabled'";
    }
}

ob_end_flush();
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../plugins/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel=" stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js">
    <title></title>
</head>

<body>
    <style>
        input[type=checkbox]:checked+label.strikethrough {
            text-decoration: line-through;
            color:red;
            position:relative;
            top:3px
        }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Editar Reunion</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                            <li class="breadcrumb-item active">Editar Reunion</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>





        <!-- Main content -->
        <section class="content">
            <?php
            $sql = "SELECT * FROM `tbl_reunion` WHERE `id_reunion` = $id ";
            $resultado = $mysqli->query($sql);
            $estado = $resultado->fetch_assoc();

            ?>
            <div class="container-fluid">
                <form role="form" name="editar-reunion" id="editar-reunion" method="post" action="../Modelos/modelo_reunion.php">
                    <div style="padding: 0px 0 25px 0; float: right;">
                        <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
                        <input type="hidden" name="reunion" value="actualizar">
                        <button style="padding-right: 15px;" type="submit" class="btn btn-success float-left" id="editar_registro" <?php echo $_SESSION['btn_crear']; ?>>Guardar Cambios</button>
                        <a style="color: white !important; margin: 0px 0px 0px 10px;" class="cancelar-reunion btn btn-danger" href="reuniones_pendientes_vista.php">Cancelar</a>
                    </div><br><br><br>
                    <div class="card card-primary card-outline card-tabs">
                        <div class="card-header p-0 pt-1 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="datosgenerales-tab" data-toggle="pill" href="#datosgenerales" role="tab" aria-controls="datosgenerales" aria-selected="false">Datos Generales y Asistencia</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="datosreunion-tab" data-toggle="pill" href="#datosreunion" role="tab" aria-controls="datosreunion" aria-selected="true">Listado participantes</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade active show" id="datosgenerales" role="tabpanel" aria-labelledby="datosgenerales-tab">
                                    <div class="row">
                                        <!-- left column -->
                                        <div class="col-md-6">
                                            <!-- general form elements -->
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h3 class="card-title">Datos Generales</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="nombre">Nombre:</label>
                                                        <input required minlength="5" type="text" value="<?php echo $estado['nombre_reunion']; ?>" class="form-control" id="nombre" name="nombre" placeholder="Ingrese nombre de la Reunion">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tipo">Tipo de Reunión</label>
                                                        <select class="form-control" onchange="showInp()" style="width: 50%;" id="tipo" name="tipo">
                                                            <option value="0">-- Selecione un Tipo --</option>
                                                            <?php
                                                            try {
                                                                $tipo_actual = $estado['id_tipo'];
                                                                $sql = "SELECT * FROM tbl_tipo_reunion_acta ";
                                                                $resultado = $mysqli->query($sql);
                                                                while ($tipo_reunion = $resultado->fetch_assoc()) {
                                                                    if ($tipo_reunion['id_tipo'] == $tipo_actual) { ?>
                                                                        <option value="<?php echo $tipo_reunion['id_tipo']; ?>" selected>
                                                                            <?php echo $tipo_reunion['tipo']; ?>
                                                                        </option>
                                                                    <?php } else { ?>
                                                                        <option value="<?php echo $tipo_reunion['id_tipo']; ?>">
                                                                            <?php echo $tipo_reunion['tipo']; ?>
                                                                        </option>
                                                            <?php }
                                                                }
                                                            } catch (Exception $e) {
                                                                echo "Error: " . $e->getMessage();
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="lugar">Lugar:</label>
                                                        <input required minlength="4" onkeyup="mayus(this);" value="<?php echo $estado['lugar']; ?>" style="width: 90%;" type="text" class="form-control" id="lugar" name="lugar" placeholder="Lugar donde se dearrollara la Reunion">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fecha">Fecha:</label>
                                                        <input required style="width: 40%;" value="<?php echo $estado['fecha']; ?>" type="date" class="form-control datetimepicker-input" id="fecha" name="fecha" min="<?php echo $hoy; ?>" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="horainicio">Hora Inicio: </label>
                                                        <input required style="width: 30%;" type="time" value="<?php echo $estado['hora_inicio']; ?>" class="form-control" id="horainicio" name="horainicio" min="7:00:00" max="23:00:00">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="horafinal">Hora Final: </label>
                                                        <input required style="width: 30%;" type="time" value="<?php echo $estado['hora_final']; ?>" class="form-control" id="horafinal" name="horafinal" min="7:30:00" max="24:00:00">
                                                    </div>
                                                    <div class="form-group">
                                                        <label id="enlaces" for="enlace">Enlace de la Reunión:</label>
                                                        <input value="<?php echo $estado['enlace']; ?>" minlength="10" type="text" class="form-control" id="enlace" name="enlace" placeholder="Ingrese el Link de la Reunion">
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <!--/.col (left) -->
                                        <!-- right column -->
                                        <div class="col-md-6">
                                            <!-- Form Element sizes -->
                                            <div class="card card-success">
                                                <div class="card-header">
                                                    <h3 class="card-title">Datos de la Reunión</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="asunto">Asunto:</label>
                                                        <textarea required minlength="4" onkeyup="mayus(this);" class="form-control" id="asunto" name="asunto" rows="3" placeholder="Ingrese el asunto de la Reunión"><?php echo $estado['asunto']; ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="agenda">Agenda Propuesta</label>
                                                        <textarea required minlength="10" onkeyup="mayus(this);" class="form-control" id="agenda" name="agenda" rows="13" placeholder="Ingrese Agenda Propuesta"><?php echo $estado['agenda_propuesta']; ?></textarea>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                        </div>
                                        <!--/.col (right) -->
                                    </div>
                                </div>
                                <div class="tab-pane fade " id="datosreunion" role="tabpanel" aria-labelledby="datosreunion-tab">
                                    <!-- /.row -->
                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <h3 class="card-title">Participantes</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-12">
                                                <!-- /.card -->
                                                <div class="card">
                                                    <div>
                                                        <a style="color: white !important; float: right; margin: 15px;" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-user-check"></i> agregar participante</a>
                                                    </div>
                                                    <div style="padding: 15px 0px 0px 15px;">
                                                        <p>
                                                            Listado de personas que estan invitadas actualmente <br> <b>SELECCIONA UNA PERSONA PARA ELIMINARLA DE LOS INVITADOS</b>
                                                        </p>
                                                    </div>
                                                    <!-- /.card-header -->
                                                    <div class="card-body">
                                                        <table class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>Nombre Participante</th>
                                                                    <th>Tipo Contrado</th>
                                                                </tr>
                                                            </thead>
                                                            <?php
                                                            try {
                                                                $sql = "SELECT
                                                    t1.id_persona,
                                                    CONCAT_WS(' ', t1.nombres, t1.apellidos) AS nombres,
                                                    t3.jornada
                                                FROM
                                                    tbl_personas t1
                                                INNER JOIN tbl_horario_docentes t2 ON
                                                    t2.id_persona = t1.id_persona
                                                INNER JOIN tbl_jornadas t3 ON
                                                    t2.id_jornada = t3.id_jornada
                                                INNER JOIN tbl_participantes t4 ON
                                                    t4.id_persona = t1.id_persona
                                                WHERE
                                                    t4.id_reunion = $id
                                                ORDER BY
                                                    nombres ASC";
                                                                $resultado = $mysqli->query($sql);
                                                            } catch (Exception $e) {
                                                                $error = $e->getMessage();
                                                                echo $error;
                                                            }
                                                            while ($estadoacta = $resultado->fetch_assoc()) { ?>
                                                                <tr>
                                                                    <td>
                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="checkbox" id="<?php echo $estadoacta['id_persona']; ?>" name="invitados[]" value="<?php echo $estadoacta['id_persona']; ?>">
                                                                            <label class="strikethrough" for="<?php echo $estadoacta['id_persona']; ?>">
                                                                                <?php echo $estadoacta['nombres']; ?>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td><?php echo $estadoacta['jornada']; ?></td>
                                                                </tr>
                                                            <?php  }  ?>
                                                        </table>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                                <!-- /.card -->
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>


                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.modal -->
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nombre Participante</th>
                                                <th>Tipo Contrado</th>
                                            </tr>
                                        </thead>

                                        <body>
                                            <?php
                                            try {
                                                $sql = "SELECT t1.id_persona,concat_ws(' ', t1.nombres, t1.apellidos) as nombres, t3.jornada FROM tbl_personas t1 INNER JOIN tbl_horario_docentes t2 ON t2.id_persona = t1.id_persona INNER JOIN tbl_jornadas t3 ON t2.id_jornada = t3.id_jornada ORDER BY nombres ASC";
                                                $resultado = $mysqli->query($sql);
                                            } catch (Exception $e) {
                                                $error = $e->getMessage();
                                                echo $error;
                                            }
                                            while ($estadoacta = $resultado->fetch_assoc()) { ?>
                                                <tr>
                                                    <td>
                                                        <div class="icheck-danger d-inline">
                                                            <input type="checkbox" id="<?php echo $estadoacta['id_persona']; ?>" name="chk[]" value="<?php echo $estadoacta['id_persona']; ?>">
                                                            <label for="<?php echo $estadoacta['id_persona']; ?>">
                                                                <?php echo $estadoacta['nombres']; ?>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td><?php echo $estadoacta['jornada']; ?></td>
                                                </tr>
                                            <?php  }  ?>
                                        </body>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="modal-footer justify-content-center">
                                    <a style="color: white ;" type="button" class="btn btn-success" data-dismiss="modal">Listo</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- /.modal -->


            </div>
            <!-- /.container-fluid -->
            </form>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    </div>
    <script type="text/javascript">
        function mayus(e) {
    e.value = e.value.toUpperCase();
}
        $(function() {
            $('#example1').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
            });
        });

        $(function() {
            $('input:checkbox').change(function() {
                $('button:submit').prop({
                    disabled: $('input:checkbox:checked').length = 0
                });
            });
        });
    </script>



    <script type="text/javascript">
        function marcar(source) {
            checkboxes = document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
            for (i = 0; i < checkboxes.length; i++) //recoremos todos los controles
            {
                if (checkboxes[i].type == "checkbox") //solo si es un checkbox entramos
                {
                    checkboxes[i].checked = source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
                }
            }
        }
        if (document.getElementById("enlace").value == "") {
            document.getElementById("enlace").style.display = "none";
            document.getElementById("enlaces").style.display = "none";
            document.getElementById("enlace").required = false;
        }

     

        function showInp() {
            getSelectValue = document.getElementById("tipo").value;
            if (getSelectValue == "2") {
                document.getElementById("enlace").style.display = "block";
                document.getElementById("enlace").required = true;
                document.getElementById("enlaces").style.display = "block";
            } else {
                document.getElementById("enlace").style.display = "none";
                document.getElementById("enlaces").style.display = "none";
                document.getElementById("enlace").required = false;
                document.getElementById("enlace").value = "";
            }
        }
    </script>
    <script>
        const inicio = document.getElementById("horainicio");
        const final = document.getElementById("horafinal");
        const comparaHoras = () => {
            const vInicio = inicio.value;
            const vFinal = final.value;
            if (!vInicio || !vFinal) {
                return;
            }
            const tIni = new Date();
            const pInicio = vInicio.split(":");
            tIni.setHours(pInicio[0], pInicio[1]);
            const tFin = new Date();
            const pFin = vFinal.split(":");
            tFin.setHours(pFin[0], pFin[1]);
            if (tFin.getTime() < tIni.getTime()) {
                alert("La hora final no puede menor a de inicio");
                document.getElementById('horafinal').value = ''
            }
            if (tFin.getTime() === tIni.getTime()) {
                alert("La hora inicio con la hora final no pueden ser Iguales");
                document.getElementById('horafinal').value = ''
            }
        }
        inicio.addEventListener("change", comparaHoras);
        final.addEventListener("change", comparaHoras);
    </script>
</body>

</html>
<script type="text/javascript" src="../js/funciones_registro_docentes.js"></script>
<script type="text/javascript" src="../js/validar_registrar_docentes.js"></script>

<script type="text/javascript" src="../js/pdf_mantenimientos.js"></script>
<script src="../plugins/select2/js/select2.min.js"></script>
<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- datatables JS -->
<script type="text/javascript" src="../plugins/datatables/datatables.min.js"></script>
<!-- para usar botones en datatables JS -->
<script src="../plugins/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="../plugins/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="../plugins/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="../plugins/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="../js/tipoacta-ajax.js"></script>