<?php

Require_once ('../clases/Conexion.php');





			if (session_status() === PHP_SESSION_NONE){session_start();} 



      
       

$sql_permisos="select pu.visualizar ,p.id_objeto from tbl_permisos_usuarios pu ,tbl_objetos p,tbl_usuarios u ,tbl_roles r where r.id_rol=pu.id_rol and r.id_rol=u.id_rol and pu.id_objeto=p.id_objeto and id_usuario=".$_SESSION['id_usuario']." ";

$resultado_permisos = $mysqli->query($sql_permisos);

/*Botones principales*/
   $_SESSION['btn_seguridad']='none';
   $_SESSION['btn_vinculacion']='none';
   $_SESSION['btn_solicitudes']='none';
   $_SESSION['btn_coordinacion']='none';
   $_SESSION['btn_docentes']='none';
   $_SESSION['btn_ayuda']='none';
   $_SESSION['btn_mantenimiento']='none';


   /*Menu laterales*/
   $_SESSION['pregunta_vista']='none';
   $_SESSION['usuarios_vista']='none';
   $_SESSION['roles_vista']='none';
   $_SESSION['permisos_usuario_vista']='none';
   $_SESSION['parametro_vista']='none';
   $_SESSION['bitacora_vista']='none';
   $_SESSION['practica_vista']='none';
   $_SESSION['supervision_vista']='none';
   $_SESSION['egresados_vista']='none';
   $_SESSION['proyectos_vinculacion_vista']='none';
   $_SESSION['final_practica']='none';
   $_SESSION['cambio_carrera']='none';
   $_SESSION['carta_egresado']='none';
   $_SESSION['equivalencias']='none';
   $_SESSION['cancelar_clases']='none';
   $_SESSION['solicitud_practica']='none';
   $_SESSION['solicitud_final_practica']='none';
   $_SESSION['solicitud_cambio_carrera']='none';
   $_SESSION['solicitud_carta_egresado']='none';
   $_SESSION['solicitud_equivalencias']='none';
   $_SESSION['solicitud_cancelar_clases']='none';
   $_SESSION['carga_academica_vista'] = 'none';
   $_SESSION['docentes_vista'] = 'none';
   $_SESSION['mantemiento_carga_academica']='none';
   $_SESSION['mantemiento_carga_academica1'] = 'none';
   $_SESSION['plan_estudio_vista'] = 'none';
   $_SESSION['mantenimiento_plan'] = 'none';

   


  while ($fila = $resultado_permisos->fetch_row())
   {
   	/*
   	echo '<script> alert("Bienvenido a nuestro sistema :  ' .$fila[0], $fila[1]. '")</script>';
       */
    if ($fila[0]=='1') 
       {
      $_SESSION['confirmacion_ver']="block";
       }
    else
       {
        $_SESSION['confirmacion_ver']="none";
       }
    permisos_a_roles_visualizar($fila[1],$_SESSION['confirmacion_ver']);
    }

    
          

 function  permisos_a_roles_visualizar($pantalla,$confirmacion)
    {
   $_SESSION['confirmacion']=$confirmacion;
  $_SESSION['pantalla']=$pantalla;
      

   /* $_SESSION['historial_registro']='none';*/

    

           if ($_SESSION['pantalla']>='1' and $_SESSION['pantalla']<='10')
       {
        if ( $_SESSION['confirmacion']=='block') 
        {
         $_SESSION['btn_seguridad']="block";

        }
       }


           if ($_SESSION['pantalla']=='14' or $_SESSION['pantalla']=='20'  or $_SESSION['pantalla']=='21')
       {
        if ( $_SESSION['confirmacion']=='block') 
        {
         $_SESSION['btn_vinculacion']="block";

        }
       }

       if ($_SESSION['pantalla']>='51')
       {
        if ( $_SESSION['confirmacion']=='block') 
        {
         $_SESSION['btn_docentes']="block";

        }
       } 
      //  if ($_SESSION['pantalla']>='51')
      //  {
      //   if ( $_SESSION['confirmacion']=='block') 
      //   {
      //    $_SESSION['btn_docentes']="block";
      //  }
      // }

      if ($_SESSION['pantalla']>='71')
       {
        if ( $_SESSION['confirmacion']=='block') 
        {
         $_SESSION['btn_ayuda']="block";

        }
       }

   if ($_SESSION['pantalla'] >= '70') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['btn_mantenimiento'] = "block";
      }
   } 
 if ($_SESSION['pantalla']=='1' or $_SESSION['pantalla']=='2')
       {
        if ( $_SESSION['confirmacion']=='block') 
        {
         $_SESSION['pregunta_vista']="block";

        }
       }

        if ($_SESSION['pantalla']=='3' or $_SESSION['pantalla']=='4')
       {
        if ( $_SESSION['confirmacion']=='block') 
        {
         $_SESSION['usuarios_vista']="block";

        }
       }
        if ($_SESSION['pantalla']=='5' or $_SESSION['pantalla']=='6')
       {
        if ( $_SESSION['confirmacion']=='block') 
        {
         $_SESSION['roles_vista']="block";

        }
       }
        if ($_SESSION['pantalla']=='7')
       {
        if ( $_SESSION['confirmacion']=='block') 
        {
         $_SESSION['parametro_vista']="block";

        }
       }
        if ($_SESSION['pantalla']=='8')
       {
        if ( $_SESSION['confirmacion']=='block') 
        {
         $_SESSION['bitacora_vista']="block";

        }
       }

        if ($_SESSION['pantalla']=='9' or $_SESSION['pantalla']=='10')
       {
        if ( $_SESSION['confirmacion']=='block') 
        {
         $_SESSION['permisos_usuario_vista']="block";

        }
       }
       

         if ($_SESSION['pantalla']=='14'  or $_SESSION['pantalla']=='18' or $_SESSION['pantalla']=='20' or $_SESSION['pantalla']=='21' or $_SESSION['pantalla']=='26'or $_SESSION['pantalla']=='27' or $_SESSION['pantalla']=='28')
       {
        if ( $_SESSION['confirmacion']=='block') 
        {
         $_SESSION['practica_vista']="block";

        }
       }
       if ($_SESSION['pantalla']=='14'  or $_SESSION['pantalla']=='18' or $_SESSION['pantalla']=='20' or $_SESSION['pantalla']=='21' or $_SESSION['pantalla']=='26'or $_SESSION['pantalla']=='27' or $_SESSION['pantalla']=='28')
       {
        if ( $_SESSION['confirmacion']=='block') 
        {
         $_SESSION['supervision_vista']="block";

        }
       }


         if ($_SESSION['pantalla']=='13' or $_SESSION['pantalla']=='15' or $_SESSION['pantalla']=='16' or $_SESSION['pantalla']=='17' or $_SESSION['pantalla']=='19' or $_SESSION['pantalla']=='39' or  $_SESSION['pantalla']=='40')
       {
        if ( $_SESSION['confirmacion']=='block') 
        {
         $_SESSION['solicitud_practica']="block";

        }
       }

           if ($_SESSION['pantalla']=='22' or $_SESSION['pantalla']=='23')
       {
        if ( $_SESSION['confirmacion']=='block') 
        {
         $_SESSION['egresados_vista']="block";

        }
       }

          if ($_SESSION['pantalla']=='24' or $_SESSION['pantalla']=='25')
       {
        if ( $_SESSION['confirmacion']=='block') 
        {
         $_SESSION['proyectos_vinculacion_vista']="block";

        }
       } 

        if ($_SESSION['pantalla']=='29')
       {
        if ( $_SESSION['confirmacion']=='block') 
        {
         $_SESSION['solicitud_final_practica']="block";

        }
       }

        if ($_SESSION['pantalla']=='30')
       {
        if ( $_SESSION['confirmacion']=='block') 
        {
         $_SESSION['solicitud_cambio_carrera']="block";

        }
       }

        if ($_SESSION['pantalla']=='31')
       {
        if ( $_SESSION['confirmacion']=='block') 
        {
         $_SESSION['solicitud_carta_egresado']="block";

        }
       }

        if ($_SESSION['pantalla']=='32')
       {
        if ( $_SESSION['confirmacion']=='block') 
        {
         $_SESSION['solicitud_equivalencias']="block";

        }
       }

        if ($_SESSION['pantalla']=='33')
       {
        if ( $_SESSION['confirmacion']=='block') 
        {
         $_SESSION['solicitud_cancelar_clases']="block";

        }
       }

        if ($_SESSION['pantalla']=='34')
       {
        if ( $_SESSION['confirmacion']=='block') 
        {
         $_SESSION['final_practica']="block";

        }
       }

        if ($_SESSION['pantalla']=='35')
       {
        if ( $_SESSION['confirmacion']=='block') 
        {
         $_SESSION['cambio_carrera']="block";

        }
       }

        if ($_SESSION['pantalla']=='36')
       {
        if ( $_SESSION['confirmacion']=='block') 
        {
         $_SESSION['carta_egresado']="block";

        }
       }

        if ($_SESSION['pantalla']=='37')
       {
        if ( $_SESSION['confirmacion']=='block') 
        {
         $_SESSION['equivalencias']="block";

        }
       }

        if ($_SESSION['pantalla']=='38')
       {
        if ( $_SESSION['confirmacion']=='block') 
        {
         $_SESSION['cancelar_clases']="block";

        }
       }



       // boton de solicitudes */
       if ($_SESSION['pantalla']>='29' and $_SESSION['pantalla']<='33' or $_SESSION['pantalla']=='13' or $_SESSION['pantalla']=='15' or $_SESSION['pantalla']=='16' or $_SESSION['pantalla']=='17' or $_SESSION['pantalla']=='19' or $_SESSION['pantalla']=='39' or  $_SESSION['pantalla']=='40' )
       {
        if ( $_SESSION['confirmacion']=='block') 
        {
         $_SESSION['btn_solicitudes']="block";

        }
       }
