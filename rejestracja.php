<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
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
            <section class="logging_form">
                <h4>Zarejestruj się</h4>
                <form action="rejestracja.php" id="loginform" method="post">
                    <label for="login">Podaj login:</label>
                    <input type="text" name="login" id="login"><br>
                    <label for="email">Podaj email:</label>
                    <input type="email" name="email" id="email"><br>
                    <label for="password">Podaj hasło:</label>
                    <input type="password" name="password" id="password"><br>
                    <label for="password">Powtórz hasło:</label>
                    <input type="password" name="password_repeated" id="password_repeated"><br><br>
                    <img src="obrazekcaptcha.php" alt="captcha" style="width: 200px;">
                    <label for="captcha">Wpisz tekst z obrazka, by potwierdzić, że nie jesteś robotem</label>
                    <input type="text" name="captcha" id="captcha"><br>
                    <br><br>
                    <input type="submit" value="Zarejestruj się" name="submit">
                </form>
                <?php
                //pobranie danych
                if (isset($_POST["submit"])) {
                    $login = $_POST["login"];
                    $email = $_POST["email"];
                    $password = $_POST["password"];
                    $password_repeated = $_POST["password_repeated"];
                    $captcha = $_POST['captcha'];
                    $original = $_SESSION["newsession"];
                    // echo($login);
                    // echo($email);
                    // echo($password);
                    // echo($password_repeated);

                    //zmienna która sprawdzi nam poprawność wszystkich warunków
                    $legal = 0;
                    //sprawdzamy czy pola sa uzupełnione
                    if (
                        empty($login) == true ||
                        empty($email) == true ||
                        empty($password) == true ||
                        empty($password_repeated) == true ||
                        empty($captcha) == true
                    ) {
                        echo ("<p class='error'>Wszystkie pola muszą być uzupełnione</p>");
                        $legal++;
                    }

                    //sprawdzenie captchy
                    if ($captcha != $original) {
                        echo ("<p class='error'>Wpisałeś źle captchę, spróbuj jeszcze raz</p>");
                        $legal++;
                    }

                    //sprawdzanie poprawności hasła i loginu
                    if ($password != $password_repeated) {
                        echo ("<p class='error'>Podane hasła nie są takie same</p>");
                    } elseif (!preg_match('/.{8,9999}/', $password)) {
                        echo "<p class='error'>Haslo jest za krótkie (minimum 8 znaków)</p>";
                        $legal++;
                    } elseif (!preg_match('/[a-z_]/', $password)) {
                        echo "<p class='error'>Haslo musi zawierać małe litery</p>";
                        $legal++;
                    } elseif (!preg_match('/[A-Z_]/', $password)) {
                        echo "<p class='error'>Haslo musi zawierać wielkie litery</p>";
                        $legal++;
                    } elseif (!preg_match('/[0-9]/', $password)) {
                        echo "<p class='error'>Haslo musi zawierać cyfrę</p>";
                        $legal++;
                    } elseif (!preg_match('/[\W]/', $password)) {
                        echo "<p class='error'>Haslo musi zawierać znaki specjalne</p>";
                        $legal++;
                    }

                    //poprawność maila
                    if (preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
                    } else {
                        echo "<p class='error'>Adres email jest niepoprawny.</p>";
                        $legal++;
                    }

                    //sprawdzanie w bazie czy mamy ten sam login
                    $conn = mysqli_connect("localhost", "root", "", "obozy");
                    $query = "select `login` from `users` where `login` = '$login'";
                    $exec = mysqli_query($conn, $query);
                    $result = mysqli_fetch_array($exec);

                    if ($result != null) {
                        echo ("<p class='error'>Podany login już istnieje </p>");
                        $legal++;
                    }

                    //wysyłanie do bazy, jeśli nie ma legalów
                    if ($legal == 0) {
                        $insert_query = "INSERT INTO users VALUES('','$login','$password','$email');";
                        mysqli_query($conn, $insert_query);
                        echo ("<p class='success'>Zarejestrowano, teraz możesz się zalogować</p><a href='logowanie.php'>Zaloguj</a>");
                        mysqli_close($conn);
                    }
                }
                ?>
            </section>
        </main>
    </section>
    <footer>
        <span id="signature">Stronę opracował: Jan Rampalski 2d</span>
    </footer>
</body>

</html>