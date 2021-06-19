//llena el plan de asignatura
function llenar_plan() {
  var cadena = "&activar=activar";
  $.ajax({
    url: "../Controlador/plan_estudio_controlador.php?op=plan",
    type: "POST",
    data: cadena,
    success: function (r) {
      $("#cbm_plan").html(r).fadeIn();
      var o = new Option("SELECCIONAR", 0);

      $("#cbm_plan").append(o);
      $("#cbm_plan").val(0);
    },
  });
}
llenar_plan();
//llena el area de asignatura

function llenar_area() {
  var cadena = "&activar=activar";
  $.ajax({
    url: "../Controlador/plan_estudio_controlador.php?op=area",
    type: "POST",
    data: cadena,
    success: function (r) {
      $("#cbm_area").html(r).fadeIn();
      var o = new Option("SELECCIONAR", 0);

      $("#cbm_area").append(o);
      $("#cbm_area").val(0);
    },
  });
}
llenar_area();

//lena perido de asignatura
function llenar_periodo() {
  var cadena = "&activar=activar";
  $.ajax({
    url: "../Controlador/plan_estudio_controlador.php?op=periodo",
    type: "POST",
    data: cadena,
    success: function (r) {
      $("#cbm_periodo").html(r).fadeIn();
      var o = new Option("SELECCIONAR", 0);

      $("#cbm_periodo").append(o);
      $("#cbm_periodo").val(0);
    },
  });
}
llenar_periodo();

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

$("#cbm_asignaturas").change(function () {
  var id_plan_estudio = $(this).val();

  console.log(id_plan_estudio);
});


var uploadField = document.getElementById("txt_silabo");
var archivo = $("#txt_silabo").val();
uploadField.onchange = function () {
  var extensiones = archivo.substring(archivo.lastIndexOf("."));
  console.log(extensiones);
  if (extensiones != ".pdf") {
    alert("El archivo de tipo " + extensiones + "no es válido");
    document.getElementById("txt_silabo").value = "";
  }
};