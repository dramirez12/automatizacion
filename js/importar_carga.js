$(document).ready(function(){

    $("#importar").on("click",function(){

        var importar_excel = $('#archivo_excel')[0].files[0];

        let formData = new FormData();
        formData.append('archivo_excel', importar_excel);

        $.ajax({
            url: '../Controlador/importar_carga_controlador.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,

            success: function (data) {
                console.log(data);
                
            }
        });

    });
});