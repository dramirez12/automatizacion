<?php
ob_start();

session_start();

require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/Conexion.php');
$id = $_GET['id'];
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');
require_once('../clases/funcion_permisos.php');
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
                        <h1>Editar estado</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                            <li class="breadcrumb-item active">Editar estado</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <?php
            $sql = "SELECT * FROM `tbl_estado_participante` WHERE `id_estado` = $id ";
            $resultado = $mysqli->query($sql);
            $estado = $resultado->fetch_assoc();

            ?>
            <form role="form" name="guardar-estadoparticipante" id="guardar-estadoparticipante" method="post" action="../Modelos/modelo_manparticipante.php">
                <div class="card-body" style="padding-top: 100px;">
                    <div class="form-group">
                        <label for="tipo">Nombre Estado: </label>
                        <input type="text" value="<?php echo $estado['estado']; ?>" class="form-control" class="form-control col-md-6" id="estado" name="estado" required title="Solo se permiten MAYÚSCULAS o MINÚSCULAS y no se Aceptan caracteres especiales" minlength="3" maxlength="15" pattern="[A-Za-z]{1,15}">
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <input type="hidden" name="estado-participante" value="actualizar">
                    <input type="hidden" name="id_estado" value="<?php echo $id; ?>">
                    <button type="submit" class="btn btn-success" id="editar_registro">Editar</button>
                    <a type="button" href="mantenimiento_estadoparticipante_vista.php" class="btn btn-danger" style="color: white;">Cancelar</a>
                </div>
            </form>
    </div>
    <!-- /.content-wrapper -->
    </div>




    <script type="text/javascript" language="javascript">
        function ventana() {
            window.open("../Controlador/reporte_mantenimiento_estadoactareunion_controlador.php", "REPORTE");
        }
    </script>



    <script type="text/javascript">
        $(function() {

            $('#tabla11').DataTable({
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
<script type="text/javascript" src="../js/funciones_registro_docentes.js"></script>
<script type="text/javascript" src="../js/validar_registrar_docentes.js"></script>

<script type="text/javascript" src="../js/pdf_mantenimientos.js"></script>
<script src="../plugins/select2/js/select2.min.js"></script>
<!-- datatables JS -->
<script type="text/javascript" src="../plugins/datatables/datatables.min.js"></script>
<!-- para usar botones en datatables JS -->
<script src="../plugins/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="../plugins/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="../plugins/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="../plugins/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="../js/tipoacta-ajax.js"></script>