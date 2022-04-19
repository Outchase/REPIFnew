<?php
if (isset($_POST['createGroup'])){
   include_once "sqlConnect.inc";      //connects to the database
   $groupName= $_POST['groupName'];
   $groupDesc= $_POST['groupDesc'];
   $hostname= $_POST['hostname'];


}
?>
