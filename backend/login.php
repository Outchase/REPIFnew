<?php

session_start();

if (isset($_POST['login'])) {                       //checks if Post login is set
    include_once "sqlConnect.inc";                  //connects to database server



    $email = $_POST['email'];                       //saves post login into a vaiable
    $password = hash('gost', $_POST['password']);   //encrypts post login with gost and saves it into a variable

    $sql = "SELECT idUserNr, dtTechnician FROM `tblUser` WHERE dtEmail='$email' AND dtPassword='$password'";     //query selects value from Table tblUser in database
    $result = $mysqli->query($sql);         //performs query in a database and saves result into a variable
    $row = mysqli_fetch_assoc($result);

    if ($result->num_rows > 0) {                                     //Return the number of rows in a result set
        $_SESSION["loggedIN"] = "1";                                //sets and saves values into a Session
        $_SESSION["email"] = $email;
        $_SESSION["userID"] = $row["idUserNr"];
       $_SESSION["technician"] = $row["dtTechnician"];
    exit("success");                                   //Prints a message and exits the current script
    } else {
        exit("");                                                    //Prints a message (empyt String) and exits the current script
    }
}

?>

