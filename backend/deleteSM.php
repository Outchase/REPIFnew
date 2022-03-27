<?php
if (isset($_POST['deleteSM'])){
    include_once "sqlConnect.inc";
    $smHostname= $_POST['deleteSM'];

    $sql = $mysqli->prepare("DELETE FROM tblSmartbox WHERE idHostname=?");
    $sql->bind_param('s', $smHostname);
    $sql->execute();

    echo "Delete successfully";

    $sql->close();
    $mysqli->close();
}
?>