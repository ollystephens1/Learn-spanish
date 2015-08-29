<?php
include 'includes/connect.php'; 

$english = $_POST['english'];
$spanish = $_POST['spanish'];
$type = $_POST['type'];
$date = date('Y-m-d H:i:s');

$check = mysql_query("SELECT * FROM words WHERE english = '$english'");
if (mysql_num_rows($check) < 1) {
    $q = "INSERT INTO words (id, spanish, english, type_id, datetime_added)
    VALUES ('', '$spanish', '$english', '$type', '$date')";

    if(mysql_query($q)) {
        $response = array('result' => 'success', 'message' => 'Word added successfully');
    } else {
        $response = array('result' => 'error', 'message' => 'Could not add word');
    }
} else {
    $response = array('result' => 'error', 'message' => '"'.$english.'" already exists in the database');
}

echo json_encode($response);

