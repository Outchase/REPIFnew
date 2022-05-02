<?php
if (isset($_POST['showSwitchTable'])){
    include_once "sqlConnect.inc";      //connects to the database

    $hostname = $_POST["hostname"];

    $sql = "SELECT * FROM tblExecuteTheSwitch WHERE fiHostname = '$hostname'";         //query that selects all the smarboxes of the giving user from Table tblConfigure
    $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable

    if ($result->num_rows > 0) {                //Return the number of rows in a result set
        $output="<table><thead><tr><th>Function Code</th><th>Description</th><th>Sequence Number</th><th>Delay</th></tr></thead><tbody>";
        for ($i=0; $i<mysqli_num_rows($result); $i++){
            $row = mysqli_fetch_assoc($result);
            $output.="<tr><td>".$row['idShouldFunctionsCode']."</td><td>".$row['dtDescription']."</td><td>".$row['dtSequenceNr']."</td><td>".$row['dtDelay']."</td><td><button class='normalBtn' onclick=showSwitchEdit('".$row['idShouldFunctionsCode']."','".$row['fiHostname']."','".$row['fiEventCode']."',".$row['fiPinNr'].",".$row['fiGroupNr'].")>Edit switch</button></td><td><button class='normalBtn' onclick=deleteSwitch('".$row['idShouldFunctionsCode']."','".$row['fiHostname']."','".$row['fiEventCode']."',".$row['fiPinNr'].",".$row['fiGroupNr'].")>Delete switch</button></td></tr>";
        }
        $output.= "</tbody></table><div id='switchEditContent' class='tableContainer'></div>";
    }else {                                             //else sends message that there are no smartboxes
        $output= "error";
    }
    echo $output;
}
?>