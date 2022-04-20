<?php
if (isset($_POST['createGroup'])){
   include_once "sqlConnect.inc";      //connects to the database
   $groupName= $_POST['groupName'];
   $groupDesc= $_POST['groupDesc'];

   $sql = $mysqli->prepare("INSERT INTO tblGroup (dtGroupName, dtDescription) VALUES (?, ?)");  //use prepare statement to insert values in table tblAffect
   $sql->bind_param('ss', $groupName, $groupDesc);
   $sql-> execute();
   $sql->close();
   $mysqli->close();

   echo "Success";     //sends ajax method a message back

}
?>
