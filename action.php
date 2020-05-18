<?php
if (isset($_POST["create_report"])) {
    $order_id = $_POST["rep_ord_id"];
    $vin = $_POST["vin"];
    $note = $_POST["note"];
    # use the stored procedure created earlier
    $sql = "CALL create_report({$order_id}, {$vin}, '{$note}','{$_SESSION["user"]}')";
    mysqli_query($conn, $sql);
    header("location: index.php");
}

if (isset($_POST["save_emp"])) {
    $username = $_POST["username"];
    $position = $_POST["position"];
    $salary = $_POST["salary"];
    # use the stored procedure created earlier
    $sql = "UPDATE employee
SET position = '{$position}', salary = {$salary}
WHERE username = '{$username}'";
    mysqli_query($conn, $sql);
    header("location: index.php");
}