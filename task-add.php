<?php
    include('database.php');

    if (isset($_POST['name'])) {
        $nombre = $_POST['name'];
        $descripcion = $_POST['description'];

        $query = "INSERT into producto(nombre, descripcion) VALUES ('$nombre', '$descripcion')";
        $result = mysqli_query($connection, $query);
        if (!$result) {
            die('Consulta fallida');
        }
        echo "Producto agregado exitosamente";
    }
?>