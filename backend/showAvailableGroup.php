<?php
if (isset($_POST['showGroup'])){
    include_once "sqlConnect.inc";      //connects to the database

    $sql= "SELECT tblGroup.idGroupNr, tblGroup.dtGroupName FROM tblGroup 
    LEFT JOIN tblAffect ON tblAffect.fiGroupNr=tblGroup.idGroupNr 
    WHERE tblAffect.fiGroupNr IS NULL";   //query that selects the groups which are not assigned to.

    $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable

    if ($result->num_rows > 0) {                //Return the number of rows in a result set
        $output= "";
        for ($i=0; $i<mysqli_num_rows($result); $i++) {
            $row = mysqli_fetch_assoc($result);
            $output.= "<option value='".$row['idGroupNr']."'>".$row['dtGroupName']."</option>";
        }

    } else {
        $output= "error";
    }
    echo $output;
    $mysqli->close();

}
?>