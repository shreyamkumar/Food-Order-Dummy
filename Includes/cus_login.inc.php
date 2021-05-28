<?php
if (isset($_POST["submit"])) {
    $email = $_POST["cusEmail"];
    $pwd = $_POST["cusPassword"];

    require_once './dbh.inc.php';
    require_once './Functions/reglog.func.inc.php';


    loginCusUser($conn, $email, $pwd);
} else {
    header("location: ../login.php");
}
