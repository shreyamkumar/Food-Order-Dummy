<?php
//Restaurant Functions
function invalidFoodName($name)
{
    $result = false;
    if (!preg_match("/^[a-zA-Z0-9 ]*$/", $name)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}


function foodExists($conn, $name, $email)
{
    $result = false;
    $sql = "SELECT * FROM foods WHERE foodName = ? AND resEmail = ?;";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: .././Components/addMenu.php?error=foodexist");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $name, $email);
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
function createFood($conn, $foodItem, $people, $cost, $foodtype, $resEmail, $resName)
{
    $result = false;
    $sql = "INSERT INTO foods (foodName, resEmail, cost, people, foodType, availAt) VALUES(?, ?, ?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: .././Components/addMenu.php?error=notcreated");
        exit();
    }


    mysqli_stmt_bind_param($stmt, "ssssss", $foodItem, $resEmail, $cost, $people, $foodtype, $resName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: .././index.php?status=success");
    exit();
}
