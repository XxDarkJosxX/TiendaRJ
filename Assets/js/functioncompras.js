
var tablecompras;

document.addEventListener("DOMContentLoaded", function () {
    tablecompras = $("#tablecompras").DataTable({
        aProcessing: true,
        aSeverSide: true,
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json",
        },
        ajax: {
            url: " " + baseurl + "/Compras/getcompras",
            dataSrc: "",
        },
        columns: [
            { data: "IdCompra" },
            { data: "NombreU" },
            { data: "NombreP" },
            { data: "NombreM" },
            { data: "Total" },
            { data: "Fecha" },
            { data: "Descripcion"},
            { data: "Estado" },
            { data: "options" },
        ],
        resonsieve: "true",
        bDestroy: true,
        iDisplayLength: 10,
        order: [[0, "desc"]],
    });

    //Insert
    var formcompras = document.querySelector("#formcompras");
    formcompras.onsubmit = function (e) {
        e.preventDefault();
        var intidusuario = document.querySelector("#idusuario").value;
        var intidproveedor = document.querySelector("#idproveedor").value;
        var intidmateriapr = document.querySelector("#idmateriapr").value;
        var inttotal = document.querySelector("#txttotal").value;
        var intstatus = document.querySelector("#liststatus").value;

        if (intidusuario == '' || intidproveedor == '' || intidmateriapr == '' || inttotal == '') {
            swal("Atención", "Todos los campos son obligatorios.", "error");
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = baseurl + '/Compras/setcompras';

        var formdata = new FormData(formcompras);

        request.open("POST", ajaxUrl, true);
        request.send(formdata);

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                console.log(request.responseText);
                var obdata = JSON.parse(request.responseText);
                console.log(obdata);
                if (obdata.status) {
                    $('#modalformcompra').modal("hide");
                    formcompras.reset();
                    swal("Compras", obdata.msg, "success");
                    tablecompras.ajax.reload(function () {
                        //fnteditrol();
                        //fntdelrol();
                        //fntproveedorcompra();
                    });

                } else {
                    swal("Error", obdata.msg, "error");
                }
            }
        }
    }

}, false);



$('#tablecompras').DataTable();
function openmodal() {
    document.querySelector('#idcompra').value = "";
    document.querySelector('#titlemodal').innerHTML = "Nueva Compra";
    document.querySelector('.modal-header').classList.replace("headerupdate", "headerregister");
    document.querySelector('#btnactionform').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btntext').innerHTML = "Guardar";
    document.querySelector('#formcompras').reset();
    fntusuariocompra();
    $('#modalformcompra').modal("show");

}

window.addEventListener('load', function () {
    fntusuariocompra();
    fntproveedorcompra();
    fntmateriaprcompra();
}, false)

function fntusuariocompra() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = baseurl + '/Compras/getselectusuarios';
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var objdata = JSON.parse(request.responseText);
            console.log(objdata);
            document.querySelector('#idusuario').value = objdata.Nombre +' '+objdata.Apellido;
        }
    }
}

function fntproveedorcompra() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = baseurl + '/Compras/getselectproveedor';
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {

            document.querySelector('#idproveedor').innerHTML = request.responseText;
            document.querySelector('#idproveedor').value = 1;
            $('#idproveedor').selectpicker('render');
        }
    }
}

function fntmateriaprcompra() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = baseurl + '/Compras/getselectmateria';
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {

            document.querySelector('#idmateriapr').innerHTML = request.responseText;
            document.querySelector('#idmateriapr').value = 1;
            $('#idmateriapr').selectpicker('render');
        }
    }
}

function fnteditcompra() {
    var btneditcompra = Array.apply(
        null,
        document.querySelectorAll(".btneditcompra")
    );
    btneditcompra.forEach(function (btneditcompra) {
        btneditcompra.addEventListener("click", function () {
            document.querySelector("#titlemodal").innerHTML = "Actualizar Compra";
            document
                .querySelector(".modal-header")
                .classList.replace("headerregister", "headerupdate");
            document
                .querySelector("#btnactionform")
                .classList.replace("btn-primary", "btn-info");
            document.querySelector("#btntext").innerHTML = "Actualizar";

            var idcompra = this.getAttribute("rl");
            var request = window.XMLHttpRequest
                ? new XMLHttpRequest()
                : new ActiveXObject("Microsoft.XMLHTTP");
            var ajaxUrl = baseurl + "/Compras/getcompra/" + idcompra;
            request.open("GET", ajaxUrl, true);
            request.send();
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    // console.log(request.responseText);
                    var objdata = JSON.parse(request.responseText);
                    if (objdata.status) {
                        document.querySelector("#idcompra").value = objdata.data.IdCompra;
                        document.querySelector("#idusuario").value = objdata.data.IdUsuario;
                        document.querySelector("#idproveedor").value = objdata.data.IdProveedor;
                        document.querySelector("#idmateriapr").value =objdata.data.IdMaterialPr;
                        document.querySelector("#txttotal").value = objdata.data.Total;
                        document.querySelector("#txtfecha").value = objdata.data.Fecha;
                        document.querySelector("#txtdescripcion").value = objdata.data.Descripcion;

                        $("#idusuario").selectpicker("render");
                        $("#idproveedor").selectpicker("render");
                        $("#idmateria").selectpicker("render");

                        if (objdata.data.Estado == 1) {
                            var optionselect =
                                '<option value="1" selected class="notblock">Activo</option>';
                        } else {
                            var optionselect =
                                '<option value="2" selected class="notblock">Inactivo</option>';
                        }
                        var htmlselect = `${optionselect} 
                                        <option value="1">Activo</option> 
                                        <option value="2">Inactivo</option>
                                        `;
                        document.querySelector("#liststatus").innerHTML = htmlselect;

                        $("#modalformcompra").modal("show");
                    } else {
                        swal("Error", objdata.msg, "error");
                    }
                }
            };
        });
    });
}



