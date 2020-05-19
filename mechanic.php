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

    tr:nth-child(even) {
        background-color: #d5d5d5
    }

    th {
        background-color: #424242;
        color: #ffffff;
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
    <style>
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
        button:hover{
            background-color: #575757;
            color: #ffffff;
            box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
        }
        form {
            border: 3px solid #000000;
        }
        input[type=text], input[type=password] {
            width: 20%;
            margin: 8px 0;
            padding: 12px 20px;
            display: inline-block;
            border: 3px solid #000000;
            box-sizing: border-box;
            box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
        }
    </style>
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
            <button type="submit" name="create_report">Save</button>
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