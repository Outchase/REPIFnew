<?php
if (isset($_POST['deleteSM'])){
    include_once "sqlConnect.inc";      //connects to database
    $smHostname= $_POST['deleteSM'];

    $sql = $mysqli->prepare("DELETE FROM tblSmartbox WHERE idHostname=?");      //use prepare statements to delete the specific Smartbox
    $sql->bind_param('s', $smHostname);                         //bound parameters
    $sql->execute();        //executes sql

    echo "Delete successfully";     //returns message back

    $sql->close();      //close sql and database connection
    $mysqli->close();
}
?>