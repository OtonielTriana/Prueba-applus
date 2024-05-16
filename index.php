<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Home</title>
</head>
<body>
    <h1 class="text-center m-3">Lista de productos</h1>

    <table class="table">
    <button type="button" onclick="location.href='librosPrestados.php'" class="btn btn-info m-2" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Top popover">
       Libros prestados
    </button>
    <button type="button" onclick="location.href='librosNoDevueltos.php'" class="btn btn-info m-2" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Top popover">
       Libros no devueltos hace 7 dias.
    </button>
<button type="button" onclick="location.href='crearProduct.php'" class="btn btn-primary" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="Right popover">
  Crear nuevo producto
</button>

        <thead>
            <tr>
                <th scope="col">Codigo</th>
                <th scope="col">Categoria</th>
                <th scope="col">Precio</th>
                <th scope="col">Eliminar</th>
                <th scope="col">Actualizar</th>
            </tr>
        </thead>
        <tbody>
          <form action="" method="post">

          </form>
            <?php
            
            include 'logicaPrueba.php';

            
            $prueba1 = new Prueba1();
            $productos = $prueba1->obtenerProductos();
            foreach ($productos as $producto) {
                echo "<tr>";
                echo "<th scope='row'>" . $producto["code"] . "</th>";
                
                
                $categorias = $prueba1->obtenerCategory();
                foreach ($categorias as $categoria) {
                  if($categoria['id'] == $producto["idCategory"] ){

                    echo "<td>" . $categoria["name"] . "</td>";
                  }
                }
                echo "<td>" . $producto["price"] . "</td>";
                echo "<td>
                <form action='logicaPrueba.php' method='post'>
                <input type='hidden' name='confirmar' value='confirmarEliminar'>
                    <input type='hidden' name='id' value='" . $producto['id'] . "'>
                    <input class='btn btn-danger' type='submit' name='eliminar' value='Eliminar'>
                </form>
              </td>";
               echo "<td>
              <a href='actualizar.php?action=actualizar&id=" . $producto['id'] . "' class='btn btn-primary'>Actualizar</a>
              </td>";
    
              

                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    
</body>
</html>