<?php
$extensionValidator = "sh";

$targetPath = "uploads/";
if ($_FILES['uploadScript']) {


    $targetFile = $_FILES['uploadScript']['name'];

    $tmpFile= $_FILES['uploadScript']['tmp_name'];

    $fileExt = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $final_file = rand(1000,1000000).$targetFile;
    if ($fileExt === $extensionValidator){

        $targetPath = $targetPath.strtolower($final_file);
        echo $tmpFile;
        if (move_uploaded_file($tmpFile,$targetPath)){

          /*  $fileName= $_POST['fileName'];
            $fileDesc= $_POST['fileDesc'];

            include_once "sqlConnect.inc";
            $sql = $mysqli->prepare("INSERT INTO tblScript (idScriptName, dtPath, dtDescription) VALUES (?, ?, ?)");
            $sql->bind_param('sss', $fileName, $targetPath, $fileDesc);
            $sql-> execute();
            $sql->close();
            $mysqli->close();*/

            echo "File successfully uploaded";

        }
    } else {
        echo "File is invalid";
    }
}
?>