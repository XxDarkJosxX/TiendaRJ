// Agrega la referencia a la librería zxcvbn en tu HTML

document.addEventListener("DOMContentLoaded", function () {
    var formusuarios = document.querySelector("#formclientes");

    formusuarios.onsubmit = function (e) {
        e.preventDefault();
        var intci = document.querySelector("#txtci").value;
        var strnombre = document.querySelector("#txtnombre").value;
        var strdireccion = document.querySelector("#txtapellido").value;
        var strapellido = document.querySelector("#txtdireccion").value;
        var strcorreo = document.querySelector("#txtcorreo").value;
        var strcontrasenia = document.querySelector("#txtcontrasenia").value;

        if (
            strnombre == "" ||
            strapellido == "" ||
            strcorreo == "" ||
            strcontrasenia == ""
        ) {
            swal("Atención", "Los campos con (*) son obligatorios.", "error");
            return false;
        }

        // Validación de contraseña con zxcvbn
        var passwordStrength = zxcvbn(strcontrasenia);
        if (passwordStrength.score < 3) {
            swal(
                "Contraseña débil",
                "Por favor, elija una contraseña más segura.",
                "error"
            );
            return false;
        }

        var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{12,}$/;
        if (!regex.test(strcontrasenia)) {
            swal(
                "Contraseña inválida",
                "La contraseña debe tener al menos 12 caracteres, incluyendo al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.",
                "error"
            );
            return false;
        }

        var request = window.XMLHttpRequest
            ? new XMLHttpRequest()
            : new ActiveXObject("Microsoft.XMLHTTP");
        var ajaxUrl = baseurl + "/Registrarse/setregistrarse";
        var formdata = new FormData(formusuarios);
        request.open("POST", ajaxUrl, true);
        request.send(formdata);
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                console.log(request.responseText);
                var obdata = JSON.parse(request.responseText);

                if (obdata.status) {
                    formusuarios.reset();
                    swal("", obdata.msg, "success");
                } else {
                    swal("Error", obdata.msg, "error");
                }
            }
        };
    };
}, false);
