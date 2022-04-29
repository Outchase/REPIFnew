<?php
echo "wtf";
$extensionValidator = "sh";     //declares some Variable and Path valid file extension

$targetPath = "/smartbox/Scripts/" . $_POST['fileName'] . "/";      // path where the file will get stored
if ($_FILES['uploadScript']) {      //when Files is uploaded executes the rest below


    $targetFile = $_FILES['uploadScript']['name'];      //saves the upladed file name into a variable

    $tmpFile = $_FILES['uploadScript']['tmp_name'];      //temporary file name on server

    $fileExt = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));   //get uploaded file extension

    if ($fileExt === $extensionValidator) {      // checks if format is valid

        $targetPath = $targetPath . $targetFile;  //final path example: /smartbox/${hostname}/${filename}/file.sh

        $directory = "/smartbox/Scripts/" . $_POST['fileName'];       //defines directory
        $permission = 0777;                                  //set permission value

        echo $targetPath;
        if (!is_dir($directory)) {                              //checks if directory exists
            if (!mkdir($directory, $permission, true)) { //creates directory if it does not exist
                echo "Error to create file"; //on error with mkdir
            }
        }


        if (move_uploaded_file($tmpFile, $targetPath)) {      //moves file from temporary to the targeted Path if success
            chmod($targetPath, 0777);
            $fileName = $_POST['fileName'];
            $fileDesc = $_POST['fileDesc'];
            $sqlPath = "/" . $fileName . "/" . $targetFile;


            include_once "sqlConnect.inc";      //connect to the database
            $sql = "SELECT idScriptName FROM tblScript WHERE idScriptName='$fileName'";
            $result = $mysqli->query($sql);             //saves the result in a variable

            if ($result->num_rows > 0) {         //Return the number of rows in a result set = checks if script alreadyy exists

                $sql = $mysqli->prepare("UPDATE tblScript SET dtDescription =? WHERE idScriptName=?");    //use prepare statement to update the values from specific script
                $sql->bind_param('ss', $fileDesc, $fileName);     //bound parameter

            } else {
                $sql = $mysqli->prepare("INSERT INTO tblScript (idScriptName, dtPath, dtDescription) VALUES (?, ?, ?)");      //use prepare statement to insert values in table tblscript
                $sql->bind_param('sss', $fileName, $sqlPath, $fileDesc);         //bound parameters

            }
            $sql->execute(); //executes sql

            echo "File successfully uploaded";      //sends ajax method a message back after success

            $sql->close();  //close sql and database connection
            $mysqli->close();


        }

    } else {
        echo "File is invalid";                 //sends ajax method an error message back
    }
}
?>