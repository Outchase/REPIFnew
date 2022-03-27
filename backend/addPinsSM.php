<?php
if (isset($_POST['addPins'])){
    include_once "sqlConnect.inc";

    $hostname = $_POST['hostname'];
    $addPinDesc = $_POST['addPinDesc'];
    $addPinInOut = $_POST['addPinInOut'];
    $addPinNr = $_POST['addPinNr'];

    $sql = "SELECT * FROM tblPin WHERE idPinNr='$addPinNr'";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
     echo "Error: Pin Number is already used";
    }else{
        $sql = $mysqli->prepare("INSERT INTO tblPin (idPinNr, dtDescription, dtInputOrOutput, fiHostname) VALUES (?, ?, ?, ?)");
        $sql->bind_param('isis', $addPinNr, $addPinDesc, $addPinInOut, $hostname);
        $sql-> execute();
        $sql->close();
        $mysqli->close();

        echo "Success";
    }
}
?>