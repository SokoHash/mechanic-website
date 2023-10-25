<?php
//Agregar_nuevo_vehiculo.php
session_start();
$url_page = "http://127.0.0.1:8000/api/vehicle/".$_SESSION["usertoken"];
$data = array("placa" => $_POST["placa"], "vehiculo" => $_POST["vehiculo"], "tipo_arreglo" => $_POST["tipo_arreglo"], "description" => $_POST["description"], "mecanico" => $_POST["mecanico"]);
$options = array(
    'http' => array(
    'header' => "Content-Type: application/json",
    'method'  => 'POST',
    'content' => json_encode($data)
)
);
$context = stream_context_create($options);
$result = file_get_contents($url_page, false, $context);
$decodedString = (array) json_decode($result);
echo $decodedString["message"];

?>