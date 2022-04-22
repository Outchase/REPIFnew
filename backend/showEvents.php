<?php
if (isset($_POST['showEvent'])){
    include_once "sqlConnect.inc";      //connects to the database
    $hostname= $_POST['hostname'];
    $output ="";

    $sql= "SELECT * from tblEvent WHERE fiHostname='$hostname'";

    $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable

    if ($result->num_rows > 0) {                //Return the number of rows in a result set
        $output.="<h3>Event lists:</h3><table><thead><tr><th>Event Code</th><th>Description</th><th>Pin number</th></tr></thead><tbody>";    //creates table if events exists
        for ($i=0; $i<mysqli_num_rows($result); $i++) {

            $row = mysqli_fetch_assoc($result);
            $output.="<tr><td>".$row['idEventCode']."</td><td>".$row['dtDescription']."</td><td>".$row['fiPinNr']."</td><td><button onclick=showEditEvent('".$row['idEventCode']."','".$hostname."',".$row['fiPinNr'].")>Edit</button></td><td><button onclick=deleteEvent('".$row['idEventCode']."','".$hostname."',".$row['fiPinNr'].")>Delete</button></td></tr>";
        }

        $output.="</tbody></table><p id='editEvent'></p>";

    } else {
        $output= "<p style='color: red'>There are no Events available for ".$hostname.". Please assign an existent event</p>";
    }
    echo $output;
    $mysqli->close();
}
?>