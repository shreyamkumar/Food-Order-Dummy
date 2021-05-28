<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/register.css" />
    <title>Login</title>
</head>

<body>

    <nav class="nav-list">
        <label class="logo"><a href="./index.php">Food<span style="color:#BBDBBD">X</span></a></label>
        <ul>

            <li><a href="./index.php">Home</a></li>


            <?php

            if (isset($_SESSION["resemail"])) {
                echo "<li><a href='./Components/addMenu.php'>Add Menu</a></li>";
                echo "<li><a href='./vieworders.php'>View Orders</a></li>";
            }
            if (isset($_SESSION["cusemail"]) || isset($_SESSION["resemail"])) {
                echo "<li><a href='./Includes/logout.inc.php'>Log out</a></li>";
            } else {
                echo "<li><a href='./register.php'>Sign Up</a></li>";
                echo "<li><a href='./login.php'>Log In</a></li>";
            }

            ?>

        </ul>
    </nav>