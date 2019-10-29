		<nav>
			<ul>
				<li><a href="inicio.php">Inicio</a></li>
			<?php 
				if($_SESSION['rol'] == 1){
			 ?>
				<li class="principal">

					<a href="#">Usuarios</a>
					<ul>
						<li><a href="registro_usuario.php">Nuevo Usuario</a></li>
						<li><a href="lista_usuarios.php">Lista de Usuarios</a></li>
					</ul>
				</li>
			<?php } ?>
				<li class="principal">
					<a href="#">Roles</a>
					<ul>
						<li><a href="#">Nuevo Rol</a></li>
						<li><a href="#">Lista de Roles</a></li>
					</ul>
				</li>
				
                <?php 
				if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2){
			 ?>
				<li class="principal">
					<a href="#">Productos</a>
					<ul>
						<li><a href="registro_producto.php">Nuevo Producto</a></li>
						<li><a href="lista_producto.php">Lista de Productos</a></li>
					</ul>
				</li>
                <?php } ?>
                <?php 
				if($_SESSION['rol'] == 1){
			 ?>
				<li class="principal">
					<a href="#">Reportes</a>
					<ul>
						<li><a href="reportes.php">reporte de creacion de usuarios </a></li>
						
					</ul>
				</li>
                 <?php } ?>
			</ul>
		</nav>