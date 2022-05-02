<?php
if (isset($_POST['showListScript'])) {
    include_once "sqlConnect.inc";      //connects to the database

    $groupNr = $_POST['groupNr'];

    $sql = "SELECT tblUse.fiScriptName, tblScript.dtDescription FROM tblUse INNER JOIN tblScript ON tblScript.idScriptName=tblUse.fiScriptName WHERE tblUse.fiGroupNr='$groupNr'";
    $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable
    $output = "";

    if ($result->num_rows > 0) {                //Return the number of rows in a result set
        $output="<table><thead><tr><th>Script Name</th><th>Description</th></tr></thead><tbody>";
        for ($i=0; $i<mysqli_num_rows($result); $i++) {

            $row = mysqli_fetch_assoc($result);
            $output.="<tr><td>".$row['fiScriptName']."</td><td>".$row['dtDescription']."</td></tr>";
        }
        $output.="</tbody></table>";
    }else{
        $output="<p style='color: red'>No used script found.</p>";
    }
    echo $output;
}
?>
