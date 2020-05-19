<?php
# check for a user session
if (!isset($_SESSION["user"])) {
    header("location: login.php");
}
?>
<h2>Supplies</h2>
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

    Body {
        font-family: Calibri, Helvetica, sans-serif;
        background-color: #848484;
    }

    button {
        background-color: #000000;
        width: 20%;
        color: white;
        padding: 15px;
        margin: 10px 0px;
        border: none;
        cursor: pointer;
        transition-duration: 0.4s;
        opacity: 0.7;
    }

    button:hover {
        background-color: #575757;
        color: #ffffff;
        box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
    }

    form {
        border: 3px solid #000000;
    }

    input[type=text], input[type=password], textarea {
        width: 20%;
        margin: 8px 0;
        padding: 12px 20px;
        display: inline-block;
        border: 3px solid #000000;
        box-sizing: border-box;
        box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
    }
</style>
<p>
    <?php
    # if the page is in record's create/update or delete mode (action parameter is set) - show 'back' link
    if (isset($_GET["action"]) && $_GET["action"] == "see_all") {
        ?>
        <h3><a href="index.php?action=see_undel">Show undelivered lots</a></h3>
    <h3>All delivery lots</h3>
        <?php
        # otherwise - show 'new record' link
    } else {
        ?>
        <h3><a href="index.php?action=see_all">Show all delivery lots</a></h3>
            <h3>Undelivered lots</h3>
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
                <a href="index.php?action=show_sup_info&id=<?= $row["id"] ?>">All info</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
</p>