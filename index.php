<?php
session_start();

require_once("connect.php");

$conn = NULL;

# check for a user session
if (isset($_SESSION["user"])) {
    $conn = db_conn();
    include("action.php");
} else {
    # redired to login page if the user is not set
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Supply</title>
</head>
<body>
<p>
    <b>User:</b> <i><?= $_SESSION["user"] ?></i> | <a href="logout.php">Logout</a>
</p>
<?php
$pos = "";
if($_SESSION["user"] == "guest") {
    $pos = "guest";
}
else {
    $sql = "select position from employee
    where username = '{$_SESSION["user"]}' AND password = '{$_SESSION["pass"]}'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $pos = $row["position"];
    }
}
# display content depending on the user type
$pos .= ".php";
if ($pos != ".php") {
    include($pos);
}else{
    echo "Username or password is incorrect. Press 'Logout to try again'";
}
?>
</body>
</html>
<?php
mysqli_close($conn);
?>
