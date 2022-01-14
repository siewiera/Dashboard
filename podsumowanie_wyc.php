<?php
session_start();
// if (!isset($_SESSION['zalogowany'])) {
//     header('Location: index.php');
//     exit();
// }


if (isset($_SESSION['nazwisko'])) {
    require_once 'database.php';

    $nr_wyceny = $_POST['nr_wyceny'];
    $podsumowanie_wycena = $db->prepare('SELECT * FROM wycena WHERE nr_wyceny LIKE :nr_wyceny');
    $podsumowanie_wycena->bindValue(':nr_wyceny', $nr_wyceny, PDO::PARAM_STR);
    $podsumowanie_wycena->execute();

    $id_k = $_POST['klientID'];
    $podsumowanie_wycena_klient = $db->prepare('SELECT * FROM klient WHERE id LIKE :klientID');
    $podsumowanie_wycena_klient->bindValue(':klientID', $id_k, PDO::PARAM_INT);
    $podsumowanie_wycena_klient->execute();

    $podsumowanie_wycena_sprzet = $db->prepare('SELECT * FROM wycena WHERE nr_wyceny LIKE :nr_wyceny');
    $podsumowanie_wycena_sprzet->bindValue(':nr_wyceny', $nr_wyceny, PDO::PARAM_STR);
    $podsumowanie_wycena_sprzet->execute();

    $podsumowanie_wycena_platnosc = $db->prepare('SELECT * FROM wycena WHERE nr_wyceny LIKE :nr_wyceny');
    $podsumowanie_wycena_platnosc->bindValue(':nr_wyceny', $nr_wyceny, PDO::PARAM_STR);
    $podsumowanie_wycena_platnosc->execute();

    $podsumowanie_wycena_suma = $db->prepare('SELECT * FROM wycena WHERE nr_wyceny LIKE :nr_wyceny');
    $podsumowanie_wycena_suma->bindValue(':nr_wyceny', $nr_wyceny, PDO::PARAM_STR);
    $podsumowanie_wycena_suma->execute();
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style_wycena_pods.css" />
    <link rel="stylesheet" href="./css/fontello3/css/fontello.css" />
    <link rel="stylesheet" href="./css/fontello4/css/fontello.css" />
    <link rel="stylesheet" href="./css/fontello5/css/fontello.css" />
    <link rel="stylesheet" href="./css/fontello2/css/fontello.css" />
    <title>Podsumowanie wyceny serwisu</title>
</head>

<body>
    <div class="tlo"></div>
    <form class="form-podsumowanie-wyceny" method="post">
        <div class="inf-wstepne">
            <div class="lewa-str">
                <div class="logo">
                    <a href="dashboard.php">
                        <div class="qs"><img src="image/qs2.png" style="display: block; margin: auto"></div>
                    </a>
                </div>
            </div>
            <div class="prawa-str">
                <div class="napis-podsumowanie">
                    <h1 class="tytul">Podsumowanie wyceny</h1>
                </div>
                <div class="dane-wyceny">

                    <?php
                    foreach ($podsumowanie_wycena as $value) {
                        echo "<div class='nr_wyceny-poj'>
                            Nr wyceny <i class='nr_wyceny'>{$value['nr_wyceny']}</i>
                            </div>";
                        echo "<div class='data-poj'>
                            Data <i class='nr_wyceny'>{$value['data']}</i>
                            </div>";
                        break;
                    }
                    ?>

                </div>
                <div class="dane">

                    <div class="dane-klienta">
                        <div class="napis-klient">
                            <h2 class="tytul-dane">Dane klienta</h2>
                        </div>
                        <div class="klient-wyc">
                            <?php
                            foreach ($podsumowanie_wycena_klient as $value) {

                                echo "<div class='imie-poj'> 
                                        Imię: <i class='imie'> {$value['imie']}</i>
                                    </div>

                                    <div class='nazwisko-poj'>
                                        Nazwisko:<i class='nazwisko'> {$value['nazwisko']}</i>
                                    </div>

                                    <div class='adres-poj'>
                                        Adres:<i class='adres'> {$value['adres']}</i>
                                    </div>

                                    <div class='nr_tel-poj'>
                                        Nr kontaktowy:<i class='nr_tel'> {$value['nr_tel']}</i>
                                    </div>";
                            }
                            ?>


                        </div>
                    </div>
                    <div class="dane-sprzetowe">
                        <div class="napis-sprzet">
                            <h2 class="tytul-dane">Dane sprzetowe</h2>
                        </div>
                        <div class="sprzet-wyc">
                            <?php
                            foreach ($podsumowanie_wycena_sprzet as $value) {

                                echo "<div class='sprzet-poj'> 
                                        Sprzęt: <i class='sprzet'> {$value['sprzet']}</i>
                                    </div>

                                    <div class='marka-poj'>
                                        Marka:<i class='marka'> {$value['marka']}</i>
                                    </div>

                                    <div class='model-poj'>
                                        Model:<i class='model'> {$value['model']}</i>
                                    </div>

                                    <div class='zestaw-poj'>
                                        Zestaw zawiera:<i class='zestaw'> {$value['zestaw']}</i>
                                    </div>

                                    <div class='opis-poj'>
                                        Opis usterki:<i class='opis'> {$value['opis_usterki']}</i>
                                    </div>";
                                break;
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="inf-platnosciowe">

            <div class="napis-platnosc">
                <h2 class="tytul-dane">Dane płatnościowe</h2>
            </div>
            <div class="dane-platnosciowe">
                <table>
                    <thead>
                        <tr>
                            <th class="head-id">Nr</th>
                            <th class="head-nazwa">Część/Usługa</th>
                            <th class="head-ilosc">Ilość</th>
                            <th class="head-czesc">Cena części</th>
                            <th class="head-usluga">Cena usługi</th>
                            <th class="head-rabat">Rabat</th>
                            <th class="head-naleznosc">Należność</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($podsumowanie_wycena_platnosc as $value) {
                            $cz = $value['cena_podz'];
                            $m = $value['marza_zl'];
                            $suma = $cz + $m;
                            $i++;
                            echo "<tr>
                                <td class='id-poj'><i class='id'>$i</i></td>
                                <td class='nazwa-poj'><i class='nazwa'> {$value['nazwa']}</i></td>
                                <td class='ilosc-poj'><i class='ilosc'> {$value['ilosc']} szt</i></td>
                                <td class='czesc-poj'><i class='czesc' id='czesc$i'>$suma zł</i></td>
                                <td class='usluga-poj'><i class='usluga'> {$value['cena_uslugi']} zł</i></td>
                                <td class='rabat-poj'><i class='rabat'> {$value['rabat']} %</i></td>
                                <td class='naleznosc-poj'><i class='naleznosc'> {$value['naleznosc']} zł</i></td>
                            <tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="platnosc-suma">
                <?php
                $i = 0;
                foreach ($podsumowanie_wycena_suma as $value) {
                    echo "<i class='tekst-suma'>Suma </i><input type='text' class='naleznosc_suma' id='naleznosc_suma' name='naleznosc_suma' value='{$value['naleznosc_suma']} zł'>";
                    break;
                }
                ?>
            </div>
            <div class="podsumowanie-serwisu">

                <i class="podpis-serwisant">Podpis serwisanta .........................</i>
                <i class="podpis-klient">Podpis klienta .........................</i>

            </div>
        </div>

    </form>
</body>

</html>