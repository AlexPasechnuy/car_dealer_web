<?php
# check for a user session
if (!isset($_SESSION["user"])) {
    header("location: login.php");
}
?>
<h3>List of employees</h3>
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
if (isset($_GET["action"]) && ($_GET["action"] == "change_emp")) {
    ?>
    <a href="index.php">Back</a>
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
            <b>Change employee</b>
        </p>
        <p>Position</p>
        <p>
            <select name="position">
                <option value="mechanic">Mechanic</option>
                <option value="sales_manager">Sales manager</option>
                <option value="supply_manager">Supply manager</option>
                <option value="HR_manager">HR manager</option>
                <option value="admin">Admin</option>
            </select>
        </p>
        <p>Salary</p>
        <p>
            <input type="number" name="salary" value="<?php echo $note ?>"></p>
        </p>
        <p>
            <input type="submit" name="save_emp" value="Save"
        </p>
    </form>
    <?php

} else {
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