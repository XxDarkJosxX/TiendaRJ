var tablemateriales;

document.addEventListener("DOMContentLoaded",function(){
    tablemateriales=$('#tablemateriales').DataTable({
        "aProcessing":true,
        "aSeverSide":true,
        "language" :{
            "url":"https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
        },
        "ajax":{
            "url":" "+baseurl+"/Materiales/getmateriales",
            "dataSrc":""
        },
        "columns": [
            { "data": 'IdMaterialPr' },
            { "data": 'Nombre' },
            { "data": 'Descripcion' },
            { "data": 'Estado' },
            { "data": 'options' }
        ],
        "resonsieve":"true",
        "bDestroy":true,
        "iDisplayLength":10,
        "order":[[0,"desc"]]

    });
    //Insert
    var formusuarios= document.querySelector("#formmaterial");
    formusuarios.onsubmit=function(e){
        e.preventDefault();

       
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = baseurl+'/Materiales/setmateriales';
      
        var formdata=new FormData(formusuarios);

        request.open("POST",ajaxUrl,true);
        request.send(formdata);
        
        request.onreadystatechange =function(){
            if(request.readyState == 4 && request.status==200){
                console.log(request.responseText);
                var obdata=JSON.parse(request.responseText);
                console.log(obdata);
                if(obdata.status){
                    $('#modalformateriales').modal("hide");
                    formusuarios.reset();
                    swal("Materia Prima", obdata.msg ,"success");
                    tablemateriales.ajax.reload(function(){
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

$('#tablemateriales').DataTable();

function openmodal(){
   
    $('#modalformateriales').modal("show");
    
}

window.addEventListener("load",function(){
    
    //fnteditrol();
    fntdelmateria();
},false);


/////////////
function fntdelmateria(){
    var btndelmateria = document.querySelectorAll(".btndelmateria")
    btndelmateria.forEach(function(btndelmateria){
        btndelmateria.addEventListener("click",function(){
            var idmateria = this.getAttribute("rl");
            swal({
                title:"Eliminar Materia Prima",
                text: "¿Realmente Quiere eliminar la Material Prima?",
                type:"warning",
                showCancelButton:true,
                confirmButtonText: "Si, Eliminar",
                cancelButtonText: "No, Cancelar",
                closeOnConfirm:false,
                closeOnCancel:true
            },function(isConfirm){
                if(isConfirm){
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl = baseurl+'/Materiales/delmateria/';
                var strdata = "idmaterial="+idmateria;
                request.open("POST",ajaxUrl,true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(strdata);
                request.onreadystatechange = function(){
                        if(request.readyState == 4 && request.status==200){
                            //console.log(request.responseText);
                            var objdata=JSON.parse(request.responseText);
                            if(objdata.status){
                                swal("Eliminar!",objdata.msg,"success");
                                tablemateriales.ajax.reload(function(){
                                    //fnteditrol();
                                    //fntdelmateria();
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


function fnteditmateria(){
    var btneditrol=Array.apply(null, document.querySelectorAll(".btneditmateria"));
 
    
    btneditrol.forEach(function(btneditrol){
        
        btneditrol.addEventListener("click",function(){
            //alert("Click to close...");
            document.querySelector('#titlemodal').innerHTML = "Actualizar Material";
            document.querySelector('.modal-header').classList.replace("headerregister","headerupdate");
            document.querySelector('#btnactionform').classList.replace("btn-primary","btn-info");
            document.querySelector('#btntext').innerHTML="Actualizar";

            var idrol = this.getAttribute("rl");
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = baseurl+'/Materiales/getmaterial/'+idrol;
            request.open("GET",ajaxUrl,true);
            request.send();
            request.onreadystatechange =function(){
                if(request.readyState == 4 && request.status==200){
                    //console.log(request.responseText);
                    var objdata=JSON.parse(request.responseText);
                    if(objdata.status){
                        document.querySelector("#idmaterial").value=objdata.data.IdMaterialPr;
                        document.querySelector("#txtnombre").value=objdata.data.Nombre;
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
                        $('#modalformateriales').modal("show");
                    }else{
                        swal("Error",objdata.msg,"error");
                    }
                }
            }
           
        });
    });
    //alert(btneditrol);
}
