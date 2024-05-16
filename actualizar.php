<?php
include 'logicaPrueba.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Actualizar datos</title>
</head>

<body>
    <div class="container">
        <br>
        <br>
        <h1 class="text-center m-3">Actualizar datos</h1>
        <form action="logicaPrueba.php" method="post">
            <input type="hidden" value="actualizar" name="actualizar">
            <?php


            if ($_GET['id']) {
                $id = $_GET['id'];
                $prueba1 = new prueba1();
                $producto = $prueba1->datosActualizar($id);



                $codigo = $producto['code'];
                $nombre = $producto['name'];
                $precio = $producto['price'];
                $categoriaid = $producto['idCategory'];
            ?>
                <div class="mb-3">
                    <label for="codigo" class="form-label">Codigo</label>
                    <input type="number" class="form-control" id="codigo" name="codigo" value="<?php echo $codigo; ?>" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>">
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="text" class="form-control" id="precio" name="precio" value="<?php echo $precio; ?>">
                </div>
                <label for="nombre" class="form-label">Categorias</label>
                <select class="form-select" aria-label="Default select example" name="categoria">
                    <option value="<?php echo $categoriaid; ?>" selected><?php echo $categoriaid; ?></option>
                    <?php
                    $prueba1 = new Prueba1();
                    $categorias = $prueba1->obtenerCategory();
                    foreach ($categorias as $categoria) {
                        if ($categoriaid == $categoria['id']) {
                            echo "<option value='" . $categoria['id'] . "' selected disable>" . $categoria['name'] . "</option>";
                        }
                        echo "<option value='" . $categoria['id'] . "'>" . $categoria['name'] . "</option>";
                    }
                    ?>



</select>
<br>
<input type="hidden" name="id" value="<?php echo $id;?> ">
<button type="submit" class="btn btn-primary">Guardar registro</button>
<?php
            }
            ?>
        </form>

    </div>
</body>

</html>