var tablepedidos;

document.addEventListener("DOMContentLoaded",function(){
    tablepedidos=$('#tablepedidosclientes').DataTable({
        "aProcessing":true,
        "aSeverSide":true,
        "language" :{
            "url":"https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
        },
        "ajax":{
            "url":" "+baseurl+"/Pedidos/getpedidosempleados",
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

    });
});
$('#tablepedidosclientes').DataTable();