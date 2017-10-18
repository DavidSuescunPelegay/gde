<div class="page-header">
    <h1>Gestion de Ficheros</h1>
</div>

<input type="hidden" id="id_Usuario" value="<?php echo $_SESSION['datosUsuario'][0]['id_Usuario']; ?>">

<div class="panel-group" id="accordionFichero" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default accordionFicheros">
        <div class="panel-heading itemsPanel" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordionFichero" href="#collapseOne"
                   aria-expanded="true" aria-controls="collapseOne">
                    Mis Fotos
                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <button type="button" class="btn btn-default" id="subirFoto">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"> Foto</span>
                </button>
                <?php
                if (isset($datos[0])) {
                    ?>
                    <br>
                    <input type="radio" id="desestablecerFotoPerfil" name="desestablecerFotoPerfil" onclick="desestablecerFotoPerfil()">
                    <label for="desestablecerFotoPerfil">Deseo eliminar mi foto de perfil actual y establecer como foto de perfil la predeterminada</label>
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php
                            foreach ($datos[0] as $ind => $archivo) {
                                if ($ind == 0) {
                                    ?>
                                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                    <?php
                                } else {
                                    ?>
                                    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $ind ?>"></li>
                                    <?php
                                }
                            }
                            ?>

                        </ol>

                        <div class="carousel-inner" role="listbox" style="height: 500px">
                            <?php
                            foreach ($datos[0] as $ind => $archivo) {
                                if ($ind == 0) {
                                    ?>
                                    <div class="item active">
                                        <p style="text-align: center"><img
                                                    src="<?php echo $archivo['url'] . $archivo['nombre'] . $archivo['ext'] ?>"
                                                    style="height: 500px"></p>
                                        <div class="carousel-caption">
                                            <?php echo $archivo['nombre'] ?>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="item">
                                        <p style="text-align: center"><img
                                                    src="<?php echo $archivo['url'] . $archivo['nombre'] . $archivo['ext'] ?>"
                                                    style="height: 500px"></p>
                                        <div class="carousel-caption">
                                            <?php echo $archivo['nombre'] ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>

                        <a class="left carousel-control" href="#carousel-example-generic" role="button"
                           data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button"
                           data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-stripped">
                            <tr style="background-color: #2E353D;">
                                <th>Pre-Visualizacion</th>
                                <th>Nombre Completo</th>
                                <th>Tipo de Archivo</th>
                                <th>Fecha de Subida</th>
                                <th>Operaciones Disponibles</th>
                            </tr>
                            <?php
                            foreach ($datos[0] as $archivo) {
                                ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo $archivo['url'] . $archivo['nombre'] . $archivo['ext'] ?>"
                                           target="_blank">
                                            <img class="imagenes"
                                                 src="<?php echo $archivo['url'] . $archivo['nombre'] . $archivo['ext'] ?>">
                                        </a>
                                        &nbsp; &nbsp;
                                        <?php
                                        if (($archivo['url'] . $archivo['nombre'] . $archivo['ext']) == $_SESSION['datosUsuario'][0]['foto_de_Perfil']) {
                                            ?>
                                            <input type="radio" id="fotoPerfil" name="fotoPerfil"
                                                   onclick="cambiarFotoPerfil(<?php echo $archivo['id_Fichero'] ?>)"
                                                   checked>
                                            <label for="fotoPerfil">Esta es tu foto de perfil</label>
                                            <?php
                                        } else {
                                            ?>
                                            <input type="radio" id="fotoPerfil" name="fotoPerfil"
                                                   onclick="cambiarFotoPerfil(<?php echo $archivo['id_Fichero'] ?>)">
                                            <label for="fotoPerfil">Establecer como foto de perfil</label>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo $archivo['url'] . $archivo['nombre'] . $archivo['ext'] ?>"
                                           target="_blank">
                                            <?php echo $archivo['nombre']; ?>
                                        </a>
                                    </td>
                                    <td><?php echo $archivo['nombre_Original']; ?></td>
                                    <td><?php echo $archivo['sysdate_Subida']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-default" title="Eliminar"
                                                onclick="desactivarFichero(<?php echo $archivo['id_Fichero'] ?>)">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="panel panel-default accordionFicheros">
        <div class="panel-heading itemsPanel" role="tab" id="headingTwo">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionFichero"
                   href="#collapseTwo"
                   aria-expanded="false" aria-controls="collapseTwo">
                    Mis Documentos
                </a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">
                <button type="button" class="btn btn-default" id="subirDocumento">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"> Documento</span>
                </button>
                <?php
                if (isset($datos[1])) {
                    ?>
                    <div class="table-responsive">
                        <table class="table table-stripped">
                            <tr style="background-color: #2E353D;">
                                <th>Nombre Completo</th>
                                <th>Tipo de Archivo</th>
                                <th>Fecha de Subida</th>
                                <th>Operaciones Disponibles</th>
                            </tr>
                            <?php
                            foreach ($datos[1] as $archivo) {
                                ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo $archivo['url'] . $archivo['nombre'] ?>"
                                           target="_blank"><?php echo $archivo['nombre'] ?></a>
                                    </td>
                                    <td><?php echo $archivo['nombre_Original'] ?></td>
                                    <td><?php echo $archivo['sysdate_Subida'] ?></td>
                                    <td>
                                        <button type="button" class="btn btn-default" title="Eliminar"
                                                onclick="desactivarFichero(<?php echo $archivo['id_Fichero'] ?>)">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>