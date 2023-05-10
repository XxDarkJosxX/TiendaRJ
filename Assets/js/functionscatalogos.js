var objdatacat='';
var objdataproductos='';

var request='';
var ajaxUrl='';

var nombrecategorias = [];

document.addEventListener("DOMContentLoaded",function(){
    request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    ajaxUrl = baseurl+'/Catalogo/getproductos';
    
    request.open("GET",ajaxUrl,true);
    request.send();


    var requestcat = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrlcat = baseurl+'/Catalogo/getcategorias';
    
    requestcat.open("GET",ajaxUrlcat,true);
    requestcat.send();
  

  
    request.onreadystatechange =function(){
        if(request.status==200){
            //console.log(request.responseText);
         
            
            request.onload = function(){
                objdataproductos=JSON.parse(request.responseText);
                allcategorias();
               
               
            }
            
        }
    }

    //categorias

    requestcat.onreadystatechange =function(){
        if(requestcat.status==200 && requestcat.readyState == 4 ){
            //console.log(request.responseText);
         
            
            requestcat.onload = function(){
                objdatacat=JSON.parse(requestcat.responseText);
                var htmlcatalogos='';

                for(var i = 0; i < objdatacat.length; i++) {
                    htmlcatalogos += `
                    <div class="form-check">
                    <input title="checkcategoria" rl="${objdatacat[i].Tipo}" class="form-check-input checkcategoria" name="checkcategoria" type="checkbox" id="${objdatacat[i].Tipo}">
                    <label class="form-check-label" for="${objdatacat[i].Tipo}">${objdatacat[i].Tipo}</label>
                    </div>
                    
                `;
                }
                document.querySelector('.categoriaslist').innerHTML = htmlcatalogos;
                fntcheckcategoria();
              
            }
           
        }
    }
    
});

function allcategorias(){
    var htmlcatalogos='';

                for(var i = 0; i < objdataproductos.length; i++) {
                    htmlcatalogos += `<div class="col-12 col-md-6 col-lg-4">
                    <div class="clean-product-item">
                        
                        <div class="d-flex justify-content-between">
                            <span class="col-3"><i class="fas fa-heart"></i></span>`;
                            
                            if (objdataproductos[i].Porcentaje != null) {
                                htmlcatalogos += `<span class="col- badge badge-primary d-inline-flex p-2">${objdataproductos[i].Porcentaje} %</span>`;
                            }

                    htmlcatalogos += `
                        </div>


                        <div class="image">
                        <a href="#"><img width="120" height="180" class="img-fluid d-block mx-auto imgtam" src="Assets/Images/productos/${objdataproductos[i].foto}"></a>
                        </div>
                       
                       
                        <div class="text-center">
                        <div class="productname card-title ">${objdataproductos[i].Nombre}</div>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <p class="mt-2 h6">${objdataproductos[i].Tipo}</p>
                        </div>
                       <center><button  rl="${objdataproductos[i].IdProducto}" class="btn btn-primary btndetalle" type="button"><i class="icon-basket"></i> Ver</button></center> 
                    </div>
                </div>`;
                }
                document.querySelector('.catalogolist').innerHTML = htmlcatalogos;
                openmodal();
}

function filtrocategorias(){
    var htmlcatalogos='';

    for(var i=0; i< nombrecategorias.length; i++){
        for(var j=0; j< objdataproductos.length; j++){
            
            if(objdataproductos[j].Tipo == nombrecategorias[i]){

                htmlcatalogos += `<div class="col-12 col-md-6 col-lg-4">
                <div class="clean-product-item">
                    
                    <div class="d-flex justify-content-between">
                        <span class="col-3"><i class="fas fa-heart"></i></span>`;
                        
                        if (objdataproductos[j].Porcentaje != null) {
                            htmlcatalogos += `<span class="col- badge badge-primary d-inline-flex p-2">${objdataproductos[j].Porcentaje} %</span>`;
                        }

                htmlcatalogos += `
                    </div>


                    <div class="image">
                    <a href="#"><img width="120" height="180" class="img-fluid d-block mx-auto imgtam" src="Assets/Images/productos/${objdataproductos[j].foto}"></a>
                    </div>
                   
                   
                    <div class="text-center">
                    <div class="productname card-title ">${objdataproductos[j].Nombre}</div>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <p class="mt-2 h6">${objdataproductos[j].Tipo}</p>
                    </div>
                   <center><button  rl="${objdataproductos[j].IdProducto}" class="btn btn-primary btndetalle" type="button"><i class="icon-basket"></i> Ver</button></center> 
                </div>
            </div>`;
            }
           
        }
        
    }

    document.querySelector('.catalogolist').innerHTML = htmlcatalogos;
    openmodal();
}

