<?php
if (isset($_POST['showInputPins'])){
    include_once "sqlConnect.inc";      //connects to the database
    $hostname= $_POST['hostname'];
    $output ="";

    $sql= "SELECT tblPin.idPinNr FROM tblPin 
    LEFT JOIN tblEvent on tblEvent.fiPinNr=tblPin.idPinNr
    WHERE tblEvent.fiPinNr IS NULL AND tblPin.fiHostname='$hostname' AND tblPin.dtInputOrOutput=1";     //query that display Input pins which are not assigned in tblEvent

    $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable

    if ($result->num_rows > 0) {                //Return the number of rows in a result set
        for ($i=0; $i<mysqli_num_rows($result); $i++) {
            $row = mysqli_fetch_assoc($result);
            $output.= "<option value='".$row['idPinNr']."'>".$row['idPinNr']."</option>";
        }

    } else {
        $output= "error";
    }
    echo $output;
    $mysqli->close();
}
?>