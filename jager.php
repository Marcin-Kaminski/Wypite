<?php
session_start();
if ($_SESSION['logged'] === true) {
    require_once 'helpers.php';
    require_once 'connect.php';
    $db = new mysqli($host, $db_user, $db_password, $db_name);
    $query = "SELECT * FROM rekord WHERE user_id = {$_SESSION['userId']}";
    $rekordy = $db->query($query)->fetch_all();
    $gramaturaJagera = '';
    $sumaJagera = 0;
    $iloscDni = 0;
    $sumaPieniedzy = 0;
    foreach ($rekordy as $rekord) {
        if ($rekord[1] == 5) {
            $sumaJagera += (int)$rekord[3];
            $gramaturaJagera = $rekord[4];
            $iloscDni += $rekord[1];
        }
    }
    $iloscDni /= 5;
    if ($sumaJagera != 0) {
        $sumaPieniedzy = $sumaJagera / 1000 * 75.99;
        $sumaJagera = 'ok. ' . $sumaJagera . ' ml.';
    } else {
        $sumaJagera = 'Nie było pite';
    }

    if ($sumaPieniedzy != 0) {
        $formatedSumaPieniedzy = 'około ' . number_format($sumaPieniedzy, 2) . ' zł.';
    } else {
        $formatedSumaPieniedzy = '0 zł';
    }
} else {
    header('location: index.php');
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
        <img  src="zdjecia/bp_logo2.png" alt="napraw kod"></a>
    </div>
    <div class="było-pite">Było pite</div>
    <div class="by-marcin">by Marcin</div>
    <img src="zdjecia/jager.png" class="ruda" alt="Coś się popsuło"> <br>
    <div class="color mb-20">
        <img src="zdjecia/bp_icon.png" alt="napraw kod" class="quantity">
        <div class="alcohol fb text-uppercase">Statystyki jagera</div>
        <div class="clearfix"></div>
        <div class="stripe percent-80 mt-0"></div>
        <div class="font-weight"></div>
        <?php
        echo 'Suma wypitego jagera:' . '<div class="fb">' . $sumaJagera . '</div>';
        echo '"Wypite" pieniądze:' . '<div class="fb">' . $formatedSumaPieniedzy . '</div>';
        echo 'Ilość dni w których piłeś:' . '<div class="fb">' . $iloscDni . '</div>';
        echo 'Ilość dni na kacu:' . '<div class="fb">' . 'Opcja niebawem dostępna' . '</div>';

        ?>
    </div>

    <a href="rankingi.php" class="popraw-rekord mb-15">Wróć</a>
</div>
</div>

</body>
</html>