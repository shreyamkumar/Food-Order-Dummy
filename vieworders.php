<?php
session_start();
require_once './Includes/dbh.inc.php';
if (isset($_SESSION["resemail"])) {
} else {
    header("location: ./index.php?error=loginasrestaurant");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./Images/fx.jpg" />
    <link rel="stylesheet" href="./Styles/register.css" />
    <link rel="stylesheet" href="./Styles/vieworders.css" />
    <title>Orders</title>
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
    <div class="order-wrapper">
        <div class="order-heading">
            <h3>your orders</h3>
        </div>
        <div class="order-tables">
            <table>
                <tr>
                    <th>Serial No.</th>
                    <th>Customer Name</th>
                    <th>Ordered Item</th>
                </tr>
                <?php
                $resMail = $_SESSION["resemail"];
                $query = "SELECT * FROM orders WHERE ordRes = '$resMail';";
                $result = mysqli_query($conn, $query);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0) {
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>";
                        echo $i;
                        echo "</td>";
                        echo "<td>";
                        echo $row['customerName'];
                        echo "</td>";
                        echo "<td>";
                        echo $row['foodName'];
                        echo "</td>";
                        echo "</tr>";

                        $i++;
                    }
                } else {
                    echo "<tr><td colspan=\"3\">";
                    echo "<p style=\"text-align:center\">You have no orders yet!</p>";
                    echo "</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
    <?php
    require_once './footer.php';

    ?>