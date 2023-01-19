<?php

$host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "piwo";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

$rezultat = $polaczenie->query("SELECT * FROM `rekord` WHERE `alcohol_id` = 1 AND `created_on` >= '2022-12-01' AND `created_on` <= '2022-12-30'");

echo '<pre>';

foreach($rezultat as $row) {
   print_r($row);
}