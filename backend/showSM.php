<?php
if (isset($_POST['sm'])) {
    include_once "sqlConnect.inc";
    $sql = "SELECT * FROM tblSmartbox";
    $result = $mysqli->query($sql);
    $a = array();

    if ($result->num_rows > 0) {

        for ($i=0; $i<mysqli_num_rows($result); $i++) {
            $row = mysqli_fetch_assoc($result);
            $a[] = array(
                "hostname"=>$row['idHostname'],
                "description"=>$row['dtDescription'],
                "location"=>$row['dtLocation']);
        }
    }else {
        echo "0 results";
    }
    $mysqli->close();
    echo json_encode($a);
}
?>