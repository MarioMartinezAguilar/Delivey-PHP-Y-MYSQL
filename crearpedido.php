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
			  <th scope="col">No. Orden</th>
			  <th scope="col">FECHA</th>
			  <th scope="col">TOTAL</th>
			  <th scope="col">ACCION</th>
			  
			</tr>
		</thead>
		<tbody>
			<?php
				require('conexion.php');
				$id = $_GET['no'];
				$fecha = date("Y-m-d H:i:s");
				$total = 0;
				$sentencia = " INSERT INTO pedido (Fecha,Total,Cliente_idCliente, entregado)
				VALUE ( '$fecha','$total', '$id', '0')";
				if(mysqli_query($conexion,$sentencia)){
						echo "<br/>PEDIDO ASIGNADO EXITOSAMENTE";
						$sentencia = "SELECT * FROM pedido WHERE Cliente_idCliente = '".$id."'
						ORDER BY idpedido DESC LIMIT 1 ";
						$consulta = mysqli_query($conexion,$sentencia);
					if (mysqli_num_rows($consulta) > 0)
					{
						while ($valor = mysqli_fetch_assoc($consulta))
						{
							echo "<tr>";
								echo "<td>"; echo $valor['idpedido']; echo "</td>";
								echo "<td>"; echo $valor['Fecha']; echo "</td>";
								echo "<td>"; echo $valor['Total']; echo "</td>";
								
								echo "<td> <a href='agregarpedido.php?no=".$valor['idpedido']."''><button type='button' class='btn btn-info btn-sm'>AGREGAR MENUS</button></a> </td>";

								
							echo "</tr>";
						}
						
					}else{
							echo "<tr>";
								echo "<td>"; echo "ERROR..."; echo "</td>";
							echo "</tr>";
						
					}
				
				}else{
						echo "Error: " . mysqli_error($conexion);
				}
			?>
		</tbody>
		</table>
		
    </div>
  </div>
</div>

</body>
</html>