<?php
if (isset($_POST['executeScript'])){
    include_once "sqlConnect.inc";      //connects to the database

    $hostname= $_POST['hostname'];
    $output="";
    $tempArray="";

    $a=array();

    $sql = "SELECT tblGroup.dtGroupName, tblGroup.idGroupNr FROM tblExecuteTheSwitch
    INNER JOIN tblGroup ON tblGroup.idGroupNr=tblExecuteTheSwitch.fiGroupNr
    WHERE fiHostname='$hostname'";         //query that selects all the smarboxes of the giving user from Table tblConfigure
    $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable

    if ($result->num_rows > 0) {                //Return the number of rows in a result set

        for ($i=0; $i<mysqli_num_rows($result); $i++) {         //the fetched values from database table will be saved into an array
            $row = mysqli_fetch_assoc($result);
            $output.=$row['dtGroupName']. "=";

            $groupPins="SELECT tblAffect.fiPinNr FROM tblAffect
            INNER JOIN tblGroup ON tblGroup.idGroupNr=tblAffect.fiGroupNr 
            WHERE fiHostname='$hostname' AND dtGroupName='".$row['dtGroupName']."'";

            $pinsResult = $mysqli->query($groupPins);                  //performs query in a database and saves result into a variable

            for ($k=0; $k<mysqli_num_rows($pinsResult); $k++){         // runs a loop so to gett all output pins from a group
                $pinRow = mysqli_fetch_assoc($pinsResult);

                if ($k>0){
                    $output.=",".$pinRow['fiPinNr'];
                }else{
                    $output.=$pinRow['fiPinNr'];
                }
                array_push($a, $pinRow['fiPinNr']); //pushes pin number into the array
            }

            $output.="\n";

            $tempFilter=$row['idGroupNr'];
            $tempSql="SELECT tblScript.idScriptName, tblScript.dtPath FROM tblUse
            INNER JOIN tblScript ON tblScript.idScriptName=tblUse.fiScriptName 
            INNER JOIN tblExecuteTheSwitch ON tblExecuteTheSwitch.fiGroupNr=tblUse.fiGroupNr 
            WHERE tblExecuteTheSwitch.fiHostname='$hostname' AND tblUse.fiGroupNr='$tempFilter' 
            GROUP BY tblScript.idScriptName";


            $result2 = $mysqli->query($tempSql);             //performs query in a database and saves result into a variable

            for ($j=0; $j<mysqli_num_rows($result2); $j++){     //runs loop and stores them into the variable
                $row2 = mysqli_fetch_assoc($result2);
                $output.=$row2['idScriptName'].'=/home/pi/pif2122"';
                $output.=$row2['dtPath'].'"'."\n";
            }
        }
        $displayArray=implode(",", $a);
        $output.="ALL=". $displayArray;

        $directory = "/smartbox/".$hostname."/data";       //defines directory
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }
        chmod($directory, 0777);

        $myfile = fopen($directory."/gl.txt", 'w+') or die("Unable to open file!");     //adds output content into file
        fwrite($myfile, $output);
        fclose($myfile);
        chmod($directory."/gl.txt", 0777);


       echo "ok";
    }else {                                             //else sends message that there are no smartboxes
        echo "Error: No switch assigned";
    }
}
?>