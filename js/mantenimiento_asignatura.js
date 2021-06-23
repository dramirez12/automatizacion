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

//llenar plan para requisito
function llenar_plan2() {
  var cadena = "&activar=activar";
  $.ajax({
    url: "../Controlador/plan_estudio_controlador.php?op=plan",
    type: "POST",
    data: cadena,
    success: function (r) {
      $("#cbm_plan_requisito").html(r).fadeIn();
      var o = new Option("SELECCIONAR", 0);

      $("#cbm_plan_requisito").append(o);
      $("#cbm_plan_requisito").val(0);
    },
  });
}
llenar_plan2();


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

//llena las asignaturas para requisito de ella
$("#cbm_plan_requisito").change(function () {
  var id_plan_estudio = $(this).val();
  console.log(id_plan_estudio);
  //  document.getElementById("txt_capacidad_edita").value = "";
  // Lista deaulas
  $.post("../Controlador/plan_estudio_controlador.php?op=id_plan", {
    id_plan_estudio: id_plan_estudio,
  }).done(function (respuesta) {
    $("#cbm_asignaturas_requisito").html(respuesta);

    // $("#cbm_requisito_asignaturas").html(respuesta);
    console.log(respuesta);
  });
});

//trae los creditos del plan 
 $("#cbm_plan").change(function () {
   var id_plan = $(this).val();
     var txt_uv = $("#txt_uv").val();
   console.log(id_plan);


     $.post(
       "../Controlador/plan_estudio_controlador.php?op=UVplan",
       { id_plan_estudio: id_plan },
       function (data_, status) {
         data_ = JSON.parse(data_);
         
         $("#txt_uv_plan").val(data_.creditos_plan);
         $("#num_clases_plan").val(data_.num_clases);
         
        
       }
   );
    $.post(
      "../Controlador/plan_estudio_controlador.php?op=contarAsignaturas",
      { id_plan_estudio: id_plan },
      function (data, status) {
        data = JSON.parse(data);
        $("#suma_clases_plan").val(data.suma);

      }
    );
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
};

//
function insertar() {
 var cbm_asignaturas = $("#cbm_asignaturas").val();

  

  console.log(cbm_asignaturas);
  $.ajax({
    type: "POST",
    url: "../Controlador/equivalencia_asignatura_plan.php",
    //  data: { array: id_area}, //capturo array
    data: {
      array: JSON.stringify(id_asignatura)
      
    },
    success: function (data) {
     // swal("Ingresado!", "Datos ingresados correctamente!", "success");
    },
  });
}

//insertar asignatura
function insertarAsignatura() {
  var cbm_plan = $("#cbm_plan").val();
  var cbm_periodo = $("#cbm_periodo").val();
  var cbm_area = $("#cbm_area").val();
  var txt_uv = $("#txt_uv").val();
  var txt_codigo_asignatura = $("#txt_codigo_asignatura").val();
  var txt_nombre_asignatura = $("#txt_nombre_asignatura").val();
  var cbm_reposicion = $("#cbm_reposicion").val();
  var cbm_suficiencia = $("#cbm_suficiencia").val();
  var txt_silabo = $("#txt_silabo").val();
  var cbm_asignaturas = $("#cbm_asignaturas").val();
  var cbm_plan1 = $("#cbm_plan1").val();
  
  var txt_uv_plan = $("#txt_uv_plan").val();
  

  if (cbm_plan == null ||
    txt_uv.length == 0 || cbm_periodo == null ||
    txt_codigo_asignatura.length == 0 || cbm_area == null ||
    txt_nombre_asignatura.length == 0 || cbm_reposicion == null ||
    txt_silabo.length == 0 || cbm_suficiencia == null ||
    cbm_asignaturas == null) {
    alert("si da");
    
  } else if (
    cbm_plan == 0 ||
    cbm_periodo == 0 ||
    cbm_area == 0 ||
    cbm_reposicion == 0 ||
    cbm_suficiencia == 0
  ) {
    alert("seleccione una opcion valida");
  } else {
  
    
    var clases_plan = document.getElementById("suma_clases_plan").value;
    var num_clases_plan = document.getElementById("num_clases_plan").value;
    
    if ((num_clases_plan + 1) > clases_plan) {
      
    alert("La asignatura excede el numero de clases asignadas al plan!");
    } else {
      
    }

   
  

    // }
    // $.post(
    //   "../Controlador/registro_docente_controlador.php?op=registar",
    //   {
    //     nombre: nombre,
    //     apellidos: apellidos,
    //     sexo: sexo,
    //     identidad: identidad,
    //     nacionalidad: nacionalidad,
    //     estado: estado,
    //     fecha_nacimiento: fecha_nacimiento,
    //     hi: hi,
    //     hf: hf,
    //     nempleado: nempleado,
    //     tipo_docente: tipo_docente,
    //     fecha_ingreso: fecha_ingreso,
    //     idjornada: idjornada,
    //     idcategoria: idcategoria,
    //   },

    //   function (e) {
    //     saveAll();
    //     saveAll2();
     
    //   }
    //);
 }
}

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
      url: "../Controlador/tabla_plan_estudio_controlador.php",
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