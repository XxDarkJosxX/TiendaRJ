var tableusuarios;

document.addEventListener("DOMContentLoaded",function(){
    tableusuarios=$('#tableusuarios').DataTable({
        "aProcessing":true,
        "aSeverSide":true,
        "language" :{
            "url":"https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
        },
        "ajax":{
            "url":" "+baseurl+"/Usuarios/getusuarios",
            "dataSrc":""
        },
        "columns": [
            { "data": 'IdUsuario' },
            { "data": 'Tipo' },
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
    if(document.querySelector("#formusuarios")){
        var formusuarios= document.querySelector("#formusuarios");
        formusuarios.onsubmit=function(e){
            e.preventDefault();
            var intidusuario=document.querySelector("#idusuario").value;
            var strnombre=document.querySelector("#txtnombre").value;
            var strapellido=document.querySelector("#txtapellido").value;
            var strcorreo=document.querySelector("#txtcorreo").value;
            var strcontrasenia=document.querySelector("#txtcontrasenia").value;
            var intidrol=document.querySelector("#txtrol").value;
            var intstatus=document.querySelector("#liststatus").value;

            if( strnombre =='' || strapellido =='' || strcorreo =='' || intidrol ==''){
                swal("Atención","Todos los campos son obligatorios.","error");
                return false;
            }
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = baseurl+'/Usuarios/setusuarios';
        
            var formdata=new FormData(formusuarios);

            request.open("POST",ajaxUrl,true);
            request.send(formdata);
            
            request.onreadystatechange =function(){
                if(request.readyState == 4 && request.status==200){
                    console.log(request.responseText);
                    var obdata=JSON.parse(request.responseText);
                    console.log(obdata);
                    if(obdata.status){
                        $('#modalformusuario').modal("hide");
                        formusuarios.reset();
                        swal("Roles de Usuario", obdata.msg ,"success");
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
    }

    if(document.querySelector("#formperfil")){
        var formusuarios= document.querySelector("#formperfil");
        formusuarios.onsubmit=function(e){
            e.preventDefault();
            var strci=document.querySelector("#txtci").value;
            var strnombre=document.querySelector("#txtnombre").value;
            var strapellido=document.querySelector("#txtapellido").value;
            var strcorreo=document.querySelector("#txtcorreo").value;
           
  
            //var intstatus=document.querySelector("#liststatus").value;

            if( strnombre =='' || strapellido =='' || strcorreo =='' || strci ==''){
                swal("Atención","Todos los campos son obligatorios.","error");
                return false;
            }
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = baseurl+'/Usuarios/setperfil';
        
            var formdata=new FormData(formusuarios);

            request.open("POST",ajaxUrl,true);
            request.send(formdata);
            
            request.onreadystatechange =function(){
                if(request.readyState != 4) return;

                if(request.status==200){
                    console.log(request.responseText);
                    var obdata=JSON.parse(request.responseText);
                    console.log(obdata);
                    if(obdata.status){
                        $('#modalformperfil').modal("hide");
                        swal({
                            title: "",
                            text: obdata.msg,
                            type: "success",
                            confirmButtonText: "Aceptar",
                            closeOnConfirm: false,
                        }, function(isConfirm) {
                            if (isConfirm) {
                                location.reload();
                            }
                        });
                    
                    } else{
                        swal("Error",obdata.msg,"error");
                    }
                }
            }
        }
    }


    //insert fiscales
    if(document.querySelector("#formdatafiscal")){
        let formdatafiscal = document.querySelector("#formdatafiscal");
        formdatafiscal.onsubmit = function(e) {
            e.preventDefault();
          
            let strnit = document.querySelector('#txtnit').value;
            let strnombrefiscal = document.querySelector('#txtnombrefiscal').value;
       
           
            if(strnit == ''|| strnombrefiscal == '' )
            {
                swal("Atención", "Todos los campos son obligatorios." , "error");
                return false;
            }
      
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxurl = baseurl+'/Usuarios/setdatosficales'; 
            let formdata = new FormData(formdatafiscal);
            request.open("POST",ajaxurl,true);
            request.send(formdata);
            request.onreadystatechange = function(){
                if(request.readyState != 4 ) return; 
                if(request.status == 200){
                    let objdata = JSON.parse(request.responseText);
                    if(objdata.status)
                    {
                
                        swal({
                            title: "",
                            text: objdata.msg,
                            type: "success",
                            confirmButtonText: "Aceptar",
                            closeOnConfirm: false,
                        }, function(isConfirm) {
                            if (isConfirm) {
                                location.reload();
                            }
                        });
                    }else{
                        swal("Error", objdata.msg , "error");
                    }
                }
  
                return false;
            }
        }
    }



    
//Cambiar Password

if(document.querySelector('#formresetpassword')){
    let formreset=document.querySelector('#formresetpassword');
    formreset.onsubmit = function(e){
      e.preventDefault();
      let stremail = document.querySelector('#txtemailreset').value;

      if(stremail == ''){
        swal("Por favor", "Escribe tu correo electrónico","error");
        return false;
      }else{
        var request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
        var ajaxUrl = baseurl + "/Usuarios/resetpassword/"+stremail;
        var formdata = new FormData(formreset);

        request.open("POST", ajaxUrl, true);

        request.send();
        request.onreadystatechange = function(){
            console.log(request.responseText);
            if(request.readyState != 4) return;
            if(request.status == 200){
              var obdata=JSON.parse(request.responseText);
              if(obdata.status){
                  swal({
                    title:"Atencion",
                    text: obdata.msg,
                    type:"success",
                    showCancelButton:true,
                    confirmButtonText: "Aceptar",
                    cancelButtonText: false,
                    closeOnConfirm:false,
                    closeOnCancel:true
                  },function(isConfirm){
                      if(isConfirm){
                          window.location= baseurl;
                      }
                  });
              }else{
                swal("Atencion",obdata.msg,"error");
              }
            
            }else{
              swal("Atencion","error en el proceso","error");
            }
            return false;
            
        }
     
      }
    }
}
    
},false);

$('#tableusuarios').DataTable();
function openmodal(){
    document.querySelector('#idusuario').value="";
    document.querySelector('#titlemodal').innerHTML = "Nuevo Usuario";
    document.querySelector('.modal-header').classList.replace("headerupdate","headerregister");
    document.querySelector('#btnactionform').classList.replace("btn-info","btn-primary");
    document.querySelector('#btntext').innerHTML="Guardar";
    document.querySelector('#formusuarios').reset();
    $('#modalformusuario').modal("show");
    
}

window.addEventListener('load',function(){
    fntrolesusuario();
},false)

function fntrolesusuario(){
    if( document.querySelector('#txtrol')){
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = baseurl+'/Usuarios/getselectroles';
        request.open("GET",ajaxUrl,true);
        request.send();

        request.onreadystatechange =function(){
            if(request.readyState == 4 && request.status==200){
             
                document.querySelector('#txtrol').innerHTML= request.responseText;
                document.querySelector('#txtrol').value=1;
                $('#txtrol').selectpicker('render');
            }
        }
    }    
}


function fnteditusuario(){
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
            var ajaxUrl = baseurl+'/Usuarios/getusuario/'+idproducto;
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

                        
                        document.querySelector("#txtrol").value=objdata.data.IdRoles;
                        $('#txtrol').selectpicker('render');
                        
                        document.querySelector("#liststatus").value=objdata.data.Estado;
                        $('#liststatus').selectpicker('render');

                     

                        $('#modalformusuario').modal("show");
                    }else{
                        swal("Error",objdata.msg,"error");
                    }
                }
            }
           
        });
    });
    
}
//Moises 
function fntdelusuario(){

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
                var ajaxUrl = baseurl+'/Usuarios/delusuario/';
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

function openmodalperfil(){
    $('#modalformperfil').modal("show");
}




function fntviewcliente(idpersona){
    var idpersona = idpersona;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxurl = baseurl+'/Usuarios/getusuario/'+idpersona;
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

