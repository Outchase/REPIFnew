<?php

if (isset($_POST['su'])){
    session_start();
    include_once "sqlConnect.inc";      //connects to the database
    $email = $_SESSION["email"];
    $userId= $_SESSION["userID"];

    $temp = array();               //declares an array

    $sql = "SELECT * FROM tblConfigure WHERE fiUserNr = '$userId'";         //query that selects all the smarboxes of the giving user from Table tblConfigure
    $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable

    if ($result->num_rows > 0) {                //Return the number of rows in a result set


        for ($i=0; $i<mysqli_num_rows($result); $i++) {                     //the fetched values from database table will be saved into an array
            $row = mysqli_fetch_assoc($result);
            $temp[] = $row['fiHostname'];
        }

        $sql = "SELECT * FROM tblSmartbox WHERE idHostname= ";          //prepare the base of query

        for ($i=0; $i<count($temp); $i++){                      //depends on the length of the array it will concatenate the rest of the query
            if ($i===0){
                $sql.= "'$temp[$i]'";
            } else{
                $sql.= " OR idHostname= '$temp[$i]'";
            }
        }

        $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable
        if ($result->num_rows > 0) {                //on success generate the table
            $output="<table><thead><tr><th>Hostname</th><th>Description</th><th>Location</th></tr></thead><tbody>";
            for ($i=0; $i<mysqli_num_rows($result); $i++){
                $row = mysqli_fetch_assoc($result);
                $output.= "<tr><td>".$row['idHostname']. "</td><td>" . $row['dtDescription'] . "</td><td>" . $row['dtLocation'] ."</td><td><button onclick=showGroups('".$row['idHostname']."')>Show Groups</button></td><td><button onclick=checkAffects('".$row['idHostname']."')>Show Events</button></td><td><button onclick=showExecuteSwitch('".$row['idHostname']."')>Show Switches</button></td></tr>";      //create rows with values that got fetched from the msql result
            }
        } else {
            $output = "false";              // error if there are no results
        }



       $output.= "</tbody></table><div id='groupsContent'>";
    }else {                                             //else sends message that there are no smartboxes
        $output= "<p>No smartboxes assigned</p>";
    }

    echo $output;
}
?>