<?php 
	session_start();
	if($_SESSION['rol'] != 1)
	{
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST))
	{
		if($_POST['codproducto'] == 1){
			header("location: lista_producto.php");
			mysqli_close($conection);
			exit;
		}
		$producto = $_POST['codproducto'];

		//$query_delete = mysqli_query($conection,"DELETE FROM usuario WHERE idusuario =$idusuario ");
		$query_delete = mysqli_query($conection,"UPDATE producto SET estatus = 0 WHERE codproducto = $producto ");
		mysqli_close($conection);
		if($query_delete){
			header("location: lista_producto.php");
		}else{
			echo "Error al eliminar";
		}

	}


/*

	if(empty($_REQUEST['id']) || $_REQUEST['id'] == 1 )
	{
		header("location: lista_producto.php");
		mysqli_close($conection);
	}else{

		$idusuario = $_REQUEST['id'];

		$query = mysqli_query($conection,"SELECT u.nombre,u.usuario,r.rol
												FROM usuario u
												INNER JOIN
												rol r
												ON u.rol = r.idrol
												WHERE u.idusuario = $idusuario ");
		
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$nombre = $data['nombre'];
				$usuario = $data['usuario'];
				$rol     = $data['rol'];
			}
		}else{
			header("location: lista_usuarios.php");
		}


	}

*/
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Eliminar producto</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<div class="data_delete">
			<h2>¿Está seguro de eliminar el siguiente producto?</h2>
			<p>producto: <span><?php echo $codproducto; ?></span></p>
			

			<form method="post" action="">
				<input type="hidden" name="codproducto" value="<?php echo $codproducto; ?>">
				<a href="lista_producto.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>
		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>