<?php

function v($text)
{
    echo '<pre>' . print_r($text, true) . '</pre>';
}

function rrr($db, $suma, $id)
{
    if ($suma != 0) {
        if (is_numeric($suma) && $suma > 1000) {
            $name = 'ok. ' . $suma / 1000 . ' l.';
        } else {
            $query = "SELECT * FROM gramatura WHERE id = $id";
            $result = $db->query($query)->fetch_assoc();
            $name = 'ok. ' . $suma . ' ' . $result['name'];
        }
    } else {
        $name = 'Nie było pite';
    }
    return $name;
}

function mostAlcohol($alcoholId, &$alcoholResults, $results)
{
    foreach ($results as $result) {
        if ($result['alcohol_id'] === $alcoholId) {
            $createdOn = new DateTime($result['created_on']);
            $date = $createdOn->format('Y-m');
            if (!isset($alcoholResults[$date])) {
                $alcoholResults[$date] = 0;
            }
            $alcoholResults[$date] += $result['quantity'];
        }
    }
}
