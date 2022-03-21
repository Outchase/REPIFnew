<?php
if (isset($_POST['um'])) {
    include_once "sqlConnect.inc";
    $sql = "SELECT * FROM `tblUser`";
    $result = $mysqli->query($sql);
    $a = array();

    if ($result->num_rows > 0) {

        for ($i=0; $i<mysqli_num_rows($result); $i++) {
            $row = mysqli_fetch_assoc($result);
            $a[] = array(
                "id"=>$row['idUserNr'],
                "name"=>$row['dtName'],
                "firstName"=>$row['dtFirstName'],
                "technician"=>$row['dtTechnician'],
                "email"=>$row['dtEmail'],
                "password"=>$row['dtPassword']);
        }
    }else {
        echo "0 results";
    }
    $mysqli->close();
    echo json_encode($a);
}
?>