<?php
# check for a user session
if (!isset($_SESSION["user"])) {
    header("location: login.php");
}
?>
<h3>Undelivered supplies</h3>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #d5d5d5
    }

    th {
        background-color: #424242;
        color: #ffffff;
    }
    body{
        background-color: #e3e3e3;
    }
</style>
<p>
    <?php
    # if the page is in record's create/update or delete mode (action parameter is set) - show 'back' link
    if (isset($_GET["action"]) && $_GET["action"] == "see_all") {
        ?>
        <a href="index.php?action=see_undel">Show undelivery lots</a>
        <?php
        # otherwise - show 'new record' link
    } else {
        ?>
        <a href="index.php?action=see_all">Show all delivery lots</a>
        <?php
    }
    $sdl = "";
    if (isset($_GET["action"]) && $_GET["action"] == "see_all") {
        $sql = "SELECT *    FROM supplies_info
    ORDER BY expected_arrival_date";
    } else {
        $sql = "SELECT *    FROM supplies_info
        WHERE status != 'delivered'
        ORDER BY expected_arrival_date";
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