<?php
if (isset($_POST['updateUM'])){         //execute the rest below if statement is true
    include_once "sqlConnect.inc";         //connect to the database
    $umID= $_POST['updateUM'];              //save the Post request value into variables
    $umName= $_POST['name'];
    $umFirstName= $_POST['firstName'];
    $umEmail= $_POST['email'];


    $sql = $mysqli-> prepare("UPDATE tblUser SET dtName=?, dtFirstName=?, dtEmail=? WHERE idUserNr=?");     //use prepare statments for update
    $sql->bind_param('sssi', $umName, $umFirstName, $umEmail, $umID);                     //bound parameters
    $sql-> execute();                                   //executes sql

    echo "Update successfully";             // send ajax method a message after executing sql

    $sql->close();                  //closes sql and database connection
    $mysqli->close();
}
?>