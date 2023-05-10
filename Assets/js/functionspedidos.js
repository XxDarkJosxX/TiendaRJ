var tablepedidos;

document.addEventListener("DOMContentLoaded",function(){
    tablepedidos=$('#tablepedidosclientes').DataTable({
        "aProcessing":true,
        "aSeverSide":true,
        "language" :{
            "url":"https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
        },
        "ajax":{
            "url":" "+baseurl+"/Pedidos/getpedidosclientes",
            "dataSrc":""
        },
        "columns": [
            { "data": 'IdVenta' },
            { "data": 'Nombre' },
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

$('#tabledetalleventas').DataTable();