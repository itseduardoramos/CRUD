<?php
    include('database.php');

    $id = $_POST['id'];
    $nombre = $_POST['name'];
    $descripcion = $_POST['description'];

    $query = "UPDATE producto SET nombre = '$nombre', descripcion = '$descripcion' WHERE id = '$id'";

    $result = mysqli_query($connection, $query);
    if (!$result) {
        die('Consulta fallida');
    }

    echo "Tarea actualizada";

?>