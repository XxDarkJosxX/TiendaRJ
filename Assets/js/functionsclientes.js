var tableusuarios;
document.addEventListener("DOMContentLoaded",function(){
    tableusuarios=$('#tableclientes').DataTable({
        "aProcessing":true,
        "aSeverSide":true,
        "language" :{
            "url":"https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
        },
        "ajax":{
            "url":" "+baseurl+"/Clientes/getclientes",
            "dataSrc":""
        },
        "columns": [
            { "data": 'IdUsuario' },
         
            { "data": 'Nombre' },
            { "data": 'Apellido' },
            { "data": 'Correo' },
            { "data": 'Estado' },
            { "data": 'options' }
        ],
        "resonsieve":"true",
        "bDestroy":true,
        "iDisplayLength":10,
        "order":[[0,"desc"]]

    });
    

    //Insert
    var formusuarios= document.querySelector("#formclientes");
    formusuarios.onsubmit=function(e){
        e.preventDefault();

           var intidusuario=document.querySelector("#idusuario").value;
           var intci=document.querySelector("#txtci").value;
           var strnombre=document.querySelector("#txtnombre").value;
           var strapellido=document.querySelector("#txtapellido").value;
           var strcorreo=document.querySelector("#txtcorreo").value;
           var strcontrasenia=document.querySelector("#txtcontrasenia").value;
    
           var intstatus=document.querySelector("#liststatus").value;

        if( strnombre =='' || strapellido =='' || strcorreo =='' || intstatus ==''){
            swal("Atención","Los campos con (*) son obligatorios.","error");
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = baseurl+'/Clientes/setclientes';
      
        var formdata=new FormData(formusuarios);

        request.open("POST",ajaxUrl,true);
        request.send(formdata);
        
        request.onreadystatechange =function(){
            if(request.readyState == 4 && request.status==200){
                console.log(request.responseText);
                var obdata=JSON.parse(request.responseText);
                console.log(obdata);
                if(obdata.status){
                    $('#modalforcliente').modal("hide");
                    formusuarios.reset();
                    swal("Administracion de Clientes", obdata.msg ,"success");
                    tableusuarios.ajax.reload(function(){
                        //fnteditrol();
                        //fntdelrol();
                        //fntpermisosrol();
                    });
                   
                } else{
                    swal("Error",obdata.msg,"error");
                }
            }
        }
    }
    
},false);
$('#tableclientes').DataTable();
function openmodal(){
    document.querySelector('#idusuario').value="";
    document.querySelector('#titlemodal').innerHTML = "Nuevo Usuario";
    document.querySelector('.modal-header').classList.replace("headerupdate","headerregister");
    document.querySelector('#btnactionform').classList.replace("btn-info","btn-primary");
    document.querySelector('#btntext').innerHTML="Guardar";
    document.querySelector('#formclientes').reset();
    $('#modalforcliente').modal("show");
    
}




function fntviewcliente(idpersona){
    var idpersona = idpersona;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxurl = baseurl+'/Clientes/getcliente/'+idpersona;
    request.open("GET",ajaxurl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objdata = JSON.parse(request.responseText);

            if(objdata.status)
            {
               var estadoUsuario = objdata.data.Estado == 1 ? 
                '<span class="badge badge-success">Activo</span>' : 
                '<span class="badge badge-danger">Inactivo</span>';

                var ci =objdata.data.ci;
                var nit =objdata.data.Nit;
                var nombre= objdata.data.Nombre;
                var nombrefical= objdata.data.NombreFiscal;
                var apellido = objdata.data.Apellido;
                var telefono = objdata.data.Telefono;
                var correo= objdata.data.Correo;
                var direccion= objdata.data.Direccion;
                var pendiente="Datos Pendientes";

                document.querySelector("#celIdentificacion").innerHTML = (ci != null) ? ci : pendiente;
                document.querySelector("#celNit").innerHTML = (nit != null) ? nit : pendiente;
                document.querySelector("#celNombre").innerHTML = (nombre != null) ? nombre : pendiente;
                document.querySelector("#celNombrefiscal").innerHTML = (nombrefical != null) ? nombrefical : pendiente;
                document.querySelector("#celApellido").innerHTML = (apellido != null) ? apellido : pendiente;
                document.querySelector("#celTelefono").innerHTML = (telefono != null) ? telefono : pendiente;
                document.querySelector("#celEmail").innerHTML = (correo != null) ? correo : pendiente;
                document.querySelector("#celDireccion").innerHTML = (direccion != null) ? direccion : pendiente;
                document.querySelector("#celEstado").innerHTML = estadoUsuario;
         
                $('#modalviewuser').modal('show');
            }else{
                swal("Error", objdata.msg , "error");
            }
        }
    }
}


