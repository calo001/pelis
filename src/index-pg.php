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
		<li class="nav-item">
			<a class="nav-link" href="select-pg.php">Lista de películas</a>
		</li>
		</ul>
	</div>
	</nav>

	<?php
        include ("conexion-pg.php");
        
        $result = pg_query($connection, "SELECT * FROM categoria");
        $numrows = pg_num_rows($result);
    ?>

	<div class="container ">
		<div class="col-sm-8 hero">
			<h1>Las mejores películas</h1>
			<h3>Encuentra las mejores películas</h3>
		</div>

		<form action="insert-pg.php" name="form" method="get">
			<div class="form-group">
				<label for="namepeli">Nombre de la palícula</label>
				<input type="text" class="form-control" name="namepeli" required="required" id="namepeli" placeholder="Ingrese nombre de película">
			</div>
			<div class="form-group">
				<label for="categoria">Selecciona categoria</label>
				<select class="form-control" name="categoria" required="required">
					<?php 
						for ($i = 0; $i < $numrows; $i++) {
							$val = $i + 1;
							echo '<option value=' . $val . '>';
							$row = pg_fetch_array($result, $i);
							$id = $row['id'];
							$name = $row['nombre'];
							echo $name;
							echo '</option>';
						}
                    ?> 
				</select>
			</div>
			<div class="form-group">
			<button id="btnSubmit" type="submit" class="btn btn-primary">Agregar</button>
		</form>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>