//DE AQUI COMIENZA el amntenimiento DE PLAN
var table;
function TablaManteniAsignatura() {
  table = $("#tabla_asignatura").DataTable({
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
      url: "../Controlador/tabla_mantenimiento_asignatura_controlador.php",
      type: "POST",
    },
    columns: [
      {
        defaultContent:
          "<button style='font-size:13px;' type='button' class='editar btn btn-primary '><i class='fas fa-edit'></i></button>",
      },

      { data: "nombre_asig" },
      { data: "codigo" },
      { data: "uv" },
      { data: "nombre_plan" },
      { data: "nombre_area" },
      //{ data: "tipo_asignatura" },
      { data: "nombre_periodo" },
      //{ data: "nombre_plan" },
      { data: "suficiencia" },
      { data: "reposicion" },
      { data: "silabo" },
    ],

    language: idioma_espanol,
    select: true,
  });
}

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

//boton editar de la tabla de asignatura
$("#tabla_asignatura").on("click", ".editar", function () {
  var data = table.row($(this).parents("tr")).data();
  if (table.row(this).child.isShown()) {
    var data = table.row(this).data();
  }

  $("#modal_editar").modal({ backdrop: "static", keyboard: false });
  $("#modal_editar").modal("show");

  $("#id_asig").val(data.id_asignatura);
  $("#txt_codigo").val(data.codigo);
  $("#txt_codigo1").val(data.codigo);
  $("#txt_nombre").val(data.nombre_asig);
  $("#txt_nombre1").val(data.nombre_asig);
  $("#txt_uv").val(data.uv);
  $("#txt_uv1").val(data.uv);
  $("#cbm_plan").val(data.id_plan_estudio).trigger("change");
  $("#cbm_plan1").val(data.id_plan_estudio);
  $("#cbm_periodo").val(data.id_periodo_plan).trigger("change");
  $("#cbm_periodo1").val(data.id_periodo_plan);
  $("#cbm_area").val(data.id_area).trigger("change");
  $("#cbm_area1").val(data.id_area);
  $("#cbm_suficiencia").val(data.suficiencia).trigger("change");
  $("#cbm_suficiencia1").val(data.suficiencia);
  $("#cbm_reposicion").val(data.reposicion).trigger("change");
  $("#cbm_reposicion1").val(data.reposicion);

  //  $("#txt_silabo").val(data.silabo);
});

//validar que solo acepte archivos pdf
function Validar() {
  var archivo = $("#txt_silabo").val();
  var extensiones = archivo.substring(archivo.lastIndexOf("."));
  console.log(extensiones);
  if (extensiones != ".pdf") {
    alert("El archivo de tipo " + extensiones + " no es válido");
    document.getElementById("txt_silabo").value = "";
  }
}

//el documento de la asignatura silabo
function RegistrarSilabo() {
  var formData = new FormData();
  var curriculum = $("#txt_silabo")[0].files[0];
  formData.append("c", curriculum);
  formData.append("Id_asignatura", $("#id_asig").val());
  //formData.append('nombrearchivo',nombrearchivo);

  $.ajax({
    url: "../Controlador/silabo_asignatura_controlador.php",
    type: "post",
    data: formData,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta != 0) {
        // Swal(
        //   "Mensaje De Confirmacion",
        //   "Se subio el curriculum con exito",
        //   "success"
        // );
        console.log("silabo");
      }
    },
  });
  return false;
}

//modificar asignatura

