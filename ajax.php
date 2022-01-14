<?php
session_start();
require_once 'database.php';

// wszystkie wprowadzone wyceny
// $klient_wycenaQuery = $db->prepare("SELECT nr_wyceny FROM wycena WHERE klientID LIKE {$_POST['name']}");
// $klient_wycenaQuery->execute();


// do akceptacji
$wycena_inf1 = $db->prepare("SELECT DISTINCT nr_wyceny FROM wycena WHERE klientID LIKE {$_POST['name']} AND status LIKE 'Do akceptacji'");
$wycena_inf1->execute();

echo "<div class='nr_wyceny-l'> Do akceptacji: {$wycena_inf1->rowCount()}</div>";

foreach ($wycena_inf1 as $value) {
    if ($wycena_inf1->rowCount() == null) {
        echo "<div class='nr_wyceny-inf'>Brak wycen o statusie 'Do akceptacji'</div";
    } else {
        echo "<div class='nr_wyceny-inf'> {$value['nr_wyceny']}</div>";
    }
}

// w trakcie
$wycena_inf2 = $db->prepare("SELECT DISTINCT nr_wyceny FROM wycena WHERE klientID LIKE {$_POST['name2']} AND status LIKE 'W trakcie'");
$wycena_inf2->execute();

echo "<div class='nr_wyceny-l'> W trakcie: {$wycena_inf2->rowCount()}</div>";

foreach ($wycena_inf2 as $value) {
    if ($wycena_inf2->rowCount() == null) {
        echo "<div class='nr_wyceny-inf'>Brak wycen o statusie 'W trakcie'</div>'";
    } else {
        echo "<div class='nr_wyceny-inf'> {$value['nr_wyceny']}</div>";
    }
}

// zakończony
$wycena_inf3 = $db->prepare("SELECT DISTINCT nr_wyceny FROM wycena WHERE klientID LIKE {$_POST['name3']} AND status LIKE 'Zakończony'");
$wycena_inf3->execute();

echo "<div class='nr_wyceny-l'> Zakończony: {$wycena_inf3->rowCount()}</div>";

foreach ($wycena_inf3 as $value) {
    if ($wycena_inf3->rowCount() == null) {
        echo "<div class='nr_wyceny-inf'>Brak wycen o statusie 'Zakończony'</div>";
    } else {
        echo "<div class='nr_wyceny-inf'> {$value['nr_wyceny']}</div>";
    }
}

// anulowany
$wycena_inf4 = $db->prepare("SELECT DISTINCT nr_wyceny FROM wycena WHERE klientID LIKE {$_POST['name4']} AND status LIKE 'Anulowany'");
$wycena_inf4->execute();

echo "<div class='nr_wyceny-l'> Anulowany: {$wycena_inf4->rowCount()}</div>";

foreach ($wycena_inf4 as $value) {
    if ($wycena_inf4->rowCount() == null) {
        echo "<div class='nr_wyceny-inf'>Brak wycen o statusie 'Anulowany'</div>";
    } else {
        echo "<div class='nr_wyceny-inf'> {$value['nr_wyceny']}</div>";
    }
}
