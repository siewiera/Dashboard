<?php
session_start();
require_once 'database.php';

$status_3 = $db->prepare("SELECT distinct nr_wyceny, data, klientID FROM wycena");

if (isset($_POST['name'])) {
    if ($_POST['name'] == 'error' | $_POST['name'] == '') {
        $status_3 = $db->prepare("SELECT distinct nr_wyceny, data, klientID FROM wycena WHERE status LIKE 'Zakończony'");
    } else {
        $status_3 = $db->prepare("SELECT distinct nr_wyceny, data, klientID FROM wycena WHERE status LIKE 'Zakończony' AND klientID LIKE {$_POST['name']}");
    }
}
$status_3->execute();

foreach ($status_3 as $value) {

    echo "<form class='it-wycena3' action='podsumowanie_wyc.php' method='post'>
            <div class='wycena3' id='wycena3'>
                                                                
                <input class='nr_wyceny3' name='nr_wyceny' value='{$value['nr_wyceny']}'>
                <input class='data3' name='data' value='{$value['data']}'>  
                <input class='klientID3' name='klientID' value='{$value['klientID']}' style='display:none'> 
                                                                                                                                                                    
                <div class='wycena_panel'>
                    <input type='submit' class='podsumowanie3' id='podsumowanie' value='Podsumowanie wyceny'>                                                                                           
                </div>
            </div>
        </form>";
}
echo "<a class='rekordy-3' id='rekordy'>Wyceny ze statusem 'Zakończone': {$status_3->rowCount()}</a>";
