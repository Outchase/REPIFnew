<?php
if (isset($_POST['showGroupEdit'])) {
    include_once "sqlConnect.inc";      //connects to the database

    $group= $_POST['groupNr'];

    $sql="SELECT * FROM tblGroup WHERE idGroupNr='$group'";

    $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable

    if ($result->num_rows > 0) {                //Return the number of rows in a result set
        $row = mysqli_fetch_assoc($result);
        $output="<table><thead><tr><th>Group Number</th><th>Group Name</th><th>Description</th></tr></thead><tbody>";
        $output.="<tr><td>".$group."</td><td><input id='inputGroupName".$group."' type='text' required value='".$row['dtGroupName']."'></td><td><input id='inputGroupDesc".$group."'type='text' value='".$row['dtDescription']."' required></td><td><button class='normalBtn' onclick='updateGroup(".$group.")'>Update</button></td><td><input class='normalBtn' type='button' value='Cancel' onclick='cancel()'></td></tr>";
        $output.="</tbody></table>";
        echo $output;
    }


    $mysqli->close();

}
?>