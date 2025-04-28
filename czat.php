<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komentarze</title>
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
                <h2>Napisz swój komentarz:</h2>
                <form action="czat.php" method="POST">
                    <label for="comment">Daj znać o swojej opini:</label></p>
                    <textarea id="comment" name="comment" rows="4" cols="100"></textarea><br>
                    <input type="submit" value="Wyślij" name="submit">
                    <?php
                    if (isset($_SESSION['login'])) {
                        if (isset($_POST["submit"])) {
                            $login = $_SESSION['login'];
                            $comment = $_POST['comment'];
                            $date = date("Y-m-d");
                            $conn = mysqli_connect("localhost", "root", "", "obozy");
                            //sprawdzamy nasze id
                            $query_id = "select id from users where login = '$login';";
                            $result_id = mysqli_query($conn, $query_id);
                            $row = mysqli_fetch_assoc($result_id);
                            $idu = $row["id"];

                            if($comment == "")
                            {
                                echo ("<p class='error'>Komentarz nie może być pusty</p>");
                            }
                            else{
                            //wysyłanie komentarza
                            $query2 = "insert into comments values ('','$idu','$comment','$date')";
                            $result2 = mysqli_query($conn, $query2);
                            }
                        }
                    } else {
                        if (isset($_POST["submit"])) {
                            echo ("<p class='error'>Aby wysłać komentarz musisz być zalogowany</p>");
                        }
                    }
                    ?>
                </form>
                <h2>Komentarze:</h2>
                <table>
                    <tr>
                        <th>Użytkownik</th>
                        <th class="th_date">Data dodania</th>
                        <th>Treść</th>
                    </tr>
                    <?php
                    error_reporting(E_ERROR | E_PARSE);
                    $conn = mysqli_connect('localhost', 'root', '', 'obozy');
                    $query = "select idw, idu, message, date from comments order by date desc;";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result)) {
                        //sprawdzanie liczby wierszy
                        $wiersz = $row['idw'];
                        //ogarnianie który uzytkownik to dane id tego usera
                        $idu = $row['idu'];
                        $query2 = "select login from users join comments on users.id = comments.idu where idu = $idu;";
                        $result2 = mysqli_query($conn, $query2);
                        $user = mysqli_fetch_array($result2)['login'];
                        if ($user == null) {
                            $user = "Użytkownik usunięty";
                        }
                        //wyświetlanie tabeli
                        echo "<tr>";
                        echo "<td>" . $user . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['message'] . "</td>";
                        echo "</tr>";
                    }
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