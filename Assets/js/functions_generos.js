
var tableRoles;

document.addEventListener('DOMContentLoaded', function(){


    var $table = $('#tableb');
    $table.bootstrapTable({
         url:" "+base_url+"/Generos/getGeneros",
         search: true,
         pagination: true,
         buttonsClass: 'primary',
         showFooter: true,
         minimumCountColumns: 2,
         columns: [{
             field: 'num',
             title: '#',
             sortable: true,
         },{
             field: 'genero',
             title: 'Generos',
             sortable: true,
         },{
            field: 'action',
            title: 'Accion',
            sortable: true,
        }, ],

      });


}); 

//NUEVO GENERO 

$("#formGenero").submit(function(e) {

    e.preventDefault(); 
    var form = $(this);

  
    if($('#txtNombre').val() == '')
    {
        swal("Atención", "Todos los campos son obligatorios." , "error");
        return false;
    }
    
    $.ajax({
        type: "POST",
        url: base_url+'/Generos/setGenero',
        data: form.serialize(),
        success: function(data)
        {
            var objData = JSON.parse(data);
            if(objData.status)
            {
                if(objData.opcion=='1'){
                    swal("Guardado", objData.msg ,"success");
                }else{
                    swal("Actualizado", objData.msg ,"success");
                }
                $('#modalFormRol').modal("hide");
                formGenero.reset();
               
                $('#tableb').bootstrapTable('refresh')
             
            }else{
                swal("Error", objData.msg , "error");
            }  
        }
    });
    
});



function openModal(){

    $('#idG').val("");
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Genero";
    document.querySelector("#formGenero").reset();
	$('#modalFormRol').modal('show');
}



function fntEditRol(g){


            document.querySelector('#titleModal').innerHTML ="Actualizar Genero";
            document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
            document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
            document.querySelector('#btnText').innerHTML ="Actualizar";

            let idrol = g.getAttribute("rl");
         
            $.ajax({
                type: "GET",
                url: base_url+'/Generos/getGenero/'+idrol,// serializes the form's elements.
                success: function(data)
                {
                    let objData = JSON.parse(data);
                    if(objData.status)
                    {
                        document.querySelector("#idG").value = objData.data.idGenero;
                        document.querySelector("#txtNombre").value = objData.data.nombreGenero;

                        $('#modalFormRol').modal('show');
                    }else{
                        swal("Error", objData.msg , "error");
                    } 
                }
            });
            
       
   
}

function fntDelRol(g){
  
            var idrol = g.getAttribute("rl");
            swal({
                title: "Eliminar Genero",
                text: "¿Realmente quiere eliminarlo?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, eliminar!",
                cancelButtonText: "No, cancelar!",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function(isConfirm) {
                
                if (isConfirm) 
                {
                    

                    $.ajax({
                        type: "POST",
                        url: base_url+'/Generos/delGenero/',
                        data: {idg:idrol}, 
                        success: function(data)
                        {
                            let objData = JSON.parse(data);
                                if(objData.status)
                                {
                                    swal("Eliminar!", objData.msg , "success");
                                    $('#tableb').bootstrapTable('refresh')
                                }else{
                                    swal("Atención!", objData.msg , "error");
                                } 
                        }
                    });




                }

            });

  
}



