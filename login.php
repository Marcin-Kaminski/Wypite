<?php
require_once 'helpers.php';
require_once 'connect.php';
$db = new mysqli($host, $db_user, $db_password, $db_name);
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
        <img  src="zdjecia/bp_logo2.png" alt="napraw kod"></a>
    </div>
    <div class="było-pite">Było pite</div>
    <div class="by-marcin">by Marcin</div>
    <div class="text-align-center">Witaj, masz już konto?</div> <br>
    <a href="login.php" class="login">zaloguj się</a>
    <a href="registration.php" class="login">zarejestruj się</a>
    <div class="color mb-20">
        <img src="zdjecia/bp_icon.png" alt="napraw kod" class="quantity">
        <div class="alcohol fb">Ranking za obecny miesiąc</div>
        <div class="clearfix"></div>
        <div class="stripe percent-80 mt-0"></div>
        <div class="font-weight"></div>
    </div>
    <div class="color">
        <div class="alcohol">Piwsko</div>
        <div class="quantity">0 szt</div>
        <div class="clearfix"></div>
        <div class="stripe"></div>
    </div>
    <div class="color">
        <div class="alcohol">Wóda</div>
        <div class="quantity">0 ml</div>
        <div class="clearfix"></div>
        <div class="stripe"></div>
    </div>
    <div class="color">
        <div class="alcohol">Jabolce</div>
        <div class="quantity">0 ml</div>
        <div class="clearfix"></div>
        <div class="stripe"></div>
    </div>
    <div class="color">
        <div class="alcohol">Ruda</div>
        <div class="quantity">0 ml</div>
        <div class="clearfix"></div>
        <div class="stripe"></div>
    </div>
    <div class="color">
        <div class="alcohol">Jager</div>
        <div class="quantity"> 0 ml</div>
        <div class="clearfix"></div>
        <div class="stripe"></div>
    </div>
    <div class="wiecej-rankingow">Więcej dzikich rankingów</div>
</div>

</body>
</html>
