<?php
//Restaurant Functions
function invalidResName($name)
{
    $result = false;
    if (!preg_match("/^[a-zA-Z0-9 ]*$/", $name)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function pwdMatch($pwd, $pwdRepeat)
{
    $result = false;
    if ($pwd !== $pwdRepeat) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}
function resEmailExists($conn, $email, $name)
{
    $result = false;
    $sql = "SELECT * FROM restaurant WHERE restaurantEmail = ? OR restaurantName = ?;";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: .././register.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $email, $name);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}
function createResUser($conn, $name, $email, $pwd)
{
    $result = false;
    $sql = "INSERT INTO restaurant (restaurantName, restaurantEmail, restaurantPwd) VALUES(?, ?, ?);";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: .././register.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: .././login.php?status=created");
}


// Customer Functions

function invalidCusName($fName, $lName)
{
    $result = false;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $fName) && !preg_match("/^[a-zA-Z0-9]*$/", $lName)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}


function cusEmailExists($conn, $email)
{
    $result = false;
    $sql = "SELECT * FROM customer WHERE customerEmail = ?;";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: .././register.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}


function createCusUser($conn, $fName, $lName, $email, $pwd, $food)
{
    $result = false;
    $sql = "INSERT INTO customer (firstName, lastName, customerEmail, customerPwd, foodChoice) VALUES(?, ?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: .././register.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $fName, $lName, $email, $hashedPwd, $food);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: .././login.php?status=created");
}


//Login Restaurant 

function loginResUser($conn, $email, $pwd, $name)
{
    $resUserExists = resEmailExists($conn, $email, $name);

    if ($resUserExists === false) {
        header("location: .././login.php?error=restaurantdoesnotexist");
        exit();
    }
    $pwdHashed = $resUserExists["restaurantPwd"];

    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {

        header("location: .././index.php?error=wrongrespassword");
    } else if ($checkPwd == true) {
        session_start();
        $_SESSION["resemail"] = $resUserExists["restaurantEmail"];
        $_SESSION["resname"] = $resUserExists["restaurantName"];
        header("location: .././index.php");
        exit();
    }
}
//Login Customer 

function loginCusUser($conn, $email, $pwd)
{
    $cusUserExists = cusEmailExists($conn, $email);

    if ($cusUserExists === false) {
        header("location: .././login.php?error=customerdoesnotexist");
        exit();
    }
    $pwdHashed = $cusUserExists["customerPwd"];

    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: .././login.php?error=wrongcuspassword");
    } else if ($checkPwd == true) {
        session_start();
        $_SESSION["cusemail"] = $cusUserExists["customerEmail"];
        $_SESSION["cusFname"] = $cusUserExists["firstName"];
        $_SESSION["cusLname"] = $cusUserExists["lastName"];
        $_SESSION["type"] = $cusUserExists["foodChoice"];
        header("location: .././index.php");
        exit();
    }
}
