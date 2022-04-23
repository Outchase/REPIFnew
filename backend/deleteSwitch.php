<?php
if (isset($_POST['deleteSwitch'])){
    include_once "sqlConnect.inc";          //conect database

    $functionsCode= $_POST['functionsCode'];
    $hostname= $_POST['hostname'];
    $eventCode= $_POST['eventCode'];
    $pinNr= $_POST['pinNr'];
    $groupNr= $_POST['groupNr'];

    $sql = $mysqli->prepare("DELETE FROM tblExecuteTheSwitch  WHERE idShouldFunctionsCode =? AND fiHostname =? AND fiEventCode =? AND fiPinNr =? AND fiGroupNr =?");            //use prepare statement to delete the selected row
    $sql->bind_param('sssii', $functionsCode, $hostname, $eventCode, $pinNr, $groupNr);                   //bound parameters
    $sql->execute();                    //executes sql

    echo "Delete successfully";         //sends message to ajax method back

    $sql->close();              //closes sql and database connection
    $mysqli->close();
}
?>