function cargartablaabajo(nombre_plan,codigo_plan) {
    // var periodo = $("#txt_num_periodo").val();
    // var anno = $("#txt_anno1").val();
  
    if (nombre_plan.length == 0 || codigo_plan.length == 0) {
     // swal("Alerta!", "ingrese datos a buscar!", "warning");
      swal({
        title: "Alerta",
        text: "Ingrese Nombre y Codigo!",
        type: "error",
        showConfirmButton: true,
        timer: 20000,
      });
    } else {
      cambiar(nombre_plan, codigo_plan);
    }
  
    console.log(nombre_plan);
    console.log(codigo_plan);
  }
  function limpiar() {
    var table3 = $("#tabla3_historial_plan").DataTable();
  
    table3.clear().draw();
  }
//datos seleccionados a la tabla
  function cambiar(a, p) {
    console.log(a);
    console.log(p);
  
    Tabla3cargar_plan(a, p);
  }
//cargar tercer tabla
var table3;
function Tabla3cargar_plan(nombre_, codigo) {
  table3 = $("#tabla3_historial_plan").DataTable({
    paging: true,
    lengthChange: true,
    ordering: true,
    info: true,
    autoWidth: true,
    responsive: false,
    ordering: true,
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
      url: "../Controlador/tabla_buscar_historial_plan_controlador.php",
      type: "POST",
      data: { nombre: nombre_, codigo_plan: codigo },
    },

    columns: [
      { data: "periodo_plan" },
      { data: "asig_vigente" },
      { data: "codigo_asig" },
      { data: "uv" },
      { data: "requisitos" },
      {
        "defaultContent": "<button class='editar btn btn-primary ' id='descargar_curriculum' name=''> <a href='' target='_blank' id='curriculum' style='color:white;font-weight: bold;'>Descargar Sílabo</a></button>"
      
      } 
    ],

    language: idioma_espanol,
    select: true,
  });
 
}

$("#tabla3_historial_plan").on("click", ".editar", function () {
  var data = table3.row($(this).parents("tr")).data();
  if (table3.row(this).child.isShown()) {
    var data = table3.row(this).data();
  }
  $("#curriculum").attr("href", data.silabo);
  var silabo=$("#curriculum").val();
  console.log(silabo);
  


});
//cargar primer tabla
var table;
function Tabla1_historial_plan() {
  table = $("#tabla1_historial_plan").DataTable({
    paging: true,
    lengthChange: true,
    ordering: true,
    info: true,
    autoWidth: true,
    responsive: false,
    ordering: true,
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
      url: "../Controlador/tabla_historial_datos_plan_controlador.php",
      type: "POST",
      
    },
    
    columns: [
      { data: "nombre" },
      { data: "codigo_plan" },
      { data: "num_clases" },
      { data: "fecha_creacion" },
      { data: "plan_vigente" },
      
      {
        defaultContent:
          
          "<div class='text-center'><div class='btn-group'><button class='ver btn btn-primary btn-m '><i class='fas fa-eye'></i></button> </div></div>",
      },
    ],

    language: idioma_espanol,
    select: true,
  });

 
}
$("#tabla1_historial_plan").on("click", ".ver", function () {
    var data = table.row($(this).parents("tr")).data();
    if (table.row(this).child.isShown()) {
      var data = table.row(this).data();
    }
    // $("#pdf").removeAttr("hidden");
    //  var btn_1 = document.getElementById("pdf");
    // btn_1.style.display = "inline";
    
    // $("#pdf").css("display", "none"); 
  
    $("#pdf").removeAttr("disabled");//habilita boton
  
     $("#nombre_busca").val(data.nombre);
    $("#codigo_busca").val(data.codigo_plan);
    $("#txt_count1").val(data.id_plan_estudio);
    
   
    var nombre_plan = $("#nombre_busca").val();
    var codigo_plan = $("#codigo_busca").val();
  
  
    cargartablaabajo(nombre_plan,codigo_plan);
    
  

  });

//PANTALLA DE COMPARAR PLANES
  //cargar segundo tabla
var table2;
function Tabla2cargar_plan() {
  table2 = $("#tabla2_historial_plan").DataTable({
    paging: true,
    lengthChange: true,
    ordering: true,
    info: true,
    autoWidth: true,
    responsive: false,
    ordering: true,
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
      url: "../Controlador/tabla_historial_plan_vigente_controlador.php",
      type: "POST",
    },

    columns: [
      { data: "periodo_plan" },
      { data: "asig_vigente" },
      { data: "codigo_asig" },
      { data: "uv" },
      { data: "requisitos" },
    ],

    language: idioma_espanol,
    select: true,
  });
 
}
//
// llenar select nombre de plan
function llenar_nombre_plan() {
  var cadena = "&activar=activar";
  $.ajax({
    url: "../Controlador/plan_estudio_controlador.php?op=nombre_plan",
    type: "POST",
    data: cadena,
    success: function (r) {
      $("#cbm_nombre_plan").html(r).fadeIn();
      var o = new Option("SELECCIONAR", 0);

      $("#cbm_nombre_plan").append(o);
      $("#cbm_nombre_plan").val(0);
    },
  });
}
llenar_nombre_plan();


  $("#cbm_nombre_plan").change(function () {
    var id_nombre_plan = $(this).val();
    $("#txt_id_nombre_plan").val(id_nombre_plan);
  
  
    if (id_nombre_plan == 0) {
      alert("Seleccione una opción válida");
      document.getElementById("cbm_nombre_plan").value = "";
    }
    var nombre_plann = cbm_nombre_plan.options[cbm_nombre_plan.selectedIndex].text;

      cargartabla4abajo(nombre_plann);
  });



//LLENAR TABLA DEL NOMBRE SELECCIONADO
function cargartabla4abajo(nombre_plann) {
  // var periodo = $("#txt_num_periodo").val();
  // var anno = $("#txt_anno1").val();

  if (nombre_plann.length == 0) {
   // swal("Alerta!", "ingrese datos a buscar!", "warning");
    swal({
      title: "Alerta",
      text: "Seleccione el Nombre !",
      type: "error",
      showConfirmButton: true,
      timer: 20000,
    });
  } else {
    cambiar_(nombre_plann);
  }

  console.log(nombre_plann);
  
}
function limpiar_() {
  var table4 = $("#tabla4_historial_plan").DataTable();

  table4.clear().draw();
}
//datos seleccionados a la tabla
function cambiar_(a) {
  console.log(a);
  

  Tabla4cargar_plan(a);
}
//cargar cuarta tabla
var table4;
function Tabla4cargar_plan(nombre_) {
table3 = $("#tabla4_historial_plan").DataTable({
  paging: true,
  lengthChange: true,
  ordering: true,
  info: true,
  autoWidth: true,
  responsive: false,
  ordering: true,
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
    url: "../Controlador/tabla_comparar_plan_controlador.php",
    type: "POST",
    data: { nombre: nombre_ },
  },

  columns: [
    { data: "periodo_plan" },
    { data: "asig_vigente" },
    { data: "codigo_asig" },
    { data: "uv" },
    { data: "requisitos" },
    
  ],


  language: idioma_espanol,
  select: true,
});

}


