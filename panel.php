<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Użytkownika</title>
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
            <?php
            if (isset($_SESSION['login'])) {
                echo ('<section class="inviting_text">
                        <h2>Panel Użytkownika:</h2>
                        <h3>Twoje Komentarze:</h3>
                        ');
            } else {
                echo ('<section class="inviting_text"><p class="error">Aby Zobaczyć panel użytkownika musisz być zalogowany</p></section>');
                echo ('<section hidden>');
            }
            error_reporting(0);
            //pobieramy id z pomocą loginu
            $login = $_SESSION['login'];
            $conn = mysqli_connect("localhost", "root", "", "obozy");
            $query_id = "select id from users where login = '$login';";
            $result_id = mysqli_query($conn, $query_id);
            $row = mysqli_fetch_assoc($result_id);
            $idu = $row["id"];
            $query_for_user_comments = "SELECT * from comments where idu = $idu;";
            $result_for_user_comments = mysqli_query($conn, $query_for_user_comments);
            if (mysqli_num_rows($result_for_user_comments) != 0) {
                echo ('
                <table>
                <tr>
                    <th class="th_date">Data</th>
                    <th>Komentarz</th>
                    <th>Usuwanie komentarza</th>
                </tr>
                ');
            } else {
                echo ("<p class='error'>Nie masz żadnego komentarza</p>");
                echo ("<table hidden>");
            }
            while ($row_for_user_comments = mysqli_fetch_array($result_for_user_comments)) {
                $idw = $row_for_user_comments['idw'];
                echo "<tr>";
                echo "<td>" . $row_for_user_comments['date'] . "</td>";
                echo "<td>" . $row_for_user_comments['message'] . "</td>";
                echo "<td ><form action='panel.php' class='delete_th' method='POST'><input type='hidden' name='idw' value='$idw'><input type='submit' name='submit' value='Usuń'></form></td>";
                echo "</tr>";
            }
            if (isset($_POST['submit'])) {
                $idw = $_POST['idw'];
                $query_for_deleting_comment = "delete from comments where idu = $idu and idw = $idw;";
                $result_for_deleting_comments = mysqli_query($conn, $query_for_deleting_comment);
                header("Refresh:0");
            }
            ?>
            </table>
            <br><br>
            <h3>Twoje rezerwacje zamówień:</h3>
            <?php
            $query_for_orders = "SELECT * from zamowienia where id_usera = $idu";
            $result_for_orders = mysqli_query($conn, $query_for_orders);
            if (mysqli_num_rows($result_for_orders) != 0) {
                echo ('
                    <table>
                <tr>
                    <th>Id oferty</th>
                    <th>Imię Dziecka</th>
                    <th>Nazwisko Dziecka</th>
                    <th>Wiek Dziecka</th>
                    <th>Miasto dziecka</th>
                    <th>Imię Rodzica</th>
                    <th>Nazwisko Rodzica</th>
                    <th>Telefon</th>
                    <th>Ilość Uczestników</th>
                    <th>Pobierz Potwierdzenie rezerwacji</th>
                    <th>Usuń rezerwacje</th>
                </tr>
                    ');
            } else {
                echo ("<p class='error'>Nie masz żadnych zamówień</p>");
                echo ("<table hidden>");
            }
            while ($row_for_orders = mysqli_fetch_array($result_for_orders)) {
                $id_zamowienia = $row_for_orders['id_zamowienia'];
                echo "<tr>";
                echo "<td>" . $row_for_orders['id_oferty'] . "</td>";
                echo "<td>" . $row_for_orders['imie_d'] . "</td>";
                echo "<td>" . $row_for_orders['nazwisko_d'] . "</td>";
                echo "<td>" . $row_for_orders['selected_age'] . "</td>";
                echo "<td>" . $row_for_orders['city'] . "</td>";
                echo "<td>" . $row_for_orders['imie_r'] . "</td>";
                echo "<td>" . $row_for_orders['nazwisko_r'] . "</td>";
                echo "<td>" . $row_for_orders['tel'] . "</td>";
                echo "<td>" . $row_for_orders['liczba_max'] . "</td>";
                echo "<td ><form action='panel.php' class='delete_th' method='POST'S><input type='hidden' name='id_zamowienia' value='$id_zamowienia'><input type='submit' name='submit_download' value='Pobierz potwierdzenie'></form></td>";
                echo "<td ><form action='panel.php' class='delete_th' method='POST'S><input type='hidden' name='id_zamowienia' value='$id_zamowienia'><input type='submit' name='submit_orders' value='Usuń'></form></td>";
                echo "</tr>";
            }
            if (isset($_POST['submit_orders'])) {
                $id_zamowienia = $_POST['id_zamowienia'];
                $query_for_deleting_order = "delete from zamowienia where id_usera = $idu and id_zamowienia = $id_zamowienia;";
                $result_for_deleting_order = mysqli_query($conn, $query_for_deleting_order);
                header("Refresh:0");
            }
            if (isset($_POST['submit_download'])) {
                $id_zamowienia = $_POST['id_zamowienia'];

                $query_for_download = "select * from zamowienia where id_zamowienia = $id_zamowienia;";
                $result_for_download = mysqli_query($conn, $query_for_download);
                $row_for_download = mysqli_fetch_assoc($result_for_download);


                $_SESSION['nr_oferty'] = $row_for_download['id_oferty'];
                $_SESSION['imie_d'] = $row_for_download['imie_d'];
                $_SESSION['nazwisko_d'] = $row_for_download['nazwisko_d'];
                $_SESSION['imie_r'] = $row_for_download['imie_r'];
                $_SESSION['nazwisko_r'] = $row_for_download['nazwisko_r'];
                $_SESSION['tel'] = $row_for_download['tel'];
                $_SESSION['city'] = $row_for_download['city'];
                $_SESSION['selected_age'] = $row_for_download['selected_age'];
                $_SESSION['liczba_max'] = $row_for_download['liczba_max'];
                $_SESSION['cena'] = $row_for_download['cena'];
                $_SESSION['barcode'] = $row_for_download['barcode'];

                echo ('<img hidden src="kreskowy.php" alt="kod kreskowy">');

                echo ('<p class=success>Pobierz potwierdzenie klikając <a href="pdf_generating.php">TUTAJ</a></p>');
            }

            ?>
            </table>
            <br><br>
            <h3>Twoje zdjęcia:</h3>

            <?php
            //sprawdzamy czy w bazie danych są zdjęcia, które mają pole login o loginie zalogowanego użytkownika
            $query_for_checking_if_user_has_photos = "select * from images where user = '$login';";
            $result_for_checking_if_user_has_photos = mysqli_query($conn, $query_for_checking_if_user_has_photos);

            if (mysqli_num_rows($result_for_checking_if_user_has_photos) == 0) {
                echo ('<p class = "error">Nie masz żadnych zdjęć</p>');
            } else {
                echo ("
                <table>
                <tr>
                    <th>Zdjęcie</th>
                    <th>Data</th>
                    <th>Usuń</th>
                </tr>
            ");
            }

            while ($row_for_checking_if_user_has_photos = mysqli_fetch_assoc($result_for_checking_if_user_has_photos)) {
                echo "<tr>";
                echo "<td><img src='" . $row_for_checking_if_user_has_photos['image_url'] . "' alt='zdjecie' style='max-width: 200px; max-height: 200px;'></td>";
                echo "<td>" . $row_for_checking_if_user_has_photos['date'] . "</td>";
                echo "<td><form action='panel.php' class='delete_th' method='POST'S><input type='hidden'  name='id_image' value='" . $row_for_checking_if_user_has_photos['id'] . "'><input type='submit' name='submit_delete_image' value='Usuń'></form></td>";
                echo "</tr>";
            }

            if (isset($_POST['submit_delete_image'])) {

                $id_image = $_POST['id_image'];
                $query_for_deleting_image = "delete from images where id = $id_image;";
                $result_for_deleting_image = mysqli_query($conn, $query_for_deleting_image);
                header("Refresh:0");
            }

            echo ('</table>');
            ?>



            <br><br>
            <h3>Twoje informacje:</h3>
            <?php
            echo ("<p>Twój login to: " . $_SESSION['login'] . "</p>");
            $query_for_password = "select password, email from users where login = '$login';";
            $result_password = mysqli_query($conn, $query_for_password);
            $row_for_password = mysqli_fetch_assoc($result_password);
            $password = $row_for_password["password"];
            $email = $row_for_password["email"];
            echo ("<p>Twój mail to: ");
            echo ("<span>$email</span></p>");
            echo ("<p>Twoje hasło to: ");
            echo ("<span class='password'>$password</span></p>");
            ?>
            <br><br><br>
            <b>Zmień login:</b><br>
            <form action="panel.php" method="POST" id="form">
                <label for="new_login">Nowy login:</label><br>
                <input type="text" name="new_login" id="new_login"><br>
                <input type="submit" value="Zmień" name="submit_change_login">

                <?php
                if (isset($_POST['submit_change_login'])) {
                    $new_login = $_POST['new_login'];
                    $legal = 0;
                    if (empty($new_login) == true) {
                        echo ("<p class='error'>Pole nie może być puste</p>");
                        $legal++;
                    } else {
                        //sprawdzanie w bazie czy mamy ten sam login
                        $conn = mysqli_connect("localhost", "root", "", "obozy");
                        $query = "select `login` from `users` where `login` = '$new_login'";
                        $exec = mysqli_query($conn, $query);
                        $result = mysqli_fetch_array($exec);

                        if ($result != null) {
                            echo ("<p class='error'>Podany login już istnieje</p>");
                            $legal++;
                        }
                    }
                    //wysyłanie do bazy, jeśli nie ma legalów
                    if ($legal == 0) {
                        $insert_query = "Update users set login = '$new_login' where login = '$login';";
                        mysqli_query($conn, $insert_query);
                        echo ("<p class='success'>Zmieniono login, aby zobaczyć zmiany wyloguj się i zaloguj ponownie</p><br><a href='logowanie.php'>Wyloguj</a>");
                        mysqli_close($conn);
                    }
                }
                ?>
            </form>
            <br><br><br>
            <b>Zmień email:</b><br>
            <form action="panel.php" id="form" method="POST">
                <label for="new_email">Nowy email:</label><br>
                <input type="email" name="new_email" id="new_email"><br>
                <input type="submit" value="Zmień" name="submit_change_email">
                <?php

                if (isset($_POST['submit_change_email'])) {
                    $legal = 0;
                    $new_email = $_POST['new_email'];

                    if (empty($_POST['new_email']) == true) {
                        echo ("<p class='error'>Pole nie może być puste</p>");
                        $legal++;
                    } elseif (preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $new_email)) {
                    } else {
                        echo "<p class='error'>Adres email jest niepoprawny.</p>";
                        $legal++;
                    }

                    if ($legal == 0) {
                        $insert_query = "Update users set email = '$new_email' where login = '$login';";
                        mysqli_query($conn, $insert_query);
                        echo ("<p class='success'>Zmieniono email</p>");
                        mysqli_close($conn);
                    }
                }
                ?>
            </form>
            <br><br><br>

            <br>
            <b>Zmień hasło:</b><br>
            <form action="panel.php" method="POST" id="form">
                <label for="new_password">Nowe hasło:</label><br>
                <input type="text" name="new_pass" id="new_pass"><br>
                <input type="submit" value="Zmień" name="submit_change">
                <?php
                if (isset($_POST['submit_change'])) {
                    $new_password = $_POST['new_pass'];
                    $legal = 0;
                    //sprawdzamy czy pola sa uzupełnione
                    if (empty($password) == true) {
                        echo ("<p class='error'>Hasło nie może być puste</p>");
                        $legal++;
                    }
                    if ($password == $new_password) {
                        echo ("<p class='error'>Nowe hasło nie może być takie samo jak stare</p>");
                        $legal++;
                    }
                    //pregmatch
                    //sprawdzanie poprawności hasła
                    if (!preg_match('/.{8,9999}/', $new_password)) {
                        echo "<p class='error'>Haslo jest za krótkie (minimum 8 znaków)</p>";
                        $legal++;
                    } elseif (!preg_match('/[a-z_]/', $new_password)) {
                        echo "<p class='error'>Haslo musi zawierać małe litery</p>";
                        $legal++;
                    } elseif (!preg_match('/[A-Z_]/', $new_password)) {
                        echo "<p class='error'>Haslo musi zawierać wielkie litery</p>";
                        $legal++;
                    } elseif (!preg_match('/[0-9]/', $new_password)) {
                        echo "<p class='error'>Haslo musi zawierać cyfrę</p>";
                        $legal++;
                    } elseif (!preg_match('/[\W]/', $new_password)) {
                        echo "<p class='error'>Haslo musi zawierać znaki specjalne</p>";
                        $legal++;
                    }
                    if ($legal == 0) {
                        $query_for_change = "update users set password = '$new_password' where login = '$login';";
                        $result_change = mysqli_query($conn, $query_for_change);
                        echo ("<p class='success'>Hasło zostało zmienione</p>");
                        header("Refresh:3");
                    }
                }
                ?>
            </form>
    </section>
    <?php //wyświetlanie lub nie panelu admina
    if (isset($_SESSION['login']) && $_SESSION['login'] == 'admin') {
        echo ('<section class="inviting_text"><h2>Panel Administratora:</h2>');
    } else {
        echo ("<div hidden>");
    }
    //PANEL ADMINA TUTAJ
    ?>
    <table>
        <h3>Tabela Users:</h3>
        <tr>
            <th>id</th>
            <th>login</th>
            <th>password</th>
            <th>email</th>
            <th>usuń</th>
        </tr>
        <?php
        $query_display_users = "SELECT * from users;";
        $result_display_users = mysqli_query($conn, $query_display_users);
        while ($row_display_users = mysqli_fetch_array($result_display_users)) {
            echo "<tr>";
            echo "<td>" . $row_display_users['id'] . "</td>";
            echo "<td>" . $row_display_users['login'] . "</td>";
            echo "<td>" . $row_display_users['password'] . "</td>";
            echo "<td>" . $row_display_users['email'] . "</td>";
            $admin_id_user = $row_display_users['id'];
            echo "<td><form action='panel.php' class='delete_th' method='POST'><input type='hidden' name='admin_id_user' value='$admin_id_user'><input type='submit' name='admin_submit_delete_user' value='Usuń'></form></td>";
            echo "</tr>";
        }

        if (isset($_POST['admin_submit_delete_user'])) {
            $admin_id_user = $_POST['admin_id_user'];

            if ($admin_id_user == 1) {
                echo ("<p class ='error'>Nie możesz usunąć swojego konta</p>");
            } else {
                $query_for_deleting_user = "delete from users where id = $admin_id_user;";
                $result_for_deleting_user = mysqli_query($conn, $query_for_deleting_user);
            }
        }

        ?>
    </table>
    <br><br><br>
    <table>
        <h3>Tabela Zamówienia:</h3>
        <tr>
            <th>Id zamówienia</th>
            <th>Id usera</th>
            <th>Id oferty</th>
            <th>Imię Dziecka</th>
            <th>Nazwisko Dziecka</th>
            <th>Wiek Dziecka</th>
            <th>Miasto dziecka</th>
            <th>Imię Rodzica</th>
            <th>Nazwisko Rodzica</th>
            <th>Telefon</th>
            <th>Ilość Uczestników</th>
            <th>Klucz kodu kreskowego</th>
            <th>Usuń</th>
        </tr>
        <?php
        $query_for_orders = "SELECT * from zamowienia";
        $result_for_orders = mysqli_query($conn, $query_for_orders);
        while ($row_for_orders = mysqli_fetch_array($result_for_orders)) {
            echo "<tr>";
            echo "<td>" . $row_for_orders['id_zamowienia'] . "</td>";
            echo "<td>" . $row_for_orders['id_usera'] . "</td>";
            echo "<td>" . $row_for_orders['id_oferty'] . "</td>";
            echo "<td>" . $row_for_orders['imie_d'] . "</td>";
            echo "<td>" . $row_for_orders['nazwisko_d'] . "</td>";
            echo "<td>" . $row_for_orders['selected_age'] . "</td>";
            echo "<td>" . $row_for_orders['city'] . "</td>";
            echo "<td>" . $row_for_orders['imie_r'] . "</td>";
            echo "<td>" . $row_for_orders['nazwisko_r'] . "</td>";
            echo "<td>" . $row_for_orders['tel'] . "</td>";
            echo "<td>" . $row_for_orders['liczba_max'] . "</td>";
            echo "<td>" . $row_for_orders['barcode'] . "</td>";
            $admin_id_order = $row_for_orders['id_zamowienia'];
            echo "<td><form action='panel.php' class='delete_th' method='POST'><input type='hidden' name='admin_id_order' value='$admin_id_order'><input type='submit' name='admin_submit_delete_order' value='Usuń'></form></td>";
            echo "</tr>";
        }

        if (isset($_POST['admin_submit_delete_order'])) {
            $admin_id_order = $_POST['admin_id_order'];
            $admin_query_for_deleting_order = "delete from zamowienia where id_zamowienia = $admin_id_order;";
            $admin_result_for_deleting_order = mysqli_query($conn, $admin_query_for_deleting_order);
            header("Refresh:0");
        }


        ?>
    </table>
    <br><br><br>
    <table>
        <h3>Tabela Images:</h3>
        <tr>
            <th>Id</th>
            <th>Obraz</th>
            <th>Login</th>
            <th>Data</th>
            <th>Usuń</th>
        </tr>
        <?php
        $query_for_images = "SELECT * from images";
        $result_for_images = mysqli_query($conn, $query_for_images);
        while ($row_for_images = mysqli_fetch_array($result_for_images)) {

            echo "<tr>";
            echo "<td>" . $row_for_images['id'] . "</td>";
            echo "<td><img src='" . $row_for_images['image_url'] . "' alt='zdjecie' style='max-width: 100px; max-height: 100px;'></td>";
            echo "<td>" . $row_for_images['user'] . "</td>";
            echo "<td>" . $row_for_images['date'] . "</td>";
            $admin_id_image = $row_for_images['id'];
            echo "<td><form action='panel.php' class='delete_th' method='POST'><input type='hidden' name='admin_id_image' value='$admin_id_image'><input type='submit' name='admin_submit_delete_image' value='Usuń'></form></td>";
            echo "</tr>";
        }

        if (isset($_POST['admin_submit_delete_image'])) {
            $admin_id_image = $_POST['admin_id_image'];
            $admin_query_for_deleting_image = "delete from images where id = $admin_id_image;";
            $admin_result_for_deleting_image = mysqli_query($conn, $admin_query_for_deleting_image);
            header("Refresh:0");
        }
        ?>
    </table>
    <br><br><br>
    <table>
        <h3>Tabela Oferty:</h3>
        <tr>
            <th>ID oferty:</th>
            <th>Miejscowość:</th>
            <th>Opis:</th>
            <th>Zarezerwowanych miejsc:</th>
            <th>Maksymalna il. miejsc:</th>
            <th>Ilość dni:</th>
            <th>Cena:</th>
            <th>Usuń</th>
        </tr>
        <?php
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
            $admin_id_oferty = $row['id'];
            echo "<td><form action='panel.php' class='delete_th' method='POST'><input type='hidden' name='admin_id_oferty' value='$admin_id_oferty'><input type='submit' name='admin_submit_delete_oferty' value='Usuń'></form></td>";
            echo "</tr>";
        }

        if (isset($_POST['admin_submit_delete_oferty'])) {
            $admin_id_oferty = $_POST['admin_id_oferty'];
            $admin_query_for_deleting_oferty = "delete from oferta where id = $admin_id_oferty;";
            $admin_result_for_deleting_oferty = mysqli_query($conn, $admin_query_for_deleting_oferty);
            header("Refresh:0");
        }

        ?>
    </table>
    <br><br><br>

    <h3>Dodaj ofertę</h3>
    <table>
        <tr>
            <th>Miejscowość:</th>
            <th>Opis:</th>
            <th>Maksymalna il. miejsc:</th>
            <th>Ilość dni:</th>
            <th>Cena:</th>
            <th>Dodaj:</th>
        </tr>
        <tr>
            <form action="panel.php" method="POST">
                <td><input type="text" name="miejscowość"></td>
                <td><textarea type="text" name="opis_oferty" rows="4" cols="70"></textarea></td>
                <td><input type="number" name="max_miejsc"></td>
                <td><input type="number" name="il_dni"></td>
                <td><input type="number" name="cena"></td>
                <td><input type="submit" name="admin_submit_add_oferty" value="Dodaj ofertę"></td>
            </form>
        </tr>
        <?php
        if (isset($_POST['admin_submit_add_oferty'])) {
            if (
                empty($_POST['miejscowość']) == true ||
                empty($_POST['opis_oferty']) == true ||
                empty($_POST['max_miejsc']) == true  ||
                empty($_POST['il_dni']) == true  ||
                empty($_POST['cena']) == true
            ) {
                echo "<p class='error'>Wszystkie pola muszą być uzupełnione i większe od zera!</p>";
            } else {
                $miejscowość = $_POST['miejscowość'];
                $opis_oferty = $_POST['opis_oferty'];
                $max_miejsc = $_POST['max_miejsc'];
                $il_dni = $_POST['il_dni'];
                $cena = $_POST['cena'];
                $admin_query_for_adding_oferty = "insert into oferta (miejscowosc, opis, miejsca_max, il_dni, cena) values ('$miejscowość', '$opis_oferty', '$max_miejsc', '$il_dni', '$cena');";
                $admin_result_for_adding_oferty = mysqli_query($conn, $admin_query_for_adding_oferty);
                header("Refresh:0");
            }
        }
        ?>

    </table>



    <br><br><br>
    <h3>Twoje zapytanie SQL:</h3>
    <form action="panel.php" method="POST" class="delete_th">
        <textarea id="zapytanie" name="zapytanie" rows="4" cols="100"></textarea><br>
        <input type="submit" name="submit_sql" value=" Wyślij SQL">
        <?php
        if (isset($_POST['submit_sql']) && empty($_POST['zapytanie']) == false) {
            $sql = $_POST['zapytanie'];
            $query_sql = "$sql";
            $result_sql = mysqli_query($conn, $query_sql);
            header("Refresh:0");
        }

        ?>
    </form>
    </div>
    </main>
    </section>
    <footer>
        <span id="signature">Stronę opracował: Jan Rampalski 2d</span>
    </footer>
</body>

</html>