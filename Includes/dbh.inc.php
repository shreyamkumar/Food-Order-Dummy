<?php
$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "foodx";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Connection Fail: " . mysqli_connect_errno());
}
