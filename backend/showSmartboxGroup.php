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
        $output.="<table><thead><tr><th>Group Number</th><th>Name</th><th>Description</th></tr></thead><tbody>";
        for ($i=0; $i<mysqli_num_rows($result); $i++) {
            $row = mysqli_fetch_assoc($result);
            $output.="<tr>
                <td>".$row['fiGroupNr']."</td>
                <td>". $row['dtGroupName'] ."</td>
                <td>". $row['dtDescription'] ."</td>
                <td><button class='normalBtn' onclick=showGroupAssignForm('".$hostname."')>Assign Groups</button></td>
                <td><button class='normalBtn' onclick='showGroupPins(".$row['fiGroupNr'].")'>Pins</button></td>
                <td><button class='normalBtn' onclick=assignScript('".$hostname."',".$row['fiGroupNr'].")>Scripts</button></td>
                <td><button class='normalBtn' onclick='editGroup(".$row['fiGroupNr'].")'>Edit group</button></td>
                <td><button class='normalBtn' onclick='deleteGroup(".$row['fiGroupNr'].")'>Delete group</button></td>
            </tr>";
        }
        $output.="</tbody></table><div id='groupResponse' class='tableContainer'></div>";
    } else {
        $output= "error";
    }

    echo $output;

    $mysqli->close();
}
?>