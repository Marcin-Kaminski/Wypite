<?php
require_once 'helpers.php';
require_once 'connect.php';
$db = new mysqli($host, $db_user, $db_password, $db_name);

if (!empty($_POST)) {
    $query = "INSERT INTO rekord(alcohol_id,quantity) VALUES($_POST[alcohol],$_POST[ilosc])";
    $db->query($query);
}
$query = "SELECT * FROM rekord";
$rekordy = $db->query($query)->fetch_all();

$gramaturaJaboli = '';
$gramaturaPiwa = '';
$gramaturaWodki = '';
$gramaturaRudej = '';
$gramaturaJagera = '';

$sumaPiwa = 0;
$sumaWodki = 0;
$sumaJaboli = 0;
$sumaRudej = 0;
$sumaJagera = 0;

foreach ($rekordy as $rekord) {
    switch ($rekord[1]) {
        case '1':
            $sumaPiwa += (int)$rekord[3];
            $gramaturaPiwa = $rekord[4];
            break;
        case '2':
            $sumaWodki += (int)$rekord[3];
            $gramaturaWodki = $rekord[4];
            break;
        case '3':
            $sumaJaboli += (int)$rekord[3];
            $gramaturaJaboli = $rekord[4];
            break;
        case '4':
            $sumaRudej += (int)$rekord[3];
            $gramaturaRudej = $rekord[4];
            break;
        case '5':
            $sumaJagera += (int)$rekord[3];
            $gramaturaJagera = $rekord[4];
    }
}
$gramaturaJaboli = rrr($db, $sumaJaboli, $gramaturaJaboli);
$gramaturaRudej = rrr($db, $sumaRudej, $gramaturaRudej);
$gramaturaWodki = rrr($db, $sumaWodki, $gramaturaWodki);
$gramaturaJagera = rrr($db, $sumaJagera, $gramaturaJagera);

if ($sumaPiwa != 0) {
    $sumaPiwa = $sumaPiwa . ' szt.';
} else {
    $sumaPiwa = 'Nie było pite';
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
    <a href="popraw_rekord.php" class="popraw-rekord">Popraw rekord</a>
    <div class="color mb-20">
        <img src="zdjecia/bp_icon.png" alt="napraw kod" class="quantity">
        <div class="alcohol fb">Ranking za obecny miesiąc</div>
        <div class="clearfix"></div>
        <div class="stripe percent-80 mt-0"></div>
        <div class="font-weight"></div>
    </div>
        <div class="color">
            <div class="alcohol">Piwsko</div>
            <?php
            echo '<div class="quantity">' . $sumaPiwa . '</div>'
            ?>
            <div class="clearfix"></div>
            <div class="stripe"></div>
        </div>
        <div class="color">
            <div class="alcohol">Wóda</div>
            <?php
            echo '<div class="quantity">' . $gramaturaWodki . '</div>'
            ?>
            <div class="clearfix"></div>
            <div class="stripe"></div>
        </div>
        <div class="color">
            <div class="alcohol">Jabolce</div>
            <?php
            echo '<div class="quantity">' . $gramaturaJaboli . '</div>'
            ?>
            <div class="clearfix"></div>
            <div class="stripe"></div>
        </div>
        <div class="color">
            <div class="alcohol">Ruda</div>
            <?php
            echo '<div class="quantity">' . $gramaturaRudej . '</div>'
            ?>
            <div class="clearfix"></div>
            <div class="stripe"></div>
        </div>
        <div class="color">
            <div class="alcohol">Jager</div>
            <?php
            echo '<div class="quantity">' . $gramaturaJagera . '</div>'
            ?>
            <div class="clearfix"></div>
            <div class="stripe"></div>
        </div>

    <div class="wiecej-rankingow">
    <a href="rankingi.php" class="wiecej-rankingow">Więcej dzikich rankingów</a>
    </div>
</div>

</body>
</html>
