<?php 
	
$alert = '';
session_start();
if(!empty($_SESSION['active']))
{
	header('Location: sistema/inicio.php');
}else{

	if(!empty($_POST))
	{
		if(empty($_POST['usuario']) || empty($_POST['clave']))
		{
			$alert = 'Ingrese su usuario y su calve';
		}else{

			require_once "conexion.php";

			$user = mysqli_real_escape_string($conection,$_POST['usuario']);
			$pass = md5(mysqli_real_escape_string($conection,$_POST['clave']));

			$query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario= '$user' AND clave = '$pass'");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);

			if($result > 0)
			{
				$data = mysqli_fetch_array($query);
				$_SESSION['active'] = true;
				$_SESSION['idUser'] = $data['idusuario'];
				$_SESSION['nombre'] = $data['nombre'];
				$_SESSION['email']  = $data['correo'];
				$_SESSION['user']   = $data['usuario'];
				$_SESSION['rol']    = $data['rol'];

				header('location: sistema/inicio.php');
			}else{
				$alert = 'El usuario o la clave son incorrectos';
				session_destroy();
			}


		}

	}
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login |Veteriaria</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/functions.js"></script>
   
</head>
<body>
	<section id="container">
		<form action="" method="post">
			
			<h3>Iniciar Sesión</h3>
			<img src="img/login.png" alt="Login">

			<input type="text" name="usuario" placeholder="Usuario">
			<input type="password" name="clave" placeholder="Contraseña">
			<div class="alert">El usuario o la clave es incorrecto</div>
			<input type="submit" value="INGRESAR">
		<div class="create_user">
			<a href="#" id="btn_register">¡Crear mi usuario!</a>
		</div>

		</form>

	</section>
	<div id="loader"></div>
	<section id="popup_register" class="">
		<form action="" method="post" id="form_register_user">
			<input type="hidden" name="buyUser" >
			<span id="close_form">X</span>
			<h2>Registro Usuarios</h2>
			<p>
				Todos los campos son obligatorios.
			</p>
			<div id="alert"></div>
			<label for="nombre">Nombre <span>*</span></label>
			<input type="text" name="nombre" id="nombre" placeholder="Nombre completo" required>
			<label for="correo">Correo electrónico <span>*</span></label>
			<input type="email" name="correo" id="correo" placeholder="Correo personal" required>
			<label for="user">Usuario <span>*</span></label>
			<input type="text" name="user" id="user" placeholder="Usuario de acceso" required>
			<label for="password">Clave <span>*</span></label>
			<input type="password" name="password" id="password" placeholder="Clave de acceso" required>
			<input type="submit" value="Crear Usuario" id="btn_create_user">
		</form>
	</section>
</body>
</html>