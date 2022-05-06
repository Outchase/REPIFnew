<?php
if (isset($_POST['pins'])){
    $hostname= $_POST['hostname'];

    include_once "sqlConnect.inc";      //connect to data base

    $sql = "SELECT * FROM `tblPin` WHERE fiHostname='$hostname'";      //query that selects everything from specific hostname
    $result = $mysqli->query($sql);         //saves results in a variable
    $output = "<table><thead><tr><th>Pin Number</th><th>Description</th><th>Input/Output</th><th>Hostname</th></tr></thead><tbody>";      //generates table tos display the pins list that are saved in teh database
    if ($result->num_rows > 0) {
        for ($i=0; $i<mysqli_num_rows($result); $i++) {
            $row = mysqli_fetch_assoc($result);
                if($row['dtInputOrOutput']=== "1"){     // if chance check box to chekced ot not checked
                    $output.= "<tr><td>".$row['idPinNr'] ."</td><td><input type='text' id='editPinsDescription". $row['idPinNr'] ."' value='". $row['dtDescription'] ."'></td><td><input type='checkbox' checked  id='editPinsInOut". $row['idPinNr'] ."'></td><td>".$hostname ."</td><td><input type='button' class='normalBtn' value='Update' onclick=updatePins(".$row['idPinNr'].",'".$hostname."')></td><td><input type='button' class='normalBtn' value='Delete' onclick=deletePins(".$row['idPinNr'].",'".$hostname."')></td></tr>";
                } else{
                    $output.= "<tr><td>".$row['idPinNr'] ."</td><td><input type='text' id='editPinsDescription". $row['idPinNr'] ."' value='". $row['dtDescription'] ."'></td><td><input type='checkbox'  id='editPinsInOut". $row['idPinNr'] ."'></td><td>".$hostname ."</td><td><input type='button' value='Update' class='normalBtn' onclick=updatePins(".$row['idPinNr'].",'".$hostname."')></td><td><input type='button' class='normalBtn' value='Delete' onclick=deletePins(".$row['idPinNr'].",'".$hostname."')></tr>";
                }
        }

    } else{     //if it is a new Smartbox with nos assigned pins display this message
        $output.= "<tr><td style='color: red'>There are no pins assign for ".$hostname ."</td></tr>";

    }

    $sql = "SELECT fiUserNr FROM `tblConfigure` WHERE fiHostname='$hostname'";  // query that selects the foreign key from specific hostname
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {        // if smartbox is assigned to User display the add pin Button
        $output.= "<tr id='addInputPins'><td class='addPin'><input type='button' class='normalBtn' value='+' onclick=addPins('".$hostname."')></td><td><input type='button' value='Close' class='normalBtn' onclick='cancelChanges()'></td></tr>";
    } else{ //else display message to assign the new smartbox to a user first
        $output.= "<tr><td style='color: red'>The Smartbox: ".$hostname ." is not assigned to any clients. Please assign the Smartbox: ".$hostname." to a Client first!</td></tr>";
    }
    $output.= "</tbody></table>";
    echo $output;       //sends the generated table back
}
?>