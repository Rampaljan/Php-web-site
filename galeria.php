<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria</title>
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
            <h2 class="inviting_text">Galeria:</h2>
            <section class="gallery">
                <?php
                $conn = mysqli_connect("localhost", "root", "", "obozy");
                $sql = "SELECT * FROM images ORDER BY date DESC";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $imageURL = $row["image_url"];
                        $user = htmlspecialchars($row["user"]);
                        $date = $row["date"];
                        echo "<div class='gallery_item'>";
                        echo "<img src='$imageURL' alt='Image' style='max-width: 300px; max-height: 300px;'>";
                        echo "<p>Dodane przez: $user, Data: $date</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p class='error'>Brak zdjęć w galerii.</p>";
                }
                ?>
            </section>
            <section class="inviting_text">
                <h4>Dodaj zdjęcie do galerii:</h4>
                <form action="galeria.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="my_image">
                    <input type="submit" name="submit" value="Prześlij">
                </form>
                <?php
                error_reporting(0);
                if (isset($_SESSION['login'])) {
                    if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
                        $img_name = $_FILES['my_image']['name'];
                        $img_size = $_FILES['my_image']['size'];
                        $tmp_name = $_FILES['my_image']['tmp_name'];
                        $error = $_FILES['my_image']['error'];
                        if ($error === 0) {
                            if ($img_size > 9000000) {
                                echo "<p class='error'>Plik jest za duży!</p>";
                            } else {
                                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                                $img_ex_lc = strtolower($img_ex);
                                $allowed_exs = array("jpg", "jpeg", "png");
                                if (in_array($img_ex_lc, $allowed_exs)) {
                                    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                                    $img_upload_path = 'uploads/' . $new_img_name;
                                    move_uploaded_file($tmp_name, $img_upload_path);
                                    // Przygotuj dane do wstawienia
                                    $image_url = $conn->real_escape_string($img_upload_path);
                                    $user = $conn->real_escape_string($_SESSION['login']);
                                    $date = date('Y-m-d'); // Aktualna data
                                    // Wstaw dane do bazy
                                    $sql = "INSERT INTO images (image_url, user, date) VALUES ('$image_url', '$user', '$date')";
                                    if ($conn->query($sql) === TRUE) {
                                        echo "<p class='success'>Obraz został pomyślnie przesłany do bazy danych!</p>";
                                        header("refresh: 3");
                                    } else {
                                        echo "<p class='error'>Nie udało się przesłać ścieżki do obrazu do bazy danych. Błąd: " . $conn->error . "</p>";
                                    }
                                } else {
                                    echo "<p class='error'>Nie można przesłać pliku tego typu!</p>";
                                }
                            }
                        } else {
                            echo "<p class='error'>Wystąpił błąd podczas przesyłania pliku!</p>";
                        }
                    }
                } else {
                    echo ("<p class='error'>Musisz być zalogowany, aby dodać zdjęcie</p>");
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