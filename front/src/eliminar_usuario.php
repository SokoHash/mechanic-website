<?php
    session_start();
    $url_page = "http://127.0.0.1:8000/api/search/".$_SESSION["usertoken"];
    $options = array(
        'http' => array(
        'header' => "Content-Type: application/json",
        'method'  => 'DELETE',
        'content' => json_encode($data)
    )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url_page, false, $context);
    $decodedString = (array) json_decode($result);
    echo $decodedString["message"];
?>
