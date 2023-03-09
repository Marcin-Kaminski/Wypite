<?php
session_start();
if (!isset($_SESSION['logged'])) {
    require_once 'helpers.php';
    require_once 'connect.php';
    $db = new mysqli($host, $db_user, $db_password, $db_name);
    if (isset($_POST['submit'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
        $flag = false;
        $query = "SELECT * FROM users WHERE user = '$login'";
        $result = $db->query($query);
        $doesUserExist = $result->num_rows;

        if ($doesUserExist > 0) {
            $userData = $result->fetch_assoc();
            if (password_verify($password, $userData['password'])) {
                $_SESSION['logged'] = true;
                $_SESSION['userId'] = $userData['id'];
                header('location: main_page.php');
            }
        } else {
            $eLogging = 'Błędny login lub hasło';
        }
    }
} else {
    header('location: main_page.php');
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
        Hasło:
        <input type="password" class="register-tables" autocomplete="off" name="password">
        <?php
        if (isset($eLogging)) {
            echo '<div class="error">' . $eLogging . '</div>';
        }
        ?>
        <button type="submit" class="popraw-rekord pointer" style="font-size: 15px; width: 255px; margin-bottom: 25px;margin-top: 25px" name="submit">Zaloguj się</button>
        <a href="registration.php" class="popraw-rekord mb-0" style="width: 255px; text-decoration: none">Przejdź do rejestracji</a>
    </form>
</div>

</body>
</html>
