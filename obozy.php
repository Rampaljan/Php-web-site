<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona Główna</title>
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
                <h4>O inicjatywie:</h4>
                <p>Zapraszamy na niezapomniane przygody zimowe dla Twoich dzieci! Nasze obozy zimowe to doskonała okazja, by w pełni wykorzystać uroki zimy. Pod okiem doświadczonych instruktorów dzieci będą doskonalić swoje umiejętności narciarskie, ślizgać się na sankach i uczyć się sztuki budowania igloo. Zapewniamy również mnóstwo zabawy poza stokiem, w tym kuligi, zabawy w śnieżki i wiele innych atrakcji. Dzięki naszym profesjonalnym opiekunom i bezpiecznej infrastrukturze, Twój maluch będzie mógł bezpiecznie i radośnie spędzić czas na świeżym powietrzu. Zapisz swoje dziecko już dziś i spraw mu zimowe wakacje pełne przygód!</p>
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
            <section class="znajdz_nas">
                <h4>Nasze biuro:</h4>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d977.6028473827073!2d18.65675261842692!3d54.3544270964645!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46fd7374d2925cc5%3A0x6b1aa305d1c8258b!2zWlPFgQ!5e0!3m2!1spl!2spl!4v1715080745131!5m2!1spl!2spl" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </section>
        </main>
    </section>
    <footer>
        <span id="signature">Stronę opracował: Jan Rampalski 2d</span>
    </footer>
</body>

</html>