<?php
if (isset($_POST['updateGroup'])) {
    include_once "sqlConnect.inc";      //connects to database
    $groupNr = $_POST['groupNr'];
    $groupName = $_POST['groupName'];
    $groupDesc = $_POST['groupDesc'];

    $sql = $mysqli-> prepare("UPDATE tblGroup SET dtGroupName=?, dtDescription =? WHERE idGroupNr=?");    //use prepare statement to update the values from specific group
    $sql->bind_param('ssi', $groupName, $groupDesc, $groupNr);     //bound parameter
    $sql-> execute();       //executes sql
    echo "Update successfully";     //sends message back

    $sql->close();      //close sql and database connection
    $mysqli->close();
}
?>
