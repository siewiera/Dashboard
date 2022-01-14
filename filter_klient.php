<?php
session_start();
require_once 'database.php';

$select_klient = $db->prepare("SELECT * FROM klient");

if (isset($_POST['name'])) {
    if ($_POST['name'] == 'error' | $_POST['name'] == '') {
        $select_klient = $db->prepare("SELECT * FROM klient");
    } else {
        $select_klient = $db->prepare("SELECT * FROM klient WHERE imie LIKE '%{$_POST['name']}%' OR nazwisko LIKE '%{$_POST['name']}%'");
    }
}
$select_klient->execute();

$i = 0;
foreach ($select_klient as $value) {
    $i++;
    echo "<form class='it-klient'>
                                                    <div class='klient' id='klient'>                                             
                                                        <input class='imie-klient' name='imie$i' value='{$value['imie']}'>
                                                        <input class='nazwisko-klient' name='nazwisko$i' value='{$value['nazwisko']}'>
                                                        <div class='klient-panel'>
                                                            <input class='adres-klient' name='adres$i' value='{$value['adres']}'>
                                                            <input class='nr_tel-klient' name='nr_tel$i' value='{$value['nr_tel']}'>
                                                            <div class='inf-box'>
                                                                <span class='inf'>i
                                                                <div class='dodatkowe-inf'>
                                                            <span class='text-id'>Id: <input class='id-klient' name='klientID' id='klientID$i'  value='{$value['id']}'></span>
                                                            <div class='text' id='wynik_wycena$i'></div>                                                             
                                                        </div> 
                                                                </span>  
                                                            </div>                                                                                                       
                                                        </div>
                                                        
                                                    </div>
                                            </form>";
}
if ($select_klient->rowCount() <= 0) {
    $klient = 'klientów';
}
if ($select_klient->rowCount() == 1) {
    $klient = 'klienta';
}
if ($select_klient->rowCount() > 1) {
    $klient = 'klientów';
}
echo "<span class='ilosc-klient_wysz' id='ilosc-klient_wysz'>Wyszukano: {$select_klient->rowCount()} $klient</span>";
