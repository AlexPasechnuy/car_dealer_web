<?php
# check for a user session
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
        <a href="index.php?action=create">View repair orders for other days</a>
        <?php
    }
    ?>
<table border="1">
    <tr>
        <th>Client name</th>
        <th>Client phone</th>
        <th>Make</th>
        <th>Model</th>
        <th>Time</th>
        <th>Info</th>
        <th>Action</th>
    </tr>
    <?php
    # retrieve and display data about contracts
    $sql = "SELECT * FROM rep_ord_info
    WHERE mechanic = '{$_SESSION["user"]}' and date = DATE(NOW())
    ORDER BY time";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        ?>

        <tr>
            <td><?= $row["client_name"] ?></td>
            <td><?= $row["client_phone"] ?></td>
            <td><?= $row["make"] ?></td>
            <td><?= $row["model"] ?></td>
            <td><?= $row["time"] ?></td>
            <td><?= $row["info"] ?></td>
            <td>
                <a href="index.php?action=delete&id=<?= $row["id"] ?>"> Report </a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
</p>