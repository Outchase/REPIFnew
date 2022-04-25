<?php
if (isset($_POST['executeScript'])){
    include_once "sqlConnect.inc";      //connects to the database

    $hostname= $_POST['hostname'];
    $output="";

    $a=array();

    $sql = "SELECT tblGroup.dtGroupName, tblGroup.idGroupNr FROM tblExecuteTheSwitch INNER JOIN tblGroup ON tblGroup.idGroupNr=tblExecuteTheSwitch.fiGroupNr WHERE fiHostname='$hostname'";         //query that selects all the smarboxes of the giving user from Table tblConfigure
    $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable

    if ($result->num_rows > 0) {                //Return the number of rows in a result set
        for ($i=0; $i<mysqli_num_rows($result); $i++) {                     //the fetched values from database table will be saved into an array
            $row = mysqli_fetch_assoc($result);
            $output.=$row['dtGroupName']. "=";
            $output.=$row['idGroupNr']."\n";
            $tempArray=$row['idGroupNr'];
            array_push($a, $tempArray); //pushes group number into the array

            $tempFilter=$row['idGroupNr'];
            $tempSql="SELECT tblScript.idScriptName, tblScript.dtPath FROM tblUse INNER JOIN tblScript ON tblScript.idScriptName=tblUse.fiScriptName INNER JOIN tblExecuteTheSwitch ON tblExecuteTheSwitch.fiGroupNr=tblUse.fiGroupNr WHERE tblExecuteTheSwitch.fiHostname='$hostname' AND tblUse.fiGroupNr='$tempFilter' GROUP BY tblScript.idScriptName";
            $result2 = $mysqli->query($tempSql);             //performs query in a database and saves result into a variable

            for ($j=0; $j<mysqli_num_rows($result2); $j++){     //runs second loop and stores them into the variable
                $row2 = mysqli_fetch_assoc($result2);
                $output.=$row2['idScriptName'].'="';
                $output.=$row2['dtPath'].'"'."\n";
            }
        }
        $displayArray=implode(",", $a);
        $output.="ALL=".$displayArray;

        $directory = "/smartbox/".$hostname."/data";       //defines directory
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        $myfile = fopen($directory."/gl.txt", 'w+') or die("Unable to open file!");
        fwrite($myfile, $output);
        fclose($myfile);

    }else {                                             //else sends message that there are no smartboxes
        echo "Error: No script assign to any group";
    }

    echo "ok";
}
?>