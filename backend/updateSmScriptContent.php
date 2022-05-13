<?php
if (isset($_POST['updateSmScriptContent'])) {
    include_once "sqlConnect.inc";      //connect to database

    $scriptName = $_POST['scriptName'];
    $scriptSmContent = $_POST['scriptSmContent'];
    $hostname=$_POST['hostname'];
    $filePath = "/smartbox/".$hostname."/*/". $scriptName . ".sh";
    $fileSource = glob($filePath);

    $file = fopen($fileSource[0], "w+");

    if ($file) {
        fwrite($file, $scriptSmContent);
        fclose($file);

        echo "Update successfully";     //return message back

    } else {
        echo "No files found";
    }
}
?>
