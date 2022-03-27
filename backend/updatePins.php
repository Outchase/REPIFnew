<?php
if (isset($_POST['updatePin'])) {
    include_once "sqlConnect.inc";
    $pinsDesc = $_POST['pinsDesc'];
    $pinsInOut = $_POST['pinsInOut'];
    $hostname = $_POST['hostname'];
    $pinId = $_POST['pinId'];

    //UPDATE `tblpin` SET `dtDescription` = 'GPIO5' WHERE `idPinNr` = 7 AND `fiHostname` = 'SB_1';
    $sql = $mysqli-> prepare("UPDATE tblPin SET dtDescription=?, dtInputOrOutput =? WHERE idPinNr=? AND fiHostname =?");
    $sql->bind_param('siis', $pinsDesc, $pinsInOut, $pinId, $hostname);
    $sql-> execute();
    echo "Update successfully";

    $sql->close();
    $mysqli->close();
}
?>