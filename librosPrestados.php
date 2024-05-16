<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Home</title>
</head>
<body>
  <div class="container">

    <br>
    <h1 class="text-center m-3" >Libros que se encuentran prestados</h1>
    <br>

<table class="table">

  <thead>
        <tr>
            <th scope="col">Titulo</th>
            <th scope="col">Autor</th>
            <th scope="col">Nombre usuario</th>
            <th scope="col">Fecha préstamo</th>
            <th scope="col">Fecha devolución</th>
        </tr>
    </thead>
    <tbody>
      <form action="" method="post">

        </form>
        <?php
        
        include 'logicaPrueba.php';
        
        
        $prueba1 = new Prueba1();
        $librosPrestados = $prueba1->obtenerLibrosPrestados();
        foreach ($librosPrestados as $libroPrestado) {
            echo "<tr>";
            echo "<th scope='row'>" . $libroPrestado["Titulo"] . "</th>";
            echo "<td>" . $libroPrestado["Autor"] . "</td>";
            echo "<td>". $libroPrestado["Nombre"].' ' .$libroPrestado["Apellido"] ." </td>";
            echo "<td>". $libroPrestado["fecha_prestamo"] ." </td>";
            echo "<td>". $libroPrestado["fecha_devolucion"] ." </td>";

            echo "</tr>";
        }
        ?>

    </tbody>
</table>

</div>
</body>
</html>