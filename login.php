<?php
session_start();

# process login form
if (isset($_POST["login"])) {
    session_unset();

    # set user session variables
    $_SESSION["user"] = $_POST["user"];
    $_SESSION["pass"] = $_POST["pass"];

    header("location: index.php");
} else if (isset($_POST["guest"])) {
    session_unset();
    $_SESSION["user"] = "guest";
    header("location: index.php");
} else {
    # redirect to a home page if user is already signed in
    if (isset($_SESSION["user"])) {
        header("location: index.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<style>
    Body {
        font-family: Calibri, Helvetica, sans-serif;
        background-color: lightskyblue;
    }
    button {
        background-color: darkblue;
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
        background-color: #3167ff;
        color: white;
        box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
    }
    form {
        border: 3px solid #f1f1f1;
    }
    input[type=text], input[type=password] {
        width: 20%;
        margin: 8px 0;
        padding: 12px 20px;
        display: inline-block;
        border: 3px solid darkblue;
        box-sizing: border-box;
        box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
    }
</style>
<h3>Car Dealer Application Login</h3>
<form method="post" action="login.php">

    <p>
        <b>User name</b>
    </p>
    <p>
        <input type="text" name="user" required/>
    </p>
    <p>
        <b>Password</b>
    </p>
    <p>
        <input type="password" name="pass" required/>
    </p>
    <p>
<!--        <button type="submit" name="login" value="Login as employee"/>-->
        <button type="submit" name="login">Login as employee</button>
    </p>
</form>
<form method="post" action="login.php">
    <br/>
    <p>
<!--        <input type="submit" name="guest" value="Login as guest"/>-->
        <button type="submit" name="guest">Login as guest</button>
    </p>
</form>
</body>
</html>