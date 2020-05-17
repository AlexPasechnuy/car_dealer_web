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
        <a href="index.php?action=create">Create profile for new employee</a>
        <?php
    }
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
    $sql = "SELECT * , DATE(birth_date) as birth, DATE(enroll_date) as enroll FROM employee
    ORDER BY surname";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        ?>

        <tr>
            <td><?= $row["name"] ?></td>
            <td><?= $row["surname"] ?></td>
            <td><?= $row["position"] ?></td>
            <td><?= $row["salary"] ?></td>
            <td><?= $row["birth"] ?></td>
            <td><?= $row["enroll"] ?></td>
            <td><?= $row["phone"] ?></td>
            <td><?= $row["email"] ?></td>
            <td>
                <a href="index.php?action=delete&id=<?= $row["id"] ?>"> change </a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
</p>