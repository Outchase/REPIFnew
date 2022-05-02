<?php
if (isset($_POST['showGroupPins'])) {
    include_once "sqlConnect.inc";      //connects to the database
    $output = "";

    $groupNr = $_POST['groupNr'];
    $sql = "SELECT tblAffect.fiPinNr, tblPin.dtDescription, tblPin.fiHostname from tblAffect INNER JOIN tblPin ON tblPin.idPinNr=tblAffect.fiPinNr AND tblPin.fiHostname=tblAffect.fiHostname WHERE fiGroupNr = '$groupNr'"; //query that selects Pins from selected Group
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {            //checks the number of rows from result
        $output = "<table><thead><tr><th>Group number</th><th>Pin number</th><th>Description</th></tr></thead><tbody>";
        for ($j = 0; $j < mysqli_num_rows($result); $j++) {
            $row = mysqli_fetch_assoc($result);
            $output .= "<tr><td>".$groupNr."</td><td>" . $row['fiPinNr'] . "</td><td>" . $row['dtDescription'] . "</td><td><button onclick=removePinFromGroup(" . $row['fiPinNr'] . "," . $groupNr . ",'" .$row['fiHostname']. "') class='normalBtn addPin'>-</button></td></tr>"; //display the pins with an option to remove the pins from the group
        }
        $output.= "<tr id='addOutput'><td><button onclick=showAddPinToGroup(".$groupNr.",'".$row['fiHostname']."') class='normalBtn addPin'>+</button></td></tr></tbody></table>";
        echo $output;
    } else {
        $output = "error";
    }
}
?>