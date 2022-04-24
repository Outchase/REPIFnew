<?php
if (isset($_POST['showScripts'])){
    include_once "sqlConnect.inc";      //connects to the database

    $sql= "SELECT idScriptName from tblScript";   //query that selects group from selected Smartbox and group them together
    $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable
    $output = "";

    if ($result->num_rows > 0) {                //Return the number of rows in a result set
        for ($i=0; $i<mysqli_num_rows($result); $i++) {

            $row = mysqli_fetch_assoc($result);
            $output.="<option value='".$row['idScriptName']."'>".$row['idScriptName']."</option>";
        }
    } else {
        $output= "error";
    }

    echo $output;

    $mysqli->close();
}

?>