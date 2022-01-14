<?php
session_start();
require_once 'database.php';
$blad = 'Błąd 68';
if (isset($_SESSION['e_imie'])) {
    echo "<div class='error2'>' .
                                    '<ul class='error-pojemnik2'>' . {$_SESSION['e_imie']}
                                    . '<li>'
                                    . '<ul class='error-pojemnik3'>' . {$_SESSION['e_imie2']} . '</ul>'
                                    . '</li>'
                                    . '</ul>'
                                    . '</div>";
    unset($_SESSION['e_imie']);
}
if (isset($_SESSION['ok_imie'])) {
    echo "<div class='ok2'>' .
                                    '<div class='ok-pojemnik2'>' . {$_SESSION['ok_imie']} . '</div>' . '</div>";
    unset($_SESSION['ok_imie']);
}

if (isset($_SESSION['e_nazwisko'])) {
    echo "<div class='error2'>' .
                                    '<ul class='error-pojemnik2'>' . {$_SESSION['e_nazwisko']}
                                    . '<li>'
                                    . '<ul class='error-pojemnik'>' . {$_SESSION['e_nazwisko2']} . '</ul>'
                                    . '</li>'
                                    . '</ul>'
                                    . '</div>";
    unset($_SESSION['e_nazwisko']);
}
if (isset($_SESSION['ok_nazwisko'])) {
    echo "<div class='ok2'>' .
                                    '<div class='ok-pojemnik2'>' . {$_SESSION['ok_nazwisko']} . '</div>' . '</div>";
    unset($_SESSION['ok_nazwisko']);
}

if (isset($_SESSION['e_adres'])) {
    echo "<div class='error2'>' .
                                    '<ul class='error-pojemnik2'>' . {$_SESSION['e_adres']}
                                    . '<li>'
                                    . '<ul class='error-pojemnik3'>' . {$_SESSION['e_adres2']} . '</ul>'
                                    . '</li>'
                                    . '</ul>'
                                    . '</div>";
    unset($_SESSION['e_adres']);
}
if (isset($_SESSION['ok_adres'])) {
    echo "<div class='ok2'>' .
                                    '<div class='ok-pojemnik2'>' . {$_SESSION['ok_adres']} . '</div>' . '</div>";
    unset($_SESSION['ok_adres']);
}

if (isset($_SESSION['e_nr_tel'])) {
    echo "<div class='error2'>' .
                                    '<ul class='error-pojemnik2'>' . {$_SESSION['e_nr_tel']}
                                    . '<li>'
                                    . '<ul class='error-pojemnik3'>' . {$_SESSION['e_nr_tel2']} . '</ul>'
                                    . '</li>'
                                    . '</ul>'
                                    . '</div>";
    unset($_SESSION['e_nr_tel']);
}
if (isset($_SESSION['ok_nr_tel'])) {
    echo "<div class='ok2'>' .
                                    '<div class='ok-pojemnik2'>' . {$_SESSION['ok_nr_tel']} . '</div>' . '</div>";
    unset($_SESSION['ok_nr_tel']);
}

// wyszukanie klienta po id
if (isset($_POST['name'])) {
    $szukaj_klienta = $db->prepare("SELECT * FROM klient WHERE id LIKE {$_POST['name']}");
    $szukaj_klienta->execute();
    if ($szukaj_klienta->rowCount() == 1) {
        foreach ($szukaj_klienta as $value)
            // echo $value['imie'];
            echo "<div class='wycena_label' id='wycena_label1'>
                            <input class='imie_label' type='text' name='imie' id='imie' value='{$value['imie']}' required>
                            <span class='imie_span'>Imię</span>                                                        
                        </div>
                        <div class='wycena_label' id='wycena_label1'>
                            <input class='nazwisko_label' type='text' name='nazwisko' id='nazwisko' value='{$value['nazwisko']}' required>
                            <span class='nazwisko_span'>Nazwisko</span>                     
                        </div>
                        <div class='wycena_label' id='wycena_label1'>
                            <input class='adres_label' type='text' name='adres' id='adres' value='{$value['adres']}' required>
                            <span class='adres_span'>Adres</span>                      
                        </div>
                        <div class='wycena_label'>
                            <input class='nr_tel_label' type='text' name='nr_tel' id='nr_tel' value='{$value['nr_tel']}' required>
                            <span class='nr_tel_span'>Nr tel</span>                    
                        </div>";
    } else {

        echo "<div class='wycena_label' id='wycena_label1'>
                            <input class='imie_label' type='text' name='imie' id='imie' value='{$blad}' required>
                            <span class='imie_span'>Imię</span>                                                        
                        </div>
                        <div class='wycena_label' id='wycena_label1'>
                            <input class='nazwisko_label' type='text' name='nazwisko' id='nazwisko' value='{$blad}' required>
                            <span class='nazwisko_span'>Nazwisko</span>                     
                        </div>
                        <div class='wycena_label' id='wycena_label1'>
                            <input class='adres_label' type='text' name='adres' id='adres' value='{$blad}' required>
                            <span class='adres_span'>Adres</span>                      
                        </div>
                        <div class='wycena_label'>
                            <input class='nr_tel_label' type='text' name='nr_tel' id='nr_tel' value='{$blad}' required>
                            <span class='nr_tel_span'>Nr tel</span>                    
                        </div>";
    }
} else if ($_POST['name'] == '') {
    echo "<div class='wycena_label' id='wycena_label1'>
                            <input class='imie_label' type='text' name='imie' id='imie' value='{$blad}' required>
                            <span class='imie_span'>Imię</span>                                                        
                        </div>
                        <div class='wycena_label' id='wycena_label1'>
                            <input class='nazwisko_label' type='text' name='nazwisko' id='nazwisko' value='{$blad}' required>
                            <span class='nazwisko_span'>Nazwisko</span>                     
                        </div>
                        <div class='wycena_label' id='wycena_label1'>
                            <input class='adres_label' type='text' name='adres' id='adres' value='{$blad}' required>
                            <span class='adres_span'>Adres</span>                      
                        </div>
                        <div class='wycena_label'>
                            <input class='nr_tel_label' type='text' name='nr_tel' id='nr_tel' value='{$blad}' required>
                            <span class='nr_tel_span'>Nr tel</span>                    
                        </div>";
}
