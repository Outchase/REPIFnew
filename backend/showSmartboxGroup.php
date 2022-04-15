<?php
if (isset($_POST['smGr'])){
    include_once "sqlConnect.inc";      //connects to the database
    $hostname= $_POST['hostname'];
   //echo "works " . $hostname;

    $sql= "SELECT fiGroupNr FROM tblAffect WHERE fiHostname = '$hostname'";   //query that selects group from selected Smartbox
    $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable
    $output = "";

    if ($result->num_rows > 1) {                //Return the number of rows in a result set
    $sql.= " GROUP BY fiGroupNr";               //Group the multiple values in fiGroupNr
    $result = $mysqli->query($sql);             //performs query in a database and saves result into a variable
      for ($i=0; $i<mysqli_num_rows($result); $i++) {
            $row = mysqli_fetch_assoc($result);
          $output.= "<div> <h4>Group: ". $row['fiGroupNr'] . "</h4>";
          $tempSql = "SELECT fiPinNr from tblAffect WHERE fiGroupNr = ". $row['fiGroupNr']; //query that selects Pins from selected Group
          $tempResult = $mysqli->query($tempSql);             //create new variable with temporary values, so it won't replace the accent one
          for ($j=0; $j<mysqli_num_rows($tempResult); $j++) {
              $tempRow = mysqli_fetch_assoc($tempResult);
              $output .= "<p>".$tempRow['fiPinNr']."</p>";
          }
          $output.= "</div>";
        }

    } else if ($result->num_rows > 0){
        $row = mysqli_fetch_assoc($result);
        print_r($row);
        for ($i=0; $i<mysqli_num_rows($result); $i++){
            $output.= "<div>test".$i."</div>";
        }
    } else {
        $output.= "<li>false</li>";
    }

    $output.= "</ul>";
    echo $output;

    $mysqli->close();
}
?>