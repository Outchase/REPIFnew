<?php
if (isset($_POST['showAssignSwitch'])){
    include_once "sqlConnect.inc";      //connects to the database
    $hostname= $_POST['hostname'];

    $sql= "SELECT tblEvent.fiHostname FROM tblEvent, tblAffect WHERE tblEvent.fiHostname='$hostname' AND tblAffect.fiHostname='$hostname' GROUP BY fiHostname";     //query that display Input pins which are not assigned in tblEvent

    $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable

    if ($result->num_rows > 0) {                //Return the number of rows in a result set
        echo "exist";
    }
    $mysqli->close();
}
?>