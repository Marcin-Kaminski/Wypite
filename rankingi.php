<?php
session_start();
require_once 'helpers.php';
require_once 'connect.php';
$db = new mysqli($host, $db_user, $db_password, $db_name);
if ($_SESSION['logged'] === true) {
    if (!empty($_GET)) {
        $getYear = $_GET['year'];
        $getMonth = $_GET['month'];
        if ($getMonth < 10) {
            $getMonth = '0' . $getMonth;
        }
        $query = "SELECT * FROM rekord WHERE user_id = {$_SESSION['userId']} AND YEAR(created_on) = " . $getYear . " AND MONTH(created_on) = " . $getMonth . "";
        $choosedDates = $db->query($query)->fetch_all();
        $beerSum = chosenAlcoholQuantity($choosedDates, '1');
        $vodkaSum = chosenAlcoholQuantity($choosedDates, '2');
        $wineSum = chosenAlcoholQuantity($choosedDates, '3');
        $whiskeySum = chosenAlcoholQuantity($choosedDates, '4');
        $jagerSum = chosenAlcoholQuantity($choosedDates, '5');
    }

    $query = "SELECT MIN(YEAR(created_on)) AS minimum_year FROM rekord";
    if (isset($db->query($query)->fetch_assoc()['minimum_year'])) {
        $minimumYear = $db->query($query)->fetch_assoc()['minimum_year'];
    } else {
        $minimumYear = 2023;
    }
    $actualDate = date('Y'); // aktualny rok
    $startYear = $minimumYear; // najnizszy rok (do fora)
    $endYear = $actualDate; // aktualny rok (do fora)
    $months = [['id' => '01', 'month' => 'Styczeń'], ['id' => '02', 'month' => 'Luty'], ['id' => '03', 'month' => 'Marzec'],
        ['id' => '04', 'month' => 'Kwiecień'], ['id' => '05', 'month' => 'Maj'], ['id' => '06', 'month' => 'Czerwiec'],
        ['id' => '07', 'month' => 'Lipiec'], ['id' => '08', 'month' => 'Sierpień'], ['id' => '09', 'month' => 'Wrzesień'],
        ['id' => '10', 'month' => 'Październik'], ['id' => '11', 'month' => 'Listopad'],
        ['id' => '12', 'month' => 'Grudzień']];

    $query = "SELECT * FROM rekord WHERE user_id = {$_SESSION['userId']}";
    $results = $db->query($query);
    mostAlcohol('1', $beerResults, $results);
    mostAlcohol('2', $vodkaResults, $results);
    mostAlcohol('3', $wineResults, $results);
    mostAlcohol('4', $whiskeyResults, $results);
    mostAlcohol('5', $jagerResults, $results);

    mostAlcoholQuantity($beerResults, $mostBeer);
    mostAlcoholQuantity($vodkaResults, $mostVodka);
    mostAlcoholQuantity($wineResults, $mostWine);
    mostAlcoholQuantity($whiskeyResults, $mostWhiskey);
    mostAlcoholQuantity($jagerResults, $mostJager);

    mostAlcArray($beerResults, $mostBeer, $mostBeerArray);
    mostAlcArray($vodkaResults, $mostVodka, $mostVodkaArray);
    mostAlcArray($wineResults, $mostWine, $mostWineArray);
    mostAlcArray($whiskeyResults, $mostWhiskey, $mostWhiskeyArray);
    mostAlcArray($jagerResults, $mostJager, $mostJagerArray);


    xyz($mostBeerArray, $bestBeerYear, $bestBeerMonth, $months, $beerArrayName);
    xyz($mostVodkaArray, $bestVodkaYear, $bestVodkaMonth, $months, $vodkaArrayName);
    xyz($mostWineArray, $bestWineYear, $bestWineMonth, $months, $wineArrayName);
    xyz($mostWhiskeyArray, $bestWhiskeyYear, $bestWhiskeyMonth, $months, $whiskeyArrayName);
    xyz($mostJagerArray, $bestJagerYear, $bestJagerMonth, $months, $jagerArrayName);
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
    <title>Było pite</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="box">
    <div style="text-align: center;">
        <a href="index.php"><img  src="zdjecia/bp_logo2.png" alt="napraw kod"></a>
    </div>
    <div class="było-pite">Było pite</div>
    <div class="by-marcin">by Marcin</div>
    <div class="color mb-20">
        <div class="alcohol fb text-uppercase" style="font-size: 15px" >Rankingi i statystyki</div> <br>
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
                '<div class="alcohol-name">' . 'Wino'  . '</div>' .
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
        echo '<select name="year" class="rectangle alcohol clearfix" style="appearance: none; margin-left: 2px">';
        for ($year = $startYear; $year <= $endYear; $year++) {
            $selected = isset($_GET['year']) && ((int)$_GET['year'] === $year) ? 'selected' : '';
            echo '<option value="' . $year . '" ' . $selected . ' >' . $year . '</option>';
        }
        echo '</select>';
        echo '<select name="month" class="rectangle alcohol" style="appearance: none; margin-left: 8px;">';
        foreach ($months as $month) {
            $selected = isset($_GET['month']) && ($_GET['month'] === $month['id']) ? 'selected' : '';
            echo '<option value="' . $month['id'] . '" ' . $selected . ' >' . $month['month'] . '</option>';
        }
        echo '</select>';
        ?>
        <input type="submit" class="popraw-rekord clearfix" value="Zobacz" >

    </form>
    <div class="alcohol fb mb-15 text-uppercase color" style="font-size: 15px">rekordowe miesiące</div>
    <div class="stripe clearfix"></div>
    <div class="color letter-size">
        <?php
        beer($mostBeer, 'Piwsko', $beerArrayName, $bestBeerYear);
        notBeer($mostVodka, 'Wóda', $vodkaArrayName, $bestVodkaYear);
        notBeer($mostWhiskey, 'Ruda', $whiskeyArrayName, $bestWhiskeyYear);
        notBeer($mostWine, 'Wino', $wineArrayName, $bestWineYear);
        notBeer($mostJager, 'Jager', $jagerArrayName, $bestJagerYear);
        echo '<div class="clearfix">' . '</div>';
        ?>
    </div>
    <div class="clearfix"></div>
    <div class="alcohol fb mb-15 text-uppercase color" style="margin-top: 10px; font-size: 15px">Statystyki poszczególnych alko</div>
    <div class="stripe clearfix mb-30"></div>
    <div style="position: relative">
        <div class="circle" style="left: 23px"></div>
        <div class="alcohol-signature">
            <a href="piwsko.php"><img src="zdjecia/beer.png" class="beer mb-15 ml-21" alt="Coś nie działa"></a>
            <div class="color text-uppercase font-weight  letter-size clearfix ml-7 mb-0">Piwsko</div>
            <div class="color letter-size clearfix ml-10">zobacz</div>
        </div>
        <div class="circle" style="left: 123px"></div>
        <div class="alcohol-signature">
            <a href="wodka.php"><img src="zdjecia/wodka.png" class="vodka mb-15 ml-vodka-image" alt="Coś nie działa"></a>
            <div class="color text-uppercase font-weight  letter-size clearfix ml-vodka-text mb-0">Wóda</div>
            <div class="color letter-size clearfix ml-vodka-text">zobacz</div>
        </div>
        <div class="circle" style="left: 223px"></div>
        <div class="alcohol-signature">
            <a href="jager.php"> <img src="zdjecia/jager.png" alt="Coś nie działa" class="jager mb-15"></a>
            <div class="color text-uppercase font-weight  letter-size clearfix ml-jager mb-0">Jager</div>
            <div class="color letter-size clearfix ml-39">zobacz</div>
        </div>
        <div class="clearfix"></div>
        <div class="circle" style="left: 23px;top: 157px"></div>
        <div class="alcohol-signature mt-40">
            <a href="wino.php"><img src="zdjecia/martiniBianco.png" alt="Coś nie działa" class="bianco mb-15 ml-21"></a>
            <div class="color text-uppercase font-weight  letter-size clearfix ml-15 mb-0">Wino</div>
            <div class="color letter-size clearfix ml-bianco-zobacz">zobacz</div>
        </div>
        <div class="circle" style="left: 123px;top: 157px"></div>
        <div class="alcohol-signature mt-40">
            <a href="ruda.php"><img src="zdjecia/ruda.png" alt="Coś się popsuło" class="ruda mb-15 ml-ruda-image"></a>
            <div class="color text-uppercase font-weight  letter-size clearfix ml-ruda-text mb-0">Ruda</div>
            <div class="color letter-size clearfix ml-ruda-zobacz">zobacz</div>
        </div>
    </div>


</div>
</body>
</html>

