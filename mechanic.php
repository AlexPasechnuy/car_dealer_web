<?php
# check for a user session
if (!isset($_SESSION["user"])) {
    header("location: login.php");
}
?>
<h3>Repair orders for today</h3>
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
if (isset($_GET["action"]) && ($_GET["action"] == "report")) {
    ?>
    <a href="index.php">Back</a>
    <?php
    # otherwise - show 'new record' link
}
if (isset($_GET["action"]) && ($_GET["action"] == "report")) {
    ?>
    <form id="cr_rep" method="post" action="index.php">
        <input type="hidden" value="<?= $_GET["id"] ?>" name="rep_ord_id"/>
        <p>
            <b>Report</b>
        </p>
        <p>VIN</p>
        <p>
            <input type="text" name="vin">
        </p>
        <p>Info</p>
        <p>
            <textarea name="note" rows="5" cols="50"></textarea>
        </p>
        <p>
            <input type="submit" name="create_report" value="Save"
        </p>
    </form>
    <?php

} else {
?>
<table border="1">
    <tr>
        <th>Client name</th>
        <th>Client surname</th>
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
                <a href="index.php?action=report&id=<?= $row["id"] ?>">Report</a>
            </td>
        </tr>
        <?php
    }
    }
    ?>
</table>
</p>