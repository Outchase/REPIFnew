<?php
if (isset($_POST['showAvailableSequenceNumber'])) {
    include_once "sqlConnect.inc";      //connects to the database

    $hostname= $_POST['hostname'];
    $output="";

    $sql = "SELECT dtSequenceNr FROM tblExecuteTheSwitch WHERE fiHostname = '$hostname'";         //query that selects all the smarboxes of the giving user from Table tblConfigure
    $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable


    if ($result->num_rows > 0) {                //Return the number of rows in a result set
        for ($i=0; $i<mysqli_num_rows($result); $i++){
            $row = mysqli_fetch_assoc($result);
            if ($row['dtSequenceNr']===null){
                $output.="<option value='".($i+1)."'>".($i+1)."</option>";
            }
        }
        $sqlNr=mysqli_num_rows($result);
        $temp=$sqlNr+1;
        $output.="<option value='".$temp."'>".$temp."</option>";
    }else{
        $output= "<option value='1'>1</option>";
    }
    echo $output;
}
?>