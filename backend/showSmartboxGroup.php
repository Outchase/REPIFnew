<?php
if (isset($_POST['smGr'])){
    include_once "sqlConnect.inc";      //connects to the database
    $hostname= $_POST['hostname'];

    $sql= "SELECT tblAffect.fiGroupNr, tblGroup.dtGroupName, tblGroup.dtDescription FROM tblAffect
    INNER JOIN tblGroup ON tblAffect.fiGroupNr=tblGroup.idGroupNr 
    WHERE fiHostname = '$hostname' GROUP BY tblAffect.fiGroupNr";   //query that selects group from selected Smartbox and group them together
    $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable
    $output = "";

    if ($result->num_rows > 0) {                //Return the number of rows in a result set
        for ($i=0; $i<mysqli_num_rows($result); $i++) {

            $row = mysqli_fetch_assoc($result);
            $output.= "<div id='group".$row['fiGroupNr']."'> <h4>Group ". $row['fiGroupNr'] . ": ". $row['dtGroupName'] ." (". $row['dtDescription'] .")</h4>";
            $tempSql = "SELECT fiPinNr from tblAffect WHERE fiGroupNr = ". $row['fiGroupNr']; //query that selects Pins from selected Group
            $tempResult = $mysqli->query($tempSql);             //create new variable with temporary values, so it won't replace the accent one
            for ($j=0; $j<mysqli_num_rows($tempResult); $j++) {
                $tempRow = mysqli_fetch_assoc($tempResult);
                $output .= "<p>".$tempRow['fiPinNr']." <button onclick=removePinFromGroup(".$tempRow['fiPinNr'].",".$row['fiGroupNr'].",'".$hostname."')>-</button></p>"; //display the pins with an option to remove the pins from the group
            }
            $output.= "<button onclick=showAddPinToGroup(".$row['fiGroupNr'].",'".$hostname."')>+</button><br><button onclick='editGroup(".$row['fiGroupNr'].")'>Edit Group</button><button onclick='deleteGroup(".$row['fiGroupNr'].")'>Delete Group</button></div>";  // add option to add pins to Group or to delete the Group
        }
        $output.="<div id='addOutput'></div>";
    } else {
        $output= "error";
    }

    echo $output;

    $mysqli->close();
}
?>