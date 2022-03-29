<?php
$extensionValidator = "sh";     //declares some Variable and Path valid file extension

$targetPath = "/smartbox/".$_POST['hostname']."/";      // path where the file will get stored
if ($_FILES['uploadScript']) {      //when Files is uploaded executes the rest below


    $targetFile = $_FILES['uploadScript']['name'];      //saves the upladed file name into a variable

    $tmpFile= $_FILES['uploadScript']['tmp_name'];      //temporary file name on server

    $fileExt = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));   //get uploaded file extension

    $final_file = rand(1000,10000).$targetFile; //adding random Numbers before filename to make sure the same file can be uploaded multiple time without error
    if ($fileExt === $extensionValidator){      // checks if format is valid

        $targetPath = $targetPath.strtolower($final_file);  //final path example: /smartbox/${hostname}/321file.sh

        $directory = "/smartbox/".$_POST['hostname'];       //defines directory
        $permission= 0777;                                  //set permission value


        if(!is_dir($directory)){                              //checks if directory exists
            if (!mkdir($directory,$permission, true)) { //creates directory if it does not exist
                echo "Error to create file"; //on error with mkdir
            }
        }


        if (move_uploaded_file($tmpFile,$targetPath)){      //moves file from temporary to the targeted Path

            $fileName= $_POST['fileName'];
            $fileDesc= $_POST['fileDesc'];

            include_once "sqlConnect.inc";      //conect to the database
            $sql = $mysqli->prepare("INSERT INTO tblScript (idScriptName, dtPath, dtDescription) VALUES (?, ?, ?)");      //use prepare statement to insert values in table tblscript
            $sql->bind_param('sss', $fileName, $targetPath, $fileDesc);         //bound parameters
            $sql-> execute();   //executes sql
            $sql->close();      //close sql and database connection
            $mysqli->close();

            echo "File successfully uploaded";      //sends ajax method a message back after success

        }
    } else {
        echo "File is invalid";                 //sends ajax method an error message back
    }
}
?>