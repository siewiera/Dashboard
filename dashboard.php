<?php
session_start();
if (!isset($_SESSION['zalogowany'])) {
    header('Location: index.php');
    exit();
}

require_once 'database.php';

$usersQuery = $db->query('SELECT * FROM admins');
$serwis = $usersQuery->fetchAll();

$tbl = $db->query("SELECT distinct nr_wyceny FROM wycena");
$userQuery = $tbl->fetchAll();
$tbl->execute();

$klientQuery = $db->query('SELECT * FROM klient');
$klientQuery->execute();


if (isset($_SESSION['klientID'])) {
    // require_once 'database.php';


    $nr_wyceny = $_POST['nr_wyceny'];
    $podsumowanie_wycena = $db->prepare('SELECT * FROM wycena WHERE nr_wyceny LIKE :nr_wyceny');
    $podsumowanie_wycena->bindValue(':nr_wyceny', $nr_wyceny, PDO::PARAM_STR);
    $podsumowanie_wycena->execute();

    $id_k = $_POST['klientID'];
    $podsumowanie_wycena_klient = $db->prepare('SELECT * FROM klient WHERE id LIKE :klientID');
    $podsumowanie_wycena_klient->bindValue(':klientID', $id_k, PDO::PARAM_INT);
    $podsumowanie_wycena_klient->execute();
}

?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/fontello/css/fontello.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <meta http-equiv="X-Ua-Compatible" content="IE=edge">

    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500&display=swap" rel="stylesheet">
    <title></title>
</head>

