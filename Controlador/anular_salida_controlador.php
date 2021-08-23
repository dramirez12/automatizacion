
<?php 

ob_start();
session_start();

require_once ('../clases/Conexion.php');
require_once ('../clases/funcion_permisos.php');
require_once ('../clases/funcion_bitacora.php');




$id="";
// if (isset($_GET['inventario'])) {
//     $inventario = $_GET['inventario'];
// }
$motivo = $_GET['motivo'];
$estado=$_GET['estado'];
$inventario=$_GET['inventario'];
$Id_objeto=208;

if (permisos::permiso_eliminar($Id_objeto)=='0') {

  echo '<script type="text/javascript">
                              swal({
                                   title:"",
                                   text:"Lo sentimos no tiene permiso para eliminar",
                                   type: "error",
                                   showConfirmButton: false,
                                   timer: 3000
                                });
                                $(".FormularioAjax")[0].reset();
                                               window.location = "../vistas/pagina_principal_vista.php.php";

                            </script>';
}
elseif ($estado=='PROCESADO'){
   $sql = "call proc_anular_salidas('$motivo','$inventario'); ";
   $resultado = $mysqli->query($sql);
    if($resultado === TRUE){
       bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'],'ANULÓ' , ' LA SALIDA DEL PRODUCTO CON NO.INVENTARIO  '. $inventario.' ');
 
                            echo '<script type="text/javascript">
                               swal({
                                    title:"",
                                    text:"Los datos se anularon correctamente",
                                    type: "success",
                                    showConfirmButton: false,
                                    timer: 9000
                                 });
                                 $(".FormularioAjax")[0].reset();
                window.location = "../vistas/gestion_salida_vista.php";
 
                             </script>'
                             ;                      
 
                         }else{
                            echo '<script type="text/javascript">
                                     swal({
                                        title:"",
                                        text:"El registro no puede ser eliminado",
                                        type: "error",
                                        showConfirmButton: false,
                                        timer: 3500
                                     });
                                      $(".FormularioAjax")[0].reset();
                                 </script>';
                         }


}elseif ($estado=='ANULADO')
{
   $sql = "call proc_anular_salida2('$motivo','$inventario'); ";
   $resultado = $mysqli->query($sql);
    if($resultado === TRUE){
       bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'],'RESTAURÓ' , 'LA SALIDA DEL PRODUCTO CON NO.INVENTARIO  '. $inventario.' ');
 
                            echo '<script type="text/javascript">
                               swal({
                                    title:"",
                                    text:"Los datos se restauraron correctamente",
                                    type: "success",
                                    showConfirmButton: false,
                                    timer: 9000
                                 });
                                 $(".FormularioAjax")[0].reset();
                window.location = "../vistas/gestion_salida_vista.php";
 
                             </script>'
                             ;                      
 
                         }else{
                            echo '<script type="text/javascript">
                                     swal({
                                        title:"",
                                        text:"El registro no puede ser eliminado",
                                        type: "error",
                                        showConfirmButton: false,
                                        timer: 3500
                                     });
                                      $(".FormularioAjax")[0].reset();
                                 </script>';
                         }



  
}
ob_end_flush();
?>