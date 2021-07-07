$(document).ready(function(){ 
    
    $('#btnEnviar').on('click',function(){
        
var url = "../Controlador/calculo_fecha_pps_controlador.php?op=fecha";
$.ajax({                        
   type: "POST",                 
   url: url,                     
   data: $("#formulario").serialize(), 
   success: function(data)             
   {
    $('#fecha_finalizacion').val(data);
 
   }
});
});
});
// $(document).ready(function(){ 
    
    
//     $('#btn_aprobacion_rechazo_practica').on('click',function(){
        
// var url = "../Controlador/calculo_fecha_pps_controlador.php?op=update";
// $.ajax({                        
//    type: "POST",                 
//    url: url,                     
//    data: $("#formulario").serialize(), 
//    success: function(data)             
//    {
//        if(data==0)
//        {
//         swal({
//             title: 'Práctica aprobada con éxito',
//             type: "success",
//             button: "OK",
//           }).then(function() {
//             location.href = '../vistas/aprobar_practica_coordinacion_vista.php';
//         }); 
//        }
//        else if(data==1)
//        {
//         swal({
//             title: 'Práctica no se pudo aprobar',
//             type: "error",
//             button: "OK",
//           }).then(function() {
//             location.href = '../vistas/aprobar_practica_coordinacion_vista.php';
//         }); 
//        }
 
//    }
// });
// });
// });


function aprobar_practica(){
    var cuenta_estudid = $("#txt_estudiante_cuenta").val();
    var obs = $("#txt_motivo_rechazo").val();
    var hrs_pps = $("#cb_horas_practica").val();
    var fecha_inicio = $("#fecha_inicio").val();
    var fecha_final = $("#fecha_finalizacion").val();


    $.ajax({
        url: "../Controlador/calculo_fecha_pps_controlador.php",
        type: "POST",
        data: {
            cuenta_estud: cuenta_estudid,
            obs_prac: obs,
            empresa_prac: empresa,
            hrs_pps: hrs_pps,
            fecha_inicio_prac: fecha_inicio,
            fecha_final_prac: fecha_final,
        },
      }).done(function (resp) {
        if (resp > 0) {
          
          swal(
            "Buen trabajo!",
            "datos actualizados correctamente!",
            "success"
          );

        } else {
          swal(
            "Alerta!",
            "No se pudo completar la actualización",
            "warning"
          );
       
        }
      });

}
