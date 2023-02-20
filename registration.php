<?php

require_once 'helpers.php';
require_once 'connect.php';
$db = new mysqli($host, $db_user, $db_password, $db_name);
if (isset($_POST['submit'])) {
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $flag = true;
    if ((strlen($login) < 3) or (strlen($login) > 20)) {
        $e_login = 'Login musi mieć od 3 do 20 znaków';
        $flag = false;
    }
    if (ctype_alnum($login) === false) {
        $flag = false;
        $e_login = 'Login może się składać tylko z liter'. '<br>' .  'i cyfer (bez polskich znaków)';
    }
    $checkedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (filter_var($checkedEmail, FILTER_VALIDATE_EMAIL) === false or $checkedEmail != $email) {
        $flag = false;
        $e_email = 'Email jest niepoprawny';
    }
    if (strlen($password1) < 8 or strlen($password1) > 20) {
        $flag = false;
        $e_password = 'Hasło musi mieć od 8 do 20 znaków';
    }
    if ($password2 != $password1) {
        $flag = false;
        $e_password2 = 'Hasła nie są identyczne';
    }
    $password_hash = password_hash($password1, PASSWORD_DEFAULT);
if ($flag === true) {
    echo 'prototyp rejestracji działa';
}
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Było pite - główna</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            /*background-image: url("zdjecia/astronaut_beer.jpg");*/
            background-size: cover;
        }
        }
    </style>
</head>
<body>
<div class="box">
    <div style="text-align: center;">
        <img  src="zdjecia/bp_logo2.png" alt="napraw kod"></a>
    </div>
    <div class="było-pite">Było pite</div>
    <div class="by-marcin">by Marcin</div>
    <form method="post">
        Login:
        <input type="text" class="register-tables" autocomplete="off" name="login">
        <?php
        if (isset($e_login)) {
            echo '<div class="error">' . $e_login . '</div>';
        }
        ?>
        E-mail:
        <input type="text" class="register-tables" autocomplete="off" name="email">
        <?php
        if (isset($e_email)) {
            echo '<div class="error">' . $e_email . '</div>';
        }
        ?>
        Hasło:
        <input type="password" class="register-tables" autocomplete="off" name="password1">
        <?php
        if (isset($e_password)) {
            echo '<div class="error">' . $e_password . '</div>';
        }
        ?>
        Powtórz hasło:
        <input type="password" class="register-tables" autocomplete="off" name="password2">
        <?php
        if (isset($e_password2)) {
            echo '<div class="error">' . $e_password2 . '</div>';
        }
        ?>
        <button type="submit" class="popraw-rekord" style="font-size: 15px" name="submit">Zarejestruj się</button>
    </form>
</div>

</body>
</html>
