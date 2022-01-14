<?php
session_start();
require_once 'database.php';
$status_1 = $db->prepare("SELECT distinct nr_wyceny, data, klientID FROM wycena");

if (isset($_POST['name2'])) {

    if ($_POST['name'] == 'error') {
        $status_1 = $db->prepare("SELECT distinct nr_wyceny, data, klientID FROM wycena WHERE status LIKE '{$_POST['name2']}'");
    } else {
        $status_1 = $db->prepare("SELECT distinct nr_wyceny, data, klientID FROM wycena WHERE status LIKE '{$_POST['name2']}' AND klientID LIKE {$_POST['name']}");
    }
}
$status_1->execute();

foreach ($status_1 as $value) {

    echo "<form class='it-wycena1' action='podsumowanie_wyc.php' method='post'>
                                                             <div class='wycena1' id='wycena1' >
                                                                
                                                                <input class='nr_wyceny1' name='nr_wyceny' value='{$value['nr_wyceny']}' >
                                                                <input class='data1' name='data' value='{$value['data']}' >  
                                                                <input class='klientID1' name='klientID' value='{$value['klientID']}' > 
                                                                                                                                                                    
                                                                <div class='wycena_panel'>
                                                                    <input type='submit' class='podsumowanie1' id='podsumowanie' value='Podsumowanie wyceny'>                                                                                           
                                                                </div>
                                                            </div>
                                                        </form>";
}

// if (isset($_POST['name'])) {
//     if ($_POST['name'] == 'error') {
//         $status_2 = $db->prepare("SELECT distinct nr_wyceny, data, klientID FROM wycena WHERE status='W trakcie'");
//     } else {
//         $status_2 = $db->prepare("SELECT distinct nr_wyceny, data, klientID FROM wycena WHERE status='W trakcie' AND klientID LIKE {$_POST['name']}");
//     }

//     $status_2->execute();
//     foreach ($status_2 as $value) {

//         echo "<form class='it-wycena2' action='podsumowanie_wyc.php' method='post'>
//                                                              <div class='wycena2' id='wycena2'>
                                                                
//                                                                 <input class='nr_wyceny2' name='nr_wyceny' value='{$value['nr_wyceny']}' >
//                                                                 <input class='data2' name='data' value='{$value['data']}' >  
//                                                                 <input class='klientID2' name='klientID' value='{$value['klientID']}' > 
                                                                                                                                                                    
//                                                                 <div class='wycena_panel'>
//                                                                     <input type='submit' class='podsumowanie2' id='podsumowanie' value='Podsumowanie wyceny'>                                                                                           
//                                                                 </div>
//                                                             </div>
//                                                         </form>";
//     }
// }
// if (isset($_POST['name'])) {
//     if ($_POST['name'] == 'error') {
//         $status_3 = $db->prepare("SELECT distinct nr_wyceny, data, klientID FROM wycena WHERE status='Zakończony'");
//     } else {
//         $status_3 = $db->prepare("SELECT distinct nr_wyceny, data, klientID FROM wycena WHERE status='Zakończony' AND klientID LIKE {$_POST['name']}");
//     }

//     $status_3->execute();
//     foreach ($status_3 as $value) {

//         echo "<form class='it-wycena3' action='podsumowanie_wyc.php' method='post'>
//                                                              <div class='wycena3' id='wycena3'>
                                                                
//                                                                 <input class='nr_wyceny3' name='nr_wyceny' value='{$value['nr_wyceny']}' >
//                                                                 <input class='data3' name='data' value='{$value['data']}' >  
//                                                                 <input class='klientID3' name='klientID' value='{$value['klientID']}' > 
                                                                                                                                                                    
//                                                                 <div class='wycena_panel'>
//                                                                     <input type='submit' class='podsumowanie3' id='podsumowanie' value='Podsumowanie wyceny'>                                                                                           
//                                                                 </div>
//                                                             </div>
//                                                         </form>";
//     }
// }
// if (isset($_POST['name'])) {
//     if ($_POST['name'] == 'error') {
//         $status_4 = $db->prepare("SELECT distinct nr_wyceny, data, klientID FROM wycena WHERE status='Anulowany'");
//     } else {
//         $status_4 = $db->prepare("SELECT distinct nr_wyceny, data, klientID FROM wycena WHERE status='Anulowany' AND klientID LIKE {$_POST['name']}");
//     }

//     $status_4->execute();
//     foreach ($status_4 as $value) {
//         echo "<form class='it-wycena4' action='podsumowanie_wyc.php' method='post'>
//                                                              <div class='wycena4' id='wycena4'>
                                                                
//                                                                 <input class='nr_wyceny4' name='nr_wyceny' value='{$value['nr_wyceny']}' >
//                                                                 <input class='data4' name='data' value='{$value['data']}' >  
//                                                                 <input class='klientID4' name='klientID' value='{$value['klientID']}' > 
                                                                                                                                                                    
//                                                                 <div class='wycena_panel'>
//                                                                     <input type='submit' class='podsumowanie4' id='podsumowanie' value='Podsumowanie wyceny'>                                                                                           
//                                                                 </div>
//                                                             </div>
//                                                         </form>";
//     }
// }
