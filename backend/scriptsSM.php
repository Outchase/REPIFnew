<?php
if (isset($_POST['scriptsSM'])){
    include_once "sqlConnect.inc";      //connects to the database

    $hostname= $_POST['hostname'];
    $output="";


    $sql = "SELECT tblUse.fiScriptName, tblScript.dtDescription, tblAffect.fiHostname 
    FROM tblUse INNER JOIN tblAffect ON tblAffect.fiGroupNr=tblUse.fiGroupNr 
    INNER JOIN tblScript ON tblScript.idScriptName=tblUse.fiScriptName 
    WHERE fiHostname='$hostname' 
    GROUP BY fiScriptName";         //query that selects all assigned scripts from given smartbox
    $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable

    if ($result->num_rows > 0) {                //Return the number of rows in a result
        $output="<table><thead><th>Script name</th><th>Description</th></thead><tbody>";
        for ($i=0; $i<mysqli_num_rows($result); $i++) {                     //the fetched values from database table will be saved into an array
            $row = mysqli_fetch_assoc($result);
            $output.="<tr><td>".$row['fiScriptName']."</td><td>".$row['dtDescription']."</td><td><input value='Edit' type='button' onclick=editScriptSm('" .$hostname. "','".$row['fiScriptName']."') class='normalBtn'></td><td><input value='Delete' type='button' onclick=deleteScriptSm('" .$hostname. "','".$row['fiScriptName']."') class='normalBtn'></td></tr>";
        }
        $output.="<tr><td><input class='normalBtn' type='button' value='Close' onclick='cancelChanges()'></td></tr>";
        $output.="</tbody></table><div id='editSmScript' class='tableContainer'></div>";
    }else{
        $output="none";
    }
    echo $output;
}
?>