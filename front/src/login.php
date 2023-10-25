<?php
    $url_page = "http://127.0.0.1:8000/api/login/";
    $data = array("email" => $_POST['correo'], "password" => $_POST['password']);
    $options = array(
        'http' => array(
        'header' => "Content-Type: application/json",
        'method'  => 'POST',
        'content' => json_encode($data)
    )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url_page, false, $context);
    if ($result === false){
        header('Location: static/login.html');
    }
    $decodedString = (array) json_decode($result);
    if ($decodedString['uservalue'] === 'admin'){
        session_start();
        $_SESSION["admintoken"] = $decodedString['tokenadmin'];
        header('Location: static/user_manager.html');
    }
    else if ($decodedString['message'] === 'token') {
        $arrayjson = json_decode(json_encode($decodedString["uservalue"][0]), true);
        session_start();
        $_SESSION["usertoken"] = $arrayjson['token_user'];
        header('Location: static/Sistema_de_gestion_de_archivo.html');
    }
    else {
        header('Location: static/login.html');
    }
?>