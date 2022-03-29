<?php
session_start();
if (isset($_POST['logout'])) {              //checks if Post logout is set
    unset($_SESSION["loggedIN"]);
    unset($_SESSION["email"]);             //unsets Sessions if statement was true
    exit("./frontend/login.html");       //Prints a message (path) and exits the current script
}
?>