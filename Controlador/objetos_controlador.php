<?php
session_start();
require_once "../Modelos/objetos_modelo.php";
require_once ('../clases/funcion_bitacora.php'); 

$id_objeto = isset($_POST["id_objeto"]) ? limpiarCadena1($_POST["id_objeto"]) : "";
$objeto = isset($_POST["objeto"]) ? limpiarCadena1($_POST["objeto"]) : "";
$id_modulo = isset($_POST["id_modulo"]) ? limpiarCadena1($_POST["id_modulo"]) : "";
$descripcion = isset($_POST["descripcion"]) ? limpiarCadena1($_POST["descripcion"]) : "";
$Id_objeto1=292;//registrar objetos
$Id_objeto2=293;//gestion objetos


$instancia_modelo=new objetos();

switch ($_GET["op"])
{
  

  case"listar":
   
      $rspta = $instancia_modelo->listar(); //instancia a la funcion listar

      //  
      //Vamos a declarar un array
      $data = array();
     while ($reg = $rspta->fetch_object()) {
        $boton_modificar=' <td style="text-align: center;"><a id="'.$reg->Id_objeto.'" class="btn btn-primary btn-raised btn-xs modificar_objeto" onclick="modificar(this)" data-toggle="modal" data-target="#modal_modificar_objeto"><i class="far fa-edit" style=""></i></a></td>';
        $boton_eliminar='<td style="text-align: center;"><button type="button" id="'.$reg->Id_objeto.'" class="btn btn-danger btn-raised btn-xs eliminar_objeto" onclick="eliminar(this)"><i class="far fa-trash-alt" style=""></i></button><div class="RespuestaAjax"></div></td>';
        $data[] = array(

          "0" => $reg->objeto,
          "1" => $reg->descripcion,
          "2" => $reg->nombre,
          "3" => $boton_modificar, 
         "4" => $boton_eliminar,
        );
      }
      $results = array(
        "sEcho" => 1, //Información para el datatables
        "iTotalRecords" => count($data), //enviamos el total registros al datatable
        "iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
        "aaData" => $data
      );
      echo json_encode($results);

      break;
  
  case 'registrar_objeto':
  
    $rspta= $instancia_modelo->registrar_objeto($objeto,$descripcion,$id_modulo);
    if ($rspta) {
      # code...
      bitacora::evento_bitacora($Id_objeto1, $_SESSION['id_usuario'],'INSERTO' , 'EL OBJETO '.$objeto.'');
     echo 1;
    }else{
      echo 0;
    }
   
    break;
   
  case 'actualizar_objeto':
      $rspta= $instancia_modelo->actualizar_objeto($id_objeto,$objeto,$descripcion,$id_modulo);
      
        if ($rspta) {
          # code...
        
        echo 1;
        }else{
          echo 0;
        }

    break;
  case 'mostrar':
    # code...
    $rspta=$instancia_modelo->mostrar($id_objeto);
   
    echo json_encode($rspta);
    break;
  case 'listar_objeto':


    break;
  case 'desactivar':
   break;
  case 'seleccionar_objeto':

    break;

  case 'selectModulos':
      if (isset($_POST['activar'])) {
          $data=array();
          $respuesta=$instancia_modelo->listar_select_modulos();
          echo '<option value="null" selected="" disabled="true">..SELECCIONA UNA OPCION..</option>';

            while ($r=$respuesta->fetch_object()) {
                 echo "<option value='". $r->id_modulo."'> ".$r->nombre." </option>";
             }
           }
           else{
             echo 'No hay informacion';
           }
         
    break;
  case 'listar_modulos':
    if (isset($_POST['activar'])) {
      $data=array();
      
      
      $respuesta=$instancia_modelo->listar_select_modulos();
    
        while ($r=$respuesta->fetch_object()) {
            
            echo '<div class="card card-default collapsed-card " ><div class="card-header"><h3 class="card-title">'.$r->nombre.'</h3>&nbsp;  &nbsp;  &nbsp;  &nbsp;  <input type="checkbox" estado="0" onclick="checked_input(this,'.$r->id_modulo.');" class="principal-input" name="" id="modulo_input'.$r->id_modulo.'" ><div class="card-tools" ><button type="button" name[]="" id="34" class="btn btn-tool obj-listar" data-card-widget="collapse"><i class="fas fa-plus"></i></button></div></div><!-- /.card-header --><div class="card-body" style="position: relative; display: none;" id="bodycard'.$r->id_modulo.'"><div id="'.$r->id_modulo.'" class="modulo-div"></div></div></div>';
         
        }

         
       }
       else{
         echo 'No hay informacion';
       }

    break;
  case 'listar_objetos_modulo':
      $respuesta=$instancia_modelo->listar_objeto_modulos();
      echo json_encode($respuesta->fetch_all());
      
          // while ($r=$respuesta->fetch_object()) {
              
          //     echo '<label for="">'.$r->objeto.'</label>  <input type="checkbox" name="" id="'.$r->Id_objeto.'"><br>';
            
          // }
  
  
      break;
  
  




 }




?>