<?php
if (isset($_POST['createSmartbox'])){
    include_once "sqlConnect.inc";      //connects to the database

    $hostname = $_POST['hostname'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    $sql = "SELECT idHostname FROM `tblSmartbox` WHERE idHostname='$hostname'";     //query that selects specific Hostname from table Smartbox
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {        //if number of sql result is greater than 0 that means a smartbox with the same hostname exists
        echo "The Smartbox with a same hostname exists already";
    }else{

        $sql = $mysqli->prepare("INSERT INTO tblSmartbox (idHostname, dtDescription, dtLocation) VALUES (?, ?, ?)");        //use prepare statements if a smartbox with the same hostname does not exist

        $sql->bind_param('sss', $hostname, $description, $location);        //bound parameters
        $sql-> execute();       //executes sql
        $sql->close();  //close sql

        echo "Create successfully";     //return message back
    }
    $mysqli->close();       //close database connection

}

?>