<?php
    session_start();
    $_SESSION["usertoken"] = "";
    $_SESSION["admintoken"] = "";
    session_destroy();
    header('Location: static/index.html');
?>