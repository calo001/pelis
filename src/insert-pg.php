<?php
	include ("conexion-pg.php");

	$var1 = $_GET['namepeli'];
	$var2 = $_GET['categoria'];

	$result = pg_query($connection, "INSERT INTO pelicula (nombre, id_categoria) VALUES ('$var1','$var2')");

    header('Location:select-pg.php');
?>
