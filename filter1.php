<?php
session_start();
require_once 'database.php';

$status_1 = $db->prepare("SELECT distinct nr_wyceny, data, klientID FROM wycena");

if (isset($_POST['name'])) {
    if ($_POST['name'] == 'error' | $_POST['name'] == '') {
        $status_1 = $db->prepare("SELECT distinct nr_wyceny, data, klientID FROM wycena WHERE status LIKE 'Do akceptacji'");
    } else {
        $status_1 = $db->prepare("SELECT distinct nr_wyceny, data, klientID FROM wycena WHERE status LIKE 'Do akceptacji' AND klientID LIKE {$_POST['name']}");
    }
}
$status_1->execute();

foreach ($status_1 as $value) {

    echo "<form class='it-wycena1' action='podsumowanie_wyc.php' method='post'>
            <div class='wycena1' id='wycena1' >
                                                                
                <input class='nr_wyceny1' name='nr_wyceny' value='{$value['nr_wyceny']}'>
                <input class='data1' name='data' value='{$value['data']}'>  
                <input class='klientID1' name='klientID' value='{$value['klientID']}' style='display:none'> 
                                                                                                                                                                   
                <div class='wycena_panel'>
                    <input type='submit' class='podsumowanie1' id='podsumowanie' value='Podsumowanie wyceny'>                                                                                           
                </div>
            </div>
        </form>";
}
echo "<a class='rekordy-1' id='rekordy'>Wyceny ze statusem 'Do akceptacji': {$status_1->rowCount()}</a>";
