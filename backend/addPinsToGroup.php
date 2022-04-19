<?php
if (isset($_POST['addPin2Group'])){
    include_once "sqlConnect.inc";      //connects to the database
    $groupNr= $_POST['groupNr'];
    $pinNr= $_POST['pin'];
    $hostname= $_POST['hostname'];

   $sql = $mysqli->prepare("INSERT INTO tblAffect (fiGroupNr, fiHostname, fiPinNr) VALUES (?, ?, ?)");  //use prepare statement to insert values in table tblAffect
    $sql->bind_param('isi', $groupNr, $hostname, $pinNr);
    $sql-> execute();
    $sql->close();
    $mysqli->close();

    echo "Success";     //sends ajax method a message back
}
?>