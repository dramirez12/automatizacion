<?php
ob_start();
session_start();
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/Conexion.php');
require_once('../clases/funcion_visualizar.php');

if (permiso_ver('144') == '1') {

    $_SESSION['nueva_reunion'] = "...";
} else {
    $_SESSION['nueva_reunion'] = "No tiene permisos para visualizar";
}

if (permiso_ver('145') == '1') {

    $_SESSION['reuniones_pendientes'] = "...";
} else {
    $_SESSION['reuniones_pendientes'] = "No tiene permisos para visualizar";
}

if (permiso_ver('146') == '1') {

    $_SESSION['lista_reunion'] = "...";
} else {
    $_SESSION['lista_reunion'] = "No tiene permisos para visualizar";
}
ob_end_flush();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Reuniones </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active">Control de actas</li>
                                <li class="breadcrumb-item active">Reuniones</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Info boxes -->
                    <div class="row" style="  display: flex; align-items: center; justify-content: center;">
                        <div class="col-6 col-sm-6 col-md-4">
                            <div class="small-box bg-light">
                                <div class="inner">
                                    <h4>Agendar Nueva Reunión </h4>
                                    <p><?php echo $_SESSION['nueva_reunion']; ?></p>
                                </div>
                                <div class="icon">
                                <i class="far fa-calendar-plus"></i>
                                </div>
                                <a href="../vistas/crear_reunion_vista.php" class="small-box-footer">
                                    Ir <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->

                        <!-- fix for small devices only -->
                        <div class="clearfix hidden-md-up"></div>



                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h4>Reuniones Pendientes</h4>
                                    <p><?php echo $_SESSION['reuniones_pendientes']; ?></p>
                                </div>
                                <div class="icon">
                                <i class="far fa-clock"></i>
                                </div>
                                <a href="../vistas/reuniones_pendientes_vista.php" class="small-box-footer">
                                    Ir <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--/. container-fluid -->
                </div>
            </section>



            <section class="content">
                <div class="container-fluid">
                    <!-- Info boxes -->
                    <div class="row" style="  display: flex; align-items: center; justify-content: center;">
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h4>Listar Reuniones</h4>
                                    <p><?php echo $_SESSION['lista_reunion']; ?></p>
                                </div>
                                <div class="icon">
                                <i class="fas fa-list-ol"></i>
                                </div>
                                <a href="../vistas/listar_reuniones_vista.php" class="small-box-footer">
                                    Ir <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <!-- /.row -->
                    </div>
                    <!--/. container-fluid -->
                </div>
            </section>
            <!-- /.content -->
        </div>

    </div>

</body>

</html>