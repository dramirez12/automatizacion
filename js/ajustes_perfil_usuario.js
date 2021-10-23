//BOTONES PARA ACTUALIZAR FOTO
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

           var tel= document.getElementById("cont1").innerHTML = " " + data.valor;
           document.getElementById('telefono').value = tel; 
           document.getElementById("telefono_anterior").value= tel;
           

        }
    );
}

function TraerCorreo() {
    var id_persona = $("#id_persona").val();
    console.log(id_persona);

    $.post(
        "../Controlador/ajustes_perfil_usuario_controlador.php?op=CargarCorreo", { id_persona: id_persona },
        function(data, status) {
            data = JSON.parse(data);

            var correo=document.getElementById("cont2").innerHTML = " " + data.valor;
            document.getElementById('correo').value = correo;
            document.getElementById("correo_anterior").value= correo;
            


        }
    );
}
//EJECUTAR FUNCIONES
$(document).ready(function() {

    TraerDatos();
    TraerTelefono();
    TraerCorreo();
	$(document).on("click", ".btn_foto", imagen);
   
});

//PERMITIR CORREO VALIDO
/* function correovalido(correo1) {
	var expresion1 =
	  /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
  
	//////console.log(expresion1.test(correo1));
	if (expresion1.test(correo1)) {
	  return 1;
	} else {
	  return 0;
	}
  } */
  /* function addCorreo() {
	
	var correo = $("#correo").val();
  
	////console.log(correo);
  
	if (correo.length == 0) {
	  alert("Completar El Campo correo Por Favor");
	} else {
	  if (correovalido($("#correo").val()) == 0) {
		//aqui debo validar que no se agregue a la tabla ...
  
		swal("Alerta", "ingresar un correo válido", "warning");
  
	    limpiarCor(); 
		return false;
	  } else {
  
		$("#ModalCorreo").modal("hide");
	  }
	}
  } */

// GUARDAR O ACTUALIZAR INFORMACION
function guardar_informacion() {
	var telefono = $('#telefono').val();
	console.log(telefono);

    var telefono_anterior = $('#telefono_anterior').val();
	console.log(telefono_anterior);

	var correo = $('#correo').val();
	console.log(correo);
	
    var correo_anterior = $('#correo_anterior').val();
	console.log(correo_anterior);

    var id_persona = $("#id_persona").val();
	console.log(id_persona);
	var id_persona_ = $("#id_persona").val();
	console.log(id_persona_);
	
	
	if (	

		correo.length == 0 ||
		telefono.length == 0 
		
	) {
		swal({
			title: "alerta",
			text: "Por favor llene los campos vacios",
			type: "warning",
			showConfirmButton: true,
			timer: 15000,
		});

	} 
	else {	
					
			
				 $.ajax({
					url: "../Controlador/ajustes_perfil_usuario_controlador.php?op=modificar_informacion",
					type: "POST",
					data: {
						telefono:telefono,	
						id_persona: id_persona,
						telefono_anterior:telefono_anterior,
						correo:correo,
						id_persona_: id_persona_,
						correo_anterior:correo_anterior

					},
				}).done(function (resp) {
					if (resp > 0) {
						$("#myModal").modal("hide");
						swal(
							"Buen trabajo!",
							"datos actualizados correctamente!",
							"success"
						);
						location.reload();

						
					} else {
						swal("Alerta!", "No se pudo completar la actualización", "warning");
						
					}
				}); 
			

	}
}

// CAMBIAR IMAGEN DE PERFIL
function imagen() {
	var imagen = document.getElementById("imagen").value;
	if (imagen == "") {
	  alert("No ha seleccionado un archivo");
	} else {
	  var frmData = new FormData();
	  var imagen = $("#imagen").val();
	  if (imagen == "") {
		document.getElementById("imagen").hidden = true;
		document.getElementById("btn_foto").hidden = true;
		document.getElementById("btn_mostrar").hidden = false;
	  } else {
		frmData.append("imagen", $("input[name=imagen]")[0].files[0]);
		frmData.append("id_persona", $("#id_persona").val());
  
		$.ajax({
		  url: "../Controlador/ajustes_perfil_usuario_controlador.php?op=CambiarFoto",
		  type: "post",
		  data: frmData,
		  processData: false,
		  contentType: false,
		  cache: false,
  
		  success: function (data) {
			data = JSON.parse(data);
  
			$("#foto").attr("src", data);
			$("#imagen").val("");
			$("#btn_mostrar").removeAttr("hidden");
			$("#imagen").attr("hidden", "hidden");
			$("#btn_foto").attr("hidden", "hidden");
			$("#btn_foto_cancelar").attr("hidden", "hidden");
		  },
		});
  
		return false;
	  }
	}
  }

  
  //============================
  //      TAMAÑO DE FOTO       =
  //============================
  var uploadField = document.getElementById("imagen");
  
  uploadField.onchange = function () {
	if (this.files[0].size > 5242880) {
	  //alert("Archivo muy grande!");
	  swal("Error", "Archivo muy grande!", "warning");
  
	  this.value = "";
	}
  };
  //VALIDAR QUE SOLO ACEPTE ARCHIVOS IMAGEN
var d = document.getElementById("imagen");

d.onchange = function () {
  var archivo = $("#imagen").val();
  var extensiones = archivo.substring(archivo.lastIndexOf("."));
  // ////console.log(extensiones);
  if (
    extensiones != ".jpg" &&
    extensiones != ".png" &&
    extensiones != ".jpeg" &&
    extensiones != ".PNG"
  ) {
    alert("El archivo de tipo " + extensiones + " no es válido");
    document.getElementById("imagen").value = "";
  }
};
  