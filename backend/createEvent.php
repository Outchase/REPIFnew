<?php
if (isset($_POST['createEvent'])){
    include_once "sqlConnect.inc";      //connects to the database
    $hostname= $_POST['hostname'];
    $eventCode= $_POST['eventCode'];
    $eventDesc= $_POST['eventDesc'];
    $eventPin= $_POST['eventPin'];

    $sql = $mysqli->prepare("INSERT INTO tblEvent (idEventCode, dtDescription, fiPinNr, fiHostname) VALUES (?, ?, ?, ?)");  //use prepare statement to insert values in table tblEvent
    $sql->bind_param('ssis', $eventCode, $eventDesc, $eventPin, $hostname);
    $sql-> execute();
    $sql->close();
    $mysqli->close();

    echo "Success";     //sends ajax method a message back
}
?>