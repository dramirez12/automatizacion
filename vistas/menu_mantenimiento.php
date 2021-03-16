<?php
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/Conexion.php');
require_once('../clases/funcion_visualizar.php');


if (permiso_ver('55') == '1') {

  $_SESSION['mantenimiento_periodo_vista'] = "...";
} else {
  $_SESSION['mantenimiento_periodo_vista'] = "No 
  tiene permisos para visualizar";
}
if (permiso_ver('56') == '1') {

  $_SESSION['mantenimiento_jornada_docente_vista'] = "...";
} else {
  $_SESSION['mantenimiento_jornada_docente_vista'] = "No 
  tiene permisos para visualizar";
}


if (permiso_ver('57') == '1') {

  $_SESSION['mantenimiento_comisiones_docente_vista'] = "...";
} else {
  $_SESSION['mantenimiento_comisiones_docente_vista'] = "No 
  tiene permisos para visualizar";
}
if (permiso_ver('59') == '1') {

  $_SESSION['mantenimiento_categorias_docente_vista'] = "...";
} else {
  $_SESSION['mantenimiento_categorias_docente_vista'] = "No 
  tiene permisos para visualizar";
}

if (permiso_ver('60') == '1') {

  $_SESSION['mantenimiento_grados_academicos_vista'] = "...";
} else {
  $_SESSION['mantenimiento_grados_academicos_vista'] = "No 
  tiene permisos para visualizar";
}
if (permiso_ver('62') == '1') {

  $_SESSION['mantenimiento_estado_civil_vista'] = "...";
} else {
  $_SESSION['mantenimiento_estado_civil_vista'] = "No 
  tiene permisos para visualizar";
}
if (permiso_ver('63') == '1') {

  $_SESSION['mantenimiento_crear_periodo_vista'] = "...";
} else {
  $_SESSION['mantenimiento_crear_periodo_vista'] = "No 
  tiene permisos para visualizar";
}

if (permiso_ver('64') == '1') {

  $_SESSION['mantenimiento_crear_comisiones_vista'] = "...";
} else {
  $_SESSION['mantenimiento_crear_comisiones_vista'] = "No 
  tiene permisos para visualizar";
}

if (permiso_ver('65') == '1') {

  $_SESSION['mantenimiento_crear_grados_academicos_vista'] = "...";
} else {
  $_SESSION['mantenimiento_crear_grados_academicos_vista'] = "No 
  tiene permisos para visualizar";
}

if (permiso_ver('66') == '1') {

  $_SESSION['mantenimiento_crear_categoria_vista'] = "...";
} else {
  $_SESSION['mantenimiento_crear_categoria_vista'] = "No 
  tiene permisos para visualizar";
}
if (permiso_ver('67') == '1') {

  $_SESSION['mantenimiento_crear_jornada_vista'] = "...";
} else {
  $_SESSION['mantenimiento_crear_jornada_vista'] = "No 
  tiene permisos para visualizar";
}
if (permiso_ver('68') == '1') {

  $_SESSION['mantenimiento_crear_estado_civil_vista'] = "...";
} else {
  $_SESSION['mantenimiento_crear_estado_civil_vista'] = "No 
  tiene permisos para visualizar";
}
if (permiso_ver('69') == '1') {

  $_SESSION['mantenimiento_horario_docente_vista'] = "...";
} else {
  $_SESSION['mantenimiento_horario_docente_vista'] = "No 
  tiene permisos para visualizar";
}
if (permiso_ver('70') == '1') {

  $_SESSION['mantenimiento_crear_horario_docente_vista'] = "...";
} else {
  $_SESSION['mantenimiento_crear_horario_docente_vista'] = "No 
  tiene permisos para visualizar";
}
if (permiso_ver('71') == '1') {

  $_SESSION['mantenimiento_genero_vista'] = "...";
} else {
  $_SESSION['mantenimiento_genero_vista'] = "No 
  tiene permisos para visualizar";
}
if (permiso_ver('72') == '1') {

  $_SESSION['mantenimiento_crear_genero_vista'] = "...";
} else {
  $_SESSION['mantenimiento_crear_genero_vista'] = "No 
  tiene permisos para visualizar";
}
if (permiso_ver('73') == '1') {

  $_SESSION['mantenimiento_nacionalidad_vista'] = "...";
} else {
  $_SESSION['mantenimiento_nacionalidad_vista'] = "No 
  tiene permisos para visualizar";
}
if (permiso_ver('74') == '1') {

  $_SESSION['mantenimiento_crear_nacionalidad_vista'] = "...";
} else {
  $_SESSION['mantenimiento_crear_nacionalidad_vista'] = "No 
  tiene permisos para visualizar";
}
if (permiso_ver('58') == '1') {

  $_SESSION['mantenimiento_edificio_vista'] = "...";
} else {
  $_SESSION['mantenimiento_edificio_vista'] = "No 
  tiene permisos para visualizar";
}
if (permiso_ver('75') == '1') {

  $_SESSION['mantenimiento_crear_edificio_vista'] = "...";
} else {
  $_SESSION['mantenimiento_crear_edificio_vista'] = "No 
  tiene permisos para visualizar";
}

