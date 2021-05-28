<?php
if (isset($_POST["submit"])) {
    $fName = $_POST["cusFname"];
    $lName = $_POST["cusLname"];
    $food = $_POST["food-type"];
    $email = $_POST["cusEmail"];
    $pwd = $_POST["cusPwd"];
    $pwdRepeat = $_POST["cusConfPwd"];

    require_once './dbh.inc.php';
    require_once './Functions/reglog.func.inc.php';

    if (invalidCusName($fName, $lName) !== false) {
        header("location: ../register.php?error=cusinvalidname");
        exit();
    }

    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: ../register.php?error=cuspasswordsdontmatch");
        exit();
    }

    if (CusEmailExists($conn, $email) !== false) {
        header("location: ../register.php?error=cusemailalreadytaken");
        exit();
    }

    createCusUser($conn, $fName, $lName, $email, $pwd, $food);
} else {
    header("location: ../register.php");
    exit();
}
