<?php
    include_once "sqlConnect.inc";      //connects to database
    $sql = "SELECT idHostname FROM tblSmartbox";       //query that selects the Hostnames of Smartboxes
    $result = $mysqli->query($sql);             //saves the result in to a variable
    $output="";                             //declares an empty variable
    if ($result->num_rows > 0) {        //Return the number of rows in a result set
        for ($i=0; $i<mysqli_num_rows($result); $i++) {      //loop through the result and adds into declared array ($a)
            $row = mysqli_fetch_assoc($result);
            $output.= "<option value='".$row['idHostname']."'>". $row['idHostname'] ."</option>"; //generate a list of option element for the selectbox in Upload script form
        }
    }
    echo $output;                   //returns value back
?>