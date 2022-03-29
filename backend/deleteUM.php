<?php
if (isset($_POST['deleteUM'])){
    include_once "sqlConnect.inc";          //conect database
    $umID= $_POST['deleteUM'];

    $sql = $mysqli->prepare("DELETE FROM tblUser WHERE idUserNr=?");            //use prepare statement to delete the selected row
    $sql->bind_param('i', $umID);                   //bound parameters
    $sql->execute();                    //executes sql

    echo "Delete successfully";         //sends message to ajax method back

    $sql->close();              //closes sql and database connection
    $mysqli->close();
}
?>