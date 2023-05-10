var tableofertas;

document.addEventListener("DOMContentLoaded", function () {

    tableofertas = $('#tableofertas').DataTable({
        "aProcessing": true,
        "aSeverSide": true,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
        },
        "ajax": {
            "url": " " + baseurl + "/Ofertas/getofertas",
            "dataSrc": ""
        },
        "columns": [
            { "data": 'IdOfertas' },
            // { "data": 'IdProducto' },
            { "data": 'Nombre' },
            { "data": 'Tipo' },
            { "data": 'Porcentaje' },
            { "data": 'FechaInicio' },
            { "data": 'FechaFinal' },
            { "data": 'Estado' },
            { "data": 'options' }
        ],
        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "desc"]]
    });
    var formofertas = document.querySelector("#formofertas");

    formofertas.onsubmit = function (e) {
        e.preventDefault();

        //TODO: Capturamos los datos
        // var intstatus = document.querySelector("#liststatus").value;
        // var intidoferta = document.querySelector("#idoferta").value;
        var intidproducto = document.querySelector("#txtproducto").value;
        var intporcentaje = document.querySelector("#txtporcentaje").value;
        var strfechaini = document.querySelector("#txtfechaini").value;
        var strfechafin = document.querySelector("#txtfechafin").value;

        //TODO: Captura para los errores
        const validateProducto = document.querySelector('#validateproducto');
        const validatePorcentaje = document.querySelector('#validateporcentaje');
        const validateFechaIni = document.querySelector('#validatefechaini');
        const validateFechaFin = document.querySelector('#validatefechafin');

        // TODO: Remover y agregar messages
        (intidproducto === '') ? _remove(validateProducto, 'El campo producto es obligatorio') : _add(validateProducto);
        (intporcentaje === '') ? _remove(validatePorcentaje, 'El campo porcentaje es obligatorio') : _add(validatePorcentaje);
        (strfechaini === '') ? _remove(validateFechaIni, 'El campo fecha inicio es obligatorio') : _add(validateFechaIni);
       
        if (strfechafin === '') {
            _remove(validateFechaFin, 'El campo fecha fin es obligatorio')
        } else if (strfechaini.valueOf() == strfechafin.valueOf()) {
            _remove(validateFechaFin, 'La Fecha tiene que ser mayor a la fecha de hoy');
        } else {
            _add(validateFechaFin);
        }


        if (intidproducto === '' || intporcentaje === '' || strfechaini === '' || strfechafin === '' || (strfechaini.valueOf() == strfechafin.valueOf())) {
            return false;
        } else {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = baseurl + '/Ofertas/setofertas';
            var formdata = new FormData(formofertas);
            request.open("POST", ajaxUrl, true);
            request.send(formdata);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    console.log(request.responseText);
                    var obdata = JSON.parse(request.responseText);
                    console.log(obdata);
                    if (obdata.status) {
                        $('#modalformofertas').modal("hide");
                        formofertas.reset();
                        swal("Oferta agregada", obdata.msg, "success");
                        tableofertas.ajax.reload(function () {
                            fnteditofertas();
                            fntdelofertas();
                        });
                    } else {
                        swal("Error", obdata.msg, "error");
                    }
                }
            }
        }
    }


    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = baseurl + '/Ofertas/getofertas';
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.status == 200) {
            request.onload = function () {
                objdata = JSON.parse(request.responseText);
                allProductos();
            }
        }
    }

}, false);

window.addEventListener('load', function () {
    fntproductosofertas();
    fnteditofertas();
    fntdelofertas();
}, false);

$('#tableofertas').DataTable();

function _remove(input, message) {
    input.classList.remove('d-none');
    input.innerHTML = message;
}

function _add(input) {
    input.classList.add('d-none');
    input.innerHTML = '';
}

function validateNumber(e) {
    const pattern = /^[0-9]$/;
    return pattern.test(e.key )
}

