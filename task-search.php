<?php
//AL BUSCAR ALGUN PRODUCTO EN LA BARRA DE BÚSQUEDA, LA INFORMACIÓN SERÁ ENVIADA DE AJAX A ESTE APARTADO
    include('database.php');
    $search = $_POST['search'];

    if (!empty($search)) {
        $query = "SELECT * FROM producto WHERE nombre LIKE '$search%'";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            die('Error de query'.mysqli_error($connection));
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
    }
?>