<?php
session_start();
if (isset($_POST["submit"])) {
    if ($_SESSION["cusemail"]) {
        $name = $_POST["foodN"];
        $f = $_SESSION["cusFname"];
        $l = $_SESSION["cusLname"];
        $flname = $f . " " . $l;

        require_once './dbh.inc.php';
        require_once './Functions/order.func.inc.php';
        addOrder($conn, $name, $flname);
        exit();
    } else if ($_SESSION["resemail"]) {
        header("location: ../index.php?error=registerascustomer");
    } else {
        header("location: ../login.php?error=loginfirst");
    }
}
