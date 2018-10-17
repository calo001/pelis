<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Películas - Lista</title>

    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
    
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<style>
	.hero {
		margin: 5em 0;
	}

    .number {
        background-color: black;
        border-radius: 20%;
        padding: .5em;
        margin: 3px;
        color: white;
    }
</style>
<body>
    <?php
        include ("conexion-pg.php");
        
        $result = pg_query($connection, "SELECT * FROM pelicula");
        $numrows = pg_num_rows($result);
    ?>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<a class="navbar-brand" href="#">Películas</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
		<li class="nav-item">
			<a class="nav-link" href="index-pg.php">Nuevo</a>
		</li>
		<li class="nav-item">
			<a class="nav-link active" href="#">Lista de películas <span class="sr-only">(current)</span></a>
		</li>   
		</ul>
	</div>
	</nav>

	<div class="container ">
		<div class="col-sm-8 hero">
			<h1>Las mejores películas</h1>
			<h3>Visualiza las peliculas</h3>
		</div>

        <table class="table display" id="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Categoria</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                for ($i = 0; $i < $numrows; $i++) {
                    echo "<tr>\n";
                    $row = pg_fetch_array($result, $i);
                    $id = $row['id'];
                    echo "<td>"
                    ?> 
                    <span class="number" ><?php echo $id ?></span>
                    <a href =" <?php echo 'delete-pg.php?id=' . $id ?>"> <button
                    type=button class="btn btn-info btn-xs">Eliminar</button></a> 
                    
                    <a href =" <?php echo 'form-pg.php?id=' . $id ?>"> 
                    <button type=button class="btn btn-info btn-xs">Modificar</button></a>
                    
                    <?php
                    echo "<td>", $row["nombre"], "</td>";
                    echo "<td>", $row["categoria"], "</td></tr>";
                    }
            ?>
        </tbody>
        </table>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#table').dataTable();
    });
    </script>

	</div>
</body>
</html>
