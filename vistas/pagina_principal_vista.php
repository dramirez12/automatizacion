<?php
session_start();
require_once ('../vistas/pagina_inicio_vista.php');
require_once ('../clases/Conexion.php'); 
/* $varsesion = $_SESSION['usuario'];
if ( $varsesion == NULL || $varsesion = '') {
  echo 'Usted no tiene autorización';
  die();
} */


		if(!ISSET($_SESSION['usuario'])){
			header('location:../index.php');
		}else{
			if((time() - $_SESSION['time']) > 60){
      /* session_destroy(); */
       
			 	 header("location:logout_page.php");  
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

