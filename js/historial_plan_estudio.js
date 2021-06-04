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
      url: "../Controlador/tabla_buscar_historial_controlador.php",
      type: "POST",
      data: { nombre: nombre_, codigo_plan: codigo },
    },

    columns: [
      { data: "periodo_plan" },
      { data: "asig_vigente" },
      { data: "codigo_asig" },
      { data: "uv" },
      { data: "equi" },
      { data: "requisito" },
    ],

    language: idioma_espanol,
    select: true,
  });
 
}
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
    
  
   // seleccionar_dias($("#txt_dias_edita").val(), ",");
  });