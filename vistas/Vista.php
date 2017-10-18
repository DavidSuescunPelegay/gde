<?php
Class Vista{
	function Vista(){
		//constructor
	}
	
	public function render($vista, $datos=array()){
		include($vista);
	}
}