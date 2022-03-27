<?php
if (isset($_POST['createSmartbox'])){
    include_once "sqlConnect.inc";

    $hostname = $_POST['hostname'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    $sql = "SELECT idHostname FROM `tblSmartbox` WHERE idHostname='$hostname'";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        echo "The Smartbox with a same hostname exists already";
    }else{

        $sql = $mysqli->prepare("INSERT INTO tblSmartbox (idHostname, dtDescription, dtLocation) VALUES (?, ?, ?)");

        $sql->bind_param('sss', $hostname, $description, $location);
        $sql-> execute();
        $sql->close();

        echo "Create successfully";
    }
    $mysqli->close();

}

?>