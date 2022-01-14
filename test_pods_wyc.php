<?php
session_start();
if (!isset($_SESSION['zalogowany'])) {
    header('Location: index.php');
    exit();
}
require_once 'database.php';
$podsumowanie_wycena = $db->query('SELECT * FROM wycena WHERE nr_wyceny="W101"');
$status = $podsumowanie_wycena->fetchAll();
$podsumowanie_wycena->execute();

// $podsumowanie_wycena_klient = $db->query('SELECT * FROM klient WHERE id=');
// $status_klient = $podsumowanie_wycena_klient->fetchAll();
// $podsumowanie_wycena_klient->execute();
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
    <form class="form-podsumowanie-wyceny" method="GET">
        <div class="inf-wstepne">
            <div class="lewa-str">
                <div class="logo">
                    <div class="qs"><img src="image/qs2.png" style="display: block; margin: auto" /></div>
                </div>
            </div>
            <div class="prawa-str">
                <div class="napis-podsumowanie">
                    <h1 class="tytul">Podsumowanie wyceny</h1>
                </div>
                <div class="dane-wyceny">
                    <div class="nr_wyceny-poj">
                        <?php
                        foreach ($podsumowanie_wycena as $row) {
                            echo "Nr wyceny <i class='nr_wyceny'>{$row['nr_wyceny']}</i>";
                            break;
                        }
                        ?>
                    </div>
                    <div class="data-poj">
                        <?php
                        foreach ($podsumowanie_wycena as $row) {

                            echo "Data 
                    <i class='data'>{$row['data']}</i>
                    ";
                            break;
                        }

                        ?>
                    </div>
                </div>
                <div class="dane">

                    <div class="dane-klienta">
                        <div class="napis-klient">
                            <h2 class="tytul-dane">Dane klienta</h2>
                        </div>
                        <div class="klient">

                        </div>
                    </div>
                    <div class="dane-sprzetowe"> </div>
                </div>

            </div>
        </div>
        <div class="inf-platnosciowe"></div>
        <div class="podsumowanie-serwisu"></div>
    </form>
</body>

</html>