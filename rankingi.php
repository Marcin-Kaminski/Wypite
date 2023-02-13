<?php
require_once 'helpers.php';
require_once 'connect.php';
$db = new mysqli($host, $db_user, $db_password, $db_name);

if (!empty($_GET)) {
    v('test');
    echo 'test';
    $getYear = $_GET['year'];
    $getMonth = $_GET['month'];
    if ($getMonth < 10) {
        $getMonth = '0' . $getMonth;
    }
    $query = "SELECT * FROM rekord WHERE YEAR(created_on) = " . $getYear . " AND MONTH(created_on) = " . $getMonth . "";
    $choosedDates = $db->query($query)->fetch_all();
    v($choosedDates);
    foreach ($choosedDates as $choosedDate) {
        v($choosedDate[1]);
    }
}

$query = "SELECT MIN(YEAR(created_on)) AS minimum_year FROM rekord";
$minimumYear = $db->query($query)->fetch_assoc()['minimum_year']; // najnizszy rok z bazy danych
$actualDate = date('Y'); // aktualny rok
$startYear = $minimumYear; // najnizszy rok (do fora)
$endYear = $actualDate; // aktualny rok (do fora)
$months = [['id' => '01', 'month' => 'Styczeń'], ['id' => '02', 'month' => 'Luty'], ['id' => '03', 'month' => 'Marzec'],
    ['id' => '04', 'month' => 'Kwiecień'], ['id' => '05', 'month' => 'Maj'], ['id' => '06', 'month' => 'Czerwiec'],
    ['id' => '07', 'month' => 'Lipiec'], ['id' => '08', 'month' => 'Sierpień'], ['id' => '09', 'month' => 'Wrzesień'],
    ['id' => '10', 'month' => 'Październik'], ['id' => '11', 'month' => 'Listopad'],
    ['id' => '12', 'month' => 'Grudzień']];

$beerResults = [];
$whiskeyResults = [];
$wineResults = [];
$vodkaResults = [];
$jagerResults = [];

$mostBeer = 0;
$mostWhiksey = 0;
$mostWine = 0;
$mostVodka = 0;
$mostJager = 0;

$mostBeerMonthArray = [];
$mostWhikseyMonthArray = [];
$mostWineMonthArray = [];
$mostVodkaMonthArray = [];
$mostJagerMonthArray = [];

$query = "SELECT * FROM rekord";
$results = $db->query($query);
$beer = '0';

mostAlcohol('1', $beerResults, $results);
mostAlcohol('2', $vodkaResults, $results);
mostAlcohol('3', $wineResults, $results);
mostAlcohol('4', $whiskeyResults, $results);
mostAlcohol('5', $jagerResults, $results);

<<<<<<< HEAD
mostAlcoholQuantity($beerResults, $mostBeer);
mostAlcoholQuantity($vodkaResults, $mostVodka);
mostAlcoholQuantity($wineResults, $mostWine);
mostAlcoholQuantity($whiskeyResults, $mostWhiskey);
mostAlcoholQuantity($jagerResults, $mostJager);

numericToWordDate($beerResults, $mostBeer, $mostBeerMonthArray, $bestBeerMonth, $bestBeerYear, $months);
numericToWordDate($vodkaResults, $mostVodka, $mostVodkaMonthArray, $bestVodkaMonth, $bestVodkaYear, $months);
numericToWordDate($wineResults, $mostWine, $mostWineMonthArray, $bestWineMonth, $bestWineYear, $months);
numericToWordDate($whiskeyResults, $mostWhiskey, $mostWhiskeyMonthArray, $bestWhiskeyMonth, $bestWhiskeyYear, $months);
numericToWordDate($jagerResults, $mostJager, $mostJagerMonthArray, $bestJagerMonth, $bestJagerYear, $months);

=======

v($beerResults);
v($vodkaResults);
v($wineResults);
v($whiskeyResults);
v($jagerResults);

foreach ($beerResults as $result) {     // liczy ilosc wypitego piwa z najlepszego miesiaca
    if ($result > $mostBeer) {
        $mostBeer = $result;
    }
}
v($mostBeer);

foreach ($beerResults as $key => $result) { // daty z tablic
    if ($mostBeer === $result) {
        $mostBeerMonthArray[] = $key;
        $bestBeerYear = substr($key, 0, 4);
        $bestBeerMonth = substr($key, 5, 2);
        foreach ($months as $month) {
            if ($bestBeerMonth === $month['id']) {
                $bestBeerMonth = $month['month'];
            }
        }
    }
}



//echo $bestBeerMonth . '<br>';
//echo $bestBeerYear;
//v($mostBeerMonthArray);
//v($mostWhiksey);
>>>>>>> parent of ada2161 (php zwariował)
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
            /*background-size: cover;*/
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
    <form method="get">
        <?php
        echo '<select name="year" class="rectangle alcohol clearfix">';
        for ($year = $startYear; $year <= $endYear; $year++) {
            echo '<option value="' . $year . '">' . $year . '</option>';
        }
        echo '</select>';
        echo '<select name="month" class="rectangle quantity">';
        foreach ($months as $month) {
            echo '<option value="' . $month['id'] . '">' . $month['month'] . '</option>';
        }
        echo '</select>';
        ?>
        <input type="submit" class="popraw-rekord clearfix" value="Zobacz" >

    </form>
    <div class="alcohol fb mb-15 text-uppercase color">rekordowe miesiące</div>
    <div class="stripe clearfix"></div>
    <div class="color">
        <?php
        echo 'Rekordowy miesiąc i rok dla piwa:' .
            '<div class="fb">' . $bestBeerMonth . ' ' . $bestBeerYear . ', ' . $mostBeer . ' szt.' . '<br>' . '<br>';
        ?>
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

