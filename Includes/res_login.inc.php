<?php
if (isset($_POST["submit"])) {
    $email = $_POST["resEmail"];
    $pwd = $_POST["resPassword"];
    $name = "";

    require_once './dbh.inc.php';
    require_once './Functions/reglog.func.inc.php';


    loginResUser($conn, $email, $pwd, $name);
} else {
    header("location: ../login.php");
}
