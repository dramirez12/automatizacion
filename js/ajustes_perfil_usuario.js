//bOTONES PARA ACTUALIZAR FOTO
function MostrarBoton() {
    $("#imagen").removeAttr("hidden");
    $("#btn_foto").removeAttr("hidden");
    $("#btn_mostrar").attr("hidden", "hidden");
    $("#btn_foto_cancelar").removeAttr("hidden");
  }
  $("#btn_foto_cancelar").click(function () {
    $("#btn_foto_cancelar").attr("hidden", "hidden");
    $("#btn_foto").attr("hidden", "hidden");
    $("#imagen").attr("hidden", "hidden");
    $("#btn_mostrar").removeAttr("hidden");
  });

 