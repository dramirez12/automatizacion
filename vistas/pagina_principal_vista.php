<?php

require_once ('../vistas/pagina_inicio_vista.php');
require_once ('../clases/Conexion.php');

// require('../clases/sesion.php');

if (isset($_SESSION["usuario"])) {

  $fechaGuardada = $_SESSION["ultimoAcceso"];
  $ahora = date("Y-n-j H:i:s");
  $tiempo_transcurrido = (strtotime($ahora) - strtotime($fechaGuardada));
  if ($tiempo_transcurrido >= 60) {
    echo '<script>
    alert("se acabo");
    </script>';
   session_start();  
 session_destroy();  
 header('location:index.php');
    //sino, actualizo la fecha de la sesión
  } else {
    $_SESSION["ultimoAcceso"] = $ahora;
  } 

}


?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>



 

<body >
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row ">
          <div class="col-12">
              <div class="d-flex justify-content-between">
                <div class="">
                  <img src="../dist/img/lOGO_OFICIAL.jpg" alt="AdminLTE Logo" class="brand-image   img-fluid"style="opacity: .2">
                </div>	
                <div>
                <img src="../dist/img/logo-unah-blue.png" alt="AdminLTE Logo" class="brand-image  img-fluid"style="opacity: .3">
                </div>
                
                </div>
          </div>

		

		

	   </div>
	 </div>
   </section>
 </div>

 
</body>
</html>

