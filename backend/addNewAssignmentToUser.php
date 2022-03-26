<?php
if (isset($_POST['addAssign'])) {
    include_once "sqlConnect.inc";

    $hostname = $_POST['hostname'];
    $userId = $_POST['userId'];

    $sql = $mysqli->prepare("INSERT INTO tblConfigure (fiUserNr, fiHostname) VALUES (?, ?)");
    $sql->bind_param('is', $userId, $hostname);
    $sql-> execute();
    $sql->close();
    $mysqli->close();


}
?>