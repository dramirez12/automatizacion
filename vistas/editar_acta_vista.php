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
$Id_objeto = 147;
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
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Editar Acta</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                            <li class="breadcrumb-item active">Editar Acta</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <?php
            $sql = "SELECT
            t1.id_reunion,
            t1.num_acta,
            t2.nombre_reunion,
            t3.id_tipo,
            t2.nombre_reunion,
            t2.lugar,
            t2.agenda_propuesta,
            t1.desarrollo,
            t1.fecha,
            t2.hora_inicio,
            t2.hora_final,
            t2.enlace
            FROM tbl_acta t1
            INNER JOIN tbl_reunion t2 ON t2.id_reunion = t1.id_reunion
            INNER JOIN tbl_tipo_reunion_acta t3 ON t3.id_tipo = t2.id_tipo
            WHERE `id_acta` = $id ";
            $resultado = $mysqli->query($sql);
            $estado = $resultado->fetch_assoc();
            ?>
            <div class="container-fluid">
                <form role="form" name="editar-actas" id="editar-actas-archivo" method="post" action="../Modelos/modelo_acta.php" enctype="multipart/form-data">
                    <div style="padding: 0px 0 25px 0; float:right;">
                        <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
                        <input type="hidden" name="acta" value="actualizar">
                        <button style="padding-right: 15px;" type="submit" class="btn btn-success float-left" id="editar_registro" <?php echo $_SESSION['btn_crear']; ?>>Guardar Como Borrador</button>
                        <a style="color: white !important; margin: 0px 0px 0px 10px;" class="cancelar-acta btn btn-danger" href="actas_pendientes_vista.php">Cancelar</a>
                    </div><br><br><br>
                    <div class="card card-primary card-outline card-tabs">
                        <div class="card-header p-0 pt-1 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="datosgenerales-tab" data-toggle="pill" href="#datosgenerales" role="tab" aria-controls="datosgenerales" aria-selected="false">Datos Generales y Asistencia</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="datosreunion-tab" data-toggle="pill" href="#datosreunion" role="tab" aria-controls="datosreunion" aria-selected="true">Datos Reunion</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="archivos-tab" data-toggle="pill" href="#archivos" role="tab" aria-controls="archivos" aria-selected="false">Adjuntar archivos</a>
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
                                                        <label for="nombre">Nombre Reunión:</label>
                                                        <input required minlength="5" type="text" value="<?php echo $estado['nombre_reunion']; ?>" class="form-control" id="nombre" name="nombre" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tipo">Tipo de Reunión</label>
                                                        <select class="form-control" onchange="showInp()" style="width: 50%;" id="tipo" name="tipo" disabled>
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
                                                        <input required minlength="4" value="<?php echo $estado['lugar']; ?>" style="width: 90%;" type="text" class="form-control" id="lugar" name="lugar" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fecha">Fecha:</label>
                                                        <input required style="width: 40%;" value="<?php echo $estado['fecha']; ?>" type="date" class="form-control datetimepicker-input" id="fecha" name="fecha" min="<?php echo $hoy; ?>" disabled />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nacta">No. Acta:</label>
                                                        <input minlength="4" onkeyup="mayus(this);" value="<?php echo $estado['num_acta']; ?>" style="width: 90%;" type="text" class="form-control" id="nacta" minlength="5" maxlength="25" name="nacta" placeholder="Ingrese numero o codigo del acta">
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
                                                        <input disabled value="<?php echo $estado['enlace']; ?>" minlength="10" type="text" class="form-control" id="enlace" name="enlace" placeholder="Ingrese el Link de la Reunion">
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
                                                    <h3 class="card-title">Asistencia</h3>
                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Nombre Participante</th>
                                                                <th>Editar Asistencia</th>
                                                                <th>Estado Asistencia Actual</th>
                                                            </tr>
                                                        </thead>

                                                        <body>
                                                            <?php
                                                            try {
                                                                $sql = "SELECT
                                                                        CONCAT_WS(' ', t4.nombres, t4.apellidos) AS nombres,
                                                                        t1.id_persona,
                                                                        t1.id_participante,
                                                                        t1.id_estado_participante,
                                                                        t3.estado,
                                                                        t1.descripcion,
                                                                        t2.nombre_reunion,
                                                                        t5.id_acta,
                                                                        t2.id_reunion
                                                                    FROM
                                                                        tbl_participantes t1
                                                                    LEFT JOIN tbl_reunion t2 ON
                                                                        t2.id_reunion = t1.id_reunion
                                                                    LEFT JOIN tbl_estado_participante t3 ON
                                                                        t3.id_estado = t1.id_estado_participante
                                                                    LEFT JOIN tbl_personas t4 ON
                                                                        t4.id_persona = t1.id_persona
                                                                    LEFT JOIN tbl_acta t5 ON
                                                                        t5.id_reunion = t1.id_reunion
                                                                    WHERE
                                                                        t5.id_acta = $id";
                                                                $resultado = $mysqli->query($sql);
                                                            } catch (Exception $e) {
                                                                $error = $e->getMessage();
                                                                echo $error;
                                                            }
                                                            while ($estadoacta = $resultado->fetch_assoc()) { ?>
                                                                <tr>
                                                                    <td>
                                                                        <label for="">
                                                                            <?php echo $estadoacta['nombres']; ?>
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <select class="form-control" name="asistencia[<?php echo $estadoacta['id_persona'] ?>]" id="<?php echo $estadoacta['id_persona']; ?>">
                                                                                <option value="0">--------</option>
                                                                                <option value="1">ASISTIO</option>
                                                                                <option value="2">INASISTENCIA</option>
                                                                                <option value="3">EXCUSA</option>
                                                                            </select>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <label for="">
                                                                            <?php echo $estadoacta['estado']; ?>
                                                                        </label>
                                                                    </td>
                                                                </tr>
                                                            <?php  }  ?>
                                                        </body>
                                                    </table>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                        </div>
                                        <!--/.col (right) -->
                                    </div>
                                </div>
                                <div class="tab-pane fade " id="datosreunion" role="tabpanel" aria-labelledby="datosreunion-tab">
                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <h3 class="card-title">Datos de la Reunión</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-12">
                                                <!-- /.card -->
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <div class="col-12">
                                                        <!-- /.card -->
                                                        <!-- /.card-header -->
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="asunto">Agenda Propuesta:</label>
                                                                <input type="hidden" name="id_reunion" id="id_reunion" value="<?php echo $estado['id_reunion']; ?>">
                                                                <textarea required minlength="4" class="form-control" id="agenda" name="agenda" rows="5" placeholder="Ingrese Agenda Propuesta" disabled><?php echo $estado['agenda_propuesta']; ?></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="agenda">Desarrollo de la reunión</label>
                                                                <textarea onkeyup="mayus(this);" minlength="10" class="form-control" id="desarrollo" name="desarrollo" rows="10" placeholder="Ingrese lo que se hablo en la reunión"><?php echo $estado['desarrollo']; ?></textarea>
                                                            </div>
                                                        </div>
                                                        <!-- /.card -->
                                                    </div>
                                                </div>
                                                <!-- /.card -->
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="archivos" role="tabpanel" aria-labelledby="archivos-tab">
                                    <div class="card card-danger">
                                        <div class="card-header">
                                            <h3 class="card-title">Adjuntar Archivos</h3>
                                        </div>
                                        <?php
                                        $sql = "SELECT
                                                    Valor
                                                FROM
                                                    `tbl_parametros`
                                                WHERE
                                                    Parametro = 'acta_archivo_permitidos'";
                                        $resultado = $mysqli->query($sql);
                                        $aceptados = $resultado->fetch_assoc();
                                        ?>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="archivo_acta">Archivo:</label>
                                                <input style="background-color: #FFC107; border: 0;" class="form-control" type="file" id="archivo_acta" multiple name="archivo_acta[]" accept="<?php echo $aceptados['Valor']; ?>">
                                                <div style="border: 0;" class="alert alert-warning alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                    <strong><i class="fas fa-upload fa-2x"></i>⠀⠀Añada el archivo aqui para subir</strong>
                                                </div>
                                            </div>

                                            <div class="col-md-8">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Nombre Archivo</th>
                                                            <th>Formato</th>
                                                            <th>Accion</th>
                                                        </tr>
                                                    </thead>

                                                    <body>
                                                        <?php
                                                        try {
                                                            $sql = "SELECT  id_recursos,id_acta,url, formato, nombre FROM tbl_acta_recursos WHERE id_acta = $id";
                                                            $resultado = $mysqli->query($sql);
                                                        } catch (Exception $e) {
                                                            $error = $e->getMessage();
                                                            echo $error;
                                                        }
                                                        while ($estadoacta = $resultado->fetch_assoc()) { ?>
                                                            <tr>
                                                                <td>
                                                                    <label for="<?php echo $estadoacta['nombre']; ?>">
                                                                        <a target="_blank" href="<?php echo $estadoacta['url'] . $estadoacta['nombre']; ?>"><?php echo $estadoacta['nombre']; ?></a>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <?php echo $estadoacta['formato']; ?>
                                                                </td>
                                                                <td><a href="#" data-id="<?php echo $estadoacta['id_recursos']; ?>" data-tipo="acta" class="borrar_recursoacta btn btn-danger">Borrar</a></td>
                                                            </tr>
                                                        <?php  }  ?>
                                                    </body>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.row -->
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
        $("#nacta").keyup(function() {
            var ta = $("#nacta");
            letras = ta.val().replace(/ /g, "");
            ta.val(letras)
        });
        $(function() {
            $('#table1').DataTable({
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
    <?php
    $sql = "SELECT
                    Valor
                FROM
                    `tbl_parametros`
                WHERE
                    Parametro = 'acta_max_size'";
    $resultado = $mysqli->query($sql);
    $aceptados = $resultado->fetch_assoc();
    ?>
    <script>
        const MAXIMO_TAMANIO_BYTES = <?php echo $aceptados['Valor']; ?>; // 1MB = 1 millón de bytes
        // Obtener referencia al elemento
        const $miInput = document.querySelector("#archivo_acta");
        $miInput.addEventListener("change", function() {
            // si no hay archivos, regresamos
            if (this.files.length <= 0) return;
            // Validamos el primer archivo únicamente
            const archivo = this.files[0];
            if (archivo.size > MAXIMO_TAMANIO_BYTES) {
                const tamanioEnMb = MAXIMO_TAMANIO_BYTES / 1000000;
                alert(`El tamaño máximo es ${tamanioEnMb} MB`);
                // Limpiar
                $miInput.value = "";
            } else {
                // Validación pasada. Envía el formulario o haz lo que tengas que hacer
            }
        });
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
        $(function() {
            $('input:checkbox').change(function() {
                $('button:submit').prop({
                    disabled: $('input:checkbox:checked').length < 2
                });
            });
        });

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
</body>

</html>
<script type="text/javascript" src="../js/funciones_registro_docentes.js"></script>
<script type="text/javascript" src="../js/validar_registrar_docentes.js"></script>
<script type="text/javascript" src="../js/pdf_mantenimientos.js"></script>
<script src="../plugins/select2/js/select2.min.js"></script>
<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="../js/tipoacta-ajax.js"></script>
<!-- datatables JS -->
<script type="text/javascript" src="../plugins/datatables/datatables.min.js"></script>
<!-- para usar botones en datatables JS -->
<script src="../plugins/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="../plugins/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="../plugins/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="../plugins/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>