<?php
if (isset($_POST['deleteUM'])){
    include_once "sqlConnect.inc";
    $umID= $_POST['deleteUM'];

    $sql = $mysqli->prepare("DELETE FROM tblUser WHERE idUserNr=?");
    $sql->bind_param('i', $umID);
    $sql->execute();

    echo "Delete successfully";

    $sql->close();
    $mysqli->close();
}
?>