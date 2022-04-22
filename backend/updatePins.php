<?php
if (isset($_POST['updateGroup'])) {
    include_once "sqlConnect.inc";      //connects to database
    $pinsDesc = $_POST['pinsDesc'];
    $pinsInOut = $_POST['pinsInOut'];
    $hostname = $_POST['hostname'];
    $pinId = $_POST['pinId'];

    $sql = $mysqli-> prepare("UPDATE tblPin SET dtDescription=?, dtInputOrOutput =? WHERE idPinNr=? AND fiHostname =?");    //use prepare statement to update the values from specific pin number and hostname
    $sql->bind_param('siis', $pinsDesc, $pinsInOut, $pinId, $hostname);     //bound parameter
    $sql-> execute();       //executes sql
    echo "Update successfully";     //sends message back

    $sql->close();      //close sql and database connection
    $mysqli->close();
}
?>