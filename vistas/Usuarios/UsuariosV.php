<?php

?>
<form id="formularioBuscar" name="formularioBuscar">
	<label for="usuarioB">Usuario:</label>
	<input type="text" id="usuarioB" name="usuarioB" value="">

	<label for="loginB">Login:</label>
	<input type="text" id="loginB" name="loginB" value="">
	
	<label for="activoB">Estado:</label>
	<select id="activoB" name="activoB" >
		<option value="S">Solo Activos</option>
		<option value="N">Solo inactivos</option>
		<option value="" selected>Activos e inactivos</option>
	</select>
	
	<button type="button" onclick="buscar();">Buscar</button>
	<button type="button" onclick="nuevoEditar('0');">Nuevo</button>
</form>
<div id="div-resultado-busqueda"></div>
<div id="div-edicion" style="display:none;">
	<div class="row">
		<div class="col-lg-12">
			<b><span id="operacion">MODIFICAR</span> USUARIO</b>
		</div>
	</div>
	<form role="form" id="formularioEdicion" name="formularioEdicion">
		<div class="row">
			<div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<input type="hidden" id="id_Usuario" name="id_Usuario" />
				<label for="nombre" >Nombre:</label>
				<input type="text" id="nombre" name="nombre" 
					class="form-control" placeholder="Nombre usuario" />
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<label for="apellido_1" >Primer Apellido:</label>
				<input type="text" id="apellido_1" name="apellido_1" 
					class="form-control" placeholder="Primer Apellido" />
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<label for="apellido_1" >Segundo Apellido:</label>
				<input type="text" id="apellido_2" name="apellido_2" 
					class="form-control" placeholder="Segundo Apellido" />
			</div>
		</div>
		<div class="row">
			<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<label for="nombre" >Login:</label>
				<input type="text" id="login" name="login" 
					class="form-control" placeholder="Login usuario" />
			</div>
			<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<label for="pass" >Contrase&ntilde;a:</label>
				<input type="password" id="pass" name="pass" 
					class="form-control" placeholder="Contrasena" />
			</div>
			<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<label for="repass" >Repetir Contrasena:</label>
				<input type="password" id="repass" name="repass" 
					class="form-control" placeholder="Repetir contrasena" />
			</div>
			<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<label for="activo" >Activo:</label>
				<select id="activo" name="activo" class="form-control">
					<option value="S">Activo</option>
					<option value="N">Inactivo</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-lg-1 col-md-1 col-sm-2 col-xs-12">
				<button type="button" onclick="guardar();">Guardar</button>
			</div>
		</div>
	</form>
</div>




