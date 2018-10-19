<?php
	include ("conexion-pg.php");

	$idnuevo = $_POST['pk'];
	$nombrenuevo = $_POST['value'];

	$result = pg_query($connection, "UPDATE pelicula SET nombre='$nombrenuevo' WHERE id=$idnuevo");

    header('Location:editinline.php');
?>
