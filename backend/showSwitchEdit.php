<?php
if (isset($_POST['showSwitchEdit'])) {
    include_once "sqlConnect.inc";      //connects to the database

    $functionsCode= $_POST['functionsCode'];
    $hostname= $_POST['hostname'];
    $eventCode= $_POST['eventCode'];
    $pinNr= $_POST['pinNr'];
    $groupNr= $_POST['groupNr'];
    $output="";

    $sql = "SELECT dtDelay, dtDescription, dtSequenceNr, idShouldFunctionsCode, fiHostname, fiEventCode, fiPinNr, fiGroupNr FROM tblExecuteTheSwitch WHERE idShouldFunctionsCode='$functionsCode' AND fiHostname='$hostname' AND fiEventCode='$eventCode' AND fiPinNr='$pinNr' AND fiGroupNr='$groupNr'";         //query that selects switch

    $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable

    if ($result->num_rows > 0) {                //Return the number of rows in a result set
        $row = mysqli_fetch_assoc($result);
        $output.= "<h3>Edit switch:</h3><label>Description: </label><input id='editSwitchDesc' type='text' value='".$row['dtDescription']."'><br><label>Sequence Number: </label><input id='editSwitchSeq' type='number' value='".$row['dtSequenceNr']."'><br><label>Delay: </label><input id='editSwitchDelay' type='number' value='".$row['dtDelay']."'><br><button onclick=updateSwitch('".$functionsCode."','".$hostname."','".$eventCode."',".$pinNr.",".$groupNr.")>Update</button>";
    }else{
        $output= "error";
    }
    echo $output;
}
?>