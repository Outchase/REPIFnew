<?php

session_start();

if (isset($_POST['login'])) {
    include_once "sqlConnect.inc";



    $email = $_POST['email'];
    $password = hash('gost', $_POST['password']);

    $sql = "SELECT idUserNr FROM `tblUser` WHERE dtEmail='$email' AND dtPassword='$password'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION["loggedIN"] = "1";
        $_SESSION["email"] = $email;
    exit("./frontend/main.html");
    } else {
        exit("");
    }
}

?>

