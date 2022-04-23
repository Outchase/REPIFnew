<?php
if (isset($_POST['showAvailableEventPins'])) {
    include_once "sqlConnect.inc";      //connects to the database

    $hostname= $_POST['hostname'];
    $eventCode=$_POST['eventCode'];
    $output="";

    $sql = "SELECT fiPinNr from tblEvent where idEventCode='$eventCode' and fiHostname='$hostname'";         //query that selects all the smarboxes of the giving user from Table tblConfigure
    $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable


    if ($result->num_rows > 0) {                //Return the number of rows in a result set
        for ($i=0; $i<mysqli_num_rows($result); $i++){
            $row = mysqli_fetch_assoc($result);
            $output.= "<option value='".$row['fiPinNr']."'>".$row['fiPinNr']."</option>";
        }
    }else{
        $output= "error";
    }
    echo $output;
}
?>