<?php
//Agregar_nuevo_vehiculo.php

$url_page = "http://127.0.0.1:8000/api/vehiculos";
$data = array("placa" => $_POST['placa'], "password" => $_POST["password"]);
$options = array(
    'http' => array(
        'header' => "Content-Type: application/json",
        'method'  => 'POST',
        'content' => json_encode($data)
    )
);
$context = stream_context_create($options);
$result = file_get_contents($url_page, false, $context);
if ($result === false) {
    echo "Error al agregar el vehículo.";
} else {
    $decodedString = (array) json_decode($result);
    echo "Vehículo agregado con éxito.";
}
?>