function fntcheckcategoria(){
    var checkcategorias=document.querySelectorAll(".checkcategoria");
    
    checkcategorias.forEach(function(checkcategorias){
        
        checkcategorias.addEventListener("change",function(){
            if(checkcategorias.checked == true){
                let nombrecategoria = this.getAttribute("rl");
                nombrecategorias.push(nombrecategoria);
                filtrocategorias();
              
            }
            if (checkcategorias.checked == false){
                nombrecategoria = this.getAttribute("rl");

                nombrecategorias=nombrecategorias.filter((item) => item !== nombrecategoria);
              
                filtrocategorias();
            }
            if(nombrecategorias.length == 0){
                allcategorias();
            }
      
        });
    });
}

let IdProducto=0;
let idpreciotalla=0;
function openmodal(){
    
    var btndetalle=document.querySelectorAll(".btndetalle");
    var htmltallas='';
    btndetalle.forEach(function(btndetalle){

        btndetalle.addEventListener("click",function(){
              
            IdProducto = this.getAttribute("rl");
            //resquest para conseguir los datos del producto seleccionado
            var requestp = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrlp = baseurl+'/Catalogo/getproducto/'+IdProducto;
            requestp.open("GET",ajaxUrlp,true);
            requestp.send();
            
            //
            var requestt = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrlt = baseurl+'/Catalogo/gettallas/'+IdProducto;
            requestt.open("GET",ajaxUrlt,true);
            requestt.send();
   


            requestt.onreadystatechange =function(){
     
                if(requestt.readyState == 4 && requestt.status==200){
                    requestt.onload = function(){
                        var objdata=JSON.parse(requestt.responseText);
                        if(objdata != ""){
                            var checked="checked";
                            var htmltallas='';
                            var htmltallasespecificacion='';
                            var titleprecioTalla=`
                                                <tr>
                                                    <td class="stat">Tallas Disponibles</td>
                                                    <td class="stat">Precio</td>
                                                </tr>`
                            ;
                            objdata.forEach(element => {
                                    htmltallas += `
                                    <label>
                                        <input ${checked} rl="${IdProducto}" type="radio" name="txttalla" id="txttalla" class="txttalla" value="${element["IdTalla"]}"> ${element["Nombre"]} &nbsp;
                                    </label>
                                    `;
                                    checked="";
                                    htmltallasespecificacion+= titleprecioTalla+`
                                    <tr>
                                    <td>${element["Nombre"]}</td>
                                    <td>${element["Precio"]}</td>
                                    </tr>
                                    `;
                                    titleprecioTalla="";
                            });
                            
                            document.querySelector(".txttallas").innerHTML= htmltallas;
                      

                            document.querySelector(".buttoncarrito").innerHTML = `
                            <button  class="btn btn-primary btnaddcarrito" type="button">
                            <i class="icon-basket"></i> Añadir al carrito
                            </button>`;
                            document.querySelector(".preciotalla").innerHTML=htmltallasespecificacion;

                            gettallaradio();
                            fntaddcarrito();
                        }else{
                            htmltallas = `
                            <label>
                                No Disponible
                            </label>
                            `;
                            document.querySelector(".txttallas").innerHTML=htmltallas;
                            document.querySelector(".buttoncarrito").innerHTML = "";
                            document.querySelector(".preciotxt").innerHTML = `
                                No Disponible
                            `;
                            document.querySelector(".preciotalla").innerHTML="<br>&nbsp;&nbsp;&nbsp; No Disponible";
                        }
                     
    
                      
                    }
                    
                }
            }



            requestp.onreadystatechange =function(){
                if(requestp.readyState == 4 && requestp.status==200){
                    requestp.onload = function(){
                    console.log(requestp.responseText);
                  
                    var objdata=JSON.parse(requestp.responseText);
                    //alert(objdata.data.IdProducto);
                    var iduser=objdata.data.IdProducto;
                    document.querySelector(".nombreproducto").innerHTML = objdata.data.Nombre;

                    document.querySelector(".descripcionproducto").innerHTML = objdata.data.Descripcion;
                    document.querySelector(".gallery").innerHTML = `
                    <div  data-dismiss="modal" >
                    <a  href="Assets/Images/productos/${objdata.data.foto}">
                    <img class="img-fluid d-block mx-auto" src="Assets/Images/productos/${objdata.data.foto}">
                    </a>
                    </div>`;
                
                    };
                    
                }};
                
            $('#modalinfodetalles').modal("show");
           
        });
        
    });
 
  
}



