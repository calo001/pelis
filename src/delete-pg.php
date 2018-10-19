<?php
    include ("conexion-pg.php");

    $id = intval($_GET['id']);
    
    $delete = pg_query($connection, "DELETE FROM pelicula WHERE id = $id");

    if ($delete) {
        header ("Location:select-pg.php");
    }
?>
