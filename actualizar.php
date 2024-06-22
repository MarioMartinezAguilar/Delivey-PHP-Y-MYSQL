<?php
	require('conexion.php');

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    $sentencia = "UPDATE menu SET 
        nombre = '".$nombre."',
        descripcion = '".$descripcion."',
        precio = '".$precio."'
        WHERE idmenu = '".$id."' ";
    if(mysqli_query($conexion, $sentencia)){
        
        header("Location: menus.php");

    }else{
        echo "Error: " . mysqli_error($conexion);
    }    
?>