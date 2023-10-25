<?php
    session_start();
    $url_page = "http://127.0.0.1:8000/api/search/".$_SESSION["admintoken"];
    $data = array("email" => $_POST['email']);
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
    $arrayjson = json_decode(json_encode($decodedString["uservalue"][0]), true);
    if ($decodedString['uservalue']) {
        session_start();
        $_SESSION["usertoken"] = $arrayjson['token_user'];
        $_SESSION["useremail"] = $arrayjson['email'];
        $_SESSION["id_card"] = $arrayjson['id_card'];
        $_SESSION["phone"] = $arrayjson['phone'];
        $_SESSION["password"] = $arrayjson['password'];

        var_dump($arrayjson);
        echo "<br>";
        echo $arrayjson;
    }
    else {
        echo "user not founded";
        header('Location: static/user_manager.html');
    }
?>
