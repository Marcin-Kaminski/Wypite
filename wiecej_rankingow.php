<?php
require_once 'helpers.php';
require_once 'connect.php';
$db = new mysqli($host, $db_user, $db_password, $db_name);

if (!empty($_POST)) {
    $query = "INSERT INTO rekord(alcohol_id,quantity) VALUES($_POST[alcohol],$_POST[ilosc])";
    $db->query($query);
}
$query = "SELECT * FROM rekord WHERE created_on >= '2022-12-01'";
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
$query = "SELECT MIN(YEAR(created_on)) AS minimum_year FROM rekord";
$minimumYear = $db->query($query)->fetch_assoc()['minimum_year']; // najnizszy rok z bazy danych

$actualDate = new DateTime();
$actualDate = ($actualDate->format('Y')); // aktualny rok

//$query = "SELECT DISTINCT YEAR(created_on) AS year FROM rekord ORDER BY year DESC";
//$distinctYears = $db->query($query)->fetch_all();
//v($distinctYears);
//
//$betweenYears = ($distinctYears[1][0]);
//v($betweenYears);
//

$dates = [$minimumYear, $betweenYears, $actualDate];
v($dates);


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
    <div class="color mb-20">
        <div class="alcohol fb text-uppercase">Rankingi i statystyki</div>
        <div class="clearfix"></div>
        <div class="stripe"></div>
        <div class="font-weight"></div>
    </div>
    <form method="post">
        <?php
            echo '<select name="year" class="rectangle alcohol clearfix">';
        foreach ($dates as $date) {
            echo '<option value="' . $date . '">' . $date . '</option>';
        }
            echo '</select>';

            echo '<select name="month" class="rectangle quantity">';
            echo '<option value="option1">Styczeń</option>';
            echo '<option value="option2">Opcja 2</option>';
            echo '<option value="option3">Opcja 3</option>';
            echo '</select>';
        ?>
        <div class="popraw-rekord clearfix">Zobacz</div>
    </form>
    <div class="alcohol fb mb-15 text-uppercase color">rekordowe miesiące</div>
    <div class="stripe clearfix"></div>
    <div class="color">
        xxxx <br>
        xxxx <br> <br>
    </div>
    <div class="alcohol fb mb-15 text-uppercase color">Statystyki poszczególnych alko</div>
    <div class="stripe clearfix mb-30"></div>
    <div class="alcohol-signature">
        <a href="piwsko.php"><img src="zdjecia/beer.png" class="beer mb-15 ml-21" alt="Coś nie działa"></a>
        <div class="color text-uppercase font-weight  letter-size clearfix ml-7 mb-0">Piwsko</div>
        <div class="color letter-size clearfix ml-10">zobacz</div>
    </div>
    <div class="alcohol-signature">
        <a href="wodka.php"><img src="zdjecia/wodka.png" class="vodka mb-15 ml-vodka-image" alt="Coś nie działa"></a>
        <div class="color text-uppercase font-weight  letter-size clearfix ml-vodka-text mb-0">Wóda</div>
        <div class="color letter-size clearfix ml-vodka-text">zobacz</div>
    </div>
    <div class="alcohol-signature">
        <a href="jager.php"> <img src="zdjecia/jager.png" alt="Coś nie działa" class="jager mb-15"></a>
        <div class="color text-uppercase font-weight  letter-size clearfix ml-jager mb-0">Jager</div>
        <div class="color letter-size clearfix ml-39">zobacz</div>
    </div>
    <div class="clearfix"></div>
    <div class="alcohol-signature mt-40">
        <a href="wino.php"><img src="zdjecia/martiniBianco.png" alt="Coś nie działa" class="bianco mb-15 ml-21"></a>
        <div class="color text-uppercase font-weight  letter-size clearfix ml-15 mb-0">Wino</div>
        <div class="color letter-size clearfix ml-bianco-zobacz">zobacz</div>
    </div>
     <div class="alcohol-signature mt-40">
         <a href="ruda.php"><img src="zdjecia/ruda.png" alt="Coś się popsuło" class="ruda mb-15 ml-ruda-image"></a>
        <div class="color text-uppercase font-weight  letter-size clearfix ml-ruda-text mb-0">Ruda</div>
        <div class="color letter-size clearfix ml-ruda-zobacz">zobacz</div>
    </div>


</div>
</body>
</html>

