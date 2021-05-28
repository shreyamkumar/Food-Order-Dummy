<?php
session_start();
require_once './Includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/register.css" />
    <link rel="stylesheet" href="./Styles/index.css" />
    <link rel="icon" href="./Images/fx.jpg" />
    <title>Home | FoodX</title>
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



    <div class="wrapper">
        <h3 class="wrapper-heading wrapper-heading-first">We deliver
            <span>
                <i>Happiness:)</i>
            </span></h3>
    </div>


    <div class="food-list">
        <div class="scroller">
            <h3 class="scroller-heading">All your happiness are down here</h3>
        </div>
        <div class="food-wrapper">
            <?php
            if (isset($_SESSION["resemail"]) || (isset($_SESSION["type"]) && $_SESSION["type"] == "Both")) {
                $query = "SELECT * FROM foods;";
            } else if ((isset($_SESSION["type"]) && $_SESSION["type"] == "Veg")) {
                $ty = $_SESSION["type"];
                $query = "SELECT * FROM foods WHERE foodType = '$ty';";
            } else if ((isset($_SESSION["type"]) && $_SESSION["type"] == "NonVeg")) {
                $ty = $_SESSION["type"];
                $query = "SELECT * FROM foods WHERE foodType = '$ty';";
            } else {
                $query = "SELECT * FROM foods;";
            }
            $result = mysqli_query($conn, $query);

            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $foodN = str_replace(' ', '', $row['foodName']);
                    echo "<form action=\"./Includes/order.inc.php\" method=\"POST\">";
                    echo "<input type=\"hidden\" name=\"foodN\" value=" . $row['foodId'] . ">";
                    echo "<div class='food-data'>";
                    echo "<div class='food-data-content'>";
                    echo "<p class=\"food-name food-specs\">";
                    echo $row['foodName'];
                    echo "</p>";
                    echo "<p class=\"food-cost food-specs\">";
                    echo "&#8377 " . $row['cost'];
                    echo "</p>";
                    echo "<p class=\"food-cost food-specs\">";
                    echo "Available at " . $row['availAt'];
                    echo "</p>";
                    echo "<p class=\"food-people food-specs\">";
                    echo "Easily serves " . $row['people'] . " people";
                    echo "</p>";
                    echo "<p class=\"food-desc food-specs\"><i>";
                    echo $row['foodDesc'];
                    echo "</i></p>";
                    echo "</div>";
                    echo "<div class='food-btn'>";
                    echo "<button class='' type='submit' id='btn' name='submit'>Order</button>";
                    echo "</div>";
                    echo "</div>";
                    echo "</form>";
                }
            } else {
                echo "<script type=\"text/javascript\">alert(\"No food available, Sorry!\");";
                echo "</script>";
            }

            ?>

        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <?php
    if (isset($_SESSION["cusemail"])) {
        echo "<script type=\"text/javascript\">  $(\"button\").addClass(\"btn-glow\");";
        echo "</script>";
    }
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "notallowedadding") {
            echo "<script type=\"text/javascript\">alert(\"You need to have a restaurant's account to add food items\");";
            echo "</script>";
        } else if ($_GET["error"] == "registerascustomer") {
            echo "<script type=\"text/javascript\">alert(\"Please register as a customer to order food!\");";
            echo "</script>";
        }
    } else if (isset($_GET["status"])) {
        if ($_GET["status"] == "successs") {
            echo "<script type=\"text/javascript\">alert(\"Your item is successfuly added:)\");";
            echo "</script>";
        } else if (isset($_GET["status"]))
            if ($_GET["status"] == "ordered") {
                echo "<script type=\"text/javascript\">alert(\"Your order was successfully placed:)\");";
                echo "</script>";
            }
    }
    ?>
    <?php
    require_once './footer.php';

    ?>