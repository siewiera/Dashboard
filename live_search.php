<?php
session_start();
require_once 'database.php';

if (isset($_POST['name'])) {

    $live_search = $db->prepare("SELECT * FROM klient WHERE imie LIKE '%{$_POST['name']}%' OR nazwisko LIKE '%{$_POST['name']}%'");
    $live_search->execute();

    if ($live_search->rowCount() == 0) {
        echo "error";
    } else if ($live_search->rowCount() >= 2) {
        echo "error";
    } else if ($_POST['name'] == '') {
        echo "error";
    } else {
        foreach ($live_search as $value) {
            echo $value['id'];
        }
    }
}
