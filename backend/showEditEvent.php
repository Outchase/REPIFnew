<?php
if (isset($_POST['showEditEvent'])){
    include_once "sqlConnect.inc";      //connects to the database
    $eventCode= $_POST['eventCode'];
    $pinNr= $_POST['pinNr'];
    $hostname= $_POST['hostname'];

    $sql= "SELECT * from tblEvent WHERE idEventCode='$eventCode' AND fiPinNr='$pinNr' AND fiHostname='$hostname'";

    $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable

    if ($result->num_rows > 0) {                //Return the number of rows in a result set
        $row = mysqli_fetch_assoc($result);
        $output= "<h4>Edit event ".$eventCode." here:</h4><label>Event Code: </label><input id='inputEventCode".$eventCode.$hostname.$pinNr."' type='text' required value='".$row['idEventCode']."'><br>
        <label>Description: </label><input id='inputEventDesc".$eventCode.$hostname.$pinNr."'type='text' value='".$row['dtDescription']."' required><br>
        <button onclick=updateEvent('".$eventCode."','".$hostname."',".$pinNr.")>Update</button>";
        echo $output;
    }
}
?>