<?php
if (isset($_POST['createUser'])){
    include_once "sqlConnect.inc";

    $name = $_POST['name'];
    $firstName = $_POST['firstName'];
    $technician = $_POST['technician'];
    $email = $_POST['email'];
    $password = hash('gost', $_POST['password']);

    $sql = "SELECT idUserNr FROM `tblUser` WHERE dtEmail='$email'";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        echo "exists";
    }else{
        $sql = $mysqli->prepare("INSERT INTO tblUser (dtName, dtFirstName, dtTechnician, dtEmail, dtPassword) VALUES (?, ?, ?, ?, ?)");

        $sql->bind_param('ssiss', $name, $firstName, $technician, $email, $password);
        $sql-> execute();

        $sql->close();
    }
    $mysqli->close();

}

?>