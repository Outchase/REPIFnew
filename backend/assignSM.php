<?php
if (isset($_POST['assign'])) {
    include_once "sqlConnect.inc";
    $hostname = $_POST['hostname'];


    $sql = "SELECT fiUserNr FROM `tblConfigure` WHERE fiHostname='$hostname'";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
       $output= "<p style='color: red'>Already assigned</p>";
    } else{
        $sql = "SELECT * FROM `tblUser`";
        $result = $mysqli->query($sql);
        $output= "<form method='post' onsubmit=updateSmAssign('".$hostname. "')><label>".$hostname. "</label><select  id='umOptions'>";
        if ($result->num_rows > 0) {
            for ($i=0; $i<mysqli_num_rows($result); $i++) {
                $row = mysqli_fetch_assoc($result);
                $output.= "<option value='". $row['idUserNr'] ."'>" .$row['dtName'] ." " .$row['dtFirstName']."</option>";
            }
        }
        $output.=" </select><input type='submit' value='Assign' ></form>";
    }
    echo $output;

    $mysqli->close();

}
