<?php

function v($text)
{
    echo '<pre>' . print_r($text, true) . '</pre>';
}

function rrr ($db,$suma,$id) {
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
