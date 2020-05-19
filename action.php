<?php
if (isset($_POST["create_report"])) {
    $order_id = $_POST["rep_ord_id"];
    $vin = $_POST["vin"];
    $note = $_POST["note"];
    $sql = "CALL create_report({$order_id}, {$vin}, '{$note}','{$_SESSION["user"]}')";
    mysqli_query($conn, $sql);
    header("location: index.php");
}

if (isset($_POST["save_emp"])) {
    $username = $_POST["username"];
    $position = $_POST["position"];
    $salary = $_POST["salary"];
    $sql = "UPDATE employee
SET position = '{$position}', salary = {$salary}
WHERE username = '{$username}'";
    mysqli_query($conn, $sql);
    header("location: index.php");
}

if (isset($_POST["del_sel_ord"])) {
    $sell_ord_id = $_POST["sell_ord_id"];
    $sql = "DELETE FROM sell_order
WHERE sell_order_id = {$sell_ord_id}";
    mysqli_query($conn, $sql);
    header("location: index.php");
}

if (isset($_POST["sell_car"])) {
    $sell_ord_id = $_POST["sell_ord_id"];
    $sql = "call sell_car({$sell_ord_id})";
    mysqli_query($conn, $sql);
    header("location: index.php");
}

if (isset($_POST["cr_sell_ord"])) {
    $vin = $_POST["vin"];
    $name = $_POST["client_name"];
    $surname = $_POST["client_surname"];
    $phone = $_POST["client_phone"];
    $info = $_POST["sell_info"];
    $sql = "INSERT INTO sell_order(vin, client_name, client_surname, client_phone, employee_username, sell_order_info)
VALUES({$vin},'{$name}','{$surname}','{$phone}','{$_SESSION["user"]}','{$info}')";
    mysqli_query($conn, $sql);
    header("location: index.php");
}


if (isset($_POST["create_rep_ord"])) {
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $phone = $_POST["phone"];
    $date = $_POST["date"];
    $hours = $_POST["hours"];
    $minutes = $_POST["minutes"];
    $info = $_POST["sell_info"];
    $model_id = $_POST["model_id"];
    $sql = "INSERT INTO repair_order(time, client_name, client_surname, client_phone, employee_username, repair_order_info, car_model_id)
VALUES('{$date} {$hours}:{$minutes}:00', '{$name}','{$surname}','{$phone}', 'n_durov', '{$info}', {$model_id})";
    mysqli_query($conn, $sql);
    header("location: index.php");
}