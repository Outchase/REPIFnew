<?php
if (isset($_POST['updateUM'])){
    include_once "sqlConnect.inc";
    $umID= $_POST['updateUM'];
    $umName= $_POST['name'];
    $umFirstName= $_POST['firstName'];
    $umEmail= $_POST['email'];


    $sql = $mysqli-> prepare("UPDATE tbluser SET dtName=?, dtFirstName=?, dtEmail=? WHERE idUserNr=?");
    $sql->bind_param('sssi', $umName, $umFirstName, $umEmail, $umID);
    $sql-> execute();

    echo "Update successfully";

    $sql->close();
    $mysqli->close();
}
?>