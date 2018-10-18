<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Películas</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<style>
	.hero {
		margin: 5em 0;
	}
</style>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<a class="navbar-brand" href="#">Películas</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
		<li class="nav-item active">
			<a class="nav-link" href="#">Nuevo <span class="sr-only">(current)</span></a>
		</li>
		</ul>
	</div>
	</nav>

	<?php
		include ("conexion-pg.php");

		if (isset($_GET['nombrenuevo'])) {
			$idnuevo=$_GET['idnuevo'];
			$nombrenuevo=$_GET['nombrenuevo']; 
			$catNuevo=$_GET['categorianueva']; 
		
			$modify = pg_query($connection, "UPDATE pelicula SET nombre='$nombrenuevo', id_categoria='$catNuevo' WHERE id=$idnuevo");
			header("Location:select-pg.php");
		} else {
			$id = $_GET['id'];
			$result = pg_query($connection, "SELECT * FROM pelicula WHERE id=$id");

			$row = pg_fetch_array($result, 0);
			$nombre = $row['nombre'];
			$idCategoria = $row['id_categoria'];

			$result = pg_query($connection, "SELECT * FROM categoria");
        	$numrows = pg_num_rows($result);
	?>
	<div class="container ">
		<div class="col-sm-8 hero">
			<h1>Las mejores películas</h1>
			<h3>Modifica la película</h3>
		</div>
			<form action="form-pg.php" method="GET">
				<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Nuevo nombre</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="inputEmail3" value="<?php echo $nombre ?>" name="nombrenuevo">
				<input type="hidden" name="idnuevo" value="<?php echo $id ?>">
				</div>

				<div class="form-group col-sm-5">
					<label for="categoria">Selecciona categoria</label>
					<select class="form-control" name="categorianueva" required="required">
						<?php 
							for ($i = 0; $i < $numrows; $i++) {
								$value = $i + 1;
								echo "<option value= $value"; 
								if ($idCategoria == $value) {
									echo " selected";
								}
								echo '>';
								$row = pg_fetch_array($result, $i);
								$id = $row['id'];
								$name = $row['nombre'];
								echo $name;
								echo '</option>';
							}
                    	?> 
					</select>
				</div>

				</div><br/><br/>
				<div align="left">
				<button type="submit" class="btn btn-success" name="enviar">Realizar cambios</button>
				</div>
			</form>
			<?php
				}
			?>
		</div>
        
        		

	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
