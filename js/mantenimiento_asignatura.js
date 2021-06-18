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

$(document).ready(function () {
  $('[name="check[]"]').click(function () {
    var arr = $('[name="check[]"]:checked')
      .map(function () {
        return this.value;
      })
      .get();

    $("#arr").text(JSON.stringify(arr));

    $("#sino").val(arr);

    // console.log(str);
  });
});

function name(params) {
          var limite = 1;
          $(".ch").change(function () {
            if ($("input:checked").length > limite) {
              alert("Solo puede seleccionar una opción ");
              document.getElementById("sino").value = "";
              document.getElementById("SI").checked = false;
              document.getElementById("NO").checked = false;
              this.checked = false;
            }
          });
}

