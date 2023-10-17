<?php
// Editar_Vehiculo.php

$url_page = "http://127.0.0.1:8000/api/vehiculos/" . $_POST['id'];
$data = array("marca" => $_POST['marca'], "modelo" => $_POST['modelo'], "anio" => $_POST['anio'], "precio" => $_POST['precio']);
$options = array(
    'http' => array(
        'header' => "Content-Type: application/json",
        'method'  => 'PUT',
        'content' => json_encode($data)
    )
);
$context = stream_context_create($options);
$result = file_get_contents($url_page, false, $context);
if ($result === false) {
    echo "Error al editar el vehículo.";
} else {
    $decodedString = (array) json_decode($result);
    echo "Vehículo editado con éxito.";
}
?>