// boton de coordinacion */
//** las pantallas son el id de la tbl_objetos */
if ($_SESSION['pantalla']>='34' and $_SESSION['pantalla']<='38' )
       {
        if ( $_SESSION['confirmacion']=='block') 
        {
         $_SESSION['btn_coordinacion']="block";

        }
       }




   //AGREGANDO CARGA ACADEMICA
   if ($_SESSION['pantalla'] == '45' ) {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['btn_coordinacion'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '47' or $_SESSION['pantalla'] =='48' or $_SESSION['pantalla'] == '104') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['carga_academica_vista'] = "block";
      }
   }

   ///planes de estudio mantenimiento

   if ($_SESSION['pantalla'] == '95') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['mantenimiento_plan'] = "block";
      }
   }

   if ($_SESSION['pantalla'] == '99' or $_SESSION['pantalla'] == '100' or $_SESSION['pantalla'] == '101' or $_SESSION['pantalla'] == '102' or $_SESSION['pantalla'] =='107' or $_SESSION['pantalla'] == '108'or $_SESSION['pantalla'] =='109' or $_SESSION['pantalla'] == '110') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['mantenimiento_plan'] = "block";
      }
   }


   //
   //esto es docentes la vista
   if ($_SESSION['pantalla'] == '49') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['docentes_vista'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '50' or $_SESSION['pantalla'] == '54' or $_SESSION['pantalla'] == '53' or $_SESSION['pantalla'] == '51') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['docentes_vista'] = "block";
      }
   }
   //menu manteniiento carga academica
   if ($_SESSION['pantalla'] == '94') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['mantemiento_carga_academica1'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '111' or $_SESSION['pantalla'] == '93' or $_SESSION['pantalla'] == '82' or $_SESSION['pantalla'] == '60' or $_SESSION['pantalla'] == '83' or $_SESSION['pantalla'] == '58'or $_SESSION['pantalla'] == '86'or $_SESSION['pantalla'] == '85'or $_SESSION['pantalla'] =='63' or $_SESSION['pantalla'] == '55') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['mantemiento_carga_academica1'] = "block";
      }
   }
   //menu mantenimietno docente

   if ($_SESSION['pantalla'] == '70') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['mantemiento_carga_academica'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '56' or $_SESSION['pantalla'] == '57' or $_SESSION['pantalla'] == '59' or $_SESSION['pantalla'] == '61' or $_SESSION['pantalla'] == '62' or $_SESSION['pantalla'] == '64' or $_SESSION['pantalla'] == '65' or $_SESSION['pantalla'] == '66' or $_SESSION['pantalla'] == '67' or $_SESSION['pantalla'] =='68' or $_SESSION['pantalla'] == '84'or $_SESSION['pantalla'] == '73'or $_SESSION['pantalla'] == '90'or $_SESSION['pantalla'] == '91'or $_SESSION['pantalla'] =='80' or $_SESSION['pantalla'] == '81'or $_SESSION['pantalla'] == '74'or $_SESSION['pantalla'] =='75' or $_SESSION['pantalla'] == '76'or $_SESSION['pantalla'] =='77' or $_SESSION['pantalla'] =='78' or $_SESSION['pantalla'] =='79' or $_SESSION['pantalla'] =='88' or $_SESSION['pantalla'] == '89') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['mantemiento_carga_academica'] = "block";
      }
   }

  


   //menu plan de estudio
   if ($_SESSION['pantalla'] == '103') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['plan_estudio_vista'] = "block";
      }
   }

   if ($_SESSION['pantalla'] == '96' or $_SESSION['pantalla'] == '97' or $_SESSION['pantalla'] == '98' or $_SESSION['pantalla'] == '106' or $_SESSION['pantalla'] == '105' or $_SESSION['pantalla'] == '112') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['plan_estudio_vista'] = "block";
      }
   }


   
   }


?>