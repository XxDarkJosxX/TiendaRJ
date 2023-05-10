var tableventas;
var tabledetalleventas;
var tabledetalleventas;
var tablecarritoventas;
var idproducto =0;
var idtalla =0;
let idpreciotalla=0;
document.addEventListener("DOMContentLoaded",function(){
    //Ventas
    tableventas=$('#tableventas').DataTable({
        "aProcessing":true,
        "aSeverSide":true,
        "language" :{
            "url":"https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
        },
        "ajax":{
            "url":" "+baseurl+"/Ventas/getventas",
            "dataSrc":""
        },
        "columns": [
            { "data": 'IdVenta' },
            { "data": 'Cliente' },
            { "data": 'Empleado' },
            { "data": 'Fecha' },
            { "data": 'MetodoPago' },
            { "data": 'CantidadTotal' },
            { "data": 'Total' },
            { "data": 'Estado' },
            { "data": 'options' }
        ],
        "resonsieve":"true",
        "bDestroy":true,
        "iDisplayLength":10,
        "order":[[0,"desc"]]

    })


    var formestadoventa= document.querySelector("#formestadoventa");
    formestadoventa.onsubmit=function(e){
        e.preventDefault();

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = baseurl+'/Ventas/setestadoventa';
      
        var formdata=new FormData(formestadoventa);

        request.open("POST",ajaxUrl,true);
        request.send(formdata);
        
        request.onreadystatechange =function(){
            if(request.readyState == 4 && request.status==200){
                console.log(request.responseText);
                var obdata=JSON.parse(request.responseText);
                if(obdata.status){
                    $('#modalformventaenvio').modal("hide");
                    swal("Administracion de Ventas", obdata.msg ,"success");
                    tableventas.ajax.reload();
                }
            }
        }
    }
    


    var formventas= document.querySelector("#formventas");
    formventas.onsubmit=function(e){
        e.preventDefault();
        var idcliente= document.querySelector("#txtidcliente").value;
        if(idcliente ==''){
            swal("Error","A ocurrido un error.","error");
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = baseurl+'/Ventas/setventa/'+idcliente;
      
        var formdata=new FormData(formventas);

        request.open("POST",ajaxUrl,true);
        request.send(formdata);

        request.onreadystatechange =function(){
            if(request.readyState == 4 && request.status==200){
                tablecarritoventas.ajax.reload(
                    function(){
                        fntdelcarrito();
                        calculototal();
                    }
                );
                tablecarritoventas.ajax.reload(
                    function(){
                    }
                );
                swal("Administración de Ventas", "Venta Registrada","success");
            }
        }

    }
    calculototal();

},false);
 

$('#tableventas').DataTable();

function openmodal(){

    document.querySelector('#btnaddcarrito').classList.replace("btn-info","btn-primary");

    $('#modalformventas').modal("show");
    
}

window.addEventListener('load',function(){
    fntcliente();
    
    fntproductos();
    fntrecharproductos();
},false)




function fntselectpreciotalla(){
   let idTalla=0;
   var combotalla = document.querySelector('#txttalla');
   let precio =0;
   let preciofinal =0;
   let porcentaje =0;


   let findselected = () => {
    idTalla = combotalla.value;
    var requestp = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrlp = baseurl+'/Catalogo/getpreciotalla/'+idproducto+'/'+idTalla;

    requestp.open("GET",ajaxUrlp,true);
    requestp.send();
    requestp.onreadystatechange =function(){
        requestp.onload = function(){
            if(requestp.readyState == 4 && requestp.status==200){
                objdata=JSON.parse(requestp.responseText);
                idpreciotalla=objdata.data.IdPrecioTalla;
                //alert(idpreciotalla);
                precio = objdata.data.Precio;
                     
                if(objdata.data.Porcentaje != null){
                    porcentaje = objdata.data.Porcentaje;
                    var porcentajefnal = (100 - porcentaje)/100;
                    preciofinal = round(precio * porcentajefnal);
                    document.querySelector("#txtprecio").value =preciofinal;
                } else{
                    document.querySelector("#txtprecio").value =precio;
                }
            }
        }
    }
   }

   combotalla.addEventListener("change",findselected);

   findselected();
}

function fntrecharproductos(){
    var combopr = document.querySelector('#txtproducto');
    combopr.addEventListener("change",fntselecttalla);
   
    
}


function fntproductos(){

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = baseurl+'/Ventas/getselectproductos';
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange =function(){
        request.onload = function(){
            if(request.readyState == 4 && request.status==200){
           
                document.querySelector('#txtproducto').innerHTML= request.responseText;
              
                $('#txtproducto').selectpicker('destroy');
                $('#txtproducto').selectpicker('render');
                fntselecttalla();
                fntaddcarrito();
            }
        }
    }

    
}

function fntselecttalla(){
    var combopr = document.querySelector('#txtproducto');
        idproducto = combopr.value;
        var requestt = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrlt = baseurl+'/Ventas/gettallas/'+idproducto;
        requestt.open("GET",ajaxUrlt,true);
        requestt.send();
        requestt.onreadystatechange =function(){
            requestt.onload = function(){
            if(requestt.readyState == 4 && requestt.status==200){
               
                    //alert(idproducto);
                    document.querySelector('#txttalla').innerHTML= requestt.responseText;
                    $('#txttalla').selectpicker('destroy');
                    $('#txttalla').selectpicker('render');
                    fntselectpreciotalla();
                }
            }
        }
    

   
}




function fntcliente(){
    
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = baseurl+'/Ventas/getselectclientes';
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange =function(){
        request.onload =function(){
            if(request.readyState == 4 && request.status==200){
                
                document.querySelector('#txtcliente').innerHTML= request.responseText;
            
                $('#txtcliente').selectpicker('destroy');
                $('#txtcliente').selectpicker('render');
            }
            var combocli = document.querySelector('#txtcliente');
            document.querySelector('#txtidcliente').value= combocli.value;
            fntmostrartablaventa();
            combocli.addEventListener("change",function(){
                document.querySelector('#txtidcliente').value= combocli.value;
            
            });
        }
    }
    
}


function fntaddcarrito(){
    var btnaddcarrito= document.querySelector(".btnaddcarrito");

        btnaddcarrito.addEventListener("click",function(){
            if(idproducto > 0 && idpreciotalla > 0){
                var requestp = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrlp = baseurl+'/Carrito/addcarrito/'+idproducto+'/'+idpreciotalla;
                requestp.open("GET",ajaxUrlp,true);
                requestp.send();
                requestp.onreadystatechange =function(){
                    requestp.onload = function(){
                        if(requestp.readyState == 4 && requestp.status==200){
                            //console.log(requestp.responseText);
                        
                            tablecarritoventas.ajax.reload(
                                function(){
                                    calculototal();
                                }
                            );
                        } 
                    }
                }
            }
          
        });
 
}

function fntmostrartablaventa(){
        //Detalle ventas

        tablecarritoventas=$('#tablecarritoventa').DataTable({
            "aProcessing":true,
            "aSeverSide":true,
            
            "language" :{
                "url":"https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
            },
            "ajax":{
                "url":" "+baseurl+"/Carrito/contentsadmin",
                "dataSrc":""
            },
            "columns": [
                { "data": 'id' },
          
                { "data": 'name' },
                { "data": 'price' },
                { "data": 'size' },
                { "data": 'qty' },
                { "data": 'options' }
              
            ],
            "resonsieve":"true",
            "bDestroy":true,
            "iDisplayLength":10,
            "order":[[0,"desc"]]
        });
}

function fntdelcarrito(){
    var btndelcarrito=document.querySelectorAll(".btndelproducto");
  
    btndelcarrito.forEach(function(btndelcarrito){
        
        btndelcarrito.addEventListener("click",function(event){
            event.preventDefault();
            var IdProducto = this.getAttribute("rl");
            request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            ajaxUrl = baseurl+'/Carrito/remove/'+IdProducto;
            //alert();
            request.open("GET",ajaxUrl,true);
            request.send();
            tablecarritoventas.ajax.reload(
                function(){
                    fntdelcarrito();
                    calculototal();
                }
            );
          
        });
    });
}


function fntupdateqty(){
    var btnupdatecarrito=document.querySelectorAll(".btnupdatecarrito");
    
    btnupdatecarrito.forEach(function(btnupdatecarrito){
        
        btnupdatecarrito.addEventListener("change",function(event){
            var IdProducto = this.getAttribute("rl");
            var catidad = btnupdatecarrito.value;
            if(catidad > 0){
                request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                ajaxUrl = baseurl+'/Carrito/updatecantidad/'+IdProducto+'/'+catidad;
                
                request.open("GET",ajaxUrl,true);
                request.send();
                calculototal();
            }else{
                alert("La cantidad no puede ser menor a 1");
                btnupdatecarrito.value = 1;
            }   
        
            
        });
    });
    
}

function calculototal(){
    requestt = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    ajaxUrlt = baseurl+'/Carrito/total';
    
    requestt.open("GET",ajaxUrlt,true);
    requestt.send();
    requestt.onreadystatechange =function(){
        if(requestt.readyState == 4 && requestt.status==200){
            var objdata=JSON.parse(requestt.responseText);
         
            document.querySelector('.txttotal').value = round( objdata) +" Bs.";
            
        }
    }
}




function fntviewcliente(intidventas){
    tabledetalleventas=$('#tabledetalleventas').DataTable({
        "aProcessing":true,
        "aSeverSide":true,
        "language" :{
            "url":"https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
        },
        "ajax":{
            "url":" "+baseurl+"/Ventas/getdetalleventas/"+intidventas+"",
            "dataSrc":""
        },
        "columns": [
            { "data": 'IdDetalleVenta' },
            { "data": 'Producto' },
            { "data": 'Cantidad' },
            { "data": 'Descuento' },
            { "data": 'Precio' }
        ],
        "resonsieve":"true",
        "bDestroy":true,
        "iDisplayLength":10,
        "order":[[0,"desc"]]

    });
    $('#modalviewdetventas').modal('show');
}




function fnteditventa(){
    var btnediventa=Array.apply(null, document.querySelectorAll(".btnediventa"));
 
    
    btnediventa.forEach(function(btnediventa){
        
        btnediventa.addEventListener("click",function(){
            document.querySelector('#titlemodalventa').innerHTML = "Actualizar Estado de Envio";
            document.querySelector('.modalventa').classList.replace("headerregister","headerupdate");
            document.querySelector('.btnventa').classList.replace("btn-primary","btn-info");
            document.querySelector('#btntextventa').innerHTML="Actualizar";

            var idventa = this.getAttribute("rl");
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = baseurl+'/Ventas/getventaestado/'+idventa;
            request.open("GET",ajaxUrl,true);
            request.send();
            request.onreadystatechange =function(){
                if(request.readyState == 4 && request.status==200){
                var objdata=JSON.parse(request.responseText);
           
                document.querySelector("#idventa").value=objdata.IdVenta;
                document.querySelector("#liststatusventa").value=objdata.Estado;
                $('#liststatusventa').selectpicker('render');
            
                $('#modalformventaenvio').modal("show");
                }
            }
        });

       
    });
}


function round(num) {
    var m = Number((Math.abs(num) * 100).toPrecision(15));
    return Math.round(m) / 100 * Math.sign(num);
}
