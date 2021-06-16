//DE AQUI COMIENZA LA GESTION DE PLAN
var table;
function TablaPlanEstudio() {
  table = $("#tabla_plan_estudio").DataTable({
    paging: true,
    lengthChange: true,
    ordering: true,
    info: true,
    autoWidth: true,
    responsive: true,
    // LengthChange: false,
    searching: { regex: true },
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    sortable: false,
    pageLength: 15,
    destroy: true,
    async: false,
    processing: true,
    ajax: {
      url: "../Controlador/tabla_plan_estudio_controlador.php",
      type: "POST",
    },
    columns: [
      {
        defaultContent:
          "<button style='font-size:13px;' type='button' class='editar btn btn-primary '><i class='fas fa-edit'></i></button>",
      },
      {
        defaultContent:
          "<button style='font-size:13px;' type='button' class='cambiar btn btn-warning '><i class='fas fa-exchange-alt'></i></button>",
      },
      { data: "nombre_plan" },
      { data: "num_clases" },
      { data: "codigo_plan" },
      { data: "nombre_tipo_plan" },
      { data: "creditos_plan" },
      { data: "plan_vigente" },
    ],

    language: idioma_espanol,
    select: true,
  });
}
//trae los datos de la tabla gestion plan
$("#tabla_plan_estudio").on("click", ".editar", function () {
  $("#modal_editar").modal({ backdrop: "static", keyboard: false });
  $("#modal_editar").modal("show");

  var data = table.row($(this).parents("tr")).data();
  if (table.row(this).child.isShown()) {
    var data = table.row(this).data();
  }

  $("#txt_nombre_edita").val(data.nombre_plan);
  $("#txt_nombre_edita2").val(data.nombre_plan);
  $("#txt_num_clases_edita").val(data.num_clases);
  $("#txt_num_clases_edita2").val(data.num_clases);
  $("#txt_codigo_plan_edita").val(data.codigo_plan);
  $("#txt_codigo_plan_edita2").val(data.codigo_plan);
  $("#cbm_tipo_plan_edita").val(data.id_tipo_plan).trigger("change");
  $("#txt_vigente_edita").val(data.plan_vigente);
  $("#txt_vigente_edita2").val(data.plan_vigente);
  $("#id_plan_estudio").val(data.id_plan_estudio);
  $("#txt_id_tipo_plan").val(data.id_tipo_plan);
});
//select del modal
function llenar_tipo_plan() {
  var cadena = "&activar=activar";
  $.ajax({
    url: "../Controlador/plan_estudio_controlador.php?op=tipo_plan",
    type: "POST",
    data: cadena,
    success: function (r) {
      $("#cbm_tipo_plan_edita").html(r).fadeIn();
      var o = new Option("SELECCIONAR", 0);

      $("#cbm_tipo_plan_edita").append(o);
      $("#cbm_tipo_plan_edita").val(0);
    },
  });
}
llenar_tipo_plan();

//boton cambiar vigencia

$("#cambiar").click(function () {
  var vigencia = $("#txt_vigente_edita").val();

  if (vigencia == "SI") {
    $("#txt_vigente_edita").val("NO");
  } else {
    $("#txt_vigente_edita").val("SI");
  }
});

//FECHA HOY
let today = new Date();
let dd = today.getDate();
let mm = today.getMonth() + 1; //January is 0!
let yyyy = today.getFullYear();
if (dd < 10) {
  dd = "0" + dd;
}
if (mm < 10) {
  mm = "0" + mm;
}

today = yyyy + "-" + mm + "-" + dd;

$("#fecha_hoy").val(today);

//      modificar plan
$("#guardar").click(function () {
  var cbm_tipo_plan = $("#cbm_tipo_plan_edita").val();
  var txt_nombre = $("#txt_nombre_edita").val();
  var txt_num_clases = $("#txt_num_clases_edita").val();
  var txt_codigo_plan = $("#txt_codigo_plan_edita").val();
  var txt_vigente = $("#txt_vigente_edita").val();
  var fecha_modificado = $("#fecha_hoy").val();
  var nombre_usuario = $("#id_sesion").val();
  var id_usuario = $("#id_sesion_usuario").val();
  var id_plan_estudio = $("#id_plan_estudio").val();
  var txt_nombre2 = $("#txt_nombre_edita2").val();
  var txt_num_clases2 = $("#txt_num_clases_edita2").val();
  var txt_codigo_plan2 = $("#txt_codigo_plan_edita2").val();
  var txt_vigente2 = $("#txt_vigente_edita2").val();

  if (
    cbm_tipo_plan == null ||
    txt_nombre.length == 0 ||
    txt_num_clases.length == 0 ||
    txt_codigo_plan.length == 0 ||
    // cbm_tipo_plan == 0 ||
    txt_vigente.length == 0 ||
    fecha_modificado.length == 0 ||
    nombre_usuario.length == 0
  ) {
    swal({
      title: "alerta",
      text: "Llene o seleccione los campos vacios correctamente",
      type: "warning",
      showConfirmButton: true,
      timer: 15000,
    });
  } else if (cbm_tipo_plan == 0) {
    alert("Seleccione una opción válida");
  } else {
    alert("No se han modificado datos");
  }
});

