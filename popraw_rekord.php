<?php
session_start();
if ($_SESSION['logged'] === true) {
    require_once 'helpers.php';
    require_once 'connect.php';
    $db = new mysqli($host, $db_user, $db_password, $db_name);

    $query2 = "SELECT * FROM gramatura";
    $gramaturyQuery = $db->query($query2);
    $gramatury = $gramaturyQuery->fetch_all();

    $query = "SELECT * FROM alcohols";
    $alcoholsQuery = $db->query($query);
    $alcohols = $alcoholsQuery->fetch_all();

    if (isset($_POST['submit'])) {
        $alcohol = $_POST['alcohol'];
        $gramatura = $_POST['gramatura'];
        $wszystkoOk = true;

        if ($alcohol == 1 && $gramatura == 2) {
            $wszystkoOk = false;
            $gramaturaError = 'Piwo liczymy na sztuki!';
        }
        if ($_POST['number'] < 0) {
            $wszystkoOk = false;
            $numberError = "Nie oszukuj!";
        }
        if (empty($_POST['number'])) {
            $wszystkoOk = false;
            $numberError = "Wpisz liczbe!";
        }
        if (($alcohol == 2 || $alcohol == 3 || $alcohol == 4 || $alcohol == 5) && $gramatura == 1) {
            $wszystkoOk = false;
            $gramaturaError = 'Tylko piwo liczymy na sztuki!';
        }

        if ($wszystkoOk === true) {
            $query = "INSERT INTO rekord(alcohol_id,quantity,gramatura, user_id) VALUES($_POST[alcohol],$_POST[number],$_POST[gramatura], $_SESSION[userId])";
            $db->query($query);
            header('Location: index.php');
        }
    }
} else {
    header('Location: index.php');
}
$number = "<input type='number' name='number' placeholder='8' style='border: none; width: 100px; height: 60px;
font-size: 60px;-moz-appearance: textfield; color: dimgray; text-align: right; font-weight: normal'"

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
    <div class="by-marcin mb-60">by Marcin</div>
    <div class="color mb-20">
        <div class="poprawianie-rekordu" style="font-size: 15px">Poprawianie rekordu</div> <br>
        <div class="alcohol mb-15 letter-size" style="clear: both; font-size: 13px">ile / gramatura</div>
        <div class="quantity letter-size-s" style="font-size: 15px">co</div>
        <div class="clearfix"></div>
        <div class="stripe mt-0"></div>
        <div class="quantity letter-size-b"></div>
    </div>
    <form method="post">
        <div class="color">
            <div class="box-left">
                <div class="vertical-stripe-short"></div>

                <div class="" style="margin-right: 15px; margin-top: -7px">
                    <?php echo $number; ?>

                    <div class="number-margin"></div>
                    <div class="font-weight text-uppercase" style="font-size: 13px">

                        <?php
                        $i = 0;
                        foreach ($gramatury as $gramatura) {
                            $checked = '';
                            $marginTop = '';
                            if ($i === 0) {
                                $checked = 'checked';
                                $marginTop = 'margin-top: 44px';
                                $i++;
                            }
                            echo "<span>" . $gramatura[1] . "</span>"
                                . "<input type='radio' name='gramatura' style='margin-bottom: 15px;$marginTop'" . $checked . " value='$gramatura[0]'><br>";
                        }
                        ?>
                    </div>
                    <?php
                    if (isset($gramaturaError)) {
                        echo "<div class='error'>$gramaturaError</div>";
                    }
                    if (isset($numberError)) {
                        echo "<div class='error'>$numberError</div>";
                    }
                    ?>
                </div>
            </div>
            <div class="box-right">
                <div class="vertical-stripe"></div>
                <div class="font-weight text-uppercase mb-20 ml-15 color" style="position: relative; z-index: 1">
                    <?php
                    $i = 0;
                    foreach ($alcohols as $alcohol) {
                        $checked = '';
                        if ($i === 0) {
                            $checked = 'checked';
                            $i++;
                        }
                        echo "<input type='radio' name='alcohol' style='margin-bottom: 15px'" . $checked . " value='$alcohol[0]'> $alcohol[1] <br>";
                    }
                    ?>
                </div>
            </div>
            <div class="clearfix"></div>
            <button type="submit" name="submit" class="popraw-rekord clearfix mb-20 pointer" style="margin-bottom: 0px">Popraw</button>
        </div>
    </form>
</div>


</div>

</body>
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
</html>
