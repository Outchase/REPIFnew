<?php
if (isset($_POST['updateSM'])){
    include_once "sqlConnect.inc";
    $smHostname= $_POST['updateSM'];
    $smDescription= $_POST['description'];
    $smLocation= $_POST['locationSM'];


    $sql = $mysqli-> prepare("UPDATE tblsmartbox SET dtDescription=?, dtLocation=? WHERE idHostname=?");
    $sql->bind_param('sss', $smDescription, $smLocation, $smHostname);
    $sql-> execute();

    echo "Update successfully";

    $sql->close();
    $mysqli->close();
}
?>