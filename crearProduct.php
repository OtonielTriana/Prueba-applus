<?php
include"logicaPrueba.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Crear Producto</title>
</head>
<body>
    <div class="container">
<br>
<br>
<h1 class="text-center m-3">Crear nuevo producto</h1>
        <form action="logicaPrueba.php" method="post">
            
            <div class="mb-3">
                <label for="codigo" class="form-label">Codigo</label>
                <input type="number" class="form-control" id="codigo" name="codigo" aria-describedby="emailHelp">
                <input type="hidden" name="crear" value="crear">
            </div>
            
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre">
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="text" class="form-control" id="precio" name="precio">
            </div>
            
               
            <label for="nombre" class="form-label">Categorias</label>
                <select class="form-select" aria-label="Default select example" name="categoria">
                    <option value="0" selected disabled>Seleccione una Categorias</option>
                    <?php
                    $prueba1 = new Prueba1();
                    $categorias = $prueba1->obtenerCategory();
                    foreach ($categorias as $categoria) {
                        echo "<option value='" . $categoria['id'] . "'>" . $categoria['name'] . "</option>";
                    }
                    ?>
                
                    
                    
                </select>
                <br>
            
            <button type="submit" class="btn btn-primary">Guardar registro</button>
        </form>
        
    </div>
</body>
</html>