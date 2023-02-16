<?php
require_once 'helpers.php';
require_once 'connect.php';
$db = new mysqli($host, $db_user, $db_password, $db_name);

if (!empty($_GET)) {
    $getYear = $_GET['year'];
    $getMonth = $_GET['month'];
    if ($getMonth < 10) {
        $getMonth = '0' . $getMonth;
    }
    $query = "SELECT * FROM rekord WHERE YEAR(created_on) = " . $getYear . " AND MONTH(created_on) = " . $getMonth . "";
    $choosedDates = $db->query($query)->fetch_all();
    $beerSum = chosenAlcoholQuantity($choosedDates, '1');
    $vodkaSum = chosenAlcoholQuantity($choosedDates, '2');
    $wineSum = chosenAlcoholQuantity($choosedDates, '3');
    $whiskeySum = chosenAlcoholQuantity($choosedDates, '4');
    $jagerSum = chosenAlcoholQuantity($choosedDates, '5');
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

$query = "SELECT * FROM rekord";
$results = $db->query($query);
mostAlcohol('1', $beerResults, $results);
mostAlcohol('2', $vodkaResults, $results);
mostAlcohol('3', $wineResults, $results);
mostAlcohol('4', $whiskeyResults, $results);
mostAlcohol('5', $jagerResults, $results);

$mostBeerArray = [];

mostAlcoholQuantity($beerResults, $mostBeer);
mostAlcoholQuantity($vodkaResults, $mostVodka);
mostAlcoholQuantity($wineResults, $mostWine);
mostAlcoholQuantity($whiskeyResults, $mostWhiskey);
mostAlcoholQuantity($jagerResults, $mostJager);

foreach ($beerResults as $key => $result) {
    if ($result === $mostBeer) {
        $mostBeerArray[] = $key;
    }
}
v($mostBeerArray);
$beerArrayName = [];
numericToWordDate($mostBeerArray, $mostBeer, $mostBeerMonthArray, $bestBeerMonth, $bestBeerYear, $months);
numericToWordDate($vodkaResults, $mostVodka, $mostVodkaMonthArray, $bestVodkaMonth, $bestVodkaYear, $months);
numericToWordDate($wineResults, $mostWine, $mostWineMonthArray, $bestWineMonth, $bestWineYear, $months);
numericToWordDate($whiskeyResults, $mostWhiskey, $mostWhiskeyMonthArray, $bestWhiskeyMonth, $bestWhiskeyYear, $months);
numericToWordDate($jagerResults, $mostJager, $mostJagerMonthArray, $bestJagerMonth, $bestJagerYear, $months);
foreach ($mostBeerArray as $result) { // daty z tablic
    $bestBeerYear = substr($result, 0, 4);
    $bestBeerMonth = substr($result, 5, 2);
    foreach ($months as $month) {
        if ($bestBeerMonth === $month['id']) {
            $beerArrayName[] = $bestBeerMonth = $month['month'];
        }
    }
}
$i = 0;
foreach ($beerArrayName as $item) {
   echo $item;
    ++$i;
}

v($beerArrayName);
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
        <div class="alcohol fb text-uppercase">Rankingi i statystyki</div> <br>
        <?php
        if (!empty($_GET)) {
                echo'<div class="alcohol-name">' . 'Piwsko'  . '</div>';
            if ($beerSum === '0') {
                echo '<div class="quantity">' . 'Nie było pite' . '</div>';
            } else {
                echo '<div class="quantity">' . $beerSum . ' szt.'  . '</div>';
            }
            echo'<div class="clearfix">' . '</div>' .
                '<div class="alcohol-name">' . 'Wódka'  . '</div>' .
                checkIf($vodkaSum) .
                '<div class="clearfix">' . '</div>' .
                '<div class="alcohol-name">' . 'Ruda'  . '</div>' .
                checkIf($whiskeySum) .
                '<div class="clearfix">' . '</div>' .
                '<div class="alcohol-name">' . 'Jabol'  . '</div>' .
                checkIf($wineSum) .
                '<div class="clearfix">' . '</div>' .
                '<div class="alcohol-name">' . 'Jager'  . '</div>' .
                checkIf($jagerSum) .
                '<div class="clearfix">' . '</div>' . '<br>';
        }
        ?>
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
    <div class="color letter-size">
        <?php
        if (!is_null($mostBeer)) {
            echo'<div class="alcohol-name">' . 'Piwsko'  . '</div>' .
                '<div class="alcohol ">' . $mostBeer . ' szt.'  . '</div>' .
                '<div class="quantity">' . $bestBeerMonth . ' ' . $bestBeerYear . '</div>' .
                '<div class="clearfix">' . '</div>';
        }
        if (!is_null($mostVodka)) {
            echo'<div class="alcohol-name">' . 'Wódka'  . '</div>' .
              '<div class="alcohol ">' . 'ok. ' . $mostVodka . ' ml.'  . '</div>' .
              '<div class="quantity">' . $bestVodkaMonth . ' ' . $bestVodkaYear . '</div>' .
              '<div class="clearfix">' . '</div>';
        }
        if (!is_null($mostWhiskey)) {
            echo'<div class="alcohol-name">' . 'Ruda'  . '</div>' .
              '<div class="alcohol ">' . 'ok. ' . $mostWhiskey . ' ml.'  . '</div>' .
              '<div class="quantity">' . $bestWhiskeyMonth . ' ' . $bestWhiskeyYear . '</div>' .
              '<div class="clearfix">' . '</div>';
        }
        if (!is_null($mostWine)) {
            echo'<div class="alcohol-name">' . 'Jabol'  . '</div>' .
              '<div class="alcohol ">' . 'ok. ' .  $mostWine . ' ml.'  . '</div>' .
              '<div class="quantity">' . $bestWineMonth . ' ' . $bestWineYear . '</div>' .
              '<div class="clearfix">' . '</div>';
        }
        if (!is_null($mostJager)) {
            echo'<div class="alcohol-name">' . 'Jager'  . '</div>' .
              '<div class="alcohol ">' . 'ok. ' . $mostJager . ' ml.'  . '</div>' .
              '<div class="quantity">' . $bestJagerMonth . ' ' . $bestJagerYear . '</div>' .
              '<div class="clearfix">' . '</div>' . '<br>';
        }
        ?>
    </div>
    <div class="clearfix"></div>
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

