<?php
$servername = "172.16.248.163";
$username = "pif_admin";
$password = "adminpw";
$dbname = "rexiz123";

$mysqli = new mysqli($servername,
    $username,
    $password,
    $dbname);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
