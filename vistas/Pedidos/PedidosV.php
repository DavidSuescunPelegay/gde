<div class="page-header">
    <h1>Gestion de Pedidos</h1>
</div>

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading itemsPanel" role="tab" id="headingCriteriosBusqueda">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseCriteriosBusqueda"
                   aria-expanded="true" aria-controls="collapseOne">
                    Criterios de Busqueda
                </a>
            </h4>
        </div>
        <div id="collapseCriteriosBusqueda" class="panel-collapse collapse in" role="tabpanel"
             aria-labelledby="headingOne">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" onkeyup="busqueda()" placeholder="Usuario"
                               id="busquedaPorUsuario">
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" onkeyup="busqueda()" placeholder="Fecha Pedido"
                               id="busquedaPorFechaPedido">
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" onkeyup="busqueda()" placeholder="Fecha Almacen"
                               id="busquedaPorFechaAlmacen">
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" onkeyup="busqueda()" placeholder="Fecha Envio"
                               id="busquedaPorFechaEnvio">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" onkeyup="busqueda()" placeholder="Fecha Recibido"
                               id="busquedaPorFechaRecibido">
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" onkeyup="busqueda()" placeholder="Fecha Finalizado"
                               id="busquedaPorFechaFinalizado">
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" onkeyup="busqueda()" placeholder="Transporte"
                               id="busquedaPorTransporte">
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" onkeyup="busqueda()" placeholder="Direccion"
                               id="busquedaPorDireccion">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<div id="resultadoBusqueda"></div>
