<?php
$html = '<nav class="navbar navbar-default" role="navigation">';

$html .= '<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Desplegar navegacion</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>';

$html .= '<div class="collapse navbar-collapse navbar-ex1-collapse">';
$html .= '<ul class="nav navbar-nav">';

foreach ($datos[0] as $ind => $opcion) {
    if (isset($opcion['subOpciones'])) {
        $html .= '<li><a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $opcion['texto'] . '<b class="caret"></b></a>';
        $html .= '<ul class="dropdown-menu">';
        foreach ($opcion['subOpciones'] as $subind => $subOpcion) {
            $html .= '<li class="dropdown">';
            $html .= '<a href="#">';
            $html .= $subOpcion['texto'];
            $html .= '</a>';
            $html .= '</li>';
        }
        $html .= '</ul>';
    } else {
        $html .= '<li><a href="' . $opcion['url'] . '">' . $opcion['texto'] . '</a></li>';
    }
    $html .= '</li>';
}
$html .= '</ul>';
$html .= '</div>';
$html .= '</nav>';

echo $html;
?>