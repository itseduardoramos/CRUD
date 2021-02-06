<?php
    include('database.php');
    $id = $_POST['id'];

    $query = "SELECT * FROM producto WHERE id = $id";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die('Consulta fallida');
    }

    $json = array();
    while ($row = mysqli_fetch_array($result)) {
        $json[] = array(
            'nombre' => $row['nombre'],
            'descripcion' => $row['descripcion'],
            'id' => $row['id']
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
?>