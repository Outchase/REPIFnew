<?php
if (isset($_POST['assign'])) {
    include_once "sqlConnect.inc";      //connects to the database
    $hostname = $_POST['hostname'];


    $sql = "SELECT tblConfigure.fiUserNr, tblUser.dtName, tblUser.dtFirstName 
    FROM `tblConfigure` 
    INNER JOIN tblUser ON tblUser.idUserNr=tblConfigure.fiUserNr
    WHERE fiHostname='$hostname'";      //query the select the Foreign key pin number from specific hostname
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
       $output= "<p style='color: red'>Smartbox ".$hostname." is already assigned to Client: ". $row['fiUserNr'].". ".$row['dtName']." ". $row['dtFirstName']."</p>";       //if number of result is greater than 0 means the Smartbox is already assigned to a user
    } else{
        $sql = "SELECT * FROM `tblUser`";       //query that selects everything from table User
        $result = $mysqli->query($sql);
        $output= "<form method='post' onsubmit=updateSmAssign('".$hostname. "') class='form'><label>Assign ".$hostname. " to: <select  id='umOptions'>";     //generates a from to assign the new smartbox
        if ($result->num_rows > 0) {
            for ($i=0; $i<mysqli_num_rows($result); $i++) {     //add a samtbox hostnames in the selectbox to select
                $row = mysqli_fetch_assoc($result);
                $output.= "<option value='". $row['idUserNr'] ."'>" .$row['dtName'] ." " .$row['dtFirstName']."</option>";
            }
        }
        $output.=" </select><input type='submit' value='Assign' class='normalBtn'></label></form>";
    }
    echo $output;       //sends the generated form or message back

    $mysqli->close();       //close database connection

}
