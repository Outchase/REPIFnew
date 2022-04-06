<?php
if (isset($_POST['smGr'])){
    include_once "sqlConnect.inc";      //connects to the database
    $hostname= $_POST['hostname'];
   //echo "works " . $hostname;

    $sql= "SELECT fiGroupNr, fiPinNr FROM tblAffect WHERE fiHostname = '$hostname'";   //query that selects group and pins from selected Smartbox
    $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable

    if ($result->num_rows > 1) {                //Return the number of rows in a result set
    $sql.= " GROUP BY fiGroupNr";
    echo $sql;
    $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable

        print_r($result);
        /*for ($i=0; $i<mysqli_num_rows($result); $i++){
            $row = mysqli_fetch_assoc($result);

        }*/

    } else if ($result->num_rows > 0){
        $row = mysqli_fetch_assoc($result);
        print_r($row);
        for ($i=0; $i<mysqli_num_rows($result); $i++){
            echo "test".$i;
        }
    } else {
        echo "false";
    }

    $mysqli->close();
}
?>