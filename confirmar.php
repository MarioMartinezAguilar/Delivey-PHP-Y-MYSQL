<?php
    require('conexion.php');
    $pedido = $_POST['pedido'];
    $total = $_POST['total'];
    $sentencia = "UPDATE pedido SET 
            Total = '".$total."'
            WHERE idpedido = '".$pedido."' ";
            if(mysqli_query($conexion, $sentencia)){
                    header("Location: pedidos.php");
            }else{
                echo "Error: "  . mysqli_error($conexion);
            }
?>