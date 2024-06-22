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
  <h5> << AGREGAR PEDIDO >></h5>
    <div class="col-sm-12">
		<br/>
		<table class="table">
		  <thead>
			<tr>
			  <th scope="col">CODIGO</th>
			  <th scope="col">NOMBRE</th>
			  <th scope="col">DESCRIPCION</th>
			  <th scope="col">COSTO</th>
			  
			</tr>
		</thead>
		<tbody>
		
		<?php
			require('conexion.php');
			$id = $_GET['no'];
			$sentencia = "SELECT * FROM menu";
			$consulta = mysqli_query($conexion,$sentencia);
			while($valor = mysqli_fetch_assoc($consulta)){
				echo "<tr>";
					echo "<td>"; echo $valor['idmenu']; echo "</td>";
					echo "<td>"; echo $valor['nombre']; echo "</td>";
					echo "<td>"; echo $valor['descripcion']; echo "</td>";
					echo "<td>"; echo $valor['precio']; echo "</td>";
					echo "<td>"; 
		?>
			<form method="POST">
				<div class="input-group col-xs-2">
					<input type="hidden" value ="<?php echo $id ?>" name="id"/>
					<input type="hidden" value ="<?php echo $valor['idmenu'] ?>" name="menu"/>
					<span class="input-group-btn">
						<button class="btn btn-outline-success my-2 my-sm-0" type="submit">AGREGAR</button>

					</span>
				</div>
			</form>

		<?php	
				echo "</td>";		
				echo "</tr>";
			}
		?>	
		</tbody>		
		</table>
		<h3> << PEDIDO >> </h3>
		<?php
			if( !empty($_POST)){
				$total = 0;
				$pedido = $_POST['id'];
				$menu = $_POST['menu'];
				$sentencia = "INSERT INTO orden (pedido_idpedido, menu_idmenu)
				VALUE ('$pedido', '$menu')";
				if(mysqli_query($conexion,$sentencia)){
			?>
					<table class="table alert-success">
						<thead>
							<tr>
								<th scope="col">CLIENTE</th>
								<th scope="col">NUMERO DE PEDIDO</th>
								<th scope="col">MENU</th>
								<th scope="col">PRECIO</th>
							
							</tr>
						</thead>
					</tboby>
			<?php
					$sentencia2 = "SELECT cliente.Nombre AS cliente_nombre, pedido.idpedido AS pedido_id,
					menu.nombre AS menu_nombre, menu.precio AS menu_precio
					FROM orden
					INNER JOIN pedido ON pedido_idpedido = idpedido
					INNER JOIN menu ON menu_idmenu = idmenu
					INNER JOIN cliente ON idCliente = Cliente_idCliente
					WHERE pedido_idpedido = '".$id."' ";
					$consulta2 = mysqli_query($conexion,$sentencia2);
					if(mysqli_num_rows($consulta2) > 0){
						while($valor2 = mysqli_fetch_assoc($consulta2)){
							echo "<tr>";
								echo "<td>"; echo $valor2['cliente_nombre']; echo "</td>";
								echo "<td>"; echo $valor2['pedido_id']; echo "</td>";
								echo "<td>"; echo $valor2['menu_nombre']; echo "</td>";
								echo "<td>"; echo $valor2['menu_precio']; echo "</td>";
							echo "</tr>";
							$total = $total + $valor2['menu_precio'];	
						}
					}else{
						echo "<tr>";
							echo "<td>"; echo "Error: " . mysqli_error($conexion); echo "</td>";
						echo "</tr>";	
					}





				}else{
					echo "Error...";
				}

			}
			
		?>
		
    </div>
  </div>
  <div class="row">
	<div class="col-sm-6">
	</div>
	<div class="col-sm-6">
		<h2>TOTAL:</h2>
		<form action="confirmar.php" method="POST">
			<div class="form-group row alert-warning">	
				<div class="col-xs-1">
					<input type="hidden" name="pedido" value="<?php echo $pedido ; ?>">
					<input type="text" style="font-size: 15pt; text-align:right;" name="total" class="form-control alert-warning" value="<?php echo $total; ?>">
				</div>
				<span class="input-group-btn">
					<button class="btn btn-warning btn-lg" type="submit">CERRAR PEDIDO</button>
				</span>
			</div>
		</form>	
	</div>
	
  </div>
</div>

</body>
</html>