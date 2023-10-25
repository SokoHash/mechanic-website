<?php
    session_start();
    $url_page = "http://127.0.0.1:8000/api/usuario/".$_SESSION["usertoken"]."/".$_SESSION["placa"];
    $postplaca = "";
    $postvehiculo = "";
    $posttipo_arreglo = "";
    $postdescription = "";
    $postmecanico = "";
    if (!empty($_POST['placa'])) {
        $postplaca = $_POST["placa"];
    }
    if (!empty($_POST['vehiculo'])) {
        $postvehiculo = $_POST["vehiculo"];
    }
    if (!empty($_POST['tipo_arreglo'])) {
        $posttipo_arreglo = $_POST["tipo_arreglo"];
    }
    if (!empty($_POST['description'])) {
        $postdescription = $_POST["description"];
    }
    if (!empty($_POST['mecanico'])) {
        $postmecanico = $_POST["mecanico"];
    }
    $data = array("placa" => $postplaca, "vehiculo" => $postvehiculo, "tipo_arreglo" => $posttipo_arreglo, "description" => $postdescription, "mecanico" => $postmecanico);

    $options = array(
        'http' => array(
        'header' => "Content-Type: application/json",
        'method'  => 'PUT',
        'content' => json_encode($data)
    )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url_page, false, $context);
    $decodedString = (array) json_decode($result);
    echo $decodedString["message"];
?>
