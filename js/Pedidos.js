function busqueda() {
    var usuario = $('#busquedaPorUsuario').val();
    var fechaPedido = $('#busquedaPorFechaPedido').val();
    var fechaAlmacen = $('#busquedaPorFechaAlmacen').val();
    var fechaEnvio = $('#busquedaPorFechaEnvio').val();
    var fechaRecibido = $('#busquedaPorFechaRecibido').val();
    var fechaFinalizado = $('#busquedaPorFechaFinalizado').val();
    var transporte = $('#busquedaPorTransporte').val();
    var direccion = $('#busquedaPorDireccion').val();

    var parametros = '&c=Pedidos&a=busqueda';
    parametros += '&usuario=' + usuario;
    parametros += '&fechaPedido=' + fechaPedido;
    parametros += '&fechaAlmacen=' + fechaAlmacen;
    parametros += '&fechaEnvio=' + fechaEnvio;
    parametros += '&fechaRecibido=' + fechaRecibido;
    parametros += '&fechaFinalizado=' + fechaFinalizado;
    parametros += '&transporte=' + transporte;
    parametros += '&direccion=' + direccion;

    $.ajax({
        url: 'AjaxC.php',
        type: 'post',
        data: parametros,
        async: true,
        success: function (vista) {
            $('#resultadoBusqueda').html(vista);
        }
    });
}

function cargarDetallesPedido(id_Pedido) {
    var parametros = '&c=Pedidos&a=detallesPedido';
    parametros += '&id_Pedido=' + id_Pedido;

    $.ajax({
        url: 'AjaxC.php',
        type: 'post',
        data: parametros,
        async: true,
        success: function (vista) {
            $('#modalDetallesPedido').html(vista);
        }
    });
}

function exportarAWord(){
    $('#busquedaPedidos').attr('action', 'vistas/Pedidos/PedidosToWord.php');
    $('#busquedaPedidos').attr('target', 'popup');
    $('#busquedaPedidos').submit();
}

function exportarAExcel(){

}

function exportarAPDF(){
    $('#busquedaPedidos').attr('action', 'vistas/Pedidos/PedidosToPDF.php');
    $('#busquedaPedidos').attr('target', 'popup');
    $('#busquedaPedidos').submit();
}