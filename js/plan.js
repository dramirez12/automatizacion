$("#guardar").click(function () {
    var cbm_tipo_plan = $("#cbm_tipo_plan").val();
    var txt_num_acta = $("#txt_num_acta").val();
    var fecha_acta = $("#fecha_acta").val();
    var fecha_emision = $("#fecha_emision").val();
    var txt_nombre = $("#txt_nombre").val();
    var txt_codigo_plan = $("#txt_codigo_plan").val();
    var txt_num_clases = $("#txt_num_clases").val();
    var txt_creditos_plan = $("#txt_creditos_plan").val();
    var fechacreacion = $("#fechacreacion").val();
    var vigencia = "NO";
    var usuario = $("#id_sesion").val();
   
      console.log(cbm_tipo_plan);
      
    if (
      cbm_tipo_plan == null ||
      txt_num_acta.length == 0 ||
      txt_nombre.length == 0 ||
      txt_codigo_plan.length == 0 ||
      txt_num_clases.length == 0 ||
      txt_creditos_plan.length == 0 ||
      fecha_acta.length == 0 ||
      fecha_emision.length == 0 ||
      fechacreacion.length==0
    ) {
      alert("Llene todos los campos");
    } else if(cbm_tipo_plan==0) {
      alert("Seleccione tipo de plan valido")
    } else {
        // alert("si");
        insertar(
          cbm_tipo_plan,
          txt_num_acta,
          fecha_acta,
          fecha_emision,
          txt_nombre,
          txt_codigo_plan,
          txt_num_clases,
          txt_creditos_plan,
          fechacreacion,
          vigencia,
          usuario
        );

    }
    
});


function insertar(
  cbm_tipo_plan,
  txt_num_acta,
  fecha_acta,
  fecha_emision,
  txt_nombre,
  txt_codigo_plan,
  txt_num_clases,
  txt_creditos_plan,
  fechacreacion,
  vigencia,
  usuario
) {
  $.post(
    "../Controlador/plan_estudio_controlador.php?op=verificarPlanNombre",
    {
      nombre: txt_nombre,
    },

    function (data, status) {
      console.log(data);
      data = JSON.parse(data);

      if (data.registro > 0) {
        alert("Ya existe un plan con el mismo nombre");
      } else {
        $.ajax({
          url: "../Controlador/crear_plan_estudio_controlador.php",
          type: "POST",
          data: {
            id_tipo_plan: cbm_tipo_plan,
            numero_acta: txt_num_acta,
            nombre: txt_nombre,
            codigo_plan: txt_codigo_plan,
            num_clases: txt_num_clases,
            creditos_plan: txt_creditos_plan,
            fecha_acta: fecha_acta,
            fecha_emision: fecha_emision,
            fecha_creacion: fechacreacion,
            Creado_por: usuario,
            plan_vigente: vigencia,
          },
        }).done(function (resp) {
          if (resp > 0) {
            
            swal(
              "Buen trabajo!",
              "datos insertados correctamente!",
              "success"
            );
            //  document.getElementById("txt_registro").value = "";

          
          } else {
            swal("Alerta!", "No se pudo completar la actualización", "warning");
            //document.getElementById("txt_registro").value = "";
          }
        });
      }
    }
  );
}