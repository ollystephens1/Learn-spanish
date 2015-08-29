<?php
$revision_status = $_POST['to_revise'];
$id = $_POST['id'];

include 'includes/connect.php';

$query = mysql_query("UPDATE words SET flagged = '$revision_status' WHERE id = '$id'");

exit();