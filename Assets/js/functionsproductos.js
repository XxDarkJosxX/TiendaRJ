var tableproductos;

document.addEventListener("DOMContentLoaded",function(){
    tableproductos=$('#tableproductos').DataTable({
        "aProcessing":true,
        "aSeverSide":true,
        "language" :{
            "url":"https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
        },
        "ajax":{
            "url":" "+baseurl+"/Productos/getproductos",
            "dataSrc":""
        },
        "columns": [
            { "data": 'IdProducto' },
            { "data": 'Tipo' },
            { "data": 'Nombre' },
            { "data": 'foto' },
            { "data": 'Descripcion' },
            { "data": 'Estado' },
            { "data": 'options' }
        ],
        "resonsieve":"true",
        "bDestroy":true,
        "iDisplayLength":10,
        "order":[[0,"desc"]]

    });

    var formproducts= document.querySelector("#formproducts");
    formproducts.onsubmit=function(e){
        e.preventDefault();

         
           var intidcategoria=document.querySelector("#txtcategoria").value;
           var strproducto=document.querySelector("#txtnombre").value;
           var strfoto=document.querySelector("#txtimagen").value;
           var strdescripcion=document.querySelector("#txtdescripcion").value;
           var intstatus=document.querySelector("#liststatus").value;

        if(intidcategoria =='' || strproducto =='' || strdescripcion ==''){
            swal("Atención","Todos los campos son obligatorios.","error");
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = baseurl+'/Productos/setproductos';
      
        var formdata=new FormData(formproducts);

        request.open("POST",ajaxUrl,true);
        request.send(formdata);
        
        request.onreadystatechange =function(){
            if(request.readyState == 4 && request.status==200){
                console.log(request.responseText);
                var obdata=JSON.parse(request.responseText);
                console.log(obdata);
                if(obdata.status){
                    $('#modalformproducts').modal("hide");
                    formproducts.reset();
                    swal("Producto Modificado", obdata.msg ,"success");
                    tableproductos.ajax.reload(function(){
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


    //formtallas
    let intidprecio = [];
    let intidcantidad = [];
    var formtallas= document.querySelector("#formtallas");
    formtallas.onsubmit=function(e){

        e.preventDefault();
        intidprecio [1] =document.querySelector("#txtprecio1").value;
        intidcantidad[1]=document.querySelector("#txtcantidad1").value;

        intidprecio[2]=document.querySelector("#txtprecio2").value;
        intidcantidad[2]=document.querySelector("#txtcantidad2").value;

        intidprecio[3]=document.querySelector("#txtprecio3").value;
        intidcantidad[3]=document.querySelector("#txtcantidad3").value;

        intidprecio[4]=document.querySelector("#txtprecio4").value;
        intidcantidad[4]=document.querySelector("#txtcantidad4").value;

        intidprecio[5]=document.querySelector("#txtprecio5").value;
        intidcantidad[5]=document.querySelector("#txtcantidad5").value;

        intidprecio[6]=document.querySelector("#txtprecio6").value;
        intidcantidad[6]=document.querySelector("#txtcantidad6").value;



        for (let i = 1; i < 7; i++) {
            if(intidprecio[i] != "" || intidcantidad[i] != ""){
                if(intidcantidad[i] == "" || intidprecio[1] == ""){
                    swal("Atención","Si es ingresado en campo de precios tambien debe llenarse la cantidad","error");
                    return false;
                } 
            }
        }


        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = baseurl+'/Productos/settallasprecio';
      
        var formdata=new FormData(formtallas);

        request.open("POST",ajaxUrl,true);
        request.send(formdata);

        request.onreadystatechange =function(){
            if(request.readyState == 4 && request.status==200){
                console.log(request.responseText);
                var obdata=JSON.parse(request.responseText);
                
                if(obdata.status){
                    $('#modalformtallas').modal("hide");
                    formtallas.reset();
                    swal("Tallas Ingresadas", obdata.msg ,"success");
                    tableproductos.ajax.reload(function(){
                    });
                   
                } else{
                    swal("Error",obdata.msg,"error");
                }
            }
        }
      
    }
    
},false);

$('#tableproductos').DataTable();
function openmodal(){
     document.querySelector('#idproducto').value="";
    document.querySelector('#titlemodal').innerHTML = "Nuevo Producto";
    document.querySelector('.modal-header').classList.replace("headerupdate","headerregister");
    document.querySelector('#btnactionform').classList.replace("btn-info","btn-primary");
    document.querySelector('#btntext').innerHTML="Guardar";
    document.querySelector('#formproducts').reset();
    $('#modalformproducts').modal("show");
    
}

window.addEventListener('load',function(){
    fntcategoriasproductos();
    fnteditproducto();
},false)

function fntcategoriasproductos(){
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = baseurl+'/Productos/getselectcategorias';
        request.open("GET",ajaxUrl,true);
        request.send();

        request.onreadystatechange =function(){
            if(request.readyState == 4 && request.status==200){
             
                document.querySelector('#txtcategoria').innerHTML= request.responseText;
                document.querySelector('#txtcategoria').value=1;
                $('#txtcategoria').selectpicker('render');
            }
        }
        
}


function fnteditproducto(){
    var btneditproducto=Array.apply(null, document.querySelectorAll(".btneditproducto"));
 
    
    btneditproducto.forEach(function(btneditproducto){
        
        btneditproducto.addEventListener("click",function(){
            //alert("Click to close...");
            document.querySelector('#titlemodal').innerHTML = "Actualizar Producto";
            document.querySelector('.modal-header').classList.replace("headerregister","headerupdate");
            document.querySelector('#btnactionform').classList.replace("btn-primary","btn-info");
            document.querySelector('#btntext').innerHTML="Actualizar";

            var idproducto = this.getAttribute("rl");
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = baseurl+'/Productos/getproducto/'+idproducto;
            request.open("GET",ajaxUrl,true);
            request.send();
            request.onreadystatechange =function(){
                if(request.readyState == 4 && request.status==200){
                    //console.log(request.responseText);
                    var objdata=JSON.parse(request.responseText);
                    if(objdata.status){

                        
                        document.querySelector("#idproducto").value=objdata.data.IdProducto;
                        document.querySelector("#txtnombre").value=objdata.data.Nombre;
                        document.querySelector("#txtcategoria").value=objdata.data.IdCategoria;
                        $('#txtcategoria').selectpicker('render');
                        

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



                        $('#modalformproducts').modal("show");
                    }else{
                        swal("Error",objdata.msg,"error");
                    }
                }
            }
           
        });
    });
    
}


function fntedittalla(){
    var btnedittalla=Array.apply(null, document.querySelectorAll(".btnedittalla"));
 
    
    btnedittalla.forEach(function(btnedittalla){
        
        btnedittalla.addEventListener("click",function(){

        
            var idproducto = btnedittalla.getAttribute("rl");
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = baseurl+'/Productos/gettallas/'+idproducto;
            request.open("GET",ajaxUrl,true);
            request.send();
            request.onreadystatechange = function(){
                request.onload = function(){
                if(request.readyState == 4 && request.status==200){
               
                    //console.log(request.responseText);
                    var objdata=JSON.parse(request.responseText);
                    var htmlinput=``;
                 

                    //   ${objdata["preciotallas"][6]["IdTalla"]}
                    objdata["tallas"].forEach(element => {
                        
                        var precio="";
                        var cantidad="";

                        objdata["preciotallas"].forEach(elementprecio => {
                            if(element['IdTalla'] == elementprecio['IdTalla']){
                                precio = elementprecio['Precio'];
                                cantidad = elementprecio['Cantidad'];
                            }
                        });

                        var inputprecio=`
                        <div class="form-group col-md-4">
                        <input value="${precio}" class="form-control" id="txtprecio${element['IdTalla']}" name="txtprecio${element['IdTalla']}" minlength="4" maxlength="20" type="number" step="0.01" placeholder="Precio"   >
                        </div>`;
                        var inputcantidad=`
                        <div class="form-group col-md-4">
                            <input value="${cantidad}" class="form-control" id="txtcantidad${element['IdTalla']}" name="txtcantidad${element['IdTalla']}" minlength="2" maxlength="20"  type="number"  placeholder="Cantidad" >
                        </div>`;

                        htmlinput+=`
                        <div class="form-row">
                            <div class="form-group col-md-4">
                         
                            <input value="${element['IdTalla']}" id="txttallavalue${element['IdTalla']}" name="txttallavalue${element['IdTalla']}" type="hidden" >
                            <input value="${element['Nombre']}" rl="${element['IdTalla']}" class="form-control" id="txttalla" name="txttalla" minlength="2" maxlength="20" pattern="[a-zA-Z ]{2,20}" type="text" readonly>
                            </div>

                            ${inputprecio}

                            ${inputcantidad}
                        </div>
                        `;
                    });
                    document.querySelector(".inputsform").innerHTML = htmlinput;
                    document.querySelector("#idproductotalla").value = idproducto;
                    
                    $('#modalformtallas').modal("show");
                }
                }
            }

           
        });
    });
}



function fntdelproducto(){
    var btndelrol = document.querySelectorAll(".btndelproducto")
    btndelrol.forEach(function(btndelrol){
        btndelrol.addEventListener("click",function(){
            var idrol = this.getAttribute("rl");
            swal({
                title:"Eliminar Producto",
                text: "¿Realmente Quiere eliminar el Producto?",
                type:"warning",
                showCancelButton:true,
                confirmButtonText: "Si, Eliminar",
                cancelButtonText: "No, Cancelar",
                closeOnConfirm:false,
                closeOnCancel:true
            },function(isConfirm){
                if(isConfirm){
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl = baseurl+'/Productos/delproducto/';
                var strdata = "idproducto="+idrol;
                request.open("POST",ajaxUrl,true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(strdata);
                request.onreadystatechange = function(){
                        if(request.readyState == 4 && request.status==200){
                            //console.log(request.responseText);
                            var objdata=JSON.parse(request.responseText);
                            if(objdata.status){
                                swal("Eliminar!",objdata.msg,"success");
                                tableproductos.ajax.reload(function(){
                                    //fnteditrol();
                                    //fntdelrol();
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


