<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/register.css" />
    <style>
        .login {
            position: absolute;
        }
    </style>

    <title>Login</title>
</head>

<body>

    <nav class="nav-list">
        <label class="logo"><a href="./index.php">Food<span style="color:#BBDBBD">X</span></a></label>
        <ul>

            <li><a href="./index.php">Home</a></li>


            <?php
            session_start();
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
        <h2>You are logging in as ?</h2>


        <ul class="tab-group">
            <li class="tab active" id="res"><a href="#restaurant">Restaurant</a></li>
            <li class="tab" id="cus"><a href="#customer">Customer</a></li>
        </ul>


        <?php
        if (isset($_GET["status"])) {
            if ($_GET["status"] == "created") {
                echo "<p style=\"color:green; text-align:center; padding-bottom:10px;\">User created successfully:)</p>";
            }
        }
        ?>
        <div class="tab-content">
            <div id="restaurant">
                <form action="./Includes/res_login.inc.php" method="post">

                    <div class="field-wrap">
                        <input class="info" type="email" name="resEmail" required autocomplete="off" placeholder="Restaurant Email" />
                    </div>

                    <div class="field-wrap">
                        <input class="info" type="password" name="resPassword" required autocomplete="off" placeholder="Password" />
                    </div>
                    <?php
                    if (isset($_GET["error"])) {
                        if ($_GET["error"] == "wrongrespassword" || $_GET["error"] == "restaurantdoesnotexist") {
                            echo "<p style=\"color:red; text-align:center;\">Wrong email or password.</p>";
                        }
                    }
                    ?>

                    <button type="submit" class="button button-block" name="submit" />Log In</button>
                    <h4 class="account-exist">Not a member? <a href="./register.php">Register</a></h4>

                </form>


            </div>

            <div id="customer">
                <form action="./Includes/cus_login.inc.php" method="post">

                    <div class="field-wrap">
                        <input class="info" type="email" name="cusEmail" required autocomplete="off" placeholder="Customer Email" />
                    </div>

                    <div class="field-wrap">

                        <input class="info" type="password" name="cusPassword" required autocomplete="off" placeholder="Password" />
                    </div>
                    <?php
                    if (isset($_GET["error"])) {
                        if ($_GET["error"] == "wrongcuspassword" || $_GET["error"] == "customerdoesnotexist") {
                            echo "<p style=\"color:red; text-align:center;\">Wrong email or password.</p>";
                        }
                    }
                    ?>

                    <button type="submit" class="button button-block" name="submit" />Log In</button>
                    <h4 class="account-exist">Not a member? <a href="./register.php">Register</a></h4>

                </form>


            </div>

        </div>


    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="./Javascript/register.js"></script>
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "loginfirst") {
            echo "<script type=\"text/javascript\">alert(\"You need to have a restaurant's account to add food items\");";
            echo "</script>";
        } else if ($_GET["error"] == "registerascustomer") {
            echo "<script type=\"text/javascript\">alert(\"Please register as a customer to order food!\");";
            echo "</script>";
        } else if ($_GET["error"] == "customerdoesnotexist" || $_GET["error"] == "wrongcuspassword") {
            echo '<script type="text/JavaScript">customerTab()</script>';
        } else if ($_GET["error"] == "restaurantdoesnotexist" || $_GET["error"] == "wrongrespassword") {
            echo '<script type="text/JavaScript">restaurantTab()</script>';
        }
    }

    ?>
    <?php
    require_once './footer.php';

    ?>