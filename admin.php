<?php
if (!isset($_SESSION["user"])) {
    header("location: login.php");
}
echo "Admin is under development";