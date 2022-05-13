<?php
$extensionValidator = "sh";     //declares some Variable and Path valid file extension

$targetPath = "/smartbox/Scripts/" . $_POST['typeScript'] . "/";      // path where the file will get stored
if ($_FILES['uploadScript']) {      //when Files is uploaded executes the rest below


    $targetFile = $_FILES['uploadScript']['name'];      //saves the upladed file name into a variable
    if ($targetFile === $_POST['fileName'] . ".sh") {
        $targetFile = str_replace(" ", "", $targetFile);
        $targetFile = str_replace("/", "", $targetFile);

        $tmpFile = $_FILES['uploadScript']['tmp_name'];      //temporary file name on server

        $fileExt = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));   //get uploaded file extension

        if ($fileExt === $extensionValidator) {      // checks if format is valid

            $targetPath = $targetPath . $targetFile;  //final path example: /smartbox/${hostname}/${filename}/file.sh

            $directory = "/smartbox/Scripts/" . $_POST['typeScript'];       //defines directory
            $permission = 0777;                                  //set permission value

            if (!is_dir($directory)) {                              //checks if directory exists
                if (!mkdir($directory, $permission, true)) { //creates directory if it does not exist
                    echo "Error to create file"; //on error with mkdir
                }
            }
            chmod($directory, 0777);

            $searchFile= "/smartbox/Scripts/*/".$targetFile;

            $files = glob($searchFile);

            if (count($files)>0){           //if there is a file with same name send error message
                echo "Error file with similar file name exists already";
            }else{
                if (move_uploaded_file($tmpFile, $targetPath)) {      //moves file from temporary to the targeted Path if success
                    chmod($targetPath, 0777);
                    $fileName = $_POST['fileName'];
                    $fileName = str_replace(" ", "", $fileName);
                    $typeScript = $_POST['typeScript'];
                    $fileDesc = $_POST['fileDesc'];
                    $sqlPath = "/" . $typeScript . "/" . $targetFile;

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
            }

        } else {
            echo "File is invalid";                 //sends ajax method an error message back
        }

    } else{
        echo "File name is incorrect"; //sends ajax method an error message back
    }
}
?>