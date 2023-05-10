var tablecategorias;
//visualizacion
document.addEventListener("DOMContentLoaded",function(){
    tablecategorias=$('#tablecategorias').DataTable({
        "aProcessing":true,
        "aSeverSide":true,
        "language" :{
            "url":"https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
        },
        "ajax":{
            "url":" "+baseurl+"/Categorias/getcategorias",
            "dataSrc":""
        },
        "columns": [
            { "data": 'IdCategoria' },
            { "data": 'Tipo' },
            { "data": 'Descripcion' },
            { "data": 'Estado' },
            { "data": 'options' }
        ],
        "resonsieve":"true",
        "bDestroy":true,
        "iDisplayLength":10,
        "order":[[0,"desc"]]

    });
    //insecion
    var formcategoria= document.querySelector("#formcategoria");
    formcategoria.onsubmit=function(e){
        e.preventDefault();
        var intidcategoria= document.querySelector("#idcategoria").value;
        var strnombre= document.querySelector("#txtnombre").value;
        var strdescripcion= document.querySelector("#txtdescripcion").value;
        var intstatus= document.querySelector("#liststatus").value;

        if(strnombre =='' || strdescripcion =='' || intstatus ==''){
            swal("Atención","Todos los campos son obligatorios.","error");
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = baseurl+'/Categorias/setcategoria';
      
        var formdata=new FormData(formcategoria);

        request.open("POST",ajaxUrl,true);
        request.send(formdata);

        request.onreadystatechange =function(){
            if(request.readyState == 4 && request.status==200){
                //console.log(request.responseText);
                var obdata=JSON.parse(request.responseText);
                //console.log(obdata);
                if(obdata.status){
                    $('#formcategoria').modal("hide");
                    formcategoria.reset();
                    swal("Categorias", obdata.msg ,"success");
                    tablecategorias.ajax.reload(function(){
                        fntdelcategoria();
                        fnteditcategoria();
                        //fntpermisosrol();
                    });
                   
                } else{
                    swal("Error",obdata.msg,"error");
                }
            }
        }
    }
});

$('#tablecategorias').DataTable();
function openmodal(){
    document.querySelector('#idcategoria').value="";
    document.querySelector('#titlemodal').innerHTML = "Nuevo Rol";
    document.querySelector('.modal-header').classList.replace("headerupdate","headerregister");
    document.querySelector('#btnactionform').classList.replace("btn-info","btn-primary");
    document.querySelector('#btntext').innerHTML="Guardar";
    document.querySelector('#formcategoria').reset();
    $('#modalformcategoria').modal("show");
    
}

window.addEventListener("load",function(){
    
    fnteditcategoria();
    fntdelcategoria();
},false);

function fnteditcategoria(){
    var btneditcategoria=Array.apply(null, document.querySelectorAll(".btneditcategoria"));
 
    
    btneditcategoria.forEach(function(btneditcategoria){
        
        btneditcategoria.addEventListener("click",function(){
            //alert("Click to close...");
            document.querySelector('#titlemodal').innerHTML = "Actualizar Categoria";
            document.querySelector('.modal-header').classList.replace("headerregister","headerupdate");
            document.querySelector('#btnactionform').classList.replace("btn-primary","btn-info");
            document.querySelector('#btntext').innerHTML="Actualizar";

            var idcategoria = this.getAttribute("rl");
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = baseurl+'/Categorias/getcategoria/'+idcategoria;
            request.open("GET",ajaxUrl,true);
            request.send();
            request.onreadystatechange =function(){
                if(request.readyState == 4 && request.status==200){
                    //console.log(request.responseText);
                    var objdata=JSON.parse(request.responseText);
                    if(objdata.status){
                        document.querySelector("#idcategoria").value=objdata.data.IdCategoria;
                        document.querySelector("#txtnombre").value=objdata.data.Tipo;
                        document.querySelector("#txtdescripcion").value=objdata.data.Descripcion;
                        if(objdata.data.Estado == 1){
                            var optionselect = '<option value="1" selected class="notblock">Activo</option>';
                        }else{
                            var optionselect = '<option value="2" selected class="notblock">Inactivo</option>';
                        }
                        var htmlselect=`${optionselect} 
                                        <option value="1">Activo</option> 
                                        <option value="2">Inactivo</option>
                                        `;
                        document.querySelector("#liststatus").innerHTML = htmlselect;
                        $('#modalformcategoria').modal("show");
                    }else{
                        swal("Error",objdata.msg,"error");
                    }
                }
            }
           
        });
    });
    //alert(btneditrol);
}

function fntdelcategoria(){
    var btndelcategoria = document.querySelectorAll(".btndelcategoria")
    btndelcategoria.forEach(function(btndelcategoria){
        btndelcategoria.addEventListener("click",function(){
            var idcategoria = this.getAttribute("rl");
            swal({
                title:"Eliminar Rol",
                text: "¿Realmente Quiere eliminar el Rol?",
                type:"warning",
                showCancelButton:true,
                confirmButtonText: "Si, Eliminar",
                cancelButtonText: "No, Cancelar",
                closeOnConfirm:false,
                closeOnCancel:true
            },function(isConfirm){
                if(isConfirm){
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl = baseurl+'/Categorias/delcategoria/';
                //Esta es la id del campo del formulario al realizar la concatenacion 
                var strdata = "idcategoria="+idcategoria;
                request.open("POST",ajaxUrl,true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(strdata);
                request.onreadystatechange = function(){
                        if(request.readyState == 4 && request.status==200){
                            //console.log(request.responseText);
                            var objdata=JSON.parse(request.responseText);
                            if(objdata.status){
                                swal("Eliminar!",objdata.msg,"success");
                                tablecategorias.ajax.reload(function(){
                                    fntdelcategoria();
                                    fnteditcategoria();
                                    //fntpermisosrol();
                                });

                            }else{
                                swal("Error",objdata.msg,"error");
                            }
                        }
                    }
                }

            });
        });
    });
}