<body onselectstart="return false;">
    <div class="tlo"></div>
    <div class="form-dashboard">

        <div class="sect">
            <div class="head">
                <div class="logo">
                    <div class="qs"><img src="photo/1.png" style="display: block; margin: auto" /></div>
                </div>
                <div class="search">
                    <i class="icon-search"></i>
                    <input class="search-label" id="search-label" type="text">
                </div>
                <div class="account">
                    <div class="account-border">
                        <div class="picture"><img src="photo/user.svg" style="display: block; margin: auto" /></div>
                    </div>
                    <div class="account-info">
                        <?php
                        echo $_SESSION['email'];
                        echo '<a href="logout.php">Wyloguj się</a></p>';
                        ?>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="menu">

                    <ul class="menu-item">Naprawy
                        <li>
                            <ul>
                                <div class="panel-item">
                                    <div class="item">
                                        <a href="wycena.php">Wycena serwisu</a>
                                        <a href="edit_wycena.php">Edycja wyceny</a>
                                    </div>
                                </div>
                            </ul>
                        </li>
                    </ul>
                    <ul class="menu-item active">Wyceny
                        <li>
                            <ul>
                                <div class="panel-item">
                                    <div class="item">
                                        <div class='wyszukaj_wycene' id='wyszukaj_wycene'>
                                            <input type="text" class='wyszukaj_w' id='wyszukaj_w'>
                                            <i class="icon-search" id='wyszukaj-icon'>
                                                <!-- <span class='czysc' id='czysc_wyszukaj_w'>x</span> -->
                                            </i>
                                            <input type="text" class='wynik-id2' id='wynik-id2' style="display: none;">
                                        </div>

                                        <?php if ($tbl->rowCount() <= 0) {
                                            echo '<a class="item_opis">Brak serwisów</a>';
                                        } ?>
                                        <div class="item_filter">
                                            <label>
                                                <span class="opis">Do akceptacji
                                                </span>
                                                <input type="checkbox" class="ch" id="ch1" onclick="a()">
                                            </label>

                                            <label>
                                                <span class="opis">W trakcie
                                                </span>
                                                <input type="checkbox" class="ch" id="ch2" onclick="a()">
                                            </label>

                                            <label>
                                                <span class="opis">Zakończony
                                                </span>
                                                <input type="checkbox" class="ch" id="ch3" onclick="a()">
                                            </label>

                                            <label>
                                                <span class="opis">Anulowany
                                                </span>
                                                <input type="checkbox" class="ch" id="ch4" onclick="a()">
                                            </label>
                                        </div>
                                        <div class="item_wycena">
                                            <span class="rekordy-0" id="rekordy">Przyjęte wyceny: <?= $tbl->rowCount() ?></span>
                                            <div class="wycena01" id="wycena01"></div>
                                            <div class="wycena02" id="wycena02"></div>
                                            <div class="wycena03" id="wycena03"></div>
                                            <div class="wycena04" id="wycena04"></div>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </li>
                    </ul>
                    <ul class="menu-item">Wszystkie serwisy
                        <li>
                            <ul>
                                <div class="panel-item">
                                    <div class="item">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th colspan="2">Łącznie rekordów: <?= $usersQuery->rowCount() ?></th>
                                                </tr>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>User</th>
                                                    <th>Nazwa usługi/części</th>
                                                    <th>Imię/nr tel</th>
                                                    <th>Nazwisko/adres</th>
                                                    <th>Cena części</th>
                                                    <th>Należność</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($userQuery as $value) {

                                                    echo "<tr>
                            <td>{$value['id']}</td>
                            <td>{$value['admin']}</td>
                            <td>{$value['data']}</td>
                            <td>{$value['nazwa']}</td>
                            <td>{$value['sprzet']}</td>
                            <td>{$value['naleznosc']}</td>
                            <td>{$value['status']}</td>
                            
                            </tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </ul>
                        </li>
                    </ul>
                    <ul class="menu-item">Twoje dane
                        <li>
                            <ul>
                                <div class="panel-item">
                                    <div class="item">
                                        <?php echo '<a class="nazwa_label" type="text">' .
                                            $_SESSION['imie'] . '</a>' ?>

                                        <?php echo '<a class="nazwa_label" type="text">' .
                                            $_SESSION['nazwisko'] . '</a>' ?>

                                        <?php echo '<a class="nazwa_label" type="text">' .
                                            $_SESSION['nick'] . '</a>' ?>

                                        <?php echo '<a class="nazwa_label" type="text">' .
                                            $_SESSION['email'] . '</a>' ?>

                                    </div>
                                </div>
                            </ul>
                        </li>
                    </ul>
                    <ul class="menu-item">Klienci
                        <li>
                            <ul>
                                <div class="panel-item">
                                    <div class="item">
                                        <div class='wyszukaj_klienta' id='wyszukaj_klienta'>
                                            <input type="text" class='wyszukaj_k' id='wyszukaj_k'>
                                            <i class="icon-search" id='wyszukaj-icon'>
                                                <!-- <span class='czysc' id='czysc_wyszukaj_k'>x</span> -->
                                            </i>
                                        </div>
                                        <div class='item-klient' id='item-klient'></div>
                                        <span class="ilosc-klient" id="klient_ilosc">Ilość wprowadzonych klientów: <?= $klientQuery->rowCount() ?></span>
                                    </div>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- <script src="script.js"></script> -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <script type="text/javascript">
        // AJAX
        // document.getElementById('wynik-id').innerText = 'error';
        var wyszukaj_w = document.getElementById('wyszukaj_w').value = '';
        var wyszukaj_k = document.getElementById('wyszukaj_k').value = '';
        var x = document.getElementById('klient_ilosc').value;
        var y = document.getElementById('rekordy').value;
        var i = 0;
        setInterval(function() {
            if (i <= x + 1) {
                $(document).ready(function() {
                    i++;
                    $("#klientID" + i).show(function() {
                        $.ajax({
                            type: 'POST',
                            url: 'ajax.php',
                            data: {
                                name: $("#klientID" + i).val(),
                                name2: $("#klientID" + i).val(),
                                name3: $("#klientID" + i).val(),
                                name4: $("#klientID" + i).val(),
                            },
                            success: function(data) {
                                $("#wynik_wycena" + i).html(data);
                                // $("#text-inf" + i).html(data2);
                            },
                        });
                    });

                });
            }

            // document.getElementById('wynik-id2').value = document.getElementById('wynik-id').innerText;
            if (document.getElementById('wyszukaj_w').value == '') {
                document.getElementById('wynik-id2').value = 'error';
            }

        }, 100);

        // wyszukuje id klienta
        $(document).ready(function() {
            $("#wyszukaj_w").keypress(function() {
                $.ajax({
                    type: 'POST',
                    url: 'live_search.php',
                    data: {
                        name: $("#wyszukaj_w").val(),
                    },
                    success: function(data) {
                        $("#wynik-id2").val(data);
                    },
                });
            });
        });

        // filtr wycen po imieniu lub nazwisku status=do akceptacji
        $(document).ready(function() {
            $("#wyszukaj_w").show(function() {
                $.ajax({
                    type: 'POST',
                    url: 'filter1.php',
                    data: {
                        name: $("#wynik-id2").val(),
                    },
                    success: function(data) {
                        $("#wycena01").html(data);
                    },
                });
            });
            $("#wyszukaj_w").keyup(function() {
                $.ajax({
                    type: 'POST',
                    url: 'filter1.php',
                    data: {
                        name: $("#wynik-id2").val(),
                    },
                    success: function(data) {
                        $("#wycena01").html(data);
                    },
                });
            });
        });

        // filtr wycen po imieniu lub nazwisku status=w trakcie
        $(document).ready(function() {
            $("#wyszukaj_w").show(function() {
                $.ajax({
                    type: 'POST',
                    url: 'filter2.php',
                    data: {
                        name: $("#wynik-id2").val(),
                    },
                    success: function(data) {
                        $("#wycena02").html(data);
                    },
                });
            });
            $("#wyszukaj_w").keyup(function() {
                $.ajax({
                    type: 'POST',
                    url: 'filter2.php',
                    data: {
                        name: $("#wynik-id2").val(),
                    },
                    success: function(data) {
                        $("#wycena02").html(data);
                    },
                });
            });
        });

        // filtr wycen po imieniu lub nazwisku status=zakończony
        $(document).ready(function() {
            $("#wyszukaj_w").show(function() {
                $.ajax({
                    type: 'POST',
                    url: 'filter3.php',
                    data: {
                        name: $("#wynik-id2").val(),
                    },
                    success: function(data) {
                        $("#wycena03").html(data);
                    },
                });
            });
            $("#wyszukaj_w").keyup(function() {
                $.ajax({
                    type: 'POST',
                    url: 'filter3.php',
                    data: {
                        name: $("#wynik-id2").val(),
                    },
                    success: function(data) {
                        $("#wycena03").html(data);
                    },
                });
            });
        });

        // filtr wycen po imieniu lub nazwisku status=anulowany
        $(document).ready(function() {
            $("#wyszukaj_w").show(function() {
                $.ajax({
                    type: 'POST',
                    url: 'filter4.php',
                    data: {
                        name: $("#wynik-id2").val(),
                    },
                    success: function(data) {
                        $("#wycena04").html(data);
                    },
                });
            });
            $("#wyszukaj_w").keyup(function() {
                $.ajax({
                    type: 'POST',
                    url: 'filter4.php',
                    data: {
                        name: $("#wynik-id2").val(),
                    },
                    success: function(data) {
                        $("#wycena04").html(data);
                    },
                });
            });
        });

        document.onselectstart = function() {
            return false;
        };

        for (x = 1; x <= 4; x++) {
            document.getElementById('ch' + x).checked = false;
        }
        $('.menu-item').on('click', function(event) {
            $('.menu-item').removeClass('active');
            $(this).addClass('active');
        });


        // var czysc_wyszukaj_k = document.querySelector('#czysc_wyszukaj_k');
        // czysc_wyszukaj_k.addEventListener('click', event => {
        //     document.getElementById('wyszukaj_k').value = '';
        // });

        // var czysc_wyszukaj_w = document.querySelector('#czysc_wyszukaj_w');
        // czysc_wyszukaj_w.addEventListener('click', event => {
        //     document.getElementById('wyszukaj_w').value = '';
        //     document.getElementById('wynik-id').innerHTML = 'error';
        // });

        // filtr klienta
        $(document).ready(function() {
            $("#wyszukaj_k").show(function() {
                $.ajax({
                    type: 'POST',
                    url: 'filter_klient.php',
                    data: {
                        name: $("#wyszukaj_k").val(),
                    },
                    success: function(data) {
                        $("#item-klient").html(data);
                    },
                });
            });
            $("#wyszukaj_k").keyup(function() {
                $.ajax({
                    type: 'POST',
                    url: 'filter_klient.php',
                    data: {
                        name: $("#wyszukaj_k").val(),
                    },
                    success: function(data) {
                        $("#item-klient").html(data);
                    },
                });
            });
        });


        setInterval(function() {
            var search_label = document.getElementById('search-label').value;

            $('.search-label').on('focus', function(event) {
                $('.search-label').removeClass('active_s');
                $(this).addClass('active_s');
            });
            $('.search-label').on('blur', function(event) {
                if (search_label.length >= 3) {
                    $(this).addClass('active_s');
                } else {
                    $('.search-label').removeClass('active_s');
                }
            });


            // wycena1.addEventListener('click', function() {
            //     document.getElementById('wycena1').style.cssText = 'position: absolute; width:600px; height:600px; top:-20%; left:0%; margin:0px auto; backdrop-filter:blur(10px); z-index:2; background:#ffffff3d; box-shadow:inset 14px 33px 79px 30px #0000008f;';
            // });

        }, 100);

        function a() {
            if (document.getElementById('ch1').checked) {
                document.getElementById("wycena01").style.display = "flex";
            } else {
                document.getElementById("wycena01").style.display = "none";
            }

            if (document.getElementById('ch2').checked) {
                document.getElementById("wycena02").style.display = "flex";
            } else {
                document.getElementById("wycena02").style.display = "none";
            }

            if (document.getElementById('ch3').checked) {
                document.getElementById("wycena03").style.display = "flex";
            } else {
                document.getElementById("wycena03").style.display = "none";
            }

            if (document.getElementById('ch4').checked) {
                document.getElementById("wycena04").style.display = "flex";
            } else {
                document.getElementById("wycena04").style.display = "none";
            }

        }
    </script>

</body>

</html>