<?php
function addOrder($conn, $id, $flname)
{
    $result = false;

    $query = "SELECT * FROM foods WHERE foodId = $id;";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $foodN = $row["foodName"];
    $resEmail = $row["resEmail"];
    $sql = "INSERT INTO orders (foodName, customerName, ordRes) VALUES(?, ?, ?);";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: .././Components/addMenu.php?error=stmtfailed");
        exit();
    }


    mysqli_stmt_bind_param($stmt, "sss", $foodN, $flname, $resEmail);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: .././index.php?status=ordered");
    exit();
}
