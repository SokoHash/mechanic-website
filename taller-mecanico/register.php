<?php
$url_page = "http://127.0.0.1:8000/signup";
$data = array("username" => $_POST['username'], "password" => $_POST['password'], "email" => $_POST['email']);
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

}
$decodedString = (array) json_decode($result);
echo $decodedString["token"];

?>