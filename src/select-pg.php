<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Películas - Lista</title>
    <!--
    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/b-1.5.4/b-html5-1.5.4/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css"/>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-flash-1.5.4/b-html5-1.5.4/datatables.min.js"></script>

    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

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

    .form {
        margin: 5em;
        padding: 2em;
        color: white;
        background-color: #505050;
    }
</style>
<body>
    <?php
        include ("conexion-pg.php");

        $result = pg_query($connection, "SELECT pelicula.id, pelicula.nombre, categoria.nombre as categoria FROM pelicula LEFT JOIN categoria ON pelicula.id_categoria = categoria.id;");
        $numrows = pg_num_rows($result);

        $resultcategorias = pg_query($connection, "SELECT * FROM categoria");
        $numrowsCategorias = pg_num_rows($resultcategorias);
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
        <li class="nav-item">
			<a class="nav-link" href="videocentro.php">Video Centros</a>
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
                    <a id="delete" href =" <?php echo 'delete-pg.php?id=' . $id ?>"
                        onclick="return confirm('Are you sure?');">
                        <button type=button class="btn btn-info btn-xs">Eliminar</button>
                    </a>

                    <a href =" <?php echo 'form-pg.php?id=' . $id ?>">
                        <button type=button class="btn btn-info btn-xs">Modificar</button>
                    </a>

                    <?php
                        echo "<td>", '<a href="#" class="edit" data-type="text" data-pk="'. $id .'" data-name="nombre" data-url="update-name.php">',
                                        $row["nombre"], "</td>", '</a>';
                        echo "<td>", $row["categoria"], "</td></tr>";
                    }
            ?>
        </tbody>
        </table>

        <!-- AGREGAR PELICULA USANDO AJAX -->
        <form name="form" method="get" class="form">
            <h2>Ingrese una nueva película con AJAX</h2>
			<div class="form-group">
				<label for="namepeli">Nombre de la palícula</label>
				<input type="text" class="form-control" name="namepeli" required="required" id="namepeli" placeholder="Ingrese nombre de película">
			</div>
			<div class="form-group">
				<label for="categoria">Selecciona categoria</label>
				<select class="form-control" name="categoria" required="required">
					<?php
						for ($i = 0; $i < $numrowsCategorias; $i++) {
							$val = $i + 1;
							echo '<option value=' . $val . '>';
							$rowCat = pg_fetch_array($resultcategorias, $i);
							$idCat = $rowCat['id'];
							$nameCat = $rowCat['nombre'];
							echo $nameCat;
							echo '</option>';
						}
                    ?>
				</select>
			</div>
			<div class="form-group">
			<button id="btnSubmit" type="submit" class="btn btn-primary">Agregar</button>
		</form>

    <script type="text/javascript" charset="utf-8">
        $(document).ready(function () {
            $('#table').DataTable({
                buttons: [
                  {
                      extend: 'excel',
                      text: 'Save current page',
                      exportOptions: {
                          modifier: {
                              page: 'current'
                          }
                      }
                  }
                ]
            });
        });

        $( "form" ).submit(function( event ) {
            //alert ("Agregar");
            var name  = event.currentTarget[0].value;
            var category = event.currentTarget[1].value;

            var params = { namepeli:name, categoria:category };
            var strParams = jQuery.param( params );
            var uri = 'insert-pg.php?' + strParams;

            $.get( uri, function( data ) {
                location.reload();
            });

            event.preventDefault();
        });

        //turn to inline mode
        $.fn.editable.defaults.mode = 'inline';

        $('.edit').editable({
            type: 'text',
            title: 'Nuevo nombre de película'
        });
    </script>
</body>
</html>