$("#guardar").click(function () {
  var cbm_plan = $("#cbm_plan").val();
  var cbm_periodo = $("#cbm_periodo").val();
  var cbm_area = $("#cbm_area").val();
  var txt_uv = $("#txt_uv").val();
  var txt_codigo_asignatura = $("#txt_codigo").val();
  var txt_nombre_asignatura = $("#txt_nombre").val();
  var cbm_reposicion = $("#cbm_reposicion").val();
  var cbm_suficiencia = $("#cbm_suficiencia").val();
  var txt_silabo = $("#txt_silabo").val();
  var id_asignatura = $("#id_asig").val();
  //var tipo_asignatura = 1;

  var cbm_plan1 = $("#cbm_plan1").val();
  var cbm_periodo1 = $("#cbm_periodo1").val();
  var cbm_area1 = $("#cbm_area1").val();
  var txt_uv1 = $("#txt_uv1").val();
  var txt_codigo_asignatura1 = $("#txt_codigo1").val();
  var txt_nombre_asignatura1 = $("#txt_nombre1").val();
  var cbm_reposicion1 = $("#cbm_reposicion1").val();
  var cbm_suficiencia1 = $("#cbm_suficiencia1").val();


  if (
    cbm_plan == null ||
    txt_uv.length == 0 ||
    cbm_periodo == null ||
    txt_codigo_asignatura.length == 0 ||
    cbm_area == null ||
    txt_nombre_asignatura.length == 0 ||
    cbm_reposicion == null ||
    cbm_suficiencia == null
  ) {
    alert("no se permiten campos vacios");
  } else if (
    cbm_plan == 0 ||
    cbm_periodo == 0 ||
    cbm_area == 0 ||
    cbm_reposicion == 0 ||
    cbm_suficiencia == 0
  ) {
    alert("seleccione una opcion valida");
  } else {

    if (cbm_plan != cbm_plan1 || cbm_periodo != cbm_periodo1 || cbm_area != cbm_area1 || txt_uv != txt_uv1 || txt_codigo_asignatura != txt_codigo_asignatura1 ||
      txt_nombre_asignatura != txt_nombre_asignatura1 || cbm_reposicion != cbm_reposicion1 || cbm_suficiencia != cbm_suficiencia1||txt_silabo.length !=0) {

      if (txt_silabo.length == 0) {
        //alert("vacio");
        if ((txt_nombre_asignatura1 = !txt_nombre_asignatura)) {
          Act_asig_si_nombre(
            cbm_plan,
            cbm_periodo,
            cbm_area,
            txt_uv,
            txt_codigo_asignatura,
            txt_nombre_asignatura,
            cbm_reposicion,
            cbm_suficiencia,
            id_asignatura
          );
        } else {
          Act_asig_no_nombre(
            cbm_plan,
            cbm_periodo,
            cbm_area,
            txt_uv,
            txt_codigo_asignatura,
            txt_nombre_asignatura,
            cbm_reposicion,
            cbm_suficiencia,
            id_asignatura
          );
       
        }
      } else {
      

        if ((txt_nombre_asignatura1 = !txt_nombre_asignatura)) {
          Act_asig_silabo_si_nombre(
            cbm_plan,
            txt_nombre_asignatura,
            cbm_periodo,
            cbm_area,
            txt_uv,
            txt_codigo_asignatura,
            txt_nombre_asignatura,
            cbm_reposicion,
            cbm_suficiencia,
            id_asignatura
          );
        } else {
          Act_asig_silabo_no_nombre(
            cbm_plan,
            txt_nombre_asignatura,
            cbm_periodo,
            cbm_area,
            txt_uv,
            txt_codigo_asignatura,
            cbm_reposicion,
            cbm_suficiencia,
            id_asignatura
          );
        }
      }
    } else {
      alert("No se han modificado datos");
    }
  }
});

//se muestra despues de insertar el silabo y actualiza la tabla
function mensaje() {
  setTimeout(function () {
    swal("Bien", "Los datos se insertaron correctamente!", "success");
    $("#modal_editar").modal("hide");
    table.ajax.reload();
    limpiarSilabo();
  }, 12000);
 
}

//limpia el campo de silabo sin guardar
function limpiarSilabo() {
  document.getElementById("txt_silabo").value = "";
}

//actualiza asignatura cunado lleva silabo y cambia nombre
function Act_asig_silabo_si_nombre(
  cbm_plan,
  txt_nombre_asignatura,
  cbm_periodo,
  cbm_area,
  txt_uv,
  txt_codigo_asignatura,
  cbm_reposicion,
  cbm_suficiencia,
  id_asignatura
) {
  $.post(
    "../Controlador/plan_estudio_controlador.php?op=nombreAsignatura",
    { id_plan_estudio: cbm_plan, asignatura: txt_nombre_asignatura },
    function (data, status) {
      data = JSON.parse(data);

      if (data.suma > 0) {
        alert("Ya existe una asignatura con ese nombre!");
      } else {
        $.post(
          "../Controlador/plan_estudio_controlador.php?op=actualizarAsignatura",
          {
            id_plan_estudio: cbm_plan,
            id_periodo_plan: cbm_periodo,
            id_area: cbm_area,
            uv: txt_uv,
            codigo: txt_codigo_asignatura,
            asignatura: txt_nombre_asignatura,
            reposicion: cbm_reposicion,
            suficiencia: cbm_suficiencia,
            estado: "",
            Id_asignatura: id_asignatura,
            // id_tipo_asignatura: tipo_asignatura,
          },

          function (e) {
            RegistrarSilabo();
          }
        );
        swal({
          title: "alerta",
          text: "Por favor espere un momento",
          type: "warning",
          showConfirmButton: false,
          timer: 11000,
        });

        mensaje();
      }
    }
  );
}

//actualiza asignatura cunado lleva silabo y no cambia nombre

function Act_asig_silabo_no_nombre(
  cbm_plan,
  txt_nombre_asignatura,
  cbm_periodo,
  cbm_area,
  txt_uv,
  txt_codigo_asignatura,
  cbm_reposicion,
  cbm_suficiencia,
  id_asignatura
) {
  $.post(
    "../Controlador/plan_estudio_controlador.php?op=actualizarAsignatura",
    {
      id_plan_estudio: cbm_plan,
      id_periodo_plan: cbm_periodo,
      id_area: cbm_area,
      uv: txt_uv,
      codigo: txt_codigo_asignatura,
      asignatura: txt_nombre_asignatura,
      reposicion: cbm_reposicion,
      suficiencia: cbm_suficiencia,
      estado: "",
      Id_asignatura: id_asignatura,
      // id_tipo_asignatura: tipo_asignatura,
    },

    function (e) {
      RegistrarSilabo();
    }
  );
  swal({
    title: "alerta",
    text: "Por favor espere un momento",
    type: "warning",
    showConfirmButton: false,
    timer: 11000,
  });

  mensaje();
}

