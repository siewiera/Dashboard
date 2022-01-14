<?php
session_start();
require_once 'database.php';

$status_2 = $db->prepare("SELECT distinct nr_wyceny, data, klientID FROM wycena");

if (isset($_POST['name'])) {
    if ($_POST['name'] == 'error' | $_POST['name'] == '') {
        $status_2 = $db->prepare("SELECT distinct nr_wyceny, data, klientID FROM wycena WHERE status LIKE 'W trakcie'");
    } else {
        $status_2 = $db->prepare("SELECT distinct nr_wyceny, data, klientID FROM wycena WHERE status LIKE 'W trakcie' AND klientID LIKE {$_POST['name']}");
    }
}
$status_2->execute();

foreach ($status_2 as $value) {

    echo "<form class='it-wycena2' action='podsumowanie_wyc.php' method='post'>
                <div class='wycena2' id='wycena2'>

                <input class='nr_wyceny2' name='nr_wyceny' value='{$value['nr_wyceny']}'> 
                <input class='data2' name='data' value='{$value['data']}'>
                <input class='klientID2' name='klientID' value='{$value['klientID']}' style='display:none'> 
                                                                                                                                                                   
                <div class='wycena_panel'>
                    <input type='submit' class='podsumowanie2' id='podsumowanie' value='Podsumowanie wyceny'>                                                                                           
                </div>
            </div>
        </form>";
}
echo "<a class='rekordy-2' id='rekordy'>Wyceny ze statusem 'W trakcie': {$status_2->rowCount()}</a>";
