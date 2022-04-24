<?php
if (isset($_POST['useScript'])){
    include_once "sqlConnect.inc";      //connects to the database
    $groupNr= $_POST['groupNr'];
    $scriptName= $_POST['scriptName'];

    $sql = "SELECT * FROM tblUse WHERE fiGroupNr='$groupNr' AND fiScriptname='$scriptName'";       //query to selected everything from specific Id
    $result = $mysqli->query($sql);         //saves query result into variable
    if ($result->num_rows > 0) {            //checks the number of rows from result
        echo "Error: Already in use";      //display error message when Pin is already in use
    }else{          //else insert it to the database
        $sql = $mysqli->prepare("INSERT INTO tblUse (fiGroupNr, fiScriptName) VALUES (?, ?)");
        $sql->bind_param('is', $groupNr, $scriptName);
        $sql-> execute();
        $sql->close();
        $mysqli->close();

        echo "Success";     //sends ajax method a message back
    }
}
?>