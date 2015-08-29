<?php
$page_title = 'Learn Spanish | Login';
include "includes/header.php";
?>      

<div class="innertube login">
    <ul>
        <form action="user/login.php" method="POST">
            <li><input type="text" name="username" placeholder="Username"></li>
            <li><input type="password" name="password" placeholder="Password"></li>
            <li><input type="submit" value="Login"></li>
        </form>
    </ul>
    
</div>

<?php
include "includes/footer.php";
?>  