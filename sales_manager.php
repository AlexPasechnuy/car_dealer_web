<?php
# check for a user session
if (!isset($_SESSION["user"])) {
    header("location: login.php");
}
?>
<h2>List of sale orders</h2>
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
<?php
# if the page is in record's create/update or delete mode (action parameter is set) - show 'back' link
if (isset($_GET["action"]) && ($_GET["action"] == "see_avail" || $_GET["action"] == "car_info"
        || $_GET["action"] == "create_sell_ord" || $_GET["action"] == "delete_sell" || $_GET["action"] == "sell_car")) {
    ?>
    <a href="index.php"><h3>Back</h3></a>
    <?php
    # otherwise - show 'new record' link
} else {
    ?>
    <a href="index.php?action=see_avail"><h3>See available cars</h3></a>
    <?php
}
if (isset($_GET["action"]) && ($_GET["action"] == "see_avail")) {
    ?>
    <table border="1">
        <tr>
            <th>VIN</th>
            <th>Make</th>
            <th>Model</th>
            <th>Colour</th>
            <th>Price</th>
            <th>Info</th>
            <th>Action</th>
        </tr>
        <?php
        # retrieve and display data about contracts
        $sql = "SELECT *
    FROM car_info
    WHERE vin NOT IN(SELECT DISTINCT vin FROM sell_order) AND sold = 0";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            ?>

            <tr>
                <td><?= $row["vin"] ?></td>
                <td><?= $row["car_make_name"] ?></td>
                <td><?= $row["car_model_name"] ?></td>
                <td><?= $row["colour"] ?></td>
                <td><?= $row["price"] ?></td>
                <td><?= $row["car_info"] ?></td>
                <td>
                    <!--                <a href="index.php?action=car_info&id=-->
                    <?//= $row["vin"] ?><!--">car_info</a>-->
                    <a href="index.php?action=create_sell_ord&id=<?= $row["vin"] ?>">Create sell order</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
} else if (isset($_GET["action"]) && $_GET["action"] == "delete_sell") {
    ?>
    <form method="post" action="index.php">
        <input type="hidden" value="<?= $_GET["id"] ?>" name="sell_ord_id"/>
        <b><h2>Delete the sell order?</h2></b>
        <p>
            <button type="submit" name="del_sel_ord">Yes</button>
        </p>
    </form>
    <?php
}else if (isset($_GET["action"]) && $_GET["action"] == "sell_car") {
    ?>
    <form method="post" action="index.php">
        <input type="hidden" value="<?= $_GET["id"] ?>" name="sell_ord_id"/>
        <b><h2>Sell car by this order?</h2></b>
        <p>
            <button type="submit" name="sell_car">Yes</button>
        </p>
    </form>
    <?php


}else if (isset($_GET["action"]) && $_GET["action"] == "create_sell_ord") {
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
    <form method="post" action="index.php">
        <input type="hidden" value="<?= $_GET["vin"] ?>" name="vin"/>
        <p>
            <b>Name: </b>
            <input type="text" name="client_name"/>
        </p>
        <p>
            <b>Surname: </b>
            <input type="text" name="client_surname"/>
        </p>
        <p>
            <b>Phone: </b>
            <input type="text" name="client_phone"/>
        </p>
        <p>
            <b>Info: </b>
            <textarea name="sell_info" rows="5" cols="50"></textarea>
        </p>
        <p>
            <button type="submit" name="cr_sell_ord">Create</button>
        </p>
    </form>
    <?php
}else {
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
                <a href="index.php?action=sell_car&id=<?= $row["id"] ?>">Sell</a>
                <a href="index.php?action=delete_sell&id=<?= $row["id"] ?>">Delete</a>
                <!--                <a href="index.php?action=car_info&id=--><?//= $row["vin"] ?><!--">Car info</a>-->
            </td>
        </tr>
        <?php
    }
    }
    ?>
</table>
</p>