//el boton de cambiar vigencia

$("#cbm_tipo_plan_edita").change(function () {
  var id_tipo_plan = $(this).val();
  $("#txt_id_tipo_plan").val(id_tipo_plan);

  if (id_tipo_plan == 0) {
    alert("Seleccione una opción válida");
    document.getElementById("cbm_tipo_plan_edita").value = "";
  }
});

$("#tabla_plan_estudio").on("click", ".cambiar", function () {
  var data = table.row($(this).parents("tr")).data();
  if (table.row(this).child.isShown()) {
    var data = table.row(this).data();
  }

  var nombre = data.nombre_plan;
  var id_plan = data.id_plan_estudio;
  var vigencia = data.plan_vigente;
  var activo = data.activo;
  var uv = data.creditos_plan;

  // console.log(nombre);
  // console.log(id_plan);
  // console.log(vigencia);
  // console.log(activo);
  // console.log(uv);

  //alert("cambio")

  // alert("la vigencia cambio");
  swal({
    title: "Estas seguro?",
    text: "Cambiar la vigencia?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      //alert(prueba);
      cambiarVigenciaPlan(id_plan, vigencia, activo, uv);

      // swal("OK");
    } else {
      //swal("Cancelado!");
    }
  });
});

function cambiarVigenciaPlan(id_plan, vigencia, activo, uv) {
  //parametros para el procedimiento
  var vigencia_si = "SI";
  var vigencia_no = "NO";
  var activo_plan_pasado = 1;
  var estado_activo_asig = 1;
  var estado_inactivo_asig = 0;

  //validando como es la vigencia del plan
  if (vigencia == "NO") {
    //LO CAMBIO A SI
    //validando que el plna no estuviera ya activo en el pasado
    if (activo == 0) {
      //alert('no esta activo');
      $.post(
        "../Controlador/plan_estudio_controlador.php?op=UVasignaturas",
        { id_plan_estudio: id_plan },
        function (data, status) {
          data = JSON.parse(data);
          //validando la suma de uv de asignaturas del plan con los creditos del plan
          if (data.uv_asig != uv) {
            alert("el plan no cumple con los requisitos de uv de asignatura");
          } else {
            // alert("esta bien");

            //desactiva los demas planes y activa este
            ponerVigentePlanNo(
              vigencia_si,
              vigencia_no,
              activo_plan_pasado,
              estado_inactivo_asig,
              estado_activo_asig,
              id_plan
            );
          }
        }
      );
    } else {
      alert("ya estuvo activo");
    }
  } else {
    
  }
}
//funcion para activar un plan cuando su vigencia es no despues
//de todas las validaciones anteriores
function ponerVigentePlanNo(
  vigencia_si,
  vigencia_no,
  activo_plan_pasado,
  estado_inactivo_asig,
  estado_activo_asig,
  id_plan
) {
  var usuario = $("#id_sesion").val();
  var fecha_hoy = $("#fecha_hoy").val();

  $.ajax({
    url: "../Controlador/modificar_plan_estudio_no_vigente_controlador.php",
    type: "POST",
    data: {
      vigencia_si: vigencia_si,
      vigencia_no: vigencia_no,
      activo_plan_pasado: activo_plan_pasado,
      estado_inactivo_asig: estado_inactivo_asig,
      estado_activo_asig: estado_activo_asig,
      id_plan: id_plan,
      modificado_por: usuario,
      fecha_primer_vigencia: fecha_hoy,
      fecha_modificacion: fecha_hoy,
     

    },
  }).done(function (resp) {
    if (resp > 0) {
      swal("Buen trabajo!", "datos insertados correctamente!", "success");
      //  document.getElementById("txt_registro").value = "";
      table.ajax.reload();
    } else {
      swal("Alerta!", "No se pudo completar la actualización", "warning");
      //document.getElementById("txt_registro").value = "";
    }
  });

}

//para poner la fecha de hoy
window.onload = function () {
  var fecha = new Date(); //Fecha actual
  var mes = fecha.getMonth() + 1; //obteniendo mes
  var dia = fecha.getDate(); //obteniendo dia
  var ano = fecha.getFullYear(); //obteniendo año
  if (dia < 10) dia = "0" + dia; //agrega cero si el menor de 10
  if (mes < 10) mes = "0" + mes; //agrega cero si el menor de 10
  document.getElementById("fecha_hoy").value = ano + "-" + mes + "-" + dia;
};