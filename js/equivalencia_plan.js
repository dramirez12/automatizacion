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
      { data: "equivalencias" },
    ],

    language: idioma_espanol,
    select: true,
  });
}

///abrir modal de tabla equivalencia
$("#tabla_equivalencia").on("click", ".editar", function () {
  var data = table.row($(this).parents("tr")).data();
  if (table.row(this).child.isShown()) {
    var data = table.row(this).data();
  }
  $("#modal_editar").modal({ backdrop: "static", keyboard: false });
  $("#modal_editar").modal("show");
  $("#txt_id_asignatura").val(data.id_asignatura);
  $("#txt_asignatura").val(data.asignatura);
  $("#txt_equivalencias").val(data.equivalencia);
  $("#cbm_plan1").val(data.id_plan_estudio).trigger("change");
  equivalencias();
});

function id_asignatura() {
  document.getElementById("txt_id_asignatura1").value =
    document.getElementById("txt_id_asignatura").value;
}
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
  //console.log(id_plan_estudio);
  //  document.getElementById("txt_capacidad_edita").value = "";
  // Lista deaulas
  $.post("../Controlador/plan_estudio_controlador.php?op=id_plan", {
    id_plan_estudio: id_plan_estudio,
  }).done(function (respuesta) {
    $("#cbm_asignaturas").html(respuesta);

    // $("#cbm_requisito_asignaturas").html(respuesta);
    //  console.log(respuesta);
  });
});

$(document).ready(function () {
  function eliminar() {
    var confirmLeave = confirm("¿Desea eliminar está equivalencia?");
    if (confirmLeave == true) {
      var id = $(this).attr("id");
      var eliminar_equivalencia = document.getElementById("tel" + id).value;
      //console.log(eliminar_equivalencia);
      $("#row" + id).remove();
      //  console.log(id);
      $.post(
        "../Controlador/equivalencia_plan_controlador.php?op=eliminar_equivalencia",
        { eliminar_equivalencia: eliminar_equivalencia },
        function (e) {}
      );

      /* swal("Buen trabajo!", "¡ Se eliminó la equivalencia!", "success"); */
    }
  }

  $(document).on("click", ".btn_remove", eliminar);

  equivalencias();
});

function equivalencias() {
  var id_asignatura = $("#txt_id_asignatura").val();

  $.post(
    "../Controlador/equivalencia_plan_controlador.php?op=id_asignatura",
    { id_asignatura: id_asignatura },
    function (data, status) {
      data = JSON.parse(data);
      //  console.log(data);
      for (i = 0; i < data.equivalencias.length; i++) {
        $("#tbl_equivalencias").append(
          '<tr id="row' +
            i +
            '">' +
            '<td id="celda' +
            i +
            '"><input maxlength="9" hidden readonly onkeyup="javascript:mascara()" id="tel' +
            i +
            '" type="tel" name="tel" class="form-control name_list" value="' +
            data["equivalencias"][i].id_equivalencia +
            '" placeholder="___-___"/></td>' +
            "<td>" +
            data["equivalencias"][i].equivalencia +
            "</td>" +
            '<td><button type="button" name="remove" id="' +
            i +
            '" class="btn btn-danger btn_remove">X</button></td>' +
            "</tr>"
        );
      }
    }
  );
  limpiar();
}

