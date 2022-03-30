<?php
if (isset($_POST['addPins'])){      //when it is set executes the rest
    include_once "sqlConnect.inc";      // connect to database

    $hostname = $_POST['hostname'];     //saves post values into variables
    $addPinDesc = $_POST['addPinDesc'];
    $addPinInOut = $_POST['addPinInOut'];
    $addPinNr = $_POST['addPinNr'];

    $sql = "SELECT * FROM tblPin WHERE idPinNr='$addPinNr' AND fiHostname='$hostname'";       //query to selected everything from specific Id
    $result = $mysqli->query($sql);         //saves query result into variable
    if ($result->num_rows > 0) {            //checks the number of rows from result
     echo "Error: Pin Number is already used";      //display error message when Pin is already in use
    }else{          //else insert it to the database
        $sql = $mysqli->prepare("INSERT INTO tblPin (idPinNr, dtDescription, dtInputOrOutput, fiHostname) VALUES (?, ?, ?, ?)");
        $sql->bind_param('isis', $addPinNr, $addPinDesc, $addPinInOut, $hostname);
        $sql-> execute();
        $sql->close();
        $mysqli->close();

        echo "Success";     //sends ajax method a message back
    }
}
?>