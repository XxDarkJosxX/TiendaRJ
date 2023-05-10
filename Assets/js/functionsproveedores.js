var tableproveedores;

document.addEventListener("DOMContentLoaded",function(){
    tableproveedores=$('#tableproveedores').DataTable({
        "aProcessing":true,
        "aSeverSide":true,
        "language" :{
            "url":"https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
        },
        "ajax":{
            "url":" "+baseurl+"/Proveedores/getproveedores",
            "dataSrc":""
        },
        "columns": [
            { "data": 'IdProveedor' },
            { "data": 'Nombre' },
            { "data": 'Ciudad' },
            { "data": 'Correo' },
            { "data": 'Telefono' },
            { "data": 'Departamento' },
            { "data": 'Rubro' },
            { "data": 'Direccion' },
            { "data": 'Provincia' },
            { "data": 'Descripcion' },
            { "data": 'Estado' },
            { "data": 'options' }
        ],
        "resonsieve":"true",
        "bDestroy":true,
        "iDisplayLength":10,
        "order":[[0,"desc"]]

    }); 
    var formproveedor= document.querySelector("#formproveedor");
    formproveedor.onsubmit=function(e){
        e.preventDefault();
        var intidproveedor= document.querySelector("#idproveedor").value;
        var strnombre= document.querySelector("#txtnombre").value;
        var strciudad= document.querySelector("#txtciudad").value;
        var strcorreo= document.querySelector("#txtcorreo").value;
        var inttelefono= document.querySelector("#txttelefono").value;
        var strdescripcion= document.querySelector("#txtdescripcion").value;
        var intstatus= document.querySelector("#liststatus").value;

        if(strnombre =='' ||strciudad =='' ||strcorreo =='' ||inttelefono =='' || strdescripcion =='' || intstatus ==''){
            swal("Atención","Todos los campos son obligatorios.","error");
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = baseurl+'/Proveedores/setproveedores';
      
        var formdata=new FormData(formproveedor);

        request.open("POST",ajaxUrl,true);
        request.send(formdata);

        request.onreadystatechange =function(){
            if(request.readyState == 4 && request.status==200){
                //console.log(request.responseText);
                var obdata=JSON.parse(request.responseText);
                //console.log(obdata);
                if(obdata.status){
                    $('#modalformproveedor').modal("hide");
                    formproveedor.reset();
                    swal("Proveedores", obdata.msg ,"success");
                    tableproveedores.ajax.reload(function(){
                        fnteditproveedor();
                        fntdelproveedor();
                        //fntpermisosrol();
                    });
                   
                } else{
                    swal("Error",obdata.msg,"error");
                }
            }
        }
    }
});

$('#tableproveedores').DataTable();
function openmodal(){
    document.querySelector('#idproveedor').value="";
    document.querySelector('#titlemodal').innerHTML = "Nuevo Proveedor";
    document.querySelector('.modal-header').classList.replace("headerupdate","headerregister");
    document.querySelector('#btnactionform').classList.replace("btn-info","btn-primary");
    document.querySelector('#btntext').innerHTML="Guardar";
    document.querySelector('#formproveedor').reset();
    $('#modalformproveedor').modal("show");
    
}

window.addEventListener("load",function(){
    
    fnteditproveedor();
    fntdelproveedor();
},false);

function fnteditproveedor(){
    var btneditproveedor=Array.apply(null, document.querySelectorAll(".btneditproveedor"));
 
    
    btneditproveedor.forEach(function(btneditproveedor){
        
        btneditproveedor.addEventListener("click",function(){
            //alert("Click to close...");
            document.querySelector('#titlemodal').innerHTML = "Actualizar Proveedor";
            document.querySelector('.modal-header').classList.replace("headerregister","headerupdate");
            document.querySelector('#btnactionform').classList.replace("btn-primary","btn-info");
            document.querySelector('#btntext').innerHTML="Actualizar";

            var idproveedor = this.getAttribute("rl");
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = baseurl+'/Proveedores/getproveedor/'+idproveedor;
            request.open("GET",ajaxUrl,true);
            request.send();
            request.onreadystatechange =function(){
                if(request.readyState == 4 && request.status==200){
                    //console.log(request.responseText);
                    var objdata=JSON.parse(request.responseText);
                    if(objdata.status){
                        document.querySelector("#idproveedor").value=objdata.data.IdProveedor;
                        document.querySelector("#txtnombre").value=objdata.data.Nombre;
                        document.querySelector("#txtciudad").value=objdata.data.Ciudad;
                        document.querySelector("#txtcorreo").value=objdata.data.Correo;
                        document.querySelector("#txttelefono").value=objdata.data.Telefono;
                        document.querySelector("#txtpais").value=objdata.data.Pais;
                        document.querySelector("#txtrubro").value=objdata.data.Rubro;
                        document.querySelector("#txtdireccion").value=objdata.data.Direccion;
                        document.querySelector("#txtprovincia").value=objdata.data.Provincia;
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
                        $('#modalformproveedor').modal("show");
                    }else{
                        swal("Error",objdata.msg,"error");
                    }
                }
            }
           
        });
    });
    //alert(btneditproveedor);
}

function fntdelproveedor(){
    var btndelproveedor = document.querySelectorAll(".btndelproveedor")
      btndelproveedor.forEach(function(btndelproveedor){
        btndelproveedor.addEventListener("click",function(){
            var idproveedor = this.getAttribute("rl");
            swal({
                title:"Eliminar Proveedor",
                text: "¿Realmente Quiere eliminar el Proveedor?",
                type:"warning",
                showCancelButton:true,
                confirmButtonText: "Si, Eliminar",
                cancelButtonText: "No, Cancelar",
                closeOnConfirm:false,
                closeOnCancel:true
            },function(isConfirm){
                if(isConfirm){
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl = baseurl+'/Proveedores/delproveedor/';
                var strdata = "idproveedor="+idproveedor;
                request.open("POST",ajaxUrl,true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(strdata);

                request.onreadystatechange =function(){
                        if(request.readyState == 4 && request.status==200){
                            console.log(request.responseText);
                            var objdata=JSON.parse(request.responseText);
                            if(objdata.status){
                                swal("Eliminar!",objdata.msg,"success");
                                tableproveedores.ajax.reload(function(){
                                    fnteditproveedor();
                                    fntdelproveedor();
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