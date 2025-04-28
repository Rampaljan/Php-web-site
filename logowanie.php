<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
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
            <section class="logging_form">
                <?php
                error_reporting(E_ERROR | E_PARSE);
                if (isset($_SESSION['login'])) {
                    echo ('<h4>Jesteś już zalogowany, możesz się wylogować</h4><form action="logowanie.php" id="loginform" method="post"><input type="submit" value="Wyloguj" name="submitlogout"></form>');
                } else {
                    echo ('
                    <h4>Zaloguj się</h4>
                <form action="logowanie.php" id="loginform" method="post">
                    <label for="login">Podaj login:</label>
                    <input type="text" name="login" id="login"><br><br>
                    <label for="password">Podaj hasło:</label>
                    <input type="password" name="password" id="password"><br>
                    <input type="submit" value="Zaloguj" name="submit">
                    
                    ');
                }
                ?>
                <?php
                if (isset($_POST["submitlogout"])) {
                    unset($_SESSION['login']);
                    header("Refresh:0");
                }
                ?>
                <?php
                if (isset($_POST["submit"])) {
                    $login = $_POST["login"];
                    $password = $_POST["password"];
                    $legal = 0;
                    if (empty($login) == true || empty($password) == true) {
                        echo ("<p class='error'>Wszystkie pola muszą być uzupełnione</p>");
                        $legal++;
                    } else {
                        $conn = mysqli_connect("localhost", "root", "", "obozy");
                        $query = "select `login` from `users` where `login` = '$login'";
                        $exec = mysqli_query($conn, $query);
                        $result = mysqli_fetch_array($exec);
                        if ($result == null) {
                            echo ("<p class='error'>Podany login nie istnieje </p>");
                        } else {
                            $query_to_check_password = "select `password` from `users` where `login` = '$login';";
                            $exec_to_check_password = mysqli_query($conn, $query_to_check_password);
                            $result = mysqli_fetch_array($exec_to_check_password);
                            $result = $result[0];
                            if ($result != $password) {
                                echo ("<p class='error'>Błędne hasło</p>");
                                $legal++;
                            } elseif ($legal == 0) {
                                //reszta kodu, wrzucenie deklaracji zakodowania do sesji
                                if (!isset($_SESSION['login'])) {
                                    $_SESSION['login'] = $login;
                                    header("Refresh:0");
                                }
                            }
                        }
                    }
                    if ($legal != 0) {
                        unset($_SESSION['login']);
                    }
                }
                ?>
                </form>
            </section>
        </main>
    </section>
    <footer>
        <span id="signature">Stronę opracował: Jan Rampalski 2d</span>
    </footer>
</body>

</html>