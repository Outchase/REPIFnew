<?php
if (isset($_POST['um'])) {  //when post um is set executes the rest below
    include_once "sqlConnect.inc";              //connects to the database
    $sql = "SELECT * FROM `tblUser`";           //query that select everything from Table tblUser
    $result = $mysqli->query($sql);             //saves the result in a variable
    $a = array();               //declares an array

    if ($result->num_rows > 0) {         //Return the number of rows in a result set

        for ($i=0; $i<mysqli_num_rows($result); $i++) {     //loop through the result and adds into declared array ($a)
            $row = mysqli_fetch_assoc($result);
            $a[] = array(
                "id"=>$row['idUserNr'],
                "name"=>$row['dtName'],
                "firstName"=>$row['dtFirstName'],
                "technician"=>$row['dtTechnician'],
                "email"=>$row['dtEmail'],
                "password"=>$row['dtPassword']);
        }
    }else {                     //else sends an error message
        echo "0 results";
    }
    $mysqli->close();       //closes database connection
    echo json_encode($a);       //display the  array in json format
}
?>