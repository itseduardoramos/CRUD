<?php
    include('database.php');

    $query = "SELECT * from producto";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("Peticion fallida".mysqli_error($connection));
    }

    $json = array();
    while ($row = mysqli_fetch_array($result)) {
        $json[] = array(
        'nombre' => $row['nombre'],
        'descripcion' => $row['descripcion'],
        'id' => $row['id']
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
?>