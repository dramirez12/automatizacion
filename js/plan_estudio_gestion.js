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
      { data: "nombre_plan" },
      { data: "num_clases" },
      { data: "codigo_plan" },
      { data: "nombre_tipo_plan" },
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
	dd = '0' + dd;
}
if (mm < 10) {
	mm = '0' + mm;
}

today = yyyy + '-' + mm + '-' + dd;

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
     cbm_tipo_plan == 0 ||
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
   } else if (txt_nombre != txt_nombre2 || txt_num_clases != txt_num_clases2 || txt_codigo_plan !=txt_codigo_plan2 ||txt_vigente!=txt_vigente2) {
     
     if (txt_vigente == txt_vigente2) {
       
        $.ajax({
          url: "../Controlador/modificar_plan_estudio_controlador.php",
          type: "POST",
          data: {
            
            nombre: txt_nombre,
            num_clases: txt_num_clases,
            codigo_plan: txt_codigo_plan,
            id_tipo_plan: cbm_tipo_plan,
            fecha_modificacion: fecha_modificado,
            modificado_por: nombre_usuario,
            id_plan_estudio: id_plan_estudio,
           // Id_usuario: id_usuario
            
          },
        }).done(function (resp) {
          if (resp > 0) {
            $("#modal_editar").modal("hide");
            swal(
              "Buen trabajo!",
              "datos actualizados correctamente!",
              "success"
            );
            //  document.getElementById("txt_registro").value = "";

            table.ajax.reload();
          } else {
            swal("Alerta!", "No se pudo completar la actualización", "warning");
            //document.getElementById("txt_registro").value = "";
          }
        });

     } else {

       alert("cambio vigencia");

     }
     
     
   } else {
     alert("No se han modificado datos")
   }


});