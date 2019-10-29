<?php 
	session_start();
	if($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2)
	{
		header("location: ./");
	}
	
	include "../conexion.php";

	if(!empty($_POST))
	{
      
        
		$alert='';
		if(empty($_POST['producto']) || empty($_POST['precio']) || empty($_POST['cantidad']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$producto   = $_POST['producto'];
			$precio     = $_POST['precio'];
			$cantidad   = $_POST['cantidad'];
            $usuario_id = $_SESSION['idUser'];
			
            $foto =$_FILES['foto'];
            $nombre_foto =$foto['name'];
            $type        =$foto['type'];
            $url_temp    =$foto['tmp_name'];
            
            $imgProducto  ='img_producto.png';
            
            if($nombre_foto != ''){
                $destino ='img/uploads/';
                $img_nombre='img_'.md5(data('d-m-Y H:m:s'));
                $imgProducto =$img_nombre.'.jpg';
                $src  =$destino.$imgProducto;
              
            }
            
			

$query_insert = mysqli_query($conection,"INSERT INTO producto (descripcion,precio,existencia,usuario_id,foto)
VALUES('$producto','$precio','$cantidad','$usuario_id','$imgProducto')");
				if($query_insert){
                    if($nombre_foto != ''){
                        move_uploaded_file($url_temp,$src);
                    }
					$alert='<p class="msg_save">producto creado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al crear el producto.</p>';
				}

			


		}

	}



 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Registro Producto</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
              <br>
        <br>
		 <br>
         <br>
			<h1>Registro Producto</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post" enctype="multipart/form-data">
                
				<label for="producto">producto</label>
				<input type="text" name="producto" id="producto" placeholder="Nombre del Producto">
				<label for="precio">Precio</label>
				<input type="number" name="precio" id="precio" placeholder="precio">
                
				<label for="cantidad">Cantidad</label>
				<input type="text" name="cantidad" id="cantidad" placeholder="cantidad del producto">
                
				<div class="photo">
	<label for="foto">Foto</label>
        <div class="prevPhoto">
        <span class="delPhoto notBlock">X</span>
        <label for="foto"></label>
        </div>
        <div class="upimg">
        <input type="file" name="foto" id="foto">
        </div>
        <div id="form_alert"></div>
</div>
                <button type="submit" value="Crear producto" class="btn_save">Crear Producto</button>

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>