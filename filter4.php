<?php
session_start();
require_once 'database.php';

$status_4 = $db->prepare("SELECT distinct nr_wyceny, data, klientID FROM wycena");

if (isset($_POST['name'])) {
    if ($_POST['name'] == 'error' | $_POST['name'] == '') {
        $status_4 = $db->prepare("SELECT distinct nr_wyceny, data, klientID FROM wycena WHERE status LIKE 'Anulowany'");
    } else {
        $status_4 = $db->prepare("SELECT distinct nr_wyceny, data, klientID FROM wycena WHERE status LIKE 'Anulowany' AND klientID LIKE {$_POST['name']}");
    }
}
$status_4->execute();
foreach ($status_4 as $value) {
    echo "<form class='it-wycena4' action='podsumowanie_wyc.php' method='post'>
            <div class='wycena4' id='wycena4'>
                                                                
                <input class='nr_wyceny4' name='nr_wyceny' value='{$value['nr_wyceny']}'>
                <input class='data4' name='data' value='{$value['data']}'>  
                <input class='klientID4' name='klientID' value='{$value['klientID']}' style='display:none'> 
                                                                                                                                                                    
                <div class='wycena_panel'>
                    <input type='submit' class='podsumowanie4' id='podsumowanie' value='Podsumowanie wyceny'>                                                                                           
                </div>
            </div>
        </form>";
}
echo "<a class='rekordy-4' id='rekordy'>Wyceny ze statusem 'Anulowane': {$status_4->rowCount()}</a>";
