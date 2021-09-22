<?php
if (isset($_SESSION["usuario"])) {

  $fechaGuardada = $_SESSION["ultimoAcceso"];
  $ahora = date("Y-n-j H:i:s");
  $tiempo_transcurrido = (strtotime($ahora) - strtotime($fechaGuardada));
  if ($tiempo_transcurrido >= 60) {
    
   header("location:logout.php");
    //sino, actualizo la fecha de la sesión
  } else {
    $_SESSION["ultimoAcceso"] = $ahora;
  } 

}
?>