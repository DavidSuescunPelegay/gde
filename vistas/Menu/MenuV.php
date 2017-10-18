<ul class="nav navbar-nav navbar-right" style="margin-right: 0.5%;">
    <?php
    foreach ($datos[0] as $opcion) {
        if (isset($opcion['subOpciones'])) {
            ?>
            <li class="menuElements">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $opcion['texto'] ?><b
                        class="caret"></b></a>
            <ul class="dropdown-menu">
                <?php foreach ($opcion['subOpciones'] as $subind => $subOpcion) { ?>
                    <li class="dropdown"><a href="<?php echo $subOpcion['url'];?>"><?php echo $subOpcion['texto']; ?></a></li>
                <?php } ?>
            </ul>
            <?php
        } else {
            ?>
            <li class="menuElements">
                <a href="<?php echo $opcion['url']; ?>"><?php echo $opcion['texto']; ?></a>
            </li>
            <?php
        }
    }
    ?>
    <li>
        &nbsp; &nbsp;
    </li>
    <li>
        <div class="profile-userbuttons">
            <a href="logout.php" style="color: white">
                <button type="button" class="btn btn-default btn-sm">Cerrar Sesion</button>
            </a>
        </div>
    </li>
</ul>
