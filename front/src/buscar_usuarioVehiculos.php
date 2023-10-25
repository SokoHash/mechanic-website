<?php
    session_start();
    $url_page = "http://127.0.0.1:8000/api/vehicle/".$_SESSION["usertoken"];
    $options = array(
        'http' => array(
        'header' => "Content-Type: application/json",
        'method'  => 'GET',
        'content' => json_encode($data)
    )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url_page, false, $context);
    $decodedString = (array) json_decode($result);
    $arrayjson = json_decode(json_encode($decodedString["uservalue"][0]), true);
    if ($decodedString['uservalue']) {
        var_dump($decodedString);
        echo "<br>";
        echo $arrayjson;
    }
    else {
        echo "user no vehicle not founded";
    }
?>
