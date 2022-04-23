<?php
if (isset($_POST['assignExecuteSwitch'])){
    include_once "sqlConnect.inc";      //connects to the database
    $assignFuncCode= $_POST['assignFuncCode'];
    $assignDesc= $_POST['assignDesc'];
    $assignSeq= $_POST['assignSeq'];
    $assignDelay= $_POST['assignDelay'];
    $assignEventCode= $_POST['assignEventCode'];
    $assignPinNr= $_POST['assignPinNr'];
    $hostname= $_POST['hostname'];
    $assignGroupNr= $_POST['assignGroupNr'];

    if ($assignSeq<1){
        $assignSeq=NULL;
    }
    if($assignDelay<1){
        $assignDelay=NULL;
    }




    $sql = $mysqli->prepare("INSERT INTO tblExecuteTheSwitch (idShouldFunctionsCode, dtDescription, dtSequenceNr, dtDelay, fiEventCode, fiPinNr, fiHostname, fiGroupNr) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");  //use prepare statement to insert values in table tblAffect
    $sql->bind_param('ssiisisi', $assignFuncCode, $assignDesc, $assignSeq, $assignDelay, $assignEventCode, $assignPinNr, $hostname, $assignGroupNr);
    $sql-> execute();
    $sql->close();
    $mysqli->close();

    echo "Success";     //sends ajax method a message back

}
?>