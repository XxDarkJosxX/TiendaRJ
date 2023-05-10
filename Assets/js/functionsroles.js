var tableroles;

document.addEventListener("DOMContentLoaded",function(){
    tableroles=$('#tableroles').DataTable({
        "aProcessing":true,
        "aSeverSide":true,
        "language" :{
            "url":"https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
        },
        "ajax":{
            "url":" "+baseurl+"/Roles/getroles",
            "dataSrc":""
        },
        "columns": [
            { "data": 'IdRoles' },
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
    
    var formrol= document.querySelector("#formrol");
    formrol.onsubmit=function(e){
        e.preventDefault();
        var intidrol= document.querySelector("#idrol").value;
        var strnombre= document.querySelector("#txtnombre").value;
        var strdescripcion= document.querySelector("#txtdescripcion").value;
        var intstatus= document.querySelector("#liststatus").value;

        if(strnombre =='' || strdescripcion =='' || intstatus ==''){
            swal("Atención","Todos los campos son obligatorios.","error");
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = baseurl+'/Roles/setroles';
      
        var formdata=new FormData(formrol);

        request.open("POST",ajaxUrl,true);
        request.send(formdata);

        request.onreadystatechange =function(){
            if(request.readyState == 4 && request.status==200){
                //console.log(request.responseText);
                var obdata=JSON.parse(request.responseText);
                //console.log(obdata);
                if(obdata.status){
                    $('#modalformrol').modal("hide");
                    formrol.reset();
                    swal("Roles de Usuario", obdata.msg ,"success");
                    tableroles.ajax.reload(function(){
                        fnteditrol();
                        fntdelrol();
                        fntpermisosrol();
                    });
                   
                } else{
                    swal("Error",obdata.msg,"error");
                }
            }
        }
    }
});

$('#tableroles').DataTable();
function openmodal(){
    document.querySelector('#idrol').value="";
    document.querySelector('#titlemodal').innerHTML = "Nuevo Rol";
    document.querySelector('.modal-header').classList.replace("headerupdate","headerregister");
    document.querySelector('#btnactionform').classList.replace("btn-info","btn-primary");
    document.querySelector('#btntext').innerHTML="Guardar";
    document.querySelector('#formrol').reset();
    $('#modalformrol').modal("show");
    
}

window.addEventListener("load",function(){
    
    fnteditrol();
    fntdelrol();
    //fntpermisosrol();
},false);



function fnteditrol(){
    var btneditrol=Array.apply(null, document.querySelectorAll(".btneditrol"));
 
    
    btneditrol.forEach(function(btneditrol){
        
        btneditrol.addEventListener("click",function(){
            //alert("Click to close...");
            document.querySelector('#titlemodal').innerHTML = "Actualizar Rol";
            document.querySelector('.modal-header').classList.replace("headerregister","headerupdate");
            document.querySelector('#btnactionform').classList.replace("btn-primary","btn-info");
            document.querySelector('#btntext').innerHTML="Actualizar";

            var idrol = this.getAttribute("rl");
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = baseurl+'/Roles/getrol/'+idrol;
            request.open("GET",ajaxUrl,true);
            request.send();
            request.onreadystatechange =function(){
                if(request.readyState == 4 && request.status==200){
                    //console.log(request.responseText);
                    var objdata=JSON.parse(request.responseText);
                    if(objdata.status){
                        document.querySelector("#idrol").value=objdata.data.IdRoles;
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
                        $('#modalformrol').modal("show");
                    }else{
                        swal("Error",objdata.msg,"error");
                    }
                }
            }
           
        });
    });
    //alert(btneditrol);
}

function fntdelrol(){
    var btndelrol = document.querySelectorAll(".btndelrol");
    btndelrol.forEach(function(btndelrol){
        btndelrol.addEventListener("click",function(){
            var idrol = this.getAttribute("rl");
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
                var ajaxUrl = baseurl+'/Roles/delrol/';
                var strdata = "idrol="+idrol;
                request.open("POST",ajaxUrl,true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(strdata);
                request.onreadystatechange = function(){
                        if(request.readyState == 4 && request.status==200){
                            //console.log(request.responseText);
                            var objdata=JSON.parse(request.responseText);
                            if(objdata.status){
                                swal("Eliminar!",objdata.msg,"success");
                                tableroles.ajax.reload(function(){
                                    fnteditrol();
                                    fntdelrol();
                                    fntpermisosrol();
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

function fntpermisosrol(){
    var btn = document.querySelectorAll(".btnpermisorol");
    btn.forEach(function(btn){
        btn.addEventListener("click",function(){
            var idrol = this.getAttribute("rl");
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = baseurl+'/Permisos/getpermisos/'+idrol;
            request.open("GET",ajaxUrl,true);
            request.send();
            request.onreadystatechange =function(){
                if(request.readyState ==4 && request.status==200){
                    //console.log(request.responseText);
                    document.querySelector('#contentajax').innerHTML= request.responseText;
                    $('#modalpermisos').modal("show");
                    document.querySelector('#formpermisos').addEventListener('submit',fntsavepermisos,false);
                }
            }
            
        });
    });
}

function fntsavepermisos(event){
    event.preventDefault();
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = baseurl+'/Permisos/setpermisos';
    var formpermisos= document.querySelector("#formpermisos");
    var formdata=new FormData(formpermisos);

    request.open("POST",ajaxUrl,true);
    request.send(formdata);
    request.onreadystatechange = function(){
        if(request.readyState==4 && request.status ==200){
            var obdata = JSON.parse(request.responseText);
            if(obdata.status){
                swal("Permisos de Usuario",obdata.msg,"success");
            }else{
                swal("Error",obdata.msg,"error");
            }
        }
    }
}

