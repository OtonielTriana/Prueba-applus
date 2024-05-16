<?php

class Prueba1 {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "prueba";
    private $conn;

    public function __construct() {
        try {
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            // Verificar conexión
            if ($this->conn->connect_error) {
                throw new Exception("Conexión fallida: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function obtenerProductos() {
        try {
            $sql = "SELECT * FROM Product";
            $result = $this->conn->query($sql);
            $productos = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $productos[] = $row;
                }
            }
            return $productos;
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function obtenerCategory(){
        try {
            $sql = "SELECT * FROM Category";
            $result = $this->conn->query($sql);
            $categorias = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $categorias[] = $row;
                }
            }
            return $categorias;
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function crear($code, $name, $price, $category) {
        try {
            $sql = "INSERT INTO Product (code, name, idCategory, price, createdAt, updatedAt) 
                    VALUES ('$code', '$name', '$category', '$price', NOW(), NOW())";
            if ($this->conn->query($sql) === TRUE) {
                return  "<script> 
                            alert('Se creó el producto con éxito.');
                            window.location.href = document.referrer;
                        </script>";
            } else {
                throw new Exception("Error: " . $sql . "<br>" . $this->conn->error);
            }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function actualizar($id, $code, $name, $price, $category) {
        try {
            $sql = "UPDATE Product SET code='$code', name='$name', idCategory='$category', price='$price', updatedAt=NOW() WHERE id=$id";
            if ($this->conn->query($sql) === TRUE) {
                return  "<script> 
                            alert('Se actualizó el producto con éxito.');
                            window.location.href = document.referrer;
                        </script>";
            } else {
                throw new Exception("Error actualizando el registro: " . $this->conn->error);
            }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function confirmarEliminar($id) {
        return "<script>
                    if (confirm('¿Está seguro de que desea eliminar el producto con ID: $id?')) {
                        window.location.href = 'logicaPrueba.php?action=eliminar&id=$id';
                    } else {
                        window.location.href = document.referrer;
                    }
                </script>";
    }

    public function eliminar($id) {
        try {
            $sql = "DELETE FROM Product WHERE id=$id";
            if ($this->conn->query($sql) === TRUE) {
                return  "<script> 
                            alert('Se eliminó el producto con éxito.');
                            window.location.href = 'index.php?';
                            exit
                        </script>";
            } else {
                throw new Exception("Error al eliminar el registro: " . $this->conn->error);
            }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function datosActualizar($id){
        try {
            $sql = "SELECT * FROM Product WHERE id=$id";
            $resultado = $this->conn->query($sql);
            if( $resultado->num_rows > 0){
                $producto = $resultado->fetch_assoc();
                return $producto;
            } else {
                throw new Exception("Error al traer los datos: " . $this->conn->error);
            }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

//LOGICA PARA LA PRUEBA 2
public function obtenerLibrosPrestados() {
    $sql = "SELECT
    l.Titulo,
    l.Autor,
    u.Nombre,
    u.Apellido,
    p.fecha_prestamo,
    p.fecha_devolucion
  FROM Prestamo p
  JOIN Libro l ON p.libro_id = l.ID
  JOIN Usuario u ON p.usuario_id = u.ID;
  ";

    try {
      $result = $this->conn->query($sql);
      $librosPrestados = array();
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $librosPrestados[] = $row;
        }
      }
      return $librosPrestados;
    } catch (mysqli_sql_exception $e) {
      return "Error consultando la base de datos: " . $e->getMessage();
    }
  }

  public function obtenerLibrosNoDevueltos() {
    $sql = "SELECT
    l.Titulo,
    l.Autor,
    u.Nombre,
    u.Apellido,
    p.fecha_prestamo
  FROM Prestamo p
  JOIN Libro l ON p.libro_id = l.ID
  JOIN Usuario u ON p.usuario_id = u.ID
  WHERE p.fecha_devolucion IS NULL
  AND DATEDIFF(CURDATE(), p.fecha_prestamo) >= 7;
  
  ";

    try {
      $result = $this->conn->query($sql);
      $librosPrestados = array();
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $librosPrestados[] = $row;
        }
      }
      return $librosPrestados;
    } catch (mysqli_sql_exception $e) {
      return "Error consultando la base de datos: " . $e->getMessage();
    }
  }



    public function __destruct() {
        $this->conn->close();
    }
}

$prueba1 = new Prueba1();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["crear"])) {
        $code = $_POST['codigo'];
        $name = $_POST['nombre'];
        $price = $_POST['precio'];
        $category = $_POST['categoria'];

        $resultado = $prueba1->crear($code, $name, $price, $category);
        echo $resultado;
    } elseif (isset($_POST["actualizar"])) {
        $id = $_POST['id'];
        $code = $_POST['codigo'];
        $name = $_POST['nombre'];
        $price = $_POST['precio'];
        $category = $_POST['categoria'];
        $resultado = $prueba1->actualizar($id, $code, $name, $price, $category);
        echo $resultado;
    } elseif(isset($_POST["confirmar"])) {
        $id = $_POST['id'];
        $resultado = $prueba1->confirmarEliminar($id);
        echo $resultado;
    } elseif (isset($_POST["eliminar"])) {
        $id = $_POST['id'];
        $resultado = $prueba1->eliminar($id);
        echo $resultado;
    }
} elseif (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'eliminar') {
        $id = $_GET['id'];
        $resultado= $prueba1->eliminar($id);
        echo $resultado;
    }
}

?>
