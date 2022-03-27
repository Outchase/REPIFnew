<?php
if (isset($_POST['deletePins'])){
    include_once "sqlConnect.inc";

    $delPinNr= $_POST['pinNr'];
    $hostname= $_POST['hostname'];


    //"DELETE FROM `tblpin` WHERE `tblpin`.`idPinNr` = 33 AND `tblpin`.`fiHostname` = \'SB_2\'" wirklich ausführen?

    $sql = $mysqli->prepare("DELETE FROM tblPin WHERE idPinNr=? AND fiHostname=?");
    $sql->bind_param('is', $delPinNr, $hostname);
    $sql->execute();

    echo "Delete successfully";

    $sql->close();
    $mysqli->close();

}
?>
