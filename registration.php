<?php
session_start();
if (isset($_SESSION['logged'])) {
    header('location: main_page.php');
} else {
    require_once 'helpers.php';
    require_once 'connect.php';
    $db = new mysqli($host, $db_user, $db_password, $db_name);

    if (isset($_POST['submit'])) {
        $login = $_POST['login'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        $email = $_POST['email'];
        $flag = true;
        if ((strlen($login) < 3) or (strlen($login) > 20)) {
            $eLogin = 'Login musi mieć od 3 do 20 znaków';
            $flag = false;
        }
        if (ctype_alnum($login) === false) {
            $flag = false;
            $eLogin = 'Login może się składać tylko z liter' . '<br>' .  'i cyfer (bez polskich znaków)';
        }
        $checkedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (filter_var($checkedEmail, FILTER_VALIDATE_EMAIL) === false or $checkedEmail != $email) {
            $flag = false;
            $eEmail = 'Email jest niepoprawny';
        }
        if (strlen($password1) < 6 or strlen($password1) > 20) {
            $flag = false;
            $ePassword = 'Hasło musi mieć od 6 do 20 znaków';
        }
        if ($password2 != $password1) {
            $flag = false;
            $ePassword2 = 'Hasła nie są identyczne';
        }
        $passwordHash = password_hash($password1, PASSWORD_DEFAULT);

        $query = "SELECT user FROM users WHERE user = '$login'";
        $doesThisLoginExist = $db->query($query)->num_rows;
        if ($doesThisLoginExist > 0) {
            $flag = false;
            $eLogin = 'Istnieje już konto o takin loginie';
        }
        $query = "SELECT id FROM users WHERE email = '$email'";
        $doesThisEmailExist = $db->query($query)->num_rows;
        if ($doesThisEmailExist > 0) {
            $flag = false;
            $eEmail = 'Istnieje już konto przypisane do' . '<br>' . 'tego adresu email';
        }
        if ($flag === true) {
            $query = "INSERT INTO users(id, user, password, email) VALUES (NULL, '$login', '$passwordHash', '$email') ";
            $db->query($query);
            header('Location: login.php');
        }
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
            background-image: url("zdjecia/astronaut_beer.jpg");
            background-size: cover;
        }
        }
    </style>
</head>
<body>
<div class="box">
    <div style="text-align: center;">
        <a href="index.php"><img  src="zdjecia/bp_logo2.png" alt="napraw kod"></a>
    </div>
    <div class="było-pite">Było pite</div>
    <div class="by-marcin">by Marcin</div>
    <form method="post">
        Login:
        <input type="text" class="register-tables" autocomplete="off" name="login">
        <?php
        if (isset($eLogin)) {
            echo '<div class="error">' . $eLogin . '</div>';
        }
        ?>
        E-mail:
        <input type="text" class="register-tables" autocomplete="off" name="email">
        <?php
        if (isset($eEmail)) {
            echo '<div class="error">' . $eEmail . '</div>';
        }
        ?>
        Hasło:
        <input type="password" class="register-tables" autocomplete="off" name="password1">
        <?php
        if (isset($ePassword)) {
            echo '<div class="error">' . $ePassword . '</div>';
        }
        ?>
        Powtórz hasło:
        <input type="password" class="register-tables" autocomplete="off" name="password2">
        <?php
        if (isset($ePassword2)) {
            echo '<div class="error">' . $ePassword2 . '</div>';
        }
        ?>
        <button type="submit" class="popraw-rekord pointer" style="font-size: 15px; width: 254px; margin-bottom: 25px; margin-top: 25px;" name="submit">Zarejestruj się</button>
        <a href="login.php" class="popraw-rekord mb-0" style="width: 252px; text-decoration: none">Przejdź do logowania</a>
    </form>
</div>

</body>
</html>