//equivalencias
/* var sendData3 = {};
var list3 = [];
var asignatura = document.getElementById("cbm_asignaturas");
var id_asignatura1 = document.getElementById("txt_id_asignatura1");

var tbl_equivalencias = document.getElementById("tbl_equivalencias");
var asignatura1 = document.getElementById("cbm_asignaturas");
var addTask3 = () => {
  var item3 = {
    id_asignatura1: id_asignatura1.value,
    asignatura: asignatura.value,

    muestra_asignatura:
      cbm_asignaturas.options[cbm_asignaturas.selectedIndex].text,
  };

  equivalencias();

  list3.push(item3);
  viewlist3();
};

var viewlist3 = () => {
  if (list3.length > 0) {
    var viewItem3 = "";
    list3.map((item3, index) => {
      item3.id = index + 1;
      viewItem3 += `<tr>`;
      viewItem3 += `<td></td>`;
      viewItem3 += `<td>${item3.muestra_asignatura}</td>`;
      viewItem3 += `<td><button type="button" name="remove" id="' + n + '" class="btn btn-danger btn_remove">X</button> </td>`;

      viewItem3 += `</tr>`;
    });
    tbl_equivalencias.innerHTML = viewItem3;

    $("#ModalTask2").modal("hide");
  }
}; */
function limpiar_arreglo() {
  list3.pop();
}
function actualizar_tabla() {
  table.ajax.reload();
}
/* function saveAll3() {
  var id_asignatura1_ = id_asignatura1.value;
  var equivalencia1_ = asignatura1.value;
  var select = $("#cbm_plan1").val();
  console.log(select);
  if (select == 0) {
    swal("Alerta!", "¡Seleccione una opcion!", "warning");
  } else {
    $.post(
      "../Controlador/equivalencia_plan_controlador.php?op=existe_equivalencias",
      { id_asignatura: id_asignatura1_, id_equivalencia: equivalencia1_ },

      function (data, status) {
       
        data = JSON.parse(data);
      

        if (id_asignatura1_ == equivalencia1_) {
          swal({
            title: "Alerta",
            text: "La asignatura es igual a la equivalencia",
            icon: "warning",
            showConfirmButton: true,
            timer: 20000,
          });
          document.getElementById("cbm_asignaturas").value = "";
          $("#ModalTask2").modal("hide");
        } else if (data == null) {
          insert_equivalencias();
        } else {
          swal({
            title: "Alerta",
            text: "La asignatura ya cuenta con está equivalencia!",
            icon: "warning",
            showConfirmButton: true,
            timer: 20000,
          });
          document.getElementById("cbm_asignaturas").value = "";
          $("#ModalTask2").modal("hide");
        }
      }
    );
  }
} */
/* function insert_equivalencias() {
  var id_asignatura = document.getElementById("txt_id_asignatura1");
  var equivalencia1 = document.getElementById("cbm_asignaturas");
  var equivalencia1_ = equivalencia1.value;
  var id_asignatura1 = id_asignatura.value;
  // console.log(equivalencia1_)
  // console.log(id_asignatura1)

  $.post(
    "../Controlador/equivalencia_plan_controlador.php?op=insertar_equivalencias",
    { id_asignatura: id_asignatura1, id_equivalencia: equivalencia1_ },

    function (data, status) {
      //  console.log(data);
      data = JSON.parse(data);
      swal("Buen trabajo!", "¡ Se insertaron nuevas equivalencias!", "success");
      limpiar_arreglo();
      equivalencias();
      
    }
  );
} */
/* function eliminar() {
  // let i = ContarTel();
  var confirmLeave = confirm(
    "¿Esta seguro de eliminar la actividad del docente?"
  );
  if (confirmLeave == true) {
    var id = $(this).attr("id");
    var eliminar_tel = document.getElementById("tel" + id).value;
    //console.log(eliminar_tel);
    $("#row" + id).remove();
    // console.log(id);
    $.post(
      "../Controlador/equivalencia_plan_controlador.php?op=eliminar_equivalencia",
      { eliminar_tel: eliminar_tel },
      function (e) {}
    );
    i--;
  }
} */

function limpiar() {
  $("#tbl_equivalencias").empty();
}
function actualizar_modal() {
  $("#tbl_equivalencias").reload();
}

function actualizar_pagina() {
  windows.location.href = windows.location.href;
}

//para nueva equivalencia
$("#nueva_equi").click(function () {
  $("#modal_nueva_equi").modal({ backdrop: "static", keyboard: false });
  $("#modal_nueva_equi").modal("show");
});

//llena el plan para equivalencia
function llenar_plan_crear() {
  var cadena = "&activar=activar";
  $.ajax({
    url: "../Controlador/plan_estudio_controlador.php?op=plan",
    type: "POST",
    data: cadena,
    success: function (r) {
      $("#cbm_plan_crear").html(r).fadeIn();
      var o = new Option("SELECCIONAR", 0);

      $("#cbm_plan_crear").append(o);
      $("#cbm_plan_crear").val(0);
    },
  });
}
llenar_plan_crear();

//lena las assignaturas vigentes
function llenar_asignatura_crear() {
  var cadena = "&activar=activar";
  $.ajax({
    url: "../Controlador/plan_estudio_controlador.php?op=asignaturaVigente",
    type: "POST",
    data: cadena,
    success: function (r) {
      $("#cbm_asignaturas_vigentes").html(r).fadeIn();
      var o = new Option("SELECCIONAR", 0);

      $("#cbm_asignaturas_vigentes").append(o);
      $("#cbm_asignaturas_vigentes").val(0);
    },
  });
}
llenar_asignatura_crear();

