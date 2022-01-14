<?php
session_start();
require_once 'database.php';


// wyszukanie admina po id
if (isset($_POST['name'])) {
    $szukaj_admin = $db->prepare("SELECT * FROM admins WHERE id LIKE {$_POST['name']}");
    $szukaj_admin->execute();
    if ($szukaj_admin->rowCount() == 1) {
        foreach ($szukaj_admin as $value) {
            echo $value['imie'] . " " . $value['nazwisko'];
        }
    } else {
        echo "Błąd 69";
    }
}
