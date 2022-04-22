<?php
if (isset($_POST['showGroupEdit'])) {
    include_once "sqlConnect.inc";      //connects to the database

    $group= $_POST['groupNr'];

    $sql="SELECT * FROM tblGroup WHERE idGroupNr='$group'";

    $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable

    if ($result->num_rows > 0) {                //Return the number of rows in a result set
        $row = mysqli_fetch_assoc($result);
        $output= "<h4>Edit group ".$group." here:</h4><label>Group Name: </label><input id='inputGroupName".$group."' type='text' required value='".$row['dtGroupName']."'><br>
        <label>Description: </label><input id='inputGroupDesc".$group."'type='text' value='".$row['dtDescription']."' required><br>
        <button onclick='updateGroup(".$group.")'>Update</button>";
        echo $output;
    }


    $mysqli->close();

}
?>