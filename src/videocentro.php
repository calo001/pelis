<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Películas</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

</head>
<style>
	.hero {
		margin: 5em 0;
	}
    .videocentros{
        margin: 20:
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
			<a class="nav-link" href="index-pg.php">Nuevo <span class="sr-only">(current)</span></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="select-pg.php">Lista de películas</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="videocentro.php">Video Centros</a>
		</li>
		</ul>
	</div>
	</nav>

	<?php
        include ("conexion-pg.php");

        # Lista de todos los videocentros
        $result = pg_query($connection, "SELECT * FROM videocentro");
        $numrows = pg_num_rows($result);

        #Verifica si la pagina fue cargada con un parametro
        #echo $param;
        if ( isset($_GET['id']) ) {
          # Video centro a mostrar según el parametro en el URL
    			$videocentro_actual = $_GET['id'];
          if ($videocentro_actual > $numrows) $videocentro_actual = pg_fetch_array ($result, 0) ['id'];
        } else {
          # Primer video centro que se muestra
          $videocentro_actual = pg_fetch_array ($result, 0) ['id'];
          #echo $videocentro_actual;
        }
        
        # Lista de peliculas sin sucursal
        $pelis_no_sucursal = pg_query($connection, "SELECT id, nombre FROM pelicula WHERE id_videocentro IS NULL LIMIT 10");
        $numrowspelis = pg_num_rows($pelis_no_sucursal);

        # Lista de peliculas que pertenecen a la primer sucursal
        $pelis_primer_sucursal = pg_query($connection, "SELECT id, nombre FROM pelicula WHERE id_videocentro = $videocentro_actual LIMIT 10");
        $rowsprimersucursal = pg_num_rows($pelis_primer_sucursal);


    ?>

	<div class="container header">
		<div class="col-sm-8 hero">
			<h1>Las mejores películas</h1>
			<h3>Encuentra los videocentros más retro del planeta</h3>
		</div>

        <form name="form" method="get">
            <div class="row">
                <div class="videocentros col-sm-8">
                        <label for="categoria">Selecciona una sucursal</label>
                        <select class="sucursales form-control" name="videocentro">
                            <?php
                                for ($i = 0; $i < $numrows; $i++) {
                                    $val = $i + 1;
                                    echo '<option value=' . $val;
                                    if ($videocentro_actual == $val) {
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
            </div>

            <div class="row">
                <div class="col-sm-7">
                    <h3>Sin sucursal asignada</h3>
                </div>
                <div class="col-sm-4">
                    <h3>Con la sucursal asignada</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">

                    <select name="from[]" id="multiselect" class="form-control" size="8" multiple="multiple">
                        <!-- Obteniendo los datos de las peliculas sin video centro-->
                        <?php
                            for ($i = 0; $i < $numrowspelis; $i++) {
                                $row = pg_fetch_array($pelis_no_sucursal, $i);
                                $id = $row['id'];
                                $name = $row['nombre'];

                                echo '<option value=' . $id . '>';
                                echo $name;
                                echo '</option>';
                            }
                        ?>
                    </select>
                </div>

                <div class="col-sm-2">
                    <button type="button" id="multiselect_rightAll" class="btn btn-block"><i class="fas fa-forward"></i></button>
                    <button type="button" id="multiselect_rightSelected" class="btn btn-block"><i class="fas fa-chevron-right"></i></button>
                    <button type="button" id="multiselect_leftSelected" class="btn btn-block"><i class="fas fa-chevron-left"></i></button>
                    <button type="button" id="multiselect_leftAll" class="btn btn-block"><i class="fas fa-backward"></i></button>
                </div>

                <div class="col-sm-5">
                    <select name="to[]" id="multiselect_to" class="form-control" size="8" multiple="multiple">
                      <!-- Obteniendo los datos de las peliculas con el primer video centro-->
                      <?php
                          for ($i = 0; $i < $rowsprimersucursal; $i++) {
                              $row = pg_fetch_array($pelis_primer_sucursal, $i);
                              $id = $row['id'];
                              $name = $row['nombre'];

                              echo '<option value=' . $id . '>';
                              echo $name;
                              echo '</option>';
                          }
                      ?>
                    </select>
                </div>
            </div>

            <button id="btnSubmit" type="submit" class="btn btn-primary">Aceptar</button>
        </form>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="lib/multiselect.min.js"></script>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('#multiselect').multiselect();
        });

        /*
         * Detecta el cambio de sucursal
         */
        $('.sucursales').on('change', function() {
            window.location.href = window.location.pathname + "?id=" + this.value;
            //alert( this.value );
        });

        /*
         * Detecta el submit del formulario
         */
        $( "form" ).submit(function( event ) {

            var id_sucursal = event.currentTarget[0].value;
            var valuesleft = $("#multiselect>option").map(function() { return $(this).val(); }).get();
            var valuesright = $("#multiselect_to>option").map(function() { return $(this).val(); }).get();

            console.log(id_sucursal);
            console.log(valuesleft);
            console.log(valuesright);

            //var params = { suc:id_sucursal, optleft:valuesleft, optright:valuesright };
            //var strParams = jQuery.param( params );
            var uri = 'cambia-sucursal.php';

            $.post( uri,
              {
                id: id_sucursal,
                sin_sucursal: valuesleft,
                con_sucursal: valuesright
              },
              function( response,status ) {
                alert (response);
                location.reload("Pelicula actualizada!");
            });

            event.preventDefault();
        });
    </script>
    </body>
</html>