//llena en cascada asignaturas del plan
$("#cbm_plan_crear").change(function () {
  var id_plan_estudio = $(this).val();
  //console.log(id_plan_estudio);
  //  document.getElementById("txt_capacidad_edita").value = "";
  // Lista deaulas
  $.post("../Controlador/plan_estudio_controlador.php?op=id_plan", {
    id_plan_estudio: id_plan_estudio,
  }).done(function (respuesta) {
    $("#cbm_asignaturas_equivalencia").html(respuesta);

    // $("#cbm_requisito_asignaturas").html(respuesta);
    // console.log(respuesta);
  });
});

//las equivalencias de la asignatura
// function insertarEquivalencias() {
//   var cbm_asignaturas = $("#cbm_asignaturas_equivalencia").val();
//   var id_asignatura = $("#cbm_asignaturas_vigentes").val();

//   // console.log(id_asignatura);
//   // console.log(cbm_asignaturas);
//   $.ajax({
//     type: "POST",
//     url: "../Controlador/equivalencia_asignatura_plan_controlador.php",
//     //  data: { array: id_area}, //capturo array
//     data: {
//       array: JSON.stringify(cbm_asignaturas),
//       Id_asignatura: id_asignatura,
//     },
//     success: function (data) {
//       //  swal("Bien!", "Datos ingresados correctamente!", "success");
//       // console.log("equivalencia");
//       cerrar();
//     },
//   });

//   //table.ajax.reload();
// }

function cerrar() {
  swal("Bien!", "Datos ingresados correctamente!", "success");

  $("#modal_nueva_equi").modal("hide");
  table.ajax.reload();
  cancelar();
}
function cancelar() {
  document.getElementById("cbm_asignaturas_vigentes").value = "";
  document.getElementById("cbm_asignaturas_equivalencia").value = "";
  document.getElementById("cbm_plan_crear").value = "";
}

// $("#refres").click(function () {
//   table.ajax.reload();
// });

$("#guardar_nueva_equi").click(function () {

  bloquea();

  var cbm_asignaturas = $("#cbm_asignaturas_vigentes").val();
  var cbm_equivalencias = $("#cbm_asignaturas_equivalencia").val();
  var plan = $("#cbm_plan_crear").val();

  if (cbm_asignaturas == null || cbm_equivalencias == null) {
    alert("Seleccione los campos correctamente");
  } else if (cbm_asignaturas == 0 ||plan==0) {
    alert("seleccione una opcion valida");
  } else {
    if (cbm_asignaturas==cbm_equivalencias) {
      
      alert("la asignatura no puede equivaler a si misma!");
    } else {
        $.post(
          "../Controlador/plan_estudio_controlador.php?op=consAsigEqui",
          {
            Id_asignatura: cbm_asignaturas,
            id_equivalencias: cbm_equivalencias,
          },
          function (data, status) {
            data = JSON.parse(data);

            if (data.suma > 0) {
              alert("La asignatura ya cuenta con esa equivalencia!");
            } else {
              $.ajax({
                url: "../Controlador/equivalencia_asignatura_plan_controlador.php",
                type: "POST",
                data: {
                  Id_asignatura: cbm_asignaturas,
                  id_equivalencias: cbm_equivalencias,
                },
              }).done(function (resp) {
                if (resp > 0) {
                  swal(
                    "Buen trabajo!",
                    "datos insertados correctamente!",
                    "success"
                  );
                  $("#modal_nueva_equi").modal("hide");
                  cancelar();
                  //  document.getElementById("txt_registro").value = "";
                  table.ajax.reload();
                } else {
                  swal("Alerta!", "No se pudo completar", "warning");
                  //document.getElementById("txt_registro").value = "";
                }
              });
            }
          }
        );
    }
  
  }
});

//
var boton = document.getElementById("guardar_nueva_equi");
boton.addEventListener("click", bloquea, false);

function bloquea() {
  if (boton.disabled == false) {
    boton.disabled = true;

    setTimeout(function () {
      boton.disabled = false;
    }, 5000);
  }
}