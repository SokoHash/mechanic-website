<?php
    $url_page = "http://127.0.0.1:8000/api/usuario/";
    $data = array("email" => $_POST["email"], "id_card" => $_POST["id_card"], "phone" => $_POST["phone"], "password" => $_POST["password"]);
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