<?php
if (isset($_POST['createUser'])){
    include_once "sqlConnect.inc";          //connects to the database

    $name = $_POST['name'];                 //saves post values into variables
    $firstName = $_POST['firstName'];
    $technician = $_POST['technician'];
    $email = $_POST['email'];
    $password = hash('gost', $_POST['password']);       //encrypt post value and saves it into a variable

    $sql = "SELECT idUserNr FROM `tblUser` WHERE dtEmail='$email'";        //query that selects specific user by the givign email
    $result = $mysqli->query($sql);                 //saves query result into variable
    if ($result->num_rows > 0) {        //if Return the number of rows in result is greater than 0 the user with the same email exists
        echo "exists";
    }else{
        $sql = $mysqli->prepare("INSERT INTO tblUser (dtName, dtFirstName, dtTechnician, dtEmail, dtPassword) VALUES (?, ?, ?, ?, ?)"); //else use prepare statement to insert values

        $sql->bind_param('ssiss', $name, $firstName, $technician, $email, $password);       //bound parameters
        $sql-> execute();           //executes sql

        $sql->close();          //close sql and database connection
    }
    $mysqli->close();

}

?>