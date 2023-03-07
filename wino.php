<?php
session_start();
if ($_SESSION['logged'] === true) {
    require_once 'helpers.php';
    require_once 'connect.php';
    $db = new mysqli($host, $db_user, $db_password, $db_name);

    $query = "SELECT * FROM rekord WHERE user_id = {$_SESSION['userId']}";
    $rekordy = $db->query($query)->fetch_all();
    $gramaturaWina = '';
    $sumaWina = 0;
    $iloscDni = 0;
    $sumaPieniedzy = 0;
    foreach ($rekordy as $rekord) {
        if ($rekord[1] == 3) {
            $sumaWina += (int)$rekord[3];
            $gramaturaWina = $rekord[4];
            $iloscDni += $rekord[1];
        }
    }
    $iloscDni /= 3;
    if ($sumaWina != 0) {
        $sumaPieniedzy = $sumaWina / 750 * 24.99;
        $sumaWina = 'ok. ' . $sumaWina . ' ml';
    } else {
        $sumaWina = 'Nie było pite';
    }

    if ($sumaPieniedzy != 0) {
        $formatedSumaPieniedzy = 'około ' . number_format($sumaPieniedzy, 2) . ' zł';
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
    <div class="color mb-20">
        <img src="zdjecia/martiniBianco.png" alt="napraw kod" class="quantity" style="height: 60px">
        <div class="alcohol fb text-uppercase alcohol-statistics">Statystyki wina</div>
        <div class="clearfix"></div>
        <div class="font-weight"></div>
        <div class="" style="font-size: 13px">
        <?php
        echo 'Suma wypitego wina:' . '<div class="fb">' . $sumaWina . '</div>';
        echo '"Wypite" pieniądze:' . '<div class="fb">' . $formatedSumaPieniedzy . '</div>';
        echo 'Ilość dni w których piłeś:' . '<div class="fb">' . $iloscDni . '</div>';
        echo 'Ilość dni na kacu:' . '<div class="fb">' . 'Opcja niebawem dostępna' . '</div>';
        ?>
        </div>
    </div>

    <a href="rankingi.php" class="popraw-rekord mb-15" style="text-decoration: none; margin-bottom: 0px!important;">Wróć</a>
</div>
</div>

</body>
</html>