<?php
if (isset($_POST['useScript'])) {
    include_once "sqlConnect.inc";      //connects to the database
    $groupNr = $_POST['groupNr'];
    $scriptName = $_POST['scriptName'];
    $hostname=  $_POST['hostname'];

    $sql = "SELECT * FROM tblUse WHERE fiGroupNr='$groupNr' AND fiScriptname='$scriptName'";       //query to selected everything from specific Id
    $result = $mysqli->query($sql);         //saves query result into variable
    if ($result->num_rows > 0) {            //checks the number of rows from result

        echo "Error";      //display error message when Pin is already in use
    } else {          //else insert it to the database
        $sql = "SELECT dtPath FROM tblScript WHERE idScriptName='$scriptName'";        //get the path from file we want to use
        $result = $mysqli->query($sql);         //saves query result into variable
        $row = mysqli_fetch_assoc($result);
        $path= $row['dtPath'];
        $sourcePath = "/smartbox/Scripts" . $path;      // saves selected path into variable

        /*$sql = "SELECT fiHostname FROM tblAffect WHERE fiGroupNr= '$groupNr'"; // get hostname
        $result = $mysqli->query($sql);         //saves query result into variable
        $row = mysqli_fetch_assoc($result);*/
        $smartboxPath = "/smartbox/" . $hostname;  //saves hostname into variable


        $a= explode("/", $path); //splits string and saves it into the array
        $pathScript = $smartboxPath . "/" . $a[1];

        if (!mkdir($smartboxPath, 0777, true)) { //creates directory if it does not exist
            echo "Directory: '$smartboxPath' exists\n"; //send error message
        }
        mkdir($pathScript, 0777, true);

        if (file_exists($sourcePath)) {
            $destinationPath= $smartboxPath.$path;
            chmod($pathScript, 0777);  // change permission from directory

            copy($sourcePath, $destinationPath);
            chmod($destinationPath, 0777);

            $sql = $mysqli->prepare("INSERT INTO tblUse (fiGroupNr, fiScriptName) VALUES (?, ?)");
            $sql->bind_param('is', $groupNr, $scriptName);
            $sql->execute();
            $sql->close();
            $mysqli->close();

            echo "Success";     //sends ajax method a message back

        } else {
            echo " $sourcePath does not exist";
        }
    }
}
?>