

document.addEventListener("DOMContentLoaded",function(){
   
    listarcarrito();
    calculototal();
});

function calculototal(){
    requestt = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    ajaxUrlt = baseurl+'/Carrito/total';
    
    requestt.open("GET",ajaxUrlt,true);
    requestt.send();
    requestt.onreadystatechange =function(){
        if(requestt.readyState == 4 && requestt.status==200){
            var objdata=JSON.parse(requestt.responseText);
         
            document.querySelector('.txttotal').innerHTML = round( objdata) +" Bs.";
            
        }
    }
}

function listarcarrito(){
    request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    ajaxUrl = baseurl+'/Carrito/contents';
    
    request.open("GET",ajaxUrl,true);
    request.send();

  
    request.onreadystatechange =function(){
        var htmlcatalogos='';
        
        if(request.readyState == 4 && request.status==200){
            //console.log(request.responseText);
            request.onload = function(){
            var objdata=JSON.parse(request.responseText);

            if(objdata == ''){
                htmlcatalogos =`
                    <div class="product">
                        <div class="row justify-content-center align-items-center">
                        
                        <h4>Su carrito esta vacío</h4>
                        </div>
                    </div>
                `;
                document.querySelector('.items').innerHTML = htmlcatalogos;
                return;
            }
            
            var oferta="Sin Aplicar";

            objdata.forEach(element => {
                htmlcatalogos += `<div class="product">
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-3">
                        <div class="product-image"><img class="img-fluid2 d-block mx-auto image" src="Assets/Images/productos/${element["namefoto"]}"></div>
                    </div>
                    <div class="col-md-5 product-info">
                    <a href="#" class="product-name">${element["name"]}</a>&nbsp&nbsp&nbsp&nbsp&nbsp
                    <button class="btn btn-danger btn-sm btndelstyle btndelcarrito" rl="${element["key"]}" title="Eliminar" type="button"><i class="fas fa-trash-alt"></i></button>
                        <div class="product-specs">
                            <div><span>Color:&nbsp;</span><span class="value">azul</span></div>
                            <div><span>Talla:&nbsp;</span><span class="value">${element["size"]}</span></div>
                        </div>
                    </div>
                    <div class="col-6 col-md-2 quantity">
                    <label class="d-none d-md-block" for="quantity">Cantidad</label>
                    <input min="1" type="number"  value="${element["qty"]}" rl="${element["key"]}" id="numberqty" name="numberqty" class="form-control quantity-input btnupdatecarrito">
                    </div>
                    <div class="col-6 col-md-2 price"><span>${element["price"]} Bs</span></div>
                </div>
            </div>`;
            if(element["porcentaje"] != 0){
                oferta="Aplicado";
            }
            });
            document.querySelector('.txtdescuento').innerHTML = oferta;
            document.querySelector('.items').innerHTML = htmlcatalogos;
            fntdelcarrito();fntupdateqty();
            }
            
        }
    }
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

function fntdelcarrito(){
    var btndelcarrito=document.querySelectorAll(".btndelcarrito");
    
    btndelcarrito.forEach(function(btndelcarrito){
        
        btndelcarrito.addEventListener("click",function(event){
            event.preventDefault();
            var IdProducto = this.getAttribute("rl");
            request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            ajaxUrl = baseurl+'/Carrito/remove/'+IdProducto;
            //alert();
            request.open("GET",ajaxUrl,true);
            request.send();
            listarcarrito();
            calculototal();
        });
    });
}




function round(num) {
    var m = Number((Math.abs(num) * 100).toPrecision(15));
    return Math.round(m) / 100 * Math.sign(num);
}

