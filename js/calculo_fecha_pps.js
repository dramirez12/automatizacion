$(document).ready(function () {

    $('#btnEnviar').on('click', function () {

        var url = "../Controlador/calculo_fecha_pps_controlador.php?op=fecha";
        $.ajax({
            type: "POST",
            url: url,
            data: $("#formulario").serialize(),
            success: function (data) {
                $('#fecha_finalizacion').val(data);

            }
        });
    });
});


$(document).ready(function () {


    $('#btn_aprobacion_rechazo_practica').on('click', function () {

        

        var cuenta_estud = $("#txt_estudiante_cuenta").val();
        var obs_prac = $("#txt_motivo_rechazo").val();
        var empresa_prac = $("#txt_empresa").val();
        var hrs_pps = $("#cb_horas_practica").val();
        var fecha_inicio_prac = $("#fecha_inicio").val();
        var fecha_final_prac = $("#fecha_finalizacion").val();
        var horario_incio_prac = $("#horario_incio").val();
        var horario_fin_prac = $("#horario_fin").val();
        var dias_prac = $("#dias").val();
        $.ajax({
            url: "../Controlador/aprobar_practica_controlador.php",
            type: "POST",
            data: {
                cuenta_estud: cuenta_estud,
                obs_prac: obs_prac,
                empresa_prac: empresa_prac,
                hrs_pps: hrs_pps,
                fecha_inicio_prac: fecha_inicio_prac,
                fecha_final_prac: fecha_final_prac,
                horario_incio_prac: horario_incio_prac,
                horario_fin_prac: horario_fin_prac,
                dias_prac: dias_prac,
            },
        }).done(function (resp) {
            if (resp > 0) {

                swal(
                    "Buen trabajo!",
                    "Datos almacenados correctamente!",
                    "success"
                );
                alert(resp);

            } else {
                swal(
                    "Alerta!",
                    "No se pudo completar la aprobacion de PPS",
                    "warning"
                );
                    alert(resp);
            }
        });
    });
});


// function aprobar_practica(){
//     var cuenta_estudid = $("#txt_estudiante_cuenta").val();
//     var obs = $("#txt_motivo_rechazo").val();
//     var empresa_prac = $("#txt_empresa").val();
//     var hrs_pps = $("#cb_horas_practica").val();
//     var fecha_inicio = $("#fecha_inicio").val();
//     var fecha_final = $("#fecha_finalizacion").val();


//     $.ajax({
//         url: "../Controlador/aprobar_practica_controlador.php",
//         type: "POST",
//         data: {
//             cuenta_estud: cuenta_estudid,
//             obs_prac: obs,
//             empresa_prac: empresa_prac,
//             hrs_pps: hrs_pps,
//             fecha_inicio_prac: fecha_inicio,
//             fecha_final_prac: fecha_final,
//         },
//       }).done(function (resp) {
//         if (resp > 0) {

//           swal(
//             "Buen trabajo!",
//             "datos actualizados correctamente!",
//             "success"
//           );

//         } else {
//           swal(
//             "Alerta!",
//             "No se pudo completar la actualización",
//             "warning"
//           );

//         }
//       });

// }
