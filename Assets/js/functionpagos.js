var conversion=0;
var precio=0;
document.addEventListener("DOMContentLoaded",function(){
    
    PayPal();
    request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    ajaxUrl = baseurl+'/Carrito/contents';
    
    request.open("GET",ajaxUrl,true);
    request.send();

     
    request.onreadystatechange =function(){
        var htmlcatalogos='';
        var htmltotal='';
        
        if(request.readyState == 4 && request.status==200){
            //console.log(request.responseText);
            request.onload = function(){
            var objdata=JSON.parse(request.responseText);

    

            objdata.forEach(element => {
                htmlcatalogos += `
                <div class="item"><span class="price">${element["price"]} Bs</span>
                    <p class="item-name">${element["name"]}</p>
                    <p class="item-description">Talla: ${element["size"]}</p>
                    <p class="item-description">${element["qty"]} unidad</p>
                </div>
            
                `;
         
            });



            htmltotal=`<div class="total"><span>Total</span><span class="price">450 Bs</span></div>`;
            document.querySelector('.listproducts').innerHTML = htmlcatalogos;
            
            }
            
        }
    }

    calculototal();
 
  
    document.querySelector('.montototalpayconversion').innerHTML = round(conversion) +" $.";
  
    
});


function calculototal(){



    requestt = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    ajaxUrlt = baseurl+'/Carrito/total';
    
    requestt.open("GET",ajaxUrlt,true);
    requestt.send();


    const moneda_one = "BOB";
    const moneda_two = "USD";
 

    requestconvert = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    ajaxUrlconvert = `https://api.exchangerate-api.com/v4/latest/${moneda_one}`;
    
    requestconvert.open("GET",ajaxUrlconvert,true);
    requestconvert.send();


    requestt.onreadystatechange =function(){
        if(requestt.readyState == 4 && requestt.status==200){
            var objdata=JSON.parse(requestt.responseText);
            precio = round(objdata);
            document.querySelector('.montototalpay').innerHTML = round(objdata) +" Bs.";
            conversion =round( precio * 0.144);
            document.querySelector('.montototalpayconversion').innerHTML = round(conversion) +" $.";
        }
    }

    requestconvert.onreadystatechange =function(){
        requestconvert.onload = function(){
        if(requestconvert.readyState == 4 && requestconvert.status==200){
            var objdataconvert=JSON.parse(requestconvert.responseText);
            let taza=  objdataconvert.rates[moneda_two];
            conversion =round( precio * taza);
            
            document.querySelector('.montototalpayconversion').innerHTML = round(conversion) +" $.";
        }
        }
    }

   
}


function round(num) {
    var m = Number((Math.abs(num) * 100).toPrecision(15));
    return Math.round(m) / 100 * Math.sign(num);
}


function PayPal(){
    paypal.Buttons({
        style:{
            label:'pay'
        },
        createOrder: (data, actions) => {
            return actions.order.create({
              purchase_units: [{
                amount: {
                  value: conversion 
                }
              }]
            });
        },
        onCancel: (data, actions) =>{
            swal("Cancelado","Pago Cacelado","error");
        },
        onApprove: (data, actions) => {
            return actions.order.capture().then(function(orderData) {
              const transaction = orderData.purchase_units[0].payments.captures[0];
              if(transaction.status){
             
                    requestt = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    ajaxUrlt = baseurl+'/Pagos/setventa/'+conversion;
                    requestt.open("GET",ajaxUrlt,true);
                    requestt.send();
                    swal({
                        title:"Pagos PayPal",
                        text: "Pago Completado Correctamente",
                        type:"success",
                   
                        confirmButtonText: "Ok",
                        closeOnConfirm:false,
                        closeOnCancel:true
                    },function(isConfirm){
                        if(isConfirm){
                            location.href =baseurl+"/Factura/generarFactura/";
                        }
                    });
             
                  
              }
              
            });
          }
    }).render('#paypal-btn-container');
}


