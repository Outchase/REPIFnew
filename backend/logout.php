<?php
session_start();
if (isset($_POST['logout'])) {
    unset($_SESSION["loggedIN"]);
    unset($_SESSION["email"]);
    exit("./frontend/login.html");
}
?>