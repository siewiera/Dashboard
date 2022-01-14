<?php
session_start();

if (isset($_POST['imie'])) {

    $wszystko_OK = true;

    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $adres = $_POST['adres'];
    $nr_tel = $_POST['nr_tel'];

    // if ((strlen($imie) < 3)) {
    //     $wszystko_OK = false;
    //     $_SESSION['e_imie'] = "Wprowadź imię klienta! Min 3 znaki";
    // } else {
    //     $_SESSION['ok_imie'] = "<i class='icon-ok'></i>";
    // }

    // if ((strlen($nazwisko) < 3)) {
    //     $wszystko_OK = false;
    //     $_SESSION['e_nazwisko'] = "Wprowadź nazwisko klienta! Min 3 znaki";
    // } else {
    //     $_SESSION['ok_nazwisko'] = "<i class='icon-ok'></i>";
    // }

    if ((strlen($adres) < 3)) {
        $wszystko_OK = false;
        $_SESSION['e_adres'] = "Wprowadź adres! Min 3 znaki";
    } else {
        $_SESSION['ok_adres'] = "<i class='icon-ok'></i>";
    }

    if (!is_numeric($nr_tel)) {
        $wszystko_OK = false;
        $_SESSION['e_nr_tel'] = "Błędny nr telefonu! Nr składa się z 9 cyfr";
    } else if ((strlen($nr_tel) < 9) || (strlen($nr_tel) > 9)) {
        $wszystko_OK = false;
        $_SESSION['e_nr_tel'] = "Błędny nr telefonu! Nr składa się z 9 cyfr";
    } else {
        $_SESSION['ok_nr_tel'] = "<i class='icon-ok'></i>";
    }

    $_SESSION['fr_imie'] = $imie;
    $_SESSION['fr_nazwisko'] = $nazwisko;
    $_SESSION['fr_adres'] = $adres;
    $_SESSION['fr_nr_tel'] = $nr_tel;

    if ($wszystko_OK == true) {
        require_once 'database.php';

        $admin = filter_input(INPUT_POST, 'imie');
        $klientID = filter_input(INPUT_POST, 'klientID');
        $adres = filter_input(INPUT_POST, 'adres');
        $nr_tel = filter_input(INPUT_POST, 'nr_tel');


        $query = $db->prepare('INSERT INTO klient VALUES 
    (NULL, :imie, :nazwisko, :adres, :nr_tel)');

        $query->bindValue(':imie', $imie, PDO::PARAM_STR);
        $query->bindValue(':nazwisko', $nazwisko, PDO::PARAM_STR);
        $query->bindValue(':adres', $adres, PDO::PARAM_STR);
        $query->bindValue(':nr_tel', $nr_tel, PDO::PARAM_INT);

        $query->execute();

        $_SESSION['save_klient'] = true;
        header('Location: save-klient.php');
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style_wycena.css" />
    <title>Wycena serwisu</title>
</head>

<body>
    <div class="tlo"></div>
    <form method="post" class="form_serwis">


        <div class="napis_serwis">
            <h2>Wycena serwisu</h2>
        </div>

        <!-- <div class="logo">
            <div class="qs"><img src="photo/1.png" style="display: block; margin: auto" /></div>
        </div> -->

        <!-- 
        <div class="naglowek">
            <div class="wycena_label">
                <?php echo '<input class="admin_label" type="text" id="admin" name="admin" value="' .
                    $_SESSION['imie'] . '" required>'
                ?>
                <span class="admin_span">Serwisant</span>
            </div>
            <div class="wycena_label">
                <?php echo '<input class="data_label" type="text" name="data" id="data" value="' .
                    date('Y-m-d') . '" required>'
                ?> <span class="data_span">Data</span>
            </div>
        </div> -->
        <div class="panel_serwis">
            <!-- <div class="wycena_label">
                <?php echo '<input class="data_label" type="text" name="data" id="data" value="' .
                    $_SESSION['id'] . +.100 . '" required>'
                ?>
                <span class="imie_span">Nr serwisowy</span>
            </div> -->


            <!-- <div class="dane_klienta" id="dane_klienta">
                <h3>Dane klienta</h3>
                <div class="wycena_label">
                    <input class="imie_label" type="text" name="imie_k" id="imie_k" required>
                    <span class="imie_span">Imię</span>
                </div>
                <div class="wycena_label">
                    <input class="nazwisko_label" type="text" name="nazwisko_k" id="nazwisko_k" required>
                    <span class="nazwisko_span">Nazwisko</span>
                </div>
                <div class="wycena_label">
                    <input class="adres_label" type="text" name="adres" id="adres" required>
                    <span class="adres_span">Adres</span>
                </div>
                <div class="wycena_label">
                    <input class="nr_tel_label" type="text" name="nr_tel" id="nr_tel" required>
                    <span class="nr_tel_span">Nr tel</span>
                </div>
                <input type="button" class="dalej_sprzet" id="dalej_sprzet" value="Dalej">

            </div>
            <div class="dane_sprzetowe" id="dane_sprzetowe">
                <h3>Dane sprzętowe</h3>

                <div class="wycena_label">
                    <input class="sprzet_label" type="text" name="sprzet" id="sprzet" required>
                    <span class="sprzet_span">Sprzęt</span>
                </div>
                <div class="wycena_label">
                    <input class="marka_label" type="text" name="marka" id="marka" required>
                    <span class="marka_span">Marka</span>
                </div>
                <div class="wycena_label">
                    <input class="model_label" type="text" name="model" id="model" required>
                    <span class="model_span">Model</span>
                </div>
                <div class="wycena_label">
                    <input class="zestaw_label" type="text" name="zestaw" id="zestaw" required>
                    <span class="zestaw_span">Dołączono</span>
                </div>
                <div class="wycena_label">
                    <input class="opis_label" type="text" name="opis_usterki" id="opis" required>
                    <span class="opis_span">Opis usterki</span>
                </div>
                <input type="button" class="dalej_wycena" id="dalej_wycena" value="Dalej">
            </div> -->
            <div class="wycena" id="wycena">

                <div class="naglowek_serwis">
                    <h3>Dane płatnościowe</h3>
                </div>

                <div class="wycena_pojemnik">
                    <div class="wycena_label">
                        <input class="nazwa_label" type="text" name="nazwa" id="nazwa" required>
                        <span class="nazwa_span">Część/Usługa</span>
                    </div>
                    <div class="wycena_label">
                        <input class="ilosc_label" type="text" name="ilosc" id="ilosc" value='1' required>
                        <span class="ilosc_span">Ilość</span>
                        <span class="ilosc_span2">szt</span>
                    </div>
                    <div class="wycena_label">
                        <input class="cena_label" type="text" name="cena_podz" id="cena_podz" required>
                        <span class="cena_span">Cena części</span>
                        <span class="cena_span2">zł</span>
                    </div>
                    <div class="wycena_label">
                        <input class="cena_label" type="text" name="cena_uslugi" id="cena_uslugi" required>
                        <span class="cena_span">Cena usługi</span>
                        <span class="cena_span2">zł</span>
                    </div>
                    <div class="wycena_label">
                        <input class="marza_label" type="text" name="marza" id="marza" value='20' required>
                        <span class="marza_span">Marza</span>
                        <span class="marza_span2">%</span>

                        <input class="marza_label" type="text" name="wylicz_marza" id="wylicz_marza" required>
                        <span class="marza_zl_span2">zł</span>
                    </div>
                    <div class="wycena_label">
                        <input class="rabat_label" type="text" name="rabat" id="rabat" value='0' required>
                        <span class="rabat_span">Rabat</span>
                        <span class="rabat_span2">%</span>

                        <input class="rabat_label" type="text" name="wylicz_rabat" id="wylicz_rabat" required>
                        <span class="rabat_zl_span2">zł</span>
                    </div>
                    <div class="wycena_label">
                        <input class="naleznosc_label" type="text" name="naleznosc" id="naleznosc" value="0" required>
                        <span class="naleznosc_span">Należność</span>
                        <span class="naleznosc_span2">zł</span>
                    </div>
                    <div class="wycena_label">
                        <input class="zysk_label" type="text" name="zysk" id="zysk" value="0" required>
                        <span class="zysk_span">Zysk</span>
                        <span class="zysk_span2">zł</span>
                    </div>
                    <div class="wycena_label">
                        <select class="status_label" name="status" id="status" required>
                            <option>Do akceptacji</option>
                            <option>W trakcie</option>
                            <option>Zakończony</option>
                            <option>Anulowany</option>
                        </select>
                        <span class="status_span">Status</span>
                    </div>
                </div>
                <input type="submit" class="zapisz" id="zapisz" value="Zapisz">
            </div>
        </div>
    </form>
    <script src="script.js"></script>

    <script>
        // setInterval(function() {
        //     var imie_k = document.getElementById('imie_k').value;
        //     var nazwisko_k = document.getElementById('nazwisko_k').value;

        //     if (imie_k.length >= 3 && nazwisko_k.length >= 3) {
        //         document.getElementById("dalej_sprzet").style.display = "grid";

        //         const dalej_sprzet = document.querySelector('.dalej_sprzet');
        //         dalej_sprzet.addEventListener('click', function() {
        //             document.getElementById("dane_sprzetowe").style.display = "grid";

        //             document.getElementById("dane_klienta").style.display = "none";

        //         });
        //     } else {
        //         document.getElementById("dalej_sprzet").style.display = "none";

        //     }

        // }, 100);



        // const dalej_wycena = document.querySelector('.dalej_wycena');
        // dalej_wycena.addEventListener('click', function() {
        //     document.getElementById("wycena").style.display = "grid";
        //     document.getElementById("dane_sprzetowe").style.display = "none";
        // });
    </script>
</body>

</html>