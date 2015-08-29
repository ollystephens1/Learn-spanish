<?php

include 'includes/connect.php'; 

// Filter by search string
$search = $_GET['search'];

// Query DB and return matching rows
$q = mysql_query("SELECT * FROM words 
    LEFT JOIN types ON words.type_id = types.id 
    WHERE words.english LIKE '%$search%'
    ORDER BY words.datetime_added DESC
    LIMIT 20
  ") or die(mysql_error()); 

$count = 0;
while($word = mysql_fetch_array($q)) {
  $class = $count % 2 == 0 ? " class='odd'" : "";
  echo "<tr".$class.">
        <td>".$word['english']."</td>
        <td>".$word['spanish']."</td>
        <td>".$word['type']."</td>
        <td>".date("d M Y", strtotime($word['datetime_added']))."</td>
    </tr>"; 
  $count++;
}


exit();


