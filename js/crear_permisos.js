

function listar_objetos() {
   // console.log(document.querySelectorAll('.modulo-div'));
    divs=document.querySelectorAll('.modulo-div');
    i=0;
   
      
       $.post('../Controlador/objetos_controlador.php?op=listar_objetos_modulo',{
            id_modulo:0
        }, async function (data, status) {
            data= JSON.parse(data);
            
           
            divs.forEach(element => {
             //  console.log(element);
                data.forEach(element2 =>{
                   // console.log(element2);
                    if (element2[4]==element["id"]) {
                       
                       
                         $("div#"+element['id']+".modulo-div").append(' <div class=" row"><div class=" col-md-8"><div class="form-group"><tr><td class="sorting_1 "><label class="" for="">'+element2[1]+'</label></td></div></div><div class=" col-sm-4"><div class="form-group td-input" id="'+element['id']+'"><td class="td-input" " style="text-align: center;"><input class="form-control" type="checkbox" name="objeto[]" id="'+element2[0]+'" value="'+element2[0]+'"></td></tr><br></div></div></div>');
                     }
                } )
            
            
            i++;
            
        });
        
    });
    
}
function listarmodulos() {

    cadena = "&activar='activar'"

	$.ajax({
		url: "../Controlador/objetos_controlador.php?op=listar_modulos",
		type: "POST",
		data: cadena,
		success: function (r) {
            
           // console.log(r);
            
			$("#modulos").html(r).fadeIn();

           
		},
        error: function (r){
            console.log(r)
        }


	}).done(function(){
        listar_objetos();
    });

    
}

function checked_input(obj,id) {
    
    id_input=$(obj).attr('id');
    console.log($(obj))
    if ($("input#modulo_input"+id+".principal-input").attr('estado')==0) {
        console.log("activado")
        $('div#'+id+".td-input").children("input").prop('checked',true);
        $("input#modulo_input"+id+".principal-input").attr('estado','1');
        
       
      }else{
        console.log("desactivado")
        
        $('div#'+id+".td-input").children("input").prop('checked',false);
        $("input#modulo_input"+id+".principal-input").attr('estado','0');
    
      }
    
}
function marcar_objetos(id) {
    $("#"+id).prop('checked',true)
    $("#"+id).attr('disabled',true);
    
}
$(document).ready(function(){
    //console.clear();
    listarmodulos();

    $("#select_roles").on("change",function () {
        console.log($(this).val());
        var rol=$(this).val();
        $("input").removeAttr("disabled");
        $("td > input").prop("checked",false);
      //  $("td > input").prop("checked",false);
       
        $.post('../Controlador/objetos_controlador.php?op=permisos_objetos',{id_rol:rol},function(data1,status){
            data1=JSON.parse(data1);
           

            data1.forEach(index=>{
               // console.log(index);
                marcar_objetos(index[1])
            })

            })
        
    })

   
    
   


});

