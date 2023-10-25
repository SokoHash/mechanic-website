<?php
    session_start();
    $url_page = "http://127.0.0.1:8000/api/usuario/".$_SESSION["usertoken"];
    $postemail = $_SESSION["useremail"];
    $postid = $_SESSION["userid_card"];
    $postphone = $_SESSION["userphone"];
    $postpassword = $_SESSION["userpassword"];
    if (!empty($_POST['email'])) {
        $postemail = $_POST["email"];
    }
    if (!empty($_POST['id_card'])) {
        $postid = $_POST["id_card"];
    }
    if (!empty($_POST['phone'])) {
        $postphone = $_POST["phone"];
    }
    if (!empty($_POST['password'])) {
        $postpassword = $_POST["password"];
    }
    $data = array("email" => $postemail, "id_card" => $postid, "phone" => $postphone, "password" => $postpassword);
    echo $postemail;
    echo "<br>";
    echo $postid;
    echo "<br>";
    echo $postphone;
    echo "<br>";
    echo $postpassword;

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
