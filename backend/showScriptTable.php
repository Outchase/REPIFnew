<?php
if (isset($_POST['showScriptTable'])) {
    $output="";
    include_once "sqlConnect.inc";      //connect to the database
    $sql = "SELECT * FROM tblScript";
    $result = $mysqli->query($sql);             //saves the result in a variable

    if ($result->num_rows > 0) {
        $output="<table><thead><tr><th>Script Name</th><th>Script Path</th><th>Description</th></tr></thead><tbody>";
        for ($i=0; $i<mysqli_num_rows($result); $i++) {     //loop through the result and adds into declared array ($a)
            $row = mysqli_fetch_assoc($result);
            $output.="<tr><td>".$row['idScriptName']."</td><td>".$row['dtPath']."</td><td>".$row['dtDescription']."</td><td><button class='normalBtn' onclick=editScript('".$row['idScriptName']."','".$row['dtPath']."')>Edit</button></td><td><button class='normalBtn' onclick=deleteScript('".$row['idScriptName']."','".$row['dtPath']."')>Delete</button></td></tr>";
        }
        $output.="</tbody></table>";
    } else{
        $output="<p style='color: red'>There are no script available</p>";
    }
    echo $output;
}
?>