if (permiso_ver('77') == '1') {

  $_SESSION['mantenimiento_atributos_vista'] = "...";
} else {
  $_SESSION['mantenimiento_atributos_vista'] = "No 
  tiene permisos para visualizar";
}

if (permiso_ver('78') == '1') {

  $_SESSION['mantenimiento_crear_atributo_vista'] = "...";
} else {
  $_SESSION['mantenimiento_crear_atributo_vista'] = "No 
  tiene permisos para visualizar";
}

if (permiso_ver(79) == '1') {

  $_SESSION['mantenimiento_actividades_vista'] = "...";
} else {
  $_SESSION['mantenimiento_actividades_vista'] = "No 
  tiene permisos para visualizar";
}


if (permiso_ver('80') == '1') {

  $_SESSION['mantenimiento_crear_actividades_vista'] = "...";
} else {
  $_SESSION['mantenimiento_crear_actividades_vista'] = "No 
  tiene permisos para visualizar";
}

if (permiso_ver('81') == '1') {

  $_SESSION['mantenimiento_aula_vista'] = "...";
} else {
  $_SESSION['mantenimiento_aula_vista'] = "No 
  tiene permisos para visualizar";
}

if (permiso_ver('82') == '1') {

  $_SESSION['mantenimiento_crear_aula_vista'] = "...";
} else {
  $_SESSION['mantenimiento_crear_aula_vista'] = "No 
  tiene permisos para visualizar";
}


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
              <h1 class="m-0 text-dark">MANTENIMIENTOS </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>

              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->



      <div class="card card-default">
          <div class="card-header">
          <h3 class="card-title">MANTENIMIENTOS CARGA </h3>
          <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
            <div class="col-md-12">


          

      <!-- /.content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row" style="  display: flex;
       align-items: center;
       justify-content: center;">

            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-light">
                <div class="inner">
                  <h4>Crear Aulas</h4>
                  <p><?php echo $_SESSION['mantenimiento_crear_aula_vista']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-plus-square"></i>
                </div>

                <a href="../vistas/mantenimiento_crear_aula_vista.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
              <!-- /.info-box -->
            </div>
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-primary">
                <div class="inner">
                  <h4>Mantenimiento Aulas </h4>
                  <p><?php echo $_SESSION['mantenimiento_aula_vista']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-edit"></i>
                </div>

                <a href="../vistas/mantenimiento_aula_vista.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
              <!-- /.info-box -->
            </div>

            <!-- /.row -->
          </div>
          <!--/. container-fluid -->
        </div>
      </section>


      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row" style="  display: flex;
    align-items: center;
    justify-content: center;">



            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-light">
                <div class="inner">
                  <h4>Crear Periodo </h4>
                  <p><?php echo $_SESSION['mantenimiento_crear_periodo_vista']; ?></p>
                </div>
                <div class="icon">
                  <i class="far fa-plus-square"></i>
                </div>
                <a href="../vistas/mantenimiento_crear_periodo_vista.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-primary">
                <div class="inner">
                  <h4>Mantenimiento Periodo </h4>
                  <p><?php echo $_SESSION['mantenimiento_periodo_vista']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-edit"></i>
                </div>
                <a href="../vistas/mantenimiento_periodo_vista.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.row -->
          </div>
          <!--/. container-fluid -->
        </div>
      </section>
      <!-- /.content -->



      <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row" style="  display: flex;
    align-items: center;
    justify-content: center;">

            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-light">
                <div class="inner">
                  <h4>Crear edificio</h4>
                  <p><?php echo $_SESSION['mantenimiento_crear_edificio_vista']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-plus-square"></i>
                </div>

                <a href="../vistas/mantenimiento_crear_edificio_vista.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
              <!-- /.info-box -->
            </div>
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-primary">
                <div class="inner">
                  <h4>Mantenimiento Edificio </h4>
                  <p><?php echo $_SESSION['mantenimiento_edificio_vista']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-edit"></i>
                </div>

                <a href="../vistas/mantenimiento_edificio_vista.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
              <!-- /.info-box -->
            </div>

            <!-- /.row -->
          </div>
          <!--/. container-fluid -->
        </div>
      </section>


       <!-- /.info-box -->
       <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row" style="  display: flex;
    align-items: center;
    justify-content: center;">
            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-light">
                <div class="inner">
                  <h4>Crear Horario </h4>
                  <p><?php echo $_SESSION['mantenimiento_crear_horario_docente_vista']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-plus-square"></i>
                </div>

                <a href="../vistas/mantenimiento_crear_horario_docente_vista.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

            </div>
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>
            <!-- /.info-box -->
            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-primary">
                <div class="inner">
                  <h4>Mantenimiento Horarios </h4>
                  <p><?php echo $_SESSION['mantenimiento_horario_docente_vista']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-edit"></i>
                </div>

                <a href="../vistas/mantenimiento_horario_docente_vista.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

            </div>
            <!-- /.row -->
          </div>
          <!--/. container-fluid -->
        </div>
      </section>


  <!-- /.form-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-body -->
            </div>







    
      <div class="card card-default">
          <div class="card-header">
          <h3 class="card-title">MANTENIMIENTOS DOCENTES </h3>
          <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
            <div class="col-md-12">
              
     
        

      <!-- /.info-box -->
      <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row" style="  display: flex;
    align-items: center;
    justify-content: center;">
            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-light">
                <div class="inner">
                  <h4>Crear Comision </h4>
                  <p><?php echo $_SESSION['mantenimiento_crear_comisiones_vista']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-plus-square"></i>
                </div>

                <a href="../vistas/mantenimiento_crear_comisiones_vista.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

            </div>
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>
            <!-- /.info-box -->
            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-primary">
                <div class="inner">
                  <h4>Mantenimiento Comisiones </h4>
                  <p><?php echo $_SESSION['mantenimiento_comisiones_docente_vista']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-edit"></i>
                </div>

                <a href="../vistas/mantenimiento_comisiones_docente_vista.php" class="small-box-footer">
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
      <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row" style="  display: flex;
    align-items: center;
    justify-content: center;">

            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-light">
                <div class="inner">
                  <h4>Crear Grados Academicos </h4>
                  <p><?php echo $_SESSION['mantenimiento_crear_grados_academicos_vista']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-plus-square"></i>
                </div>

                <a href="../vistas/mantenimiento_crear_grados_academicos_vista.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
              <!-- /.info-box -->
            </div>
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-primary">
                <div class="inner">
                  <h4>Mantenimiento Grados Academicos </h4>
                  <p><?php echo $_SESSION['mantenimiento_grados_academicos_vista']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-edit"></i>
                </div>

                <a href="../vistas/mantenimiento_grados_academicos_vista.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.row -->
          </div>
          <!--/. container-fluid -->
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row" style="  display: flex;
    align-items: center;
    justify-content: center;">

            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-light">
                <div class="inner">
                  <h4>Crear Categoria </h4>
                  <p><?php echo $_SESSION['mantenimiento_crear_categoria_vista']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-plus-square"></i>
                </div>

                <a href="../vistas/mantenimiento_crear_categoria_vista.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
              <!-- /.info-box -->
            </div>
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-primary">
                <div class="inner">
                  <h4>Mantenimiento Categorias </h4>
                  <p><?php echo $_SESSION['mantenimiento_categorias_docente_vista']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-edit"></i>
                </div>

                <a href="../vistas/mantenimiento_categorias_docente_vista.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.row -->
          </div>
          <!--/. container-fluid -->
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row" style="  display: flex;
    align-items: center;
    justify-content: center;">

            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-light">
                <div class="inner">
                  <h4>Crear Jornada </h4>
                  <p><?php echo $_SESSION['mantenimiento_crear_jornada_vista']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-plus-square"></i>
                </div>

                <a href="../vistas/mantenimiento_crear_jornada_vista.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
              <!-- /.info-box -->
            </div>
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-4">
              <div class="small-box bg-primary">
                <div class="inner">
                  <h4>Mantenimiento Jornadas </h4>
                  <p><?php echo $_SESSION['mantenimiento_jornada_docente_vista']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-edit"></i>
                </div>

                <a href="../vistas/mantenimiento_jornadas_docente_vista.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

            </div>

            <!-- /.row -->
          </div>
          <!--/. container-fluid -->
        </div>
      </section>
      <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row" style="  display: flex;
    align-items: center;
    justify-content: center;">

            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-light">
                <div class="inner">
                  <h4>Crear Estado Civil </h4>
                  <p><?php echo $_SESSION['mantenimiento_crear_estado_civil_vista']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-plus-square"></i>
                </div>

                <a href="../vistas/mantenimiento_crear_estado_civil_vista.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
              <!-- /.info-box -->
            </div>
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-primary">
                <div class="inner">
                  <h4>Mantenimiento Estado Civil </h4>
                  <p><?php echo $_SESSION['mantenimiento_estado_civil_vista']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-edit"></i>
                </div>

                <a href="../vistas/mantenimiento_estado_civil_vista.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
              <!-- /.info-box -->
            </div>

            <!-- /.row -->
          </div>
          <!--/. container-fluid -->
        </div>
      </section>


     

      <!-- /.content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row" style="  display: flex;
    align-items: center;
    justify-content: center;">

            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-light">
                <div class="inner">
                  <h4>Crear Genero </h4>
                  <p><?php echo $_SESSION['mantenimiento_crear_genero_vista']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-plus-square"></i>
                </div>

                <a href="../vistas/mantenimiento_crear_genero_vista.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
              <!-- /.info-box -->
            </div>
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-primary">
                <div class="inner">
                  <h4>Mantenimiento Género </h4>
                  <p><?php echo $_SESSION['mantenimiento_genero_vista']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-edit"></i>
                </div>

                <a href="../vistas/mantenimiento_genero_vista.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>



              <!-- /.info-box -->
            </div>

            <!-- /.row -->
          </div>
          <!--/. container-fluid -->
        </div>
      </section>

       <!-- /.content -->
       <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row" style="  display: flex;
    align-items: center;
    justify-content: center;">

            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-light">
                <div class="inner">
                  <h4>Crear Nacionalidad</h4>
                  <p><?php echo $_SESSION['mantenimiento_crear_nacionalidad_vista']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-plus-square"></i>
                </div>

                <a href="../vistas/mantenimiento_crear_nacionalidad_vista.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
              <!-- /.info-box -->
            </div>
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-primary">
                <div class="inner">
                  <h4>Mantenimiento Nacionalidad </h4>
                  <p><?php echo $_SESSION['mantenimiento_nacionalidad_vista']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-edit"></i>
                </div>

                <a href="../vistas/mantenimiento_nacionalidad_vista.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
              <!-- /.info-box -->
            </div>

            <!-- /.row -->
          </div>
          <!--/. container-fluid -->
        </div>
      </section>


    


       <!-- /.content -->
       <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row" style="  display: flex;
    align-items: center;
    justify-content: center;">

            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-light">
                <div class="inner">
                  <h4>Crear Atributo</h4>
                  <p><?php echo $_SESSION['mantenimiento_crear_atributo_vista']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-plus-square"></i>
                </div>

                <a href="../vistas/mantenimiento_crear_atributo_vista.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
              <!-- /.info-box -->
            </div>
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-primary">
                <div class="inner">
                  <h4>Mantenimiento Atributos </h4>
                  <p><?php echo $_SESSION['mantenimiento_atributos_vista']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-edit"></i>
                </div>

                <a href="../vistas/mantenimiento_atributos_vista.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
              <!-- /.info-box -->
            </div>

            <!-- /.row -->
          </div>
          <!--/. container-fluid -->
        </div>
      </section>



       <!-- /.content -->
       <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row" style="  display: flex;
       align-items: center;
       justify-content: center;">

            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-light">
                <div class="inner">
                  <h4>Crear Actividades</h4>
                  <p><?php echo $_SESSION['mantenimiento_crear_actividades_vista']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-plus-square"></i>
                </div>

                <a href="../vistas/mantenimiento_crear_actividades_vista.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
              <!-- /.info-box -->
            </div>
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-primary">
                <div class="inner">
                  <h4>Mantenimiento Actividades </h4>
                  <p><?php echo $_SESSION['mantenimiento_actividades_vista']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-edit"></i>
                </div>

                <a href="../vistas/mantenimiento_actividades_vista.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
              <!-- /.info-box -->
            </div>

            <!-- /.row -->
          </div>
          <!--/. container-fluid -->
        </div>
      </section>

<!-- /.form-group -->
       </div>  
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          </div>
  





  </div>

  </div>

</body>

</html>