//actualiza la asignatura sin silabo cambio nombre
function Act_asig_si_nombre(
  cbm_plan,
  cbm_periodo,
  cbm_area,
  txt_uv,
  txt_codigo_asignatura,
  txt_nombre_asignatura,
  cbm_reposicion,
  cbm_suficiencia,
  id_asignatura
) {
  $.post(
    "../Controlador/plan_estudio_controlador.php?op=nombreAsignatura",
    { id_plan_estudio: cbm_plan, asignatura: txt_nombre_asignatura },
    function (data, status) {
      data = JSON.parse(data);

      if (data.suma > 0) {
        alert("Ya existe una asignatura con ese nombre!");
      } else {
        $.post(
          "../Controlador/plan_estudio_controlador.php?op=actualizarAsignatura",
          {
            id_plan_estudio: cbm_plan,
            id_periodo_plan: cbm_periodo,
            id_area: cbm_area,
            uv: txt_uv,
            codigo: txt_codigo_asignatura,
            asignatura: txt_nombre_asignatura,
            reposicion: cbm_reposicion,
            suficiencia: cbm_suficiencia,
            estado: "",
            Id_asignatura: id_asignatura,

            // id_tipo_asignatura: tipo_asignatura,
          },

          function (e) {
            swal({
              title: "Bien",
              text: "Se actualizó correctamente",
              type: "success",
              showConfirmButton: false,
              timer: 4000,
            });
            $("#modal_editar").modal("hide");
            table.ajax.reload();
          }
        );
      }
    }
  );
}

//actualiza asignatura sin silabo no cambia nombre
function Act_asig_no_nombre(
  cbm_plan,
  cbm_periodo,
  cbm_area,
  txt_uv,
  txt_codigo_asignatura,
  txt_nombre_asignatura,
  cbm_reposicion,
  cbm_suficiencia,
  id_asignatura
) {
  $.post(
    "../Controlador/plan_estudio_controlador.php?op=actualizarAsignatura",
    {
      id_plan_estudio: cbm_plan,
      id_periodo_plan: cbm_periodo,
      id_area: cbm_area,
      uv: txt_uv,
      codigo: txt_codigo_asignatura,
      asignatura: txt_nombre_asignatura,
      reposicion: cbm_reposicion,
      suficiencia: cbm_suficiencia,
      estado: "",
      Id_asignatura: id_asignatura,
      // id_tipo_asignatura: tipo_asignatura,
    },

    function (e) {
      swal({
        title: "Bien",
        text: "Se actualizó correctamente",
        type: "success",
        showConfirmButton: false,
        timer: 4000,
      });
      $("#modal_editar").modal("hide");
      table.ajax.reload();
    }
  );
}

//asignatura de servicio
function TablaManteniAsignaturaServicio() {
  table = $("#tabla_asignatura_servicio").DataTable({
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
      url: "../Controlador/tabla_mantenimiento_asignatura_servicio_controlador.php",
      type: "POST",
    },
    columns: [
      {
        defaultContent:
          "<button style='font-size:13px;' type='button' class='editar1 btn btn-primary '><i class='fas fa-edit'></i></button>",
      },

      { data: "nombre_asig" },
      { data: "codigo" },
      { data: "uv" },
      { data: "nombre_plan" },
      { data: "nombre_area" },
      //{ data: "tipo_asignatura" },
      { data: "nombre_periodo" },
      //{ data: "nombre_plan" },
      { data: "suficiencia" },
      { data: "reposicion" },
      { data: "silabo" },
    ],

    language: idioma_espanol,
    select: true,
  });
}

//boton editar de la tabla de asignatura servicio
$("#tabla_asignatura_servicio").on("click", ".editar1", function () {
  var data = table.row($(this).parents("tr")).data();
  if (table.row(this).child.isShown()) {
    var data = table.row(this).data();
  }

  $("#modal_editar").modal({ backdrop: "static", keyboard: false });
  $("#modal_editar").modal("show");

  $("#id_asig").val(data.id_asignatura);
  $("#txt_codigo").val(data.codigo);
  $("#txt_codigo1").val(data.codigo);
  $("#txt_nombre").val(data.nombre_asig);
  $("#txt_nombre1").val(data.nombre_asig);
  $("#txt_uv").val(data.uv);
  $("#txt_uv1").val(data.uv);
  $("#cbm_plan").val(data.id_plan_estudio).trigger("change");
  $("#cbm_plan1").val(data.id_plan_estudio);
  $("#cbm_periodo").val(data.id_periodo_plan).trigger("change");
  $("#cbm_periodo1").val(data.id_periodo_plan);
  $("#cbm_area").val(data.id_area).trigger("change");
  $("#cbm_area1").val(data.id_area);
  $("#cbm_suficiencia").val(data.suficiencia).trigger("change");
  $("#cbm_suficiencia1").val(data.suficiencia);
  $("#cbm_reposicion").val(data.reposicion).trigger("change");
  $("#cbm_reposicion1").val(data.reposicion);

  //  $("#txt_silabo").val(data.silabo);
});
