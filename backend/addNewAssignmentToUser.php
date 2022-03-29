<?php
if (isset($_POST['addAssign'])) {
    include_once "sqlConnect.inc";          //connects to database

    $hostname = $_POST['hostname'];
    $userId = $_POST['userId'];

    $sql = $mysqli->prepare("INSERT INTO tblConfigure (fiUserNr, fiHostname) VALUES (?, ?)");       //use prepare statement to insert values in table tblConfigure
    $sql->bind_param('is', $userId, $hostname);     //bound parameters
    $sql-> execute();       //executes sql
    $sql->close();          //closes sql and database connection
    $mysqli->close();

    echo "Success";
}
?>