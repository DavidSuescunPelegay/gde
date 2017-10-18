<div class="table-responsive">
	<table class="table table-striped">
		<tr>
			<th></th>
			<th>Nombre</th>
			<th>Login</th>
			<th>Activo</th>
			<th></th>
		</tr>
		<?php foreach ($datos as $fila){ ?>
			<tr>
				<td>
					<a href="#edicionUsuario" style="text-decoration:none; color: #000000;">
					<button type="button"
					onclick="nuevoEditar('<?php echo $fila['id_Usuario']; ?>')">
					Editar
					</button>
					</a>
				</td>
				<td><?php echo $fila['apellido_1'].' '.$fila['apellido_2'].', '
							.$fila['nombre']; ?></td>
				<td><?php echo $fila['login']; ?></td>
				<td><?php 
						if($fila['activo']!='S'){
							echo 'Inactivo';
						}
					?>
				</td>
				<td>
					<?php if($fila['activo']!='S'){ ?>
							<button type="button" 
								onclick="activar('S','<?php echo $fila['id_Usuario']; ?>')">
								Activar</button>
					<?php }else{ ?>
							<button type="button" 
								onclick="activar('N','<?php echo $fila['id_Usuario']; ?>')">
								Desactivar</button>
					<?php } ?>
				</td>
			</tr>
		
		<?php  } ?>
		
	</table>
</div>