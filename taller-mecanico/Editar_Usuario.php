<?php
// Editar_Usuario.php

$url_page = "http://127.0.0.1:8000/api/usuarios/" . $_POST['id'];
$data = array("nombre" => $_POST['nombre'], "apellido" => $_POST['apellido'], "email" => $_POST['email'], "password" => $_POST['password']);
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
    echo "Error al editar el usuario.";
} else {
    $decodedString = (array) json_decode($result);
    echo "Usuario editado con éxito.";
}
?>