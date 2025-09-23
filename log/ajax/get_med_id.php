<?php
include '../config/connection.php';

$id = $_POST['id'];
$query = "select`id` 
from `medicine_details` 
where `id` = '$id';";

$stmt = $con->prepare($query);
  $stmt->execute();

	$r = $stmt->fetch(PDO::FETCH_ASSOC);
  $count = $r['id'];

  echo $count;


// $result= mysqli_query($con, "SELECT  FROM medicine_details WHERE id= '$id'");
// $row = mysqli_fetch_array($result);

// $out = $row['total'];
// echo $out;




?>