function openmodal() {
    document.querySelector("#selected").classList.add('d-none');
    document.querySelector('#idoferta').value = "";
    document.querySelector('#titlemodal').innerHTML = "Nueva Oferta";
    document.querySelector('.modal-header').classList.replace("headerupdate", "headerregister");
    document.querySelector('#btnactionform').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btntext').innerHTML = "Guardar";
    document.querySelector('#formofertas').reset();
    $('#modalformofertas').modal("show");
};

function fntproductosofertas() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = baseurl + '/Ofertas/getselectproductos';
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            document.querySelector('#txtproducto').innerHTML = request.responseText;
            // document.querySelector('#txtproducto').value = 1;
            $('#txtproducto').selectpicker('render');
        }
    }
}

function fnteditofertas() {
    var btneditofertas = Array.apply(null, document.querySelectorAll(".btneditofertas"));

    btneditofertas.forEach(function (btneditofertas) {
        btneditofertas.addEventListener("click", function () {
            document.querySelector('#titlemodal').innerHTML = "Actualizar Oferta";
            document.querySelector('.modal-header').classList.replace("headerregister", "headerupdate");
            document.querySelector('#btnactionform').classList.replace("btn-primary", "btn-info");
            document.querySelector('#btntext').innerHTML = "Actualizar";

            var idofertas = this.getAttribute("rl");
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = baseurl + '/Ofertas/getoferta/' + idofertas;
            request.open("GET", ajaxUrl, true);
            request.send();
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    //console.log(request.responseText);
                    var objdata = JSON.parse(request.responseText);
                    if (objdata.status) {
                        document.querySelector("#idoferta").value = objdata.data.IdOfertas;
                        document.querySelector("#txtproducto").value = objdata.data.IdProducto;
                        document.querySelector("#txtporcentaje").value = objdata.data.Porcentaje;
                        document.querySelector("#txtfechaini").value = objdata.data.FechaInicio;
                        document.querySelector("#txtfechafin").value = objdata.data.FechaFinal;
                        document.querySelector("#selected").classList.remove('d-none');
                        
                        $('#txtproducto').selectpicker('render');

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
                        $('#modalformofertas').modal("show");
                    } else {
                        swal("Error", objdata.msg, "error");
                    }
                }
            }

        });
    });
};

function fntdelofertas() {
    var btndelofertas = document.querySelectorAll(".btndelofertas")
    btndelofertas.forEach(function (btndelofertas) {
        btndelofertas.addEventListener("click", function () {
            var idofertas = this.getAttribute("rl");
            swal({
                title: "Eliminar oferta ? ",
                text: "¿Realmente Quiere eliminar esta oferta?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, Eliminar",
                cancelButtonText: "No, Cancelar",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    var ajaxUrl = baseurl + '/Ofertas/delofertas/';
                    var strdata = "idofertas=" + idofertas;
                    request.open("POST", ajaxUrl, true);
                    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    request.send(strdata);
                    request.onreadystatechange = function () {
                        if (request.readyState == 4 && request.status == 200) {
                            //console.log(request.responseText);
                            var objdata = JSON.parse(request.responseText);
                            if (objdata.status) {
                                swal("Eliminar!", objdata.msg, "success");
                                tableofertas.ajax.reload(function () {
                                    //fnteditrol();
                                    //fntdelmateria();
                                    //fntpermisosrol();
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


function allProductos() {
    const fecha = new Date();
    for (var i = 0; i < objdata.length; i++) {
        const f = moment(fecha).format('DD/MM/YYYY');
        const ff = moment(objdata[i].FechaFinal).format('DD/MM/YYYY');
        if (validarFechaEnRango(f, ff)) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = baseurl + '/Ofertas/setofertaEstado/' + objdata[i].IdOfertas;
            request.open("PUT", ajaxUrl, true);
            request.send();
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    // console.log(request.responseText);
                    var objdata = JSON.parse(request.responseText);
                    if (objdata.status) {
                        tableofertas.ajax.reload(function () {

                        });
                    } else {
                        swal("Error", objdata.msg, "error");
                    }
                }
            }
        }
    }
}

function validarFechaEnRango(fecha, fin) {
    // return inicio.valueOf() <= fecha.valueOf() && fecha.valueOf() <= fin.valueOf();
    return fin.valueOf() <= fecha.valueOf();
}