<?php
session_start();
require_once 'helpers.php';
require_once 'connect.php';

$db = new mysqli($host, $db_user, $db_password, $db_name);

if (!empty($_POST)) {
    $query = "INSERT INTO rekord(alcohol_id,quantity) VALUES($_POST[alcohol],$_POST[ilosc])";
    $db->query($query);
}
$query = "SELECT * FROM rekord WHERE created_on >= '2022-12-01'";
$wyniki = $db->query($query)->fetch_all();


$sumap = 0;
foreach ($wyniki as $wynik) {
    if ($wynik[1] === '1') {
        $sumap = $sumap + (int)$wynik[3];
    }
}
$sumaw = 0;
foreach ($wyniki as $wynik) {
    if ($wynik[1] === '2') {
        $sumaw = $sumaw + (int)$wynik[3];
    }
}
$sumaj = 0;
foreach ($wyniki as $wynik) {
    if ($wynik[1] === '3') {
        $sumaj = $sumaj + (int)$wynik[3];
    }
}
$sumar = 0;
foreach ($wyniki as $wynik) {
    if ($wynik[1] === '4') {
        $sumar = $sumar + (int)$wynik[3];
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Popraw rekord</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<h1><a href="index.php">Główna</a> </h1>
<form method="post">

    Ilość: <br/> <input autocomplete="off" type="" name="ilosc"> <br/> <br/>

    <label for="alcohol">Typ alkoholu:</label>

    <select name="alcohol" id="alcohol">
        <option value="1">Piwsko</option>
        <option value="2">Wóda</option>
        <option value="3">Jabolce</option>
        <option value="4">Ruda</option>
    </select> <br>
    <button type="submit" >Zapisz</button>
    <br> <br>
    Piwa wypite w tym miesiącu:
    <?php
    echo $sumap;
    ?>
    <br>
    Wóda wypita w tym miesiącu:
    <?php
    echo $sumaw
    ?>
    <br>
    Jabole wypite w tym miesiącu:
    <?php
    echo $sumaj
    ?>
    <br>
    Ruda wypita w tym miesiącu:
    <?php
    echo $sumar
    ?>


</form>

</body>
</html>

