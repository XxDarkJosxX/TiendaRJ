$('.login-content [data-toggle="flip"]').click(function () {
  $(".login-box").toggleClass("flipped");
  return false;
});

document.addEventListener("DOMContentLoaded",function () {
    if (document.querySelector("#formlogin")) {
      let formlogin = document.querySelector("#formlogin");
      formlogin.onsubmit = function (e) {
        e.preventDefault();

        let stremail = document.querySelector("#txtemail").value;
        let strpasswod = document.querySelector("#txtpassword").value;

        if (stremail == "" || strpasswod == "") {
          swal("Por favor", "Ingresa tu correo y contraseña", "error");
          return false;
        } else {
          var request = window.XMLHttpRequest
            ? new XMLHttpRequest()
            : new ActiveXObject("Microsoft.XMLHTTP");
          var ajaxUrl = baseurl + "/Login/loginuser";
          var formdata = new FormData(formlogin);

          request.open("POST", ajaxUrl, true);

          request.send(formdata);
          //console.log(request);

          request.onreadystatechange = function () {
            if (request.readyState != 4) return;
            if (request.status == 200) {
              var obdata = JSON.parse(request.responseText);
              if (obdata.status) {
                window.location = baseurl + "/dashboard";
              } else {
                swal("Error", obdata.msg, "error");
                document.querySelector("#txtpassword").value = "";
              }
            } else {
              swal("Error", "Error en el proceso", "error");
            }
          };
        }
      };
    }

    
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
          var ajaxUrl = baseurl + "/Login/resetpassword";
          var formdata = new FormData(formreset);

          request.open("POST", ajaxUrl, true);

          request.send(formdata);
          request.onreadystatechange = function(){
              console.log(request);
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

  if(document.querySelector('#formcambiarpass')){
    let formcambio=document.querySelector('#formcambiarpass');
    formcambio.onsubmit = function(e){
      e.preventDefault();
      let strpassword=document.querySelector('#txtpasswordcam').value;
      let strpasswordconfirm=document.querySelector('#txtpasswordconfirm').value;
      let iduser=document.querySelector('#iduser').value;
      if(strpassword == "" || strpasswordconfirm == ""){
          swal("Por favor", "Escribe la nueva contraseña.","error");
          return false;
      }else{
        if(strpassword.lenght < 5){
          swal("Por favor", "La contraseña debe tener como minimo 5 caracteres.","info");
          return false;
        }
        if(strpassword != strpasswordconfirm){
          swal("Atencion", "Las contraseñas no son iguales.","info");
          return false;
        }
        var request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
        var ajaxUrl = baseurl + "/Login/setpassword";
        var formdata = new FormData(formcambio);
        request.open("POST", ajaxUrl, true);
        request.send(formdata);
        request.onreadystatechange = function(){
          if(request.readyState != 4) return;
          if(request.status == 200){
            var obdata=JSON.parse(request.responseText);
            if(obdata.status){
              swal({
                title:"Atencion",
                text: obdata.msg,
                type:"success",
           
                confirmButtonText: "Iniciar Sesion",
           
                closeOnConfirm:false,
           
              },function(isConfirm){
                  if(isConfirm){
                      window.location= baseurl+'/login';
                  }
              });
            }else{
              swal("Atencion",obdata.msg,"error");
            }
          }else{
            swal("Atencion","Error en el proceso","error");
          }
        }
      }
    }
  }

  },false);


