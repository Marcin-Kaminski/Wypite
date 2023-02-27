<?php
session_start();
if ($_SESSION['logged'] === true) {
    require_once 'helpers.php';
    require_once 'connect.php';
    $db = new mysqli($host, $db_user, $db_password, $db_name);
    $query = "SELECT * FROM rekord WHERE user_id = {$_SESSION['userId']}";
    $rekordy = $db->query($query)->fetch_all();
    $gramaturaPiwa = '';
    $sumaPiwa = 0;
    $iloscDni = 0;
    $sumaPieniedzy = 0;
    foreach ($rekordy as $rekord) {
        switch ($rekord[1]) {
            case '1':
                $sumaPiwa += (int)$rekord[3];
                $gramaturaPiwa = $rekord[4];
                break;
        }
        if ($rekord[1] == 1) {
            $iloscDni += $rekord[1];
        }
    }
    if ($sumaPiwa != 0) {
        $sumaPieniedzy = 'około ' . $sumaPiwa * 2.99 . ' zł';
        $sumaPiwa = $sumaPiwa . ' szt';
    } else {
        $sumaPiwa = 'Nie było pite';
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
    <img src="zdjecia/beer.png" class="beer" alt="Coś się popsuło"> <br>
    <div class="color mb-20">
        <img src="zdjecia/beer.png" alt="napraw kod" class="quantity" style="height: 40px">
        <div class="alcohol fb text-uppercase" style="margin-bottom: 2px">Statystyki Piwska</div>
        <div class="clearfix"></div>
        <div class="stripe percent-80 mt-0"></div>
        <div class="font-weight"></div>
        <?php
        echo 'Suma wypitych piw:' . '<div class="fb">' . $sumaPiwa . '</div>';
        echo '"Wypite" pieniądze:' . '<div class="fb">' . $sumaPieniedzy . '</div>';
        echo 'Ilość dni w których piłeś:' . '<div class="fb">' . $iloscDni . '</div>';
        echo 'Ilość dni na kacu:' . '<div class="fb">' . 'Opcja niebawem dostępna' . '</div>';

        ?>
    </div>

    <a href="rankingi.php" class="popraw-rekord mb-15">Wróć</a>
    </div>
</div>

</body>
</html>
