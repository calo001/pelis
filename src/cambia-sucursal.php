<?php
	include ("conexion-pg.php");

	$idsucursal = $_POST['id'];
	$pelisinsucursal = $_POST['sin_sucursal'];
	$peliconsucursal = $_POST['con_sucursal'];

	if (count($pelisinsucursal) > 0) {
		foreach ($pelisinsucursal as $peli) {
			pg_query($connection, "UPDATE pelicula SET id_videocentro=NULL WHERE id=$peli");
		}
	}

	if (count($peliconsucursal) > 0) {
		foreach ($peliconsucursal as $peli) {
			pg_query($connection, "UPDATE pelicula SET id_videocentro=$idsucursal WHERE id=$peli");
		}
	}

	echo $idsucursal;
?>
