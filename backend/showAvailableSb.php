<?php
if (isset($_POST['showAvailableSb'])){
    session_start();
    $userId= $_SESSION["userID"];
    $output= "";

    include_once "sqlConnect.inc";      //connects to the database

    $sql= "SELECT tblConfigure.fiHostname FROM tblConfigure 
    INNER JOIN tblUser ON tblUser.idUserNr=tblConfigure.fiUserNr 
    WHERE tblConfigure.fiUserNr='$userId'";   //query that selects the groups which are not assigned to.

    $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable

    if ($result->num_rows > 0) {                //Return the number of rows in a result set

        for ($i=0; $i<mysqli_num_rows($result); $i++) {
            $row = mysqli_fetch_assoc($result);
            $output.= "<option value='".$row['fiHostname']."'>".$row['fiHostname']."</option>";
        }
    } else {
        $output= "error";
    }
    echo $output;
    $mysqli->close();

}
?>