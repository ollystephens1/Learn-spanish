<?php
session_start();
$user_credentials = validateUserInput($_POST);

if(is_array($user_credentials) && $user_credentials != FALSE) {
    $password = md5($user_credentials['password']);
    $username = $user_credentials['username'];
    include '../includes/connect.php';
    
    $query = mysql_query("SELECT * FROM users WHERE username = '$username'");
    if(mysql_num_rows($query) > 0) {
        while($row = mysql_fetch_array($query)) {
            if($password == $row['password']) {
                unset($row['password']);
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['user'] = $row;
                header('Location: ../index.php');
            } else {
                echo "Passwords don't match :/";
            }
        }
    } else {
        echo "Username does not exist :/";
    }
    
} else {
    echo "Not logged in :/";
}




function validateUserInput($post_data) {
    
    if(isset($post_data['username']) && $post_data['username'] != NULL && isset($post_data['password']) && $post_data['password'] != NULL) {
        if(is_array($post_data))
        foreach($post_data as $key => $post) {
            $post = trim($post);
            $post = htmlspecialchars($post);
            $post = addslashes($post);
        }
        return $post_data;
    } else {
        return FALSE;
    }
}

?>