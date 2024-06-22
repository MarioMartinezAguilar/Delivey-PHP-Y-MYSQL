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
  <h5> << PRINCIPAL >></h5>
    <div class="col-sm-12">
		<form method="POST">
			<div class="col-lg-12">
				<div class="input-group">
				  <input type="text" name="cliente" placeholder="Ingrese numero de telefono" class="form-control">
				  <span class="input-group-btn">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Busqueda</button>
				  </span>
				</div>
			  </div>
		</form>
		<br/>
		<table class="table">
		  <thead>
			<tr>
			  <th scope="col">CODIGO</th>
			  <th scope="col">NOMBRE</th>
			  <th scope="col">TELEFONO</th>
			  <th scope="col">DIRECCION</th>
			  
			</tr>
		</thead>
		<tbody >
		<?php
			require('conexion.php');
			

  		if(!empty($_POST)){
			$cadena = $_POST['cliente'];
			$sentencia ="SELECT 
			cliente.idCliente AS id_cliente, 
			cliente.Nombre AS nombre_cliente,
			telefono.numero AS telefono_numero,
			direccion.nombre AS nombre_direccion
			FROM cliente INNER JOIN telefono ON telefono.Cliente_idcliente = cliente.idCliente
			INNER JOIN direccion ON direccion.Cliente_idCliente= cliente.idCliente
			WHERE telefono.numero LIKE '%".$cadena."%' ";
			$consulta =mysqli_query($conexion,$sentencia);
			if(mysqli_num_rows($consulta) > 0){
				while($valor = mysqli_fetch_assoc($consulta)){
					
					echo "<tr>";
					echo"<td>"; echo $valor['id_cliente']; echo "</td/>";
					echo"<td>"; echo $valor['nombre_cliente']; echo "</td/>";
					echo"<td>"; echo $valor['telefono_numero']; echo "</td/>";
					echo"<td>"; echo $valor['nombre_direccion']; echo "</td/>";
					echo "<td> <a href='crearpedido.php?no=".$valor['id_cliente']."''><button type='button' class='btn btn-success btn-md'>CREAR PEDIDO</button></a> </td>";
					echo "</tr>";
				}
			}else{
				echo "<tr>";
					echo "<tr>"; echo "NO SE ENCONTRARON VALORES...."; echo "</td>";
				echo "<tr>";	
			}

		}

			
		?>
    </div>
  </div>
</div>

</body>
</html>
