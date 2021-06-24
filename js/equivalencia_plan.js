//cargar tabla equivalencia

var table;
function TablaPlanEstudio() {
  table = $("#tabla_equivalencia").DataTable({
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
      url: "../Controlador/tabla_equivalencia_plan_controlador.php",
      type: "POST",
    },
    columns: [
      {
        defaultContent:
          "<button style='font-size:13px;' type='button' class='editar btn btn-primary '><i class='fas fa-edit'></i></button>",
      },

      { data: "asignatura" },
      { data: "equivalencia" },
    ],

    language: idioma_espanol,
    select: true,
  });
}

///abrir modal de tabla equivalencia
$("#tabla_equivalencia").on("click", ".editar", function () {
  $("#modal_editar").modal({ backdrop: "static", keyboard: false });
  $("#modal_editar").modal("show");

  var data = table.row($(this).parents("tr")).data();
  if (table.row(this).child.isShown()) {
    var data = table.row(this).data();
    }
    
    $("#txt_asignatura").val(data.asignatura);
    $("#txt_equivalencias").val(data.equivalencia);
    $("#cbm_plan1").val(data.id_plan_estudio).trigger("change");

 
});

function llenar_selectasignatura() {
  var cadena = "&activar=activar";
  $.ajax({
    url: "../Controlador/plan_estudio_controlador.php?op=asignaturas",
    type: "POST",
    data: cadena,
    success: function (r) {
      // console.log(r);

      $("#cbm_asignaturas").html(r).fadeIn();
    },
  });
}
llenar_selectasignatura();

//llena el plan para equivalencia
function llenar_plan1() {
  var cadena = "&activar=activar";
  $.ajax({
    url: "../Controlador/plan_estudio_controlador.php?op=plan",
    type: "POST",
    data: cadena,
    success: function (r) {
      
      $("#cbm_plan1").html(r).fadeIn();
      var o = new Option("SELECCIONAR", 0);

      $("#cbm_plan1").append(o);
      $("#cbm_plan1").val(0);

    },
  });
}
llenar_plan1();

//llena en cascada equivalencia que selecciona del plan
$("#cbm_plan1").change(function () {
  var id_plan_estudio = $(this).val();
  console.log(id_plan_estudio);
  //  document.getElementById("txt_capacidad_edita").value = "";
  // Lista deaulas
  $.post("../Controlador/plan_estudio_controlador.php?op=id_plan", {
    id_plan_estudio: id_plan_estudio,
  }).done(function (respuesta) {
    $("#cbm_asignaturas").html(respuesta);

   // $("#cbm_requisito_asignaturas").html(respuesta);
    console.log(respuesta);
  });
});
