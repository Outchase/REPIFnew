<?php
if (isset($_POST['assignToGroup'])){
    include_once "sqlConnect.inc";      //connects to the database
    $hostname = $_POST['hostname'];
    $group = $_POST['group'];
    $pin = $_POST['pin'];

    $sql = $mysqli->prepare("INSERT INTO tblAffect (fiGroupNr, fiHostname, fiPinNr) VALUES (?, ?, ?)");       //use prepare statement to insert values in table tblConfigure
    $sql->bind_param('isi', $group, $hostname, $pin);     //bound parameters
    $sql-> execute();       //executes sql
    $sql->close();          //closes sql and database connection
    $mysqli->close();

    echo "Success";


}
?>