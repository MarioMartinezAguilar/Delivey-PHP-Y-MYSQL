<!DOCTYPE html>
<html lang="en">
<head>
  <title>Delivery PHP</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <style>
  .fakeimg {
    height: 200px;
    background: #aaa;
  }
  </style>
</head>
<body>
<div class="jumbotron text-center" style="margin-bottom:0">
	<h1>Aplicación Web PHP y SQL: Base de Datos</h1>
	<h4>Elaborado Por: Mario Martínez Aguilar | Ing.Tic's Desarrollo Web</h4> 
</div>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
	<div class="btn-group btn-group-lg align-items-center col-12">
	  <a href="index.php" class="btn btn-info btn-lg" role="button">PRINCIPAL</a>
	  <a href="clientes.php" class="btn btn-warning btn-lg" role="button">CLIENTES</a>
	  <a href="pedidos.php" class="btn btn-success btn-lg" role="button">PEDIDOS</a>
	  <a href="menus.php" class="btn btn-primary btn-lg" role="button">MENUS</a>
	</div>	
</nav>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-12 alert-primary">
		<?php
			require('conexion.php');
			$id = $_GET['no'];
			$sentencia = "SELECT * FROM menu WHERE idmenu = '".$id."' ";
			$consulta =mysqli_query($conexion, $sentencia);
			while ($valor = mysqli_fetch_array($consulta))
			{
		?>
				<form action="actualizar.php" method="POST">
						  <input type="hidden" name="id"  value="<?php echo $valor['0']; ?>">
						  <div class="form-group ">
							<label for="Nombre:">Nombre:</label>
							<input type="text" class="form-control" name="nombre" value="<?php echo $valor['1']; ?>">
						  </div>
						  <div class="form-group">
							<label for="descripcion:">Caracteristicas:</label>
							<input type="text" class="form-control" name="descripcion"  value="<?php echo $valor['2'];  ?>">
						  </div>
						  <div class="form-group">
							<label for="precio">precio:</label>
							<input type="text" class="form-control" name="precio"  value="<?php echo $valor['3']; ?>">
						  </div>
						  <button type="submit" class="btn btn-primary">ACTUALIZAR</button>
				</form>
		<?php
			}
		?>
    </div>
  </div>
</div>

</body>
</html>