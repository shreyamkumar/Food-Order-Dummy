<?php
if (isset($_POST["submit"])) {
    $name = $_POST["resName"];
    $email = $_POST["resEmail"];
    $pwd = $_POST["resPwd"];
    $pwdRepeat = $_POST["resConfPwd"];

    require_once './dbh.inc.php';
    require_once './Functions/reglog.func.inc.php';

    if (invalidResName($name) !== false) {
        header("location: ../register.php?error=invalidrestaurnatname");
        exit();
    }

    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: ../register.php?error=passwordsdontmatch");
        exit();
    }

    if (resEmailExists($conn, $email, $name) !== false) {
        header("location: ../register.php?error=emailalreadytaken");
        exit();
    }

    createResUser($conn, $name, $email, $pwd);
} else {
    header("location: ../register.php");
    exit();
}