function fnteditcliente(){
    var btneditusuario=Array.apply(null, document.querySelectorAll(".btneditusuario"));
 
    
    btneditusuario.forEach(function(btneditusuario){
        
        btneditusuario.addEventListener("click",function(){
            //alert("Click to close...");
            document.querySelector('#titlemodal').innerHTML = "Actualizar Usuario";
            document.querySelector('.modal-header').classList.replace("headerregister","headerupdate");
            document.querySelector('#btnactionform').classList.replace("btn-primary","btn-info");
            document.querySelector('#btntext').innerHTML="Actualizar";

            var idproducto = this.getAttribute("rl");
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = baseurl+'/Clientes/getcliente/'+idproducto;
            request.open("GET",ajaxUrl,true);
            request.send();
            request.onreadystatechange =function(){
                if(request.readyState == 4 && request.status==200){
                    //console.log(request.responseText);
                    var objdata=JSON.parse(request.responseText);
                    if(objdata.status){

                        
                        document.querySelector("#idusuario").value=objdata.data.IdUsuario;
                        document.querySelector("#txtci").value=objdata.data.ci;
                        document.querySelector("#txtnombre").value=objdata.data.Nombre;
                        document.querySelector("#txtapellido").value=objdata.data.Apellido;
                        document.querySelector("#txtcorreo").value=objdata.data.Correo;
                        document.querySelector("#txtdireccion").value=objdata.data.Direccion;
                        document.querySelector("#txttelefono").value=objdata.data.Telefono;
                        document.querySelector("#txtnombretributario").value=objdata.data.NombreFiscal;
                        document.querySelector("#txtnit").value=objdata.data.Nit;
                     
                  
                        


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



                        $('#modalforcliente').modal("show");
                    }else{
                        swal("Error",objdata.msg,"error");
                    }
                }
            }
           
        });
    });
    
}


function fntdelcliente(){

    var btndelusuario = document.querySelectorAll(".btndelusuario")
    btndelusuario.forEach(function(btndelusuario){
        btndelusuario.addEventListener("click",function(){
            var idusuarios = this.getAttribute("rl");
            swal({
                title:"Eliminar Usuario",
                text: "¿Realmente Quiere eliminar el Usuario?",
                type:"warning",
                showCancelButton:true,
                confirmButtonText: "Si, Eliminar",
                cancelButtonText: "No, Cancelar",
                closeOnConfirm:false,
                closeOnCancel:true
            },function(isConfirm){
                if(isConfirm){
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl = baseurl+'/Clientes/delcliente/';
                var strdata = "idusuario="+idusuarios;
                request.open("POST",ajaxUrl,true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(strdata);
                request.onreadystatechange =function(){
                        if(request.readyState == 4 && request.status==200){
                            console.log(request.responseText);
                            var objdata=JSON.parse(request.responseText);
                            if(objdata.status){
                                swal("Eliminar!",objdata.msg,"success");
                                tableusuarios.ajax.reload(function(){
                                    //funeditsuario();
                                    //fundelusuario();
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