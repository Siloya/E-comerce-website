<?php
function get_ratings_count($vendor_id){
  global $conn;
  $sql = "SELECT * FROM rating WHERE vendor_id='$vendor_id'";
  $result = $conn->query($sql);
  if(!$result){
    echo $conn->error;
  } else {
    return $result->num_rows;
  }
}
function get_average_rating($vendor_id){
  $average = 0;
  global $conn;
  $sql = "SELECT * FROM rating WHERE vendor_id='$vendor_id'";
  $result = $conn->query($sql);
  if(!$result){
    echo $conn->error;
  } else {
    $num_rows = $result->num_rows;
    if($num_rows > 0){
      while($rating = $result->fetch_assoc()){
        $average += $rating['stars'];
      }
      $average = $average/$num_rows;
    }
  }
  return $average;
}



 ?>
