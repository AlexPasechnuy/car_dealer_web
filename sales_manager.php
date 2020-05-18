<?php
# check for a user session
if (!isset($_SESSION["user"])) {
    header("location: login.php");
}
?>
<h3>List of sale orders</h3>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even){background-color: #f2f2f2}

    th {
        background-color: lightskyblue;
        color: white;
    }
</style>
<?php
# if the page is in record's create/update or delete mode (action parameter is set) - show 'back' link
if (isset($_GET["action"]) && ($_GET["action"] == "avail_cars")) {
    ?>
    <a href="index.php">Back</a>
    <?php
    # otherwise - show 'new record' link
}else{
    ?>
    <a href="index.php?action=see_avail">See available cars</a>
    <?php
}
if (isset($_GET["action"]) && ($_GET["action"] == "see_avail")) {

} else {
?>
<table border="1">
    <tr>
        <th>Client name</th>
        <th>Client phone</th>
        <th>VIN</th>
        <th>Make</th>
        <th>Model</th>
        <th>Price</th>
        <th>Info</th>
        <th>Action</th>
    </tr>
    <?php
    # retrieve and display data about contracts
    $sql = "SELECT *
    FROM sell_ord_info
    WHERE employee_username = '{$_SESSION["user"]}'
    ORDER BY client_name";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        ?>

        <tr>
            <td><?= $row["client_name"] ?></td>
            <td><?= $row["client_phone"] ?></td>
            <td><?= $row["vin"] ?></td>
            <td><?= $row["make"] ?></td>
            <td><?= $row["model"] ?></td>
            <td><?= $row["price"] ?></td>
            <td><?= $row["info"] ?></td>
            <td>
                <a href="index.php?action=sell&id=<?= $row["id"] ?>">Sell</a>
                <a href="index.php?action=delete&id=<?= $row["id"] ?>">Delete</a>
                <a href="index.php?action=car_info&id=<?= $row["vin"] ?>">Car info</a>
            </td>
        </tr>
        <?php
    }
    }
    ?>
</table>
</p>