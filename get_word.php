<?php

include 'includes/connect.php'; 

// Filter by type
if(!empty($_GET['typefilter'])) {
    $types = implode(",", $_GET['typefilter']);
}

// Filter by date
if($_GET['datefilter'] == "week") {
    $time = "-1 week";
} elseif ($_GET['datefilter'] == "month") {
    $time = "-1 month";
} else {
    $time = "-10 years";
}
$datefilter = date('Y-m-d H:i:s', strtotime($time));

// Filter by revision status
if($_GET['revisionlist'] == "1" ) {
    $revision_query = " AND words.flagged = 1";
} else {
    $revision_query = "";
}


// Get word
if(!isset($types)) {
    // No filter (date only)
    $q = mysql_query("SELECT * FROM words 
        LEFT JOIN types ON words.type_id = types.id 
        WHERE words.datetime_added >= '$datefilter'
        ".$revision_query."
        ORDER BY RAND() 
        LIMIT 1");
} else {
    // Filtered by type
   $q = mysql_query("SELECT * FROM words 
        LEFT JOIN types ON words.type_id = types.id 
        WHERE words.datetime_added >= '$datefilter'
        ".$revision_query."
        AND words.type_id IN ($types)
        ORDER BY RAND() 
        LIMIT 1"); 
}

$word = mysql_fetch_array($q);
echo json_encode($word);

exit();
