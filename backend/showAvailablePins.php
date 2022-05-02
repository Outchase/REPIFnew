<?php
if (isset($_POST['avPin'])){
    include_once "sqlConnect.inc";      //connects to the database
    $hostname = $_POST['hostname'];
    $output = "";

    $sql= "SELECT tblPin.idPinNr, tblPin.dtInputOrOutput FROM tblPin 
    LEFT JOIN tblAffect ON tblAffect.fiPinNr=tblPin.idPinNr AND tblAffect.fiHostname=tblPin.fiHostname
    WHERE tblAffect.fiPinNr IS NULL and tblPin.fiHostname='$hostname' AND tblPin.dtInputOrOutput=0";   //query that selects the pins which are not assigned to a group from selected hostname


    $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable

    if ($result->num_rows > 0) {                //Return the number of rows in a result set
        for ($i=0; $i<mysqli_num_rows($result); $i++) {
            $row = mysqli_fetch_assoc($result);
            $output.= "<option  value='".$row['idPinNr']."'>".$row['idPinNr']."</option>";
        }

    } else {
      $output= "error";
    }
    echo $output;
    $mysqli->close();
}
?>