<?php
    require('conexion.php');
    $id = $_GET['no'];
    $sentencia = "UPDATE pedido SET
    entregado = 1
    WHERE idpedido = '".$id."'";
    if(mysqli_query($conexion, $sentencia)){
        header("Location: pedidos.php");
    }else{
        echo "Error: " . mysqli_error($conexion);
    }

?>