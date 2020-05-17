<?php
if (!isset($_SESSION["user"])) {
    header("location: login.php");
}
?>
<h3>Repair orders for today</h3>
<p>
    <?php
    # if the page is in record's create/update or delete mode (action parameter is set) - show 'back' link
    if (isset($_GET["action"]) && ($_GET["action"] == "create" || $_GET["action"] == "update"
            || $_GET["action"] == "delete")) {
        ?>
        <a href="index.php">Back</a>
        <?php
        # otherwise - show 'new record' link
    } else {
        ?>
        <a href="index.php?action=create">View list of available cars</a>
        <?php
    }
    ?>
<table border="1">
    <tr>
        <th>Client name</th>
        <th>Client phone</th>
        <th>Make</th>
        <th>Model</th>
        <th>Info</th>
        <th>Action</th>
    </tr>
    <?php
    # retrieve and display data about contracts
    $sql = "select sell_order.vin, concat(sell_order.client_name, ' ', sell_order.client_surname) as client_name, sell_order.client_phone, car_make.car_make_name, car_model.car_model_name, sell_order.sell_order_info
from car_make, car_model, sell_order, car
where sell_order.vin = car.vin and car.car_model_id = car_model.car_model_id and car_model.car_make_id = car_make.car_make_id and sell_order.employee_username = '{$_SESSION["user"]}'";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        ?>

        <tr>
            <td><?= $row["client_name"]?></td>
            <td><?= $row["client_phone"]?></td>
            <td><?= $row["car_make_name"] ?></td>
            <td><?= $row["car_model_name"] ?></td>
            <td><?= $row["sell_order_info"] ?></td>
            <td>
                <a href="index.php?action=update&id=<?= $row["id"] ?>">All info</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
</p>