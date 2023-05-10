var tablecontratos;

document.addEventListener("DOMContentLoaded", function () {

    tablecontratos = $('#tablecontratos').DataTable({
        "aProcessing": true,
        "aSeverSide": true,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
        },
        "ajax": {
            "url": " " + baseurl + "/Contratos/getcontratos",
            "dataSrc": ""
        },
        "columns": [
            { "data": 'IdContrato' },
            // { "data": 'IdUsuario' },
            { "data": 'Usuario' },
            // { "data": 'IdCliente' },
            { "data": 'Cliente' },
            { "data": 'Descripcion' },
            { "data": 'FileName' },
            { "data": 'FileSize' },
            // { "data": 'FileUrl' },
            { "data": 'Fecha' },
            // { "data": 'Estado' },
            { "data": 'options' }
        ],
        "responsive": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "desc"]]
    });

    var formcontratos = document.querySelector("#formcontratos");

    formcontratos.onsubmit = function (e) {
        e.preventDefault();

        // var intstatus = document.querySelector("#liststatus").value;
        // var intidusuario = document.querySelector("#idusuario").value;

        //TODO: Capturamos los datos
        var intidcontrato = document.querySelector("#idcontrato").value;
        var datefecha = document.querySelector("#txtfecha").value;
        var filearchivo = document.querySelector("#txtarchivo").value;
        var intidcliente = document.querySelector("#idcliente").value;
        var strdescripcion = document.querySelector("#txtdescripcion").value;

        //TODO: Captura para los errores
        const validateFecha = document.querySelector('#validatefecha');
        const validateArchivo = document.querySelector('#validatearchivo');
        const validateDescripcion = document.querySelector('#validatedescripcion');
        const validateCliente = document.querySelector('#validatecliente');

        // TODO: Remover y agregar messages
        (datefecha === '') ? _remove(validateFecha, 'El campo fecha es obligatorio') : _add(validateFecha);
        (filearchivo === '') ? _remove(validateArchivo, 'El campo archivo es obligatorio') : _add(validateArchivo);
        (intidcliente === '') ? _remove(validateCliente, 'El campo cliente es obligatorio') : _add(validateCliente);
        
        if (strdescripcion === '') {
            _remove(validateDescripcion, 'El campo descripcion es obligatorio');
        } else if (strdescripcion.length > 100) {
            _remove(validateDescripcion, 'El campo descripcion puede tener 100 caracteres como maximo');
        } else {
            _add(validateDescripcion);
        }
        
        //TODO: Post Contrato
        if (datefecha === '' || filearchivo === '' || intidcliente === '' || strdescripcion === '') {
            return false;
        } else {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = baseurl + '/Contratos/setcontratos';
            var formdata = new FormData(formcontratos);
            request.open("POST", ajaxUrl, true);
            request.send(formdata);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    var obdata = JSON.parse(request.responseText);
                    if (obdata.status) {
                        $('#modalformcontratos').modal("hide");
                        formcontratos.reset();
                        swal("Se agrego correctamente", obdata.msg, "success");
                        tablecontratos.ajax.reload(function () { });
                    } else {
                        swal("Error", obdata.msg, "error");
                    }
                }
            }
        }
    }

}, false);


function _remove(input, message) {
    input.classList.remove('d-none');
    input.innerHTML = message;
}

function _add(input) {
    input.classList.add('d-none');
    input.innerHTML = '';
}

var _validFileExtensions = [".pdf", ".doc", ".docx"];
function ValidateSingleInput(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
        if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    document.querySelector('#validatearchivo').classList.add('d-none');
                    document.querySelector('#validatearchivo').innerHTML = '';
                    blnValid = true;
                    break;
                }
            }

            if (!blnValid) {
                document.querySelector('#validatearchivo').classList.remove('d-none');
                document.querySelector('#validatearchivo').innerHTML = `Formato invalido, solo se aceptan archivos ${_validFileExtensions.join(", ")}`;
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
}

function fntusuariocontrato() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = baseurl + '/Contratos/getselectusuarios';
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            document.querySelector('#idcliente').innerHTML = request.responseText;
            // document.querySelector('#idcliente').value = 0;
            $('#idcliente').selectpicker('render');
        }
    }
}

window.addEventListener('load', function () {
    fntusuariocontrato();
}, false)


$('#tablecontratos').DataTable();

function openmodal() {
    document.querySelector('#idcontrato').value = "";
    document.querySelector('#titlemodal').innerHTML = "Agregar Contrato";
    document.querySelector('.modal-header').classList.replace("headerupdate", "headerregister");
    document.querySelector('#btnactionform').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btntext').innerHTML = "Guardar";
    document.querySelector('#formcontratos').reset();
    $('#modalformcontratos').modal("show");
};

function fnteditcontrato() {
    var btneditcontratos = Array.apply(null, document.querySelectorAll(".btneditcontratos"));
    btneditcontratos.forEach(function (btneditcontratos) {
        btneditcontratos.addEventListener("click", function () {
            //alert("Click to close...");
            document.querySelector('#titlemodal').innerHTML = "Actualizar Usuario";
            document.querySelector('.modal-header').classList.replace("headerregister", "headerupdate");
            document.querySelector('#btnactionform').classList.replace("btn-primary", "btn-info");
            document.querySelector('#btntext').innerHTML = "Actualizar";

            var idproducto = this.getAttribute("rl");
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = baseurl + '/Usuarios/getusuario/' + idproducto;
            request.open("GET", ajaxUrl, true);
            request.send();
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    console.log(request.responseText);
                    var objdata = JSON.parse(request.responseText);
                    if (objdata.status) {
                        document.querySelector("#idusuario").value = objdata.data.IdUsuario;
                        document.querySelector("#txtnombre").value = objdata.data.Nombre;
                        document.querySelector("#txtapellido").value = objdata.data.Apellido;
                        document.querySelector("#txtcorreo").value = objdata.data.Correo;
                        //document.querySelector("#txtcontrasenia").value=objdata.data.Contrasenia;


                        document.querySelector("#txtrol").value = objdata.data.IdRoles;
                        $('#txtrol').selectpicker('render');



                        if (objdata.data.Estado == 1) {
                            var optionselect = '<option value="1" selected class="notblock">Activo</option>';
                        } else {
                            var optionselect = '<option value="2" selected class="notblock">Inactivo</option>';
                        }
                        var htmlselect = `${optionselect} 
                                        <option value="1">Activo</option> 
                                        <option value="2">Inactivo</option>
                                        `;
                        document.querySelector("#liststatus").innerHTML = htmlselect;



                        $('#modalformusuario').modal("show");
                    } else {
                        swal("Error", objdata.msg, "error");
                    }
                }
            }

        });
    });
}

function fntdelcontrato() {
    var btndelcontrato = document.querySelectorAll(".btndelcontrato")
    btndelcontrato.forEach(function (btndelcontrato) {
        btndelcontrato.addEventListener("click", function () {
            var idcontratos = this.getAttribute("rl");
            swal({
                title: "Eliminar Contrato",
                text: "¿Realmente quiere eliminar el Contrato?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, Eliminar",
                cancelButtonText: "No, Cancelar",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    var ajaxUrl = baseurl + '/Contratos/delcontrato/';
                    var strdata = "idcontrato=" + idcontratos;
                    request.open("POST", ajaxUrl, true);
                    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    request.send(strdata);
                    request.onreadystatechange = function () {
                        if (request.readyState == 4 && request.status == 200) {
                            var objdata = JSON.parse(request.responseText);
                            if (objdata.status) {
                                swal("Eliminar!", objdata.msg, "success");
                                tablecontratos.ajax.reload(function () {
                                });
                            } else {
                                swal("Error", objdata.msg, "error");
                            }
                        }
                    }
                }

            });
        });
    });
}