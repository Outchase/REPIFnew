<?php
if (isset($_POST['deleteGroup'])){
    include_once "sqlConnect.inc";      //connects to the database
    $groupNr= $_POST['groupNr'];

    $sql = $mysqli->prepare("DELETE FROM tblGroup WHERE idGroupNr=?");     //use prepare statement to delete the specific Group
    $sql->bind_param('i', $groupNr);       //bound parameters
    $sql->execute();            //executes sql

    echo "Delete successfully";     //sends back a message

    $sql->close();         //close sql and connection to database
    $mysqli->close();
}
?>