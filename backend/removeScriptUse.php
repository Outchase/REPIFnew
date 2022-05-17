<?php
if (isset($_POST['removeScriptUse'])) {
    include_once "sqlConnect.inc";      //connect to database

    $groupNr = $_POST['groupNr'];
    $scriptName = $_POST['scriptName'];
    $hostname = $_POST['hostname'];

    $sql = "SELECT * FROM tblScript 
    WHERE idScriptName='$scriptName'";
    $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable
    $row = mysqli_fetch_assoc($result);
    $path=$row['dtPath'];
    unlink('/smartbox/'.$hostname.'/'.$path);



        $sql = $mysqli->prepare("DELETE FROM tblUse WHERE fiScriptName=? AND fiGroupNr=?");     //user prepare statement to delete the specific pinNumber and hostname
        $sql->bind_param('si', $scriptName, $groupNr);       //bound parameters
        $sql->execute();            //executes sql


        echo "Remove successfully";     //sends back a message

        $sql->close();         //close sql and connection to database
        $mysqli->close();
}
?>