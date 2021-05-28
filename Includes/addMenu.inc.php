<?php

if (isset($_POST["submit"])) {
    session_start();
    $foodItem = $_POST["foodItem"];
    $people = $_POST["people"];
    $cost = $_POST["cost"];
    $foodtype = $_POST["food-type"];
    $resEmail = $_SESSION["resemail"];
    $resName = $_SESSION["resname"];

    require_once './dbh.inc.php';
    require_once './Functions/addMenu.func.inc.php';

    if (invalidFoodName($foodItem) !== false) {
        header("location: ../Components/addMenu.php?error=invaliddesc");
        exit();
    }
    if (foodExists($conn, $foodItem, $resEmail) !== false) {
        header("location: ../Components/addMenu.php?error=invalidrestaurnatname");
        exit();
    }

    createFood($conn, $foodItem, $people, $cost, $foodtype, $resEmail, $resName);
} else {
    header("location: ../index.php");
}
