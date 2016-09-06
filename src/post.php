<?php 
include "db_connect.php";

$errors = array();
$data = array();

// Get posted data and decode JSON

$_POST = json_decode(file_get_contents('php://input'), true);

// Check if any blank values

if (empty($_POST['name'])) {
  $errors['name'] = 'Name is required';
}
if (empty($_POST['suggestion'])) {
  $errors['suggestion'] = 'Suggestion is required';
}
  
$name = mysqli_real_escape_string($connect, $_POST['name']);
$suggestion = mysqli_real_escape_string($connect, $_POST['suggestion']);

if(!empty($errors)){
  $data['errors'] = $errors;
} else {
  date_default_timezone_set("Europe/London");
  $date = date('Y-m-d H:i:s', time());
  mysqli_query($connect, "INSERT INTO `suggestions` (`user`,`suggestion`,`date`) VALUES ('$name', '$suggestion', '$date')");
  mysqli_close($connect);
  $data['message'] = 'Suggested';
}

echo json_encode($data)




?>