<?php
if (isset($_POST['sm'])) {      //when post um is set executes the rest below
    include_once "sqlConnect.inc";          //connects to the database
    $sql = "SELECT * FROM tblSmartbox";        //query that select everything from Table tblSmartbox
    $result = $mysqli->query($sql);             //saves the result in a variable
    $a = array();               //declares an array

    if ($result->num_rows > 0) {                //Return the number of rows in a result set

        for ($i=0; $i<mysqli_num_rows($result); $i++) {         //loop through the array and adds into declared array ($a)
            $row = mysqli_fetch_assoc($result);
            $a[] = array(
                "hostname"=>$row['idHostname'],
                "description"=>$row['dtDescription'],
                "location"=>$row['dtLocation']);
        }
    }else {                                             //else sends an error message
        echo "0 results";
    }
    $mysqli->close();       //closes database connection
    echo json_encode($a);       //display the  array in json format
}
?>