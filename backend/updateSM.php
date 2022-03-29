<?php
if (isset($_POST['updateSM'])){
    include_once "sqlConnect.inc";      //connects to database
    $smHostname= $_POST['updateSM'];
    $smDescription= $_POST['description'];
    $smLocation= $_POST['locationSM'];


    $sql = $mysqli-> prepare("UPDATE tblSmartbox SET dtDescription=?, dtLocation=? WHERE idHostname=?");        //use prepare statement to update values from specific hostname
    $sql->bind_param('sss', $smDescription, $smLocation, $smHostname);      //bound parameters
    $sql-> execute();   //excutes sql

    echo "Update successfully";     //return message back

    $sql->close();      //close sql and database connection
    $mysqli->close();
}
?>