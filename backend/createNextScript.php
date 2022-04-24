<?php
if (isset($_POST['executeNextScript'])){
    include_once "sqlConnect.inc";      //connects to the database

    $hostname= $_POST['hostname'];
    $output="";

    $sql = "SELECT tblPin.dtDescription, tblExecuteTheSwitch.fiEventCode, tblExecuteTheSwitch.idShouldFunctionsCode, tblGroup.dtGroupName, tblUse.fiScriptName
    FROM tblExecuteTheSwitch 
        LEFT JOIN tblUse ON tblUse.fiGroupNr=tblExecuteTheSwitch.fiGroupNr 
        INNER JOIN tblPin ON tblPin.idPinNr=tblExecuteTheSwitch.fiPinNr 
        INNER JOIN tblGroup ON tblGroup.idGroupNr=tblExecuteTheSwitch.fiGroupNr
    WHERE tblPin.fiHostname = '$hostname'";         //query that selects all the smarboxes of the giving user from Table tblConfigure
    $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable

    if ($result->num_rows > 0) {                //Return the number of rows in a result set
        for ($i=0; $i<mysqli_num_rows($result); $i++) {                     //the fetched values from database
            $row = mysqli_fetch_assoc($result);
            $output.= $row['dtDescription'] . ",";
            $output.= $row['fiEventCode'] . "=";
               if ($row['fiScriptName']===NULL ){
                   $output.= $row['idShouldFunctionsCode'];
               } else{
                   $output.= "S,".$row['fiScriptName'].":".$row['idShouldFunctionsCode'];
                   $filterScriptName=$row['fiScriptName'];
                   $filterFunctionCode=$row['idShouldFunctionsCode'];
                   $tempSql=$sql." AND fiScriptName='$filterScriptName' AND idShouldFunctionsCode='$filterFunctionCode'";
                   $result2 = $mysqli->query($tempSql);             //performs query in a database
                   if ($result2->num_rows > 0) {                //Return the number of rows in a result set
                       for ($j = 0; $j < mysqli_num_rows($result2); $j++) {
                           $row2 = mysqli_fetch_assoc($result2);
                           $output.= ",".$row2['dtGroupName'].":".$row2['idShouldFunctionsCode'];

                           $filterGroupName=$row2['dtGroupName'];
                           $newFilterFunctionCode=$row2['idShouldFunctionsCode'];
                           $newSql="SELECT tblGroup.dtGroupName, tblExecuteTheSwitch.idShouldFunctionsCode, tblExecuteTheSwitch.dtDelay 
                            FROM tblExecuteTheSwitch 
                                INNER JOIN tblGroup ON tblGroup.idGroupNr=tblExecuteTheSwitch.fiGroupNr 
                            WHERE dtGroupName='$filterGroupName' AND idShouldFunctionsCode='$newFilterFunctionCode' AND fiHostname='$hostname'";

                           $result3 = $mysqli->query($newSql);             //performs query in a database
                           if ($result3->num_rows > 0) {                //Return the number of rows in a result set
                                   $row3 = mysqli_fetch_assoc($result3);
                               $output.= ",". $row3['dtGroupName'];
                                   if($row3['dtDelay']!== NULL){
                                       $output.= ",".$row3['dtDelay'];
                                   }
                           }

                       }
                   }

               }

            $output.= "\n";
            $directory = "/smartbox/".$hostname."/data";       //defines directory

            $myfile = fopen($directory."/tefg.txt", "w+") or die("Unable to open file!");
            fwrite($myfile, $output);
            fclose($myfile);

        }
        echo "Success";
    }else {                                             //else sends message that there are no smartboxes
        echo "Error: No script assign to any group";
    }
}
?>