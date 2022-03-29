<?php
if (isset($_POST['changePw'])) {
    include_once "sqlConnect.inc";      //connect to database

    $email= $_POST['email'];
    $recPw = hash('gost',$_POST['recPw']);
    $newPw = hash('gost',$_POST['newPw']);

    $sql = "SELECT * FROM tblUser WHERE dtEmail='$email' AND dtPassword='$recPw'";     //query that selects everythin from table user with the specific email and password
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {        //if sql result rows is greater than 0 means the user with this password exists
        $row = mysqli_fetch_assoc($result);

        $sql = $mysqli-> prepare("UPDATE tblUser SET dtPassword=? WHERE idUserNr=?");       //use prepare statement to update values from specific user
        $sql->bind_param('si', $newPw, $row['idUserNr']);       //bound parameters
        $sql-> execute();       //executes sql

        echo "Password changed";        //return message back

        $sql->close();      //close sql and database connection
        $mysqli->close();
    }else {
        echo "User not found";  //return error message back
    }
}
?>