function gettallaradio(){
    let idTalla=0;
    var txttalla=Array.apply(null, document.querySelectorAll(".txttalla"));
 
    let precio =0;
    let preciofinal =0;
    let porcentaje =0;


    let findselected = () => {
   
        idTalla = document.querySelector(".txttalla:checked").value;
        var requestp = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrlp = baseurl+'/Catalogo/getpreciotalla/'+IdProducto+'/'+idTalla;

        requestp.open("GET",ajaxUrlp,true);
        requestp.send();

        
        requestp.onreadystatechange =function(){
            
            if(requestp.readyState == 4 && requestp.status==200){
                    console.log(requestp.responseText);
                    objdata=JSON.parse(requestp.responseText);
                    idpreciotalla=objdata.data.IdPrecioTalla;
                    precio = objdata.data.Precio;
                    
                    if(objdata.data.Porcentaje != null){
                        porcentaje = objdata.data.Porcentaje;
                        var porcentajefnal = (100 - porcentaje)/100;
                        preciofinal = round(precio * porcentajefnal);
            
                        document.querySelector(".preciotxt").innerHTML = `
                        <h3 class="precioproducto"><del>${precio} Bs.</del> &nbsp;&nbsp; ${preciofinal} Bs.</h3>
                        
                        `;
                    } else{
                        document.querySelector(".preciotxt").innerHTML = `
                        <h3 class="precioproducto">${precio} Bs.</h3>
                        `;
                    }
                   
            }
        };

    
         
         
    }

    txttalla.forEach(function(txttalla){
        txttalla.addEventListener("change",findselected);
      
    });

    findselected();
    
    
}


function oferta(precio){
    
    var requesto = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrlo = baseurl+'/Catalogo/getoferta/'+IdProducto;
    
    requesto.open("GET",ajaxUrlo,true);
    requesto.send();
    requesto.onload =function(){
        var objdatao=JSON.parse(requesto.responseText);
        if(objdatao != ""){
            var porcentaje =objdatao.Porcentaje;
            document.querySelector(".preciotxt").innerHTML = `
            <h3 class="precioproducto">${precio} Bs. ${porcentaje}</h3>
              
            `;
        }
       
    }
}


function fntaddcarrito(){
    var btnaddcarrito= document.querySelector(".btnaddcarrito");
        
        
        btnaddcarrito.addEventListener("click",function(){
            
            var requestp = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrlp = baseurl+'/Carrito/addcarrito/'+IdProducto+'/'+idpreciotalla;
            requestp.open("GET",ajaxUrlp,true);
            requestp.send();
            requestp.onreadystatechange =function(){
                if(requestp.readyState == 4 && requestp.status==200){
                    swal("Carrito","Producto Añadido","success");
                    
                }
            }
        });
 
}


function round(num) {
    var m = Number((Math.abs(num) * 100).toPrecision(15));
    return Math.round(m) / 100 * Math.sign(num);
}

