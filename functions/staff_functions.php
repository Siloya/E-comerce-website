<?php
function get_staff_name($staff_id){
  global $conn;
  $sql = "SELECT * FROM staff WHERE id=$staff_id";
  $result = $conn->query($sql);
  if(!$result){
    echo $conn->error;
  } else {
    if($result->num_rows > 0){
      while($staff = $result->fetch_assoc()){
        return $staff['firstname'].' '.$staff['lastname'];
      }
    }
  }
}
?>
