<?php
session_start();

if (isset($_SESSION["resemail"]) || isset($_SESSION["cusemail"])) {
    header("location: ./index.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/register.css" />
    <title>Register</title>
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


    <div class="form">

        <ul class="tab-group">
            <li class="tab active" id="res"><a href="#restaurant">Restaurant</a></li>
            <li class="tab" id="cus"><a href="#customer">Customer</a></li>
        </ul>

        <div class="tab-content">
            <div id="restaurant">
                <h2>Sign Up As Restaurant</h2>

                <form action="./Includes/res_register.inc.php" method="post">

                    <div class="field-wrap">
                        <?php
                        if (isset($_GET["error"])) {
                            if ($_GET["error"] == "invalidrestaurnatname") {
                                echo "<p style=\"color:red\">Invalid Restaurant's Name</p>";
                            }
                        }
                        ?>
                        <input class="info" type="text" name="resName" required autocomplete="off" placeholder="Restaurant Name" />
                    </div>

                    <div class="field-wrap">
                        <?php
                        if (isset($_GET["error"])) {
                            if ($_GET["error"] == "emailalreadytaken") {
                                echo "<p style=\"color:red\">Email already exists</p>";
                            }
                        }
                        ?>
                        <input class="info" type="email" name="resEmail" required autocomplete="off" placeholder="Email" />
                    </div>

                    <div class="field-wrap">
                        <?php
                        if (isset($_GET["error"])) {
                            if ($_GET["error"] == "passwordsdontmatch") {
                                echo "<p style=\"color:red\">Password did not match!</p>";
                            }
                        }
                        ?>
                        <input class="info" type="password" name="resPwd" required autocomplete="off" placeholder="Password" />
                    </div>
                    <div class="field-wrap">
                        <input class="info" type="password" name="resConfPwd" required autocomplete="off" placeholder="Confirm Password" />
                    </div>
                    <?php
                    if (isset($_GET["error"])) {
                        if ($_GET["error"] == "stmtfailed") {
                            echo "<p style=\"color:red; text-align:center;\">ILLEGAL INPUTS</p>";
                        }
                    }
                    ?>

                    <button type="submit" class="button button-block" name="submit" />Register</button>
                    <h4 class="account-exist">Already have an account? <a href="./login.php">Login</a></h4>

                </form>


            </div>

            <div id="customer">
                <h2>Sign Up As Customer</h2>

                <form action="./Includes/cus_register.inc.php" method="post">

                    <div class="top-row">
                        <div class="field-wrap">
                            <?php
                            if (isset($_GET["error"])) {
                                if ($_GET["error"] == "cusinvalidname") {
                                    echo "<p style=\"color:red\">Invalid Name</p>";
                                }
                            }
                            ?>
                            <input class="info" type="text" name="cusFname" required autocomplete="off" placeholder="First Name" />
                        </div>

                        <div class="field-wrap">
                            <input class="info" type="text" name="cusLname" required autocomplete="off" placeholder="Last Name" />
                        </div>
                    </div>

                    <div class="field-wrap preference-head">
                        <label class="preference-label">Food Preference</label>
                        <div class="preference" id="radio-switch">
                            <input class="" name="food-type" type="radio" value="Veg" checked="checked">
                            <label for="Veg" onclick="">Veg</label>
                            <input class="" name="food-type" type="radio" value="NonVeg">
                            <label for="Non-Veg" onclick="">Non-Veg</label>
                            <input class="" name="food-type" type="radio" value="Both">
                            <label for="Non-Veg" onclick="">Both</label>
                        </div>
                    </div>
                    <div class="field-wrap">
                        <?php
                        if (isset($_GET["error"])) {
                            if ($_GET["error"] == "cusemailalreadytaken") {
                                echo "<p style=\"color:red\">Email aready exists!</p>";
                            }
                        }
                        ?>
                        <input class="info" type="email" name="cusEmail" required autocomplete="off" placeholder="Email" />
                    </div>

                    <div class="field-wrap">
                        <?php
                        if (isset($_GET["error"])) {
                            if ($_GET["error"] == "cuspasswordsdontmatch") {
                                echo "<p style=\"color:red\">Password did not match!</p>";
                            }
                        }
                        ?>
                        <input class="info" type="password" name="cusPwd" required autocomplete="off" placeholder="Password" />
                    </div>
                    <div class="field-wrap">
                        <input class="info" type="password" name="cusConfPwd" required autocomplete="off" placeholder="Confirm Password" />
                    </div>
                    <?php
                    if (isset($_GET["error"])) {
                        if ($_GET["error"] == "stmtfailed") {
                            echo "<p style=\"color:red; text-align:center;\">ILLEGAL INPUTS</p>";
                        }
                    }
                    ?>

                    <button type="submit" class="button button-block" name="submit" />Register</button>
                    <h4 class="account-exist">Already have an account? <a href=".login.php">Login</a></h4>

                </form>
            </div>

        </div>


    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="./Javascript/register.js">
    </script>
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "cusemailalreadytaken" || $_GET["error"] == "cusinvalidname" || $_GET["error"] == "cuspasswordsdontmatch") {
            echo '<script type="text/JavaScript">customerTab()</script>';
        } else if ($_GET["error"] == "resemailalreadytaken" || $_GET["error"] == "invalidrestaurnatname" || $_GET["error"] == "respasswordsdontmatch") {
            echo '<script type="text/JavaScript">restaurantTab()</script>';
        }
    }
    ?>

    <?php
    require_once './footer.php';

    ?>