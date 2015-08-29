<?php
    require_once "core/init.php";
    include_once "includes/connect.php";
    $types = mysql_query("SELECT * FROM types");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $page_title; ?></title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="mobile.css" media="screen and (max-width: 900px)">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="global.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Archivo+Narrow' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <header>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="index.php">Flashcards</a></li>
                <li><a href="#" onclick="toggleAddWord()">Add word</a></li>
                <li><a href="dictionary.php">Dictionary</a></li>
                <li><a href="#">Settings</a></li>
                <li>
                    <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE) : ?>
                        <a href="#"><?=$_SESSION['user']['username']; ?></a>
                    <?php else : ?>
                        <a href="login.php">Login</a>
                    <?php endif; ?>
                </li>
            </ul>
            <div class="handle"><div class="menu-icon"></div></div>
        </header>
        <div class="add hidden" id="add-word">
            <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE) : ?>
                <form action="" method="post" id="add_word_form">
                    <input id="spanish-field" type="text" name="spanish" placeholder="Spanish..." maxlength="50" required>
                    <input type="text" name="english" placeholder="English..." maxlength="50" required>
                    <select name="type">
                        <?php while($type = mysql_fetch_assoc($types)): ?>
                                <option value="<?=$type['id']?>"><?=$type['type']?></option>
                        <?php endwhile;?>
                    </select>
                    <input type="submit" value="Add word">
                </form>
                <ul id="chars">
                    <li>&Aacute;</li>
                    <li>&Eacute;</li>
                    <li>&Iacute;</li>
                    <li>&Oacute;</li>
                    <li>&Uacute;</li>
                    <li>&Ntilde;</li>
                    <li>&Uuml;</li>
                    <li>&aacute;</li>
                    <li>&eacute;</li>
                    <li>&iacute;</li>
                    <li>&oacute;</li>
                    <li>&uacute;</li>
                    <li>&ntilde;</li>
                    <li>&uuml;</li>
                    <li>&iquest;</li>
                    <li>&iexcl; </li>
                </ul>
            <?php else : ?>
                <p>You must be logged in to add new words.</p>
                <a href="login.php">Login now!</a>
            <?php endif; ?>
        </div>
        <div class="alert hidden" id="alert"></div>