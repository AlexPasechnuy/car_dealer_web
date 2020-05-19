<?php
# check for a user session
if (!isset($_SESSION["user"])) {
    header("location: login.php");
}
?>
<h2>List of employees</h2>
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
    button:hover{
        background-color: #575757;
        color: #ffffff;
        box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
    }
    form {
        border: 3px solid #000000;
    }
    input[type=text], input[type=password] ,select , input[type=number]{
        width: 20%;
        margin: 8px 0;
        padding: 12px 20px;
        display: inline-block;
        border: 3px solid #000000;
        box-sizing: border-box;
        box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
</style>
<?php
# if the page is in record's create/update or delete mode (action parameter is set) - show 'back' link
if (isset($_GET["action"]) && ($_GET["action"] == "change_emp")) {
    ?>
    <h3><a href="index.php">Back</a></h3>
    <?php
    # otherwise - show 'new record' link
}
if (isset($_GET["action"]) && ($_GET["action"] == "change_emp")) {
    $username = $_GET["id"];
    $sql = "SELECT salary FROM employee WHERE username = '{$username}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $note = $row["salary"];
    ?>
    <form id="cr_rep" method="post" action="index.php">
        <input type="hidden" value="<?= $username ?>" name="username"/>
        <p>
            <b><h3>Change employee</h3></b>
        </p>
        <p><b>Position</b></p>
        <p>
            <select name="position">
                <option value="mechanic">Mechanic</option>
                <option value="sales_manager">Sales manager</option>
                <option value="supply_manager">Supply manager</option>
                <option value="HR_manager">HR manager</option>
                <option value="admin">Admin</option>
            </select>
        </p>
        <p><b>Salary</b></p>
        <p>
            <input type="number" name="salary" value="<?php echo $note ?>"></p>
        </p>
        <p>
            <button type="submit" name="save_emp">Save</button>
        </p>
    </form>
    <?php

}else {
?>
<table border="1">
    <tr>
        <th>Name</th>
        <th>Surname</th>
        <th>Position</th>
        <th>Salary</th>
        <th>Birth date</th>
        <th>Enrollment date</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    <?php
    # retrieve and display data about contracts
    $sql = "SELECT *, DATE(birth_date) as birth_date, DATE(enroll_date) as enroll_date 
    FROM employee
    ORDER BY surname";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        ?>

        <tr>
            <td><?= $row["name"] ?></td>
            <td><?= $row["surname"] ?></td>
            <td><?= $row["position"] ?></td>
            <td><?= $row["salary"] ?></td>
            <td><?= $row["birth_date"] ?></td>
            <td><?= $row["enroll_date"] ?></td>
            <td><?= $row["phone"] ?></td>
            <td><?= $row["email"] ?></td>
            <td>
                <a href="index.php?action=change_emp&id=<?= $row["username"] ?>">Change</a>
            </td>
        </tr>
        <?php
    }
    }
    ?>
</table>
</p>