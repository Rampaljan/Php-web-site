<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zamówienia</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <section class="header_section1_logo">
            <a href="obozy.php" id="logoid"><img class="logo" src="logo.png" alt="zima"></a>
        </section>
        <section class="header_section2_title">
            <h1>Obozy Letnie i Zimowe Dla Dzieci</h1>
        </section>
        <section class="header_section3_registration">
            <?php
            session_start();
            if (isset($_SESSION['login'])) {
                // echo("true");
                $login1 = $_SESSION['login'];
                echo ("
                    <a href='logowanie.php'>
                    <div class='logged'>
                        <div class='user_image'>
                            <img src='user_default_ok.jpeg' alt='user photo' id='user_photo'>
                        </div>
                        <div class='username'>
                            <span>Zalogowano jako:</span><br>
                            <span>$login1</span>
                        </div>
                    </div>
                    </a>
                    ");
            } else {
                // echo("false");
                echo ("
                    <a href='logowanie.php'>
                    <div class='logged'>
                        <div class='user_image'>
                            <img src='user_default_wrong.jpeg' alt='user photo' id='user_photo'>
                        </div>
                        <div class='username'>
                            <span>Zaloguj się</span>
                        </div>
                    </div>
                </a>
                    ");
            }
            ?>
        </section>
    </header>
    <section>
        <nav>
            <ul>
                <h3>Przejdź do:</h3>
                <li><a href="obozy.php">Strona główna</a></li>
                <li><a href="logowanie.php">Logowanie</a></li>
                <li><a href="rejestracja.php">Rejestracja</a></li>
                <li><a href="zamowienia.php">Zamówienia</a></li>
                <li><a href="czat.php">Komentarze</a></li>
                <li><a href="galeria.php">Galeria</a></li>
                <li><a href="panel.php">Panel Użytkownika</a></li>
            </ul>
            <div class="counter">
                <h3>Licznik!</h3>
                <table>
                    <tr>
                        <th>Twoje odwiedziny na stronie:</th>
                        <th>Łączne odwiedziny na stronie</th>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            $countvisit = 1;

                            if (isset($_COOKIE['countvisit'])) {
                                $countvisit = $_COOKIE['countvisit'];
                                $countvisit++;
                            }
                            setcookie('countvisit', $countvisit);
                            echo $countvisit;
                            ?>
                        </td>
                        <td>
                            <?php //licznik
                            $df  = "count.txt";
                            if (!($fp = @fopen($df, "r"))) {
                                $count = 0;
                            } else {
                                $count = fgets($fp, 100);
                                fclose($fp);
                            }
                            $count += 1;
                            $fp = fopen($df, "w");
                            if (!flock($fp, LOCK_EX)) {
                                fclose($fp);
                                return;
                            } else {
                                fputs($fp, $count);
                                flock($fp, LOCK_UN);
                                fclose($fp);
                            }
                            echo $count;
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
        </nav>
        <main>

            <section class="inviting_text">
                <h3>Złóż rezerwację na zamówienie</h3>
                <form action="zamowienia.php" method="POST" id="orderform">
                    <h4>Podaj swoje dane:</h4>
                    <label for="imie_r">Twoje imię:</label>
                    <input type="text" name="imie_r" id="imie_r">
                    <br>
                    <label for="nazwisko_r">Twoje nazwisko:</label>
                    <input type="text" name="nazwisko_r" id="nazwisko_r">
                    <br>
                    <label for="tel">Twój telefon:</label>
                    <input type="tel" name="tel" id="tel">
                    <br><br>
                    <h4>Podaj dane dziecka:</h4>
                    <label for="imie_d">Imię:</label>
                    <input type="text" name="imie_d" id="imie_d">
                    <br>
                    <label for="nazwisko_d">Nazwisko:</label>
                    <input type="text" name="nazwisko_d" id="nazwisko_d">
                    <br>
                    <label for="age">Wiek dziecka:</label>
                    <select name="age" id="age">
                        <optgroup label="Dzieci">
                            <option name="age_d_5-7">5 - 7 lat</option>
                            <option name="age_d_8-10">8 - 10 lat</option>
                        </optgroup>
                        <optgroup label="Młodzież">
                            <option name="age_m_11-13">11 - 13 lat</option>
                            <option name="age_m_14-16">14 - 16 lat</option>
                        </optgroup>
                    </select>
                    <br>
                    <label for="city">Miasto dziecka:</label>
                    <input type="text" name="city" id="city">
                    <br><br>
                    <h4>Wybierz ofertę (spis ofert znajduje się poniżej)</h4>
                    <label for="nr_oferty">Wpisz id oferty:</label>
                    <input type="number" name="nr_oferty" id="nr_oferty">
                    <br><br>
                    <input type="submit" value="Złóż zamówienie" name="submit"><br>

                    <?php
                    $legal = 0;
                    //pobranie wartości
                    if (isset($_POST['submit'])) {
                        $imie_r = $_POST['imie_r'];
                        $nazwisko_r = $_POST['nazwisko_r'];
                        $tel = $_POST['tel'];
                        $imie_d = $_POST['imie_d'];
                        $nazwisko_d = $_POST['nazwisko_d'];
                        $nr_oferty = $_POST['nr_oferty'];
                        $city = $_POST['city'];

                        if (isset($_POST['age'])) {
                            $selected_age = $_POST['age'];
                        }
                    }
                    //sprawdzenie czy jesteś zalogowany
                    if (!isset($_SESSION['login'])) {
                        if (isset($_POST["submit"])) {
                            echo ("<p class='error'>Aby złożyć zamówienie musisz być zalogowany</p>");
                            $legal++;
                        }
                    }
                    //sprawdzanie czy pola są puste
                    if (isset($_POST['submit'])) {
                        if (
                            empty($imie_r) == true ||
                            empty($nazwisko_r) == true ||
                            empty($tel) == true ||
                            empty($imie_d) == true ||
                            empty($nazwisko_d) == true ||
                            empty($city) == true ||
                            isset($nr_oferty) == false
                        ) {
                            echo ("<p class='error'>Wszystkie pola muszą być uzupełnione</p>");
                            $legal++;
                        } else {
                            $imie_r = ucfirst(strtolower($imie_r));
                            $nazwisko_r = ucfirst(strtolower($nazwisko_r));
                            $imie_d = ucfirst(strtolower($imie_d));
                            $nazwisko_d = ucfirst(strtolower($nazwisko_d));
                            $city = ucfirst(strtolower($city));
                        }
                    }
                    //pregmatch
                    if (isset($_POST['submit'])) {

                        if (empty($imie_r) || !preg_match("/^[a-zA-ZąĄćĆęĘłŁńŃóÓśŚźŹżŻ ]*$/", $imie_r)) {
                            echo ("<p class='error'>Podaj poprawne imię rodzica (tylko litery i spacje)</p>");
                            $legal++;
                        }
                        if (empty($nazwisko_r) || !preg_match("/^[a-zA-ZąĄćĆęĘłŁńŃóÓśŚźŹżŻ ]*$/", $nazwisko_r)) {
                            echo ("<p class='error'>Podaj poprawne nazwisko rodzica (tylko litery i spacje)</p>");
                            $legal++;
                        }
                        if (empty($tel) || !preg_match("/^[0-9]{9}$/", $tel)) {
                            echo ("<p class='error'>Podaj poprawny numer telefonu (9 cyfr bez spacji)</p>");
                            $legal++;
                        }
                        if (empty($imie_d) || !preg_match("/^[a-zA-ZąĄćĆęĘłŁńŃóÓśŚźŹżŻ ]*$/", $imie_d)) {
                            echo ("<p class='error'>Podaj poprawne imię dziecka (tylko litery i spacje)</p>");
                            $legal++;
                        }
                        if (empty($nazwisko_d) || !preg_match("/^[a-zA-ZąĄćĆęĘłŁńŃóÓśŚźŹżŻ ]*$/", $nazwisko_d)) {
                            echo ("<p class='error'>Podaj poprawne nazwisko dziecka (tylko litery i spacje)</p>");
                            $legal++;
                        }
                        if (empty($city) || !preg_match("/^[a-zA-ZąĄćĆęĘłŁńŃóÓśŚźŹżŻ ]*$/", $city)) {
                            echo ("<p class='error'>Podaj poprawną nazwę miasta (tylko litery i spacje)</p>");
                            $legal++;
                        }
                    }
                    //sprawdzanie ilości ofert
                    if (isset($_POST['submit']) && $legal == 0) {
                        $conn = mysqli_connect("localhost", "root", "", "obozy");
                        $query = "select count(id) as liczba from oferta;";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($result);
                        $liczba = $row["liczba"];

                        if ($nr_oferty < 1 || $nr_oferty > $liczba) {
                            echo ("<p class='error'>Podany numer oferty nie istnieje</p>");
                            $legal++;
                        }
                    }

                    //sprawdzamy ilość zarezerwowanych miejsc
                    if (isset($_POST['submit']) && $legal == 0) {
                        $query_check_reservation = "select count(id_oferty) as liczba from zamowienia where id_oferty = '$nr_oferty';";
                        $result_check_reservation = mysqli_query($conn, $query_check_reservation);
                        $row_check_reservation = mysqli_fetch_assoc($result_check_reservation);
                        $liczba_check_reservation = $row_check_reservation["liczba"];
                    }

                    //sprawdzamy ilość maksymalnych miejsc
                    if (isset($_POST['submit']) && $legal == 0) {
                        $query_check_max = "select miejsca_max from oferta where id = '$nr_oferty';";
                        $result_check_max = mysqli_query($conn, $query_check_max);
                        $row_check_max = mysqli_fetch_assoc($result_check_max);
                        $liczba_max = $row_check_max["miejsca_max"];
                    }

                    // sprawdzamy warunek czy są miejsca
                    if (isset($_POST['submit']) && $legal == 0) {
                        if ($liczba_check_reservation == $liczba_max) {
                            echo ("<p class='error'>Przepraszamy, wszystkie wolne miejsca na tę ofertę są już wyprzedane. Wybierz inną ofertę</p>");
                            $legal++;
                        }
                    }

                    if (isset($_POST['submit'])) {
                        if ($legal == 0) {
                            echo ("<p class='success'>Zamówienie zostało złożone</p><br><a target='_blank' class='success' href='pdf_generating.php'>Pobierz potwierdzenie zamówienia w formie PDF. <br> Będzie ono potrzebne na obozie.<br> Kopia potwierdzenia niedługo zostanie również wysłana na twój email</a>");

                            //TUTAJ ZACZYNAMY DOPIERO WYSYŁAĆ ZAMÓWIENIE

                            //wysłanie zamowienia
                            $login = $_SESSION['login'];
                            $query_id = "select id from users where login = '$login';";
                            $result_id = mysqli_query($conn, $query_id);
                            $row = mysqli_fetch_assoc($result_id);
                            $idu = $row["id"];


                            $insert_query = "insert into zamowienia values ('',$idu,$nr_oferty,'$imie_d','$nazwisko_d','$imie_r','$nazwisko_r','$tel','$city','$selected_age',$liczba_max,'');";
                            $result_insert = mysqli_query($conn, $insert_query);

                            //sprawdzamy cene wybranej oferty
                            $query_price = "select cena from oferta where id = '$nr_oferty';";
                            $result_price = mysqli_query($conn, $query_price);
                            $row_price = mysqli_fetch_assoc($result_price);
                            $cena = $row_price["cena"];

                            //sprawdzamy id wysłanego zamowienia, aby stworzyć unikalny barcode
                            $query_barcode = "SELECT * FROM zamowienia WHERE id_usera = '$idu' ORDER BY id_zamowienia DESC LIMIT 1;";
                            $result_barcode = mysqli_query($conn, $query_barcode);
                            $row_barcode = mysqli_fetch_assoc($result_barcode);
                            $idz = $row_barcode["id_zamowienia"];


                            //sprawdzamy rozmiar id, żeby dostosować go do barcodeu
                            $idzstring = str_split($idz);
                            $barcode = rand(10000000, 99999999);
                            $barcode = substr("$barcode", -sizeof($idzstring) - 2);
                            $barcode = "*" . $idz . $barcode . "*";
                            $query_sending_barcode = "Update zamowienia set barcode = '$barcode' where id_zamowienia = '$idz';";
                            $result_update = mysqli_query($conn, $query_sending_barcode);


                            //robimy sesje ze wszystkimi danymi, aby później je wykorzystać w pdfie
                            $_SESSION['nr_oferty'] = $nr_oferty;
                            $_SESSION['imie_d'] = $imie_d;
                            $_SESSION['nazwisko_d'] = $nazwisko_d;
                            $_SESSION['imie_r'] = $imie_r;
                            $_SESSION['nazwisko_r'] = $nazwisko_r;
                            $_SESSION['tel'] = $tel;
                            $_SESSION['city'] = $city;
                            $_SESSION['selected_age'] = $selected_age;
                            $_SESSION['liczba_max'] = $liczba_max;
                            $_SESSION['cena'] = $cena;
                            $_SESSION['barcode'] = $barcode;
                        }
                    }
                    ?>
                    <img hidden src="kreskowy.php" alt="kod kreskowy">
                </form>
            </section>
            <section class="inviting_text">
                <h4>Nasza oferta:</h4>
                <table>
                    <tr>
                        <th>ID oferty:</th>
                        <th>Miejscowość:</th>
                        <th>Opis:</th>
                        <th>Zarezerwowanych miejsc:</th>
                        <th>Maksymalna il. miejsc:</th>
                        <th>Ilość dni:</th>
                        <th>Cena:</th>
                    </tr>
                    <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'obozy');
                    $query = "select * from oferta order by id";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_array($result)) {
                        //sprawdzanie ile jest zarezerwowanych miejsc
                        $id_oferty = $row['id'];

                        $query_check = "select count(id_oferty) as liczba from zamowienia where id_oferty = '$id_oferty';";
                        $result_check = mysqli_query($conn, $query_check);
                        $row_check = mysqli_fetch_assoc($result_check);
                        $liczba = $row_check["liczba"];

                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['miejscowosc'] . "</td>";
                        echo "<td>" . $row['opis'] . "</td>";
                        echo "<td>" . $liczba . "</td>";
                        echo "<td>" . $row['miejsca_max'] . "</td>";
                        echo "<td>" . $row['il_dni'] . "</td>";
                        echo "<td>" . $row['cena'] . "zł</td>";
                        echo "</tr>";
                    }
                    $close = mysqli_close($conn);
                    ?>
                </table>
            </section>
        </main>
    </section>
    <footer>
        <span id="signature">Stronę opracował: Jan Rampalski 2d</span>
    </footer>
</body>

</html>