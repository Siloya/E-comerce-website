<?php
include_once('server/database.php');
function get_active_categories_list(){
  global $conn;
  $categories = array();
  $sql = "SELECT * FROM category WHERE active=1 ORDER BY name ASC";
  $result = $conn->query($sql);
  if(!$result){
    echo $conn->error;
    die();
  } else {
    if($result->num_rows > 0){
      while($category = $result->fetch_assoc()){
        $categories[] = $category;
      }
    }
  }
  return $categories;
}


 ?>
