<?php
if (isset($_POST['showListScript'])) {
    include_once "sqlConnect.inc";      //connects to the database

    $groupNr = $_POST['groupNr'];
    $output = "";

    $sql = "SELECT tblUse.fiScriptName, tblScript.dtDescription FROM tblUse 
    INNER JOIN tblScript ON tblScript.idScriptName=tblUse.fiScriptName 
    WHERE tblUse.fiGroupNr='$groupNr'";
    $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable

    if ($result->num_rows > 0) {                //Return the number of rows in a result set
        $output="<table><thead><tr><th>Script Name</th><th>Description</th></tr></thead><tbody>";
        for ($i=0; $i<mysqli_num_rows($result); $i++) {

            $row = mysqli_fetch_assoc($result);
            $output.="<tr><td>".$row['fiScriptName']."</td><td>".$row['dtDescription']."</td><td><input value='Remove' type='button' onclick=removeScriptUse('".$groupNr."','".$row['fiScriptName']."') class='normalBtn'></td></tr>";
        }
        $output.="</tr></tbody></table>";
    }else{
        $output="<p style='color: red'>No used script found.</p>";
    }
    $sql= "SELECT idScriptName from tblScript";   //query that selects group from selected Smartbox and group them together
    $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable

    if ($result->num_rows > 0) {                //Return the number of rows in a result set
        $output.="<label id='scriptChoice'>Select script: <select class='asGr' id='availScript'>";
        for ($i=0; $i<mysqli_num_rows($result); $i++) {

            $row = mysqli_fetch_assoc($result);
            $output.="<option value='".$row['idScriptName']."'>".$row['idScriptName']."</option>";
        }
        $output.="</select></label><br><div class='formButton'><button class='normalBtn' onclick='useScript(" . $groupNr . ")'>Assign</button>";
    } else {
        $output.= "<p style='color: red; padding-left: 0.5rem;'>No Script available. Contact Technician.</p><div class='formButton'>";
    }
    $output.="<input class='normalBtn' type='button' value='Cancel' onclick='cancel()'></div>";
    echo $output;
}
?>
