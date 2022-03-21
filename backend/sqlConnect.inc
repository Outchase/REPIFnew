<?php
$servername = "127.0.0.1";
$username = "pif_user";
$password = "userpw";
$dbname = "rexiz123";

$mysqli = new mysqli($servername,
    $username,
    $password,
    $dbname);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
