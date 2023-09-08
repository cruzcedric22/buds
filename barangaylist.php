<?php
include('includes/config.php');

 if (isset($_POST['barangay'])) {
   $selectedBarangay = $_POST['barangay'];

  $sql = "SELECT zone FROM brgyzone_list WHERE barangay = '$selectedBarangay'";

if($result = $conn->query($sql)){
  if($result->num_rows > 0){
    while ($row = $result -> fetch_assoc()) {
      echo $row['zone'];
    }

  }
}  else{
die("Error:".$conn->error);
}
}
?>
