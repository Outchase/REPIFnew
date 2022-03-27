<?php
if (isset($_POST['pins'])){
    $hostname= $_POST['hostname'];

    include_once "sqlConnect.inc";

    $sql = "SELECT * FROM `tblPin` WHERE fiHostname='$hostname'";
    $result = $mysqli->query($sql);
    $output = "<table><thead><tr><th>Pin Number</th><th>Description</th><th>Input/Output</th><th>Hostname</th></tr></thead><tbody>";
    if ($result->num_rows > 0) {
        for ($i=0; $i<mysqli_num_rows($result); $i++) {
            $row = mysqli_fetch_assoc($result);
                if($row['dtInputOrOutput']=== "1"){
                    $output.= "<tr><td>".$row['idPinNr'] ."</td><td><input type='text' id='editPinsDescription". $row['idPinNr'] ."' value='". $row['dtDescription'] ."'></td><td><input type='checkbox' checked  id='editPinsInOut". $row['idPinNr'] ."'></td><td>".$hostname ."</td><td><input type='button' value='update pins' onclick=updatePins(".$row['idPinNr'].",'".$hostname."')></td><td><input type='button' value='delete pins' onclick=deletePins(".$row['idPinNr'].",'".$hostname."')></td></tr>";
                } else{
                    $output.= "<tr><td>".$row['idPinNr'] ."</td><td><input type='text' id='editPinsDescription". $row['idPinNr'] ."' value='". $row['dtDescription'] ."'></td><td><input type='checkbox'  id='editPinsInOut". $row['idPinNr'] ."'></td><td>".$hostname ."</td><td><input type='button' value='update pins' onclick=updatePins(".$row['idPinNr'].",'".$hostname."')></td></tr>";
                }
        }

    } else{
        $output.= "<tr><td style='color: red'>There are no pins assign for ".$hostname ."</td></tr>";

    }

    $sql = "SELECT fiUserNr FROM `tblConfigure` WHERE fiHostname='$hostname'";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        $output.= "<tr id='addInputPins'><td><input type='button' value='+' onclick=addPins('".$hostname."')></td></tr>";
    } else{
        $output.= "<tr><td style='color: red'>The Smartbox: ".$hostname ." is not assigned to any clients. Please assign the Smartbox: ".$hostname." to a Client first!</td></tr>";
    }
    $output.= "</tbody></table>";
    echo $output;
}
?>