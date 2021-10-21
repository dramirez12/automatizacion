//bOTONES PARA ACTUALIZAR FOTO
function MostrarBoton() {
    $("#imagen").removeAttr("hidden");
    $("#btn_foto").removeAttr("hidden");
    $("#btn_mostrar").attr("hidden", "hidden");
    $("#btn_foto_cancelar").removeAttr("hidden");
}
$("#btn_foto_cancelar").click(function() {
    $("#btn_foto_cancelar").attr("hidden", "hidden");
    $("#btn_foto").attr("hidden", "hidden");
    $("#imagen").attr("hidden", "hidden");
    $("#btn_mostrar").removeAttr("hidden");
});

function TraerDatos() {
    var id_persona = $("#id_persona").val();


    $.post(
        "../Controlador/ajustes_perfil_usuario_controlador.php?op=CargarDatos", { id_persona: id_persona },
        function(data, status) {

            data = JSON.parse(data);


            $("#foto").attr("src", data["all"][0].foto);


        }
    );
}

function TraerTelefono() {
    var id_persona = $("#id_persona").val();

    $.post(
        "../Controlador/ajustes_perfil_usuario_controlador.php?op=Cargartelefono", { id_persona: id_persona },
        function(data, status) {
            data = JSON.parse(data);

            document.getElementById("cont1").innerHTML = " " + data.valor;

        }
    );
}

function TraerCorreo() {
    var id_persona = $("#id_persona").val();

    $.post(
        "../Controlador/ajustes_perfil_usuario_controlador.php?op=CargarCorreo", { id_persona: id_persona },
        function(data, status) {
            data = JSON.parse(data);

            document.getElementById("cont2").innerHTML = " " + data.valor;
        }
    );
}
$(document).ready(function() {

    TraerDatos();
    TraerTelefono();
    TraerCorreo();
});