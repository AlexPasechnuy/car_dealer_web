<?php
# check for a user session
if (!isset($_SESSION["user"])) {
    header("location: login.php");
}
?>
<h3>Undelivered supplies</h3>
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
        <a href="index.php?action=create">View all delivery lots</a>
        <?php
    }
    ?>
<table border="1">
    <tr>
        <th>Make</th>
        <th>Country</th>
        <th>City</th>
        <th>Expected arrival date</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    <?php
    # retrieve and display data about contracts
    $sql = "SELECT *    FROM supplies_info
    WHERE status != 'delivered'
    ORDER BY expected_arrival_date";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        ?>

        <tr>
            <td><?= $row["make"] ?></td>
            <td><?= $row["country"] ?></td>
            <td><?= $row["city"] ?></td>
            <td><?= $row["expected_arrival_date"] ?></td>
            <td><?= $row["status"] ?></td>
            <td>
                <a href="index.php?action=update&id=<?= $row["id"] ?>">All info</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
</p>