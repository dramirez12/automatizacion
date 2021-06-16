// $(document).ready(function () {

//     $("#importar").on("click", function () {

//         var importar_excel = $('#archivo_excel')[0].files[0];

//         let formData = new FormData();
//         formData.append('archivo_excel', importar_excel);

//         $.ajax({
//             url: '../Controlador/importar_carga_controlador.php',
//             type: 'POST',
//             data: formData,
//             contentType: false,
//             processData: false,

//             success: function (data) {
//                 console.log(data);

//             }
//         });

//     });
// });



function cargar_excel(){

    var excel = $("#archivo_excel").val();

    if (excel === "") {
        
        alert("ni idea");
    }

    var formData = new FormData();
    var files = $("#archivo_excel")[0].files[0];

    formData.append("archivoExcel", files);

    $.ajax({
        url: "../Controlador/importar_carga_controlador.php?op=cargarExcel",
        type: "post",
        data: formData,
        contentType: false,
        processData: false,
        success: function (respuesta) {

            $("#div_tabla").html(respuesta);

        },
    });
    return false;
};