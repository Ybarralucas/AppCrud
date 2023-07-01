


var tableRoles;

document.addEventListener('DOMContentLoaded', function(){


    var $table = $('#tablecan');
    $table.bootstrapTable({
         url:" "+base_url+"/Canciones/getCanciones",
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
             field: 'cancion',
             title: 'Canciones',
             sortable: true,
         },{
            field: 'action',
            title: 'Accion',
            sortable: true,
        }, ],

      });


}); 

//NUEVO GENERO 

$("#formCancion").submit(function(e) {
   

    e.preventDefault(); 
    var form = $(this);
     
  
    if($('#txtNombre').val() == '')
    {
        swal("Atención", "Todos los campos son obligatorios." , "error");
        return false;
    }
    
    $.ajax({
        type: "POST",
        url: base_url+'/Canciones/setCancion',
        data: form.serialize(), // serializes the form's elements.
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
                formCan.reset();
               
                $('#tablecan').bootstrapTable('refresh')
             
            }else {
                swal("Error", objData.msg , "error");
            }  
        }
    });
    
});

$('#tableRoles').DataTable();

function openModal(){

   
    document.querySelector('#idCan').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Agregar cancion";
    document.querySelector("#formCancion").reset();
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
                url: base_url+'/Canciones/getCancion/'+idrol,
                success: function(data)
                {
                    let objData = JSON.parse(data);
                    if(objData.status)
                    {
                        document.querySelector("#idCan").value = objData.data.idCancion;
                        document.querySelector("#txtNombre").value = objData.data.nombreCancion;
                        document.querySelector("#txtidGenero").value = objData.data.idGenero;

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
                title: "Eliminar cancion",
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
                        url: base_url+'/Canciones/delCancion/',
                        data: {idCancion:idrol}, 
                        success: function(data)
                        {
                            let objData = JSON.parse(data);
                                if(objData.status)
                                {
                                    swal("Eliminar!", objData.msg , "success");
                                    $('#tablecan').bootstrapTable('refresh')
                                }else{
                                    swal("Atención!", objData.msg , "error");
                                } 
                        }
                    });



                }






            });

  
}
