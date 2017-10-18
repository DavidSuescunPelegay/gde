<div class="page-header">
    <h1>Gestion de Pedidos</h1>
</div>

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading itemsPanel" role="tab" id="headingCriteriosBusqueda">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseCriteriosBusqueda" aria-expanded="true" aria-controls="collapseOne">
                    Criterios de Busqueda
                </a>
            </h4>
        </div>
        <div id="collapseCriteriosBusqueda" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <input type="text" class="form-control" onkeyup="busqueda()" placeholder="Usuario"
                       id="busquedaPorUsuario">
                <input type="text" class="form-control" onkeyup="busqueda()" placeholder="Fecha Pedido"
                       id="busquedaPorFechaPedido">
                <input type="text" class="form-control" onkeyup="busqueda()" placeholder="Fecha Almacen"
                       id="busquedaPorFechaAlmacen">
                <input type="text" class="form-control" onkeyup="busqueda()" placeholder="Fecha Envio"
                       id="busquedaPorFechaEnvio">
                <input type="text" class="form-control" onkeyup="busqueda()" placeholder="Fecha Recibido"
                       id="busquedaPorFechaRecibido">
                <input type="text" class="form-control" onkeyup="busqueda()" placeholder="Fecha Finalizado"
                       id="busquedaPorFechaFinalizado">
                <input type="text" class="form-control" onkeyup="busqueda()" placeholder="Transporte"
                       id="busquedaPorTransporte">
                <input type="text" class="form-control" onkeyup="busqueda()" placeholder="Direccion"
                       id="busquedaPorDireccion">
            </div>
        </div>
    </div>
</div>

<div id="resultadoBusqueda"></div>
