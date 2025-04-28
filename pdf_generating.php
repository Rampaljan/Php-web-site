<?php

require('fpdf186\fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();

//pobieramy zmienne z sesji
session_start();
$nr_oferty = $_SESSION["nr_oferty"];
$imie_d = $_SESSION["imie_d"];
$nazwisko_d = $_SESSION["nazwisko_d"];
$imie_r = $_SESSION["imie_r"];
$nazwisko_r = $_SESSION["nazwisko_r"];
$tel = $_SESSION["tel"];
$city = $_SESSION["city"];
$selected_age = $_SESSION["selected_age"];
$liczba_max = $_SESSION["liczba_max"];
$cena = $_SESSION["cena"];
$login = $_SESSION['login'];
$barcode = $_SESSION['barcode'];

//tytuł
$pdf->SetFont('Arial', 'B', 30);
$pdf->Cell(200, 10, 'Potwierdzenie Rezerwacji', 0, 1, 'C');

$pdf->SetFont('Arial', '', 16);

$pdf->Cell(100, 10, '', 0, 0);
$pdf->Cell(100, 10, '', 0, 1);

$pdf->Cell(100, 10, 'Nr Oferty:', 0, 0);
$pdf->Cell(100, 10, $nr_oferty, 0, 1);

$pdf->Cell(100, 10, 'Imie i Nazwisko Dziecka:', 0, 0);
$pdf->Cell(100, 10, $imie_d . ' ' . $nazwisko_d, 0, 1);

$pdf->Cell(100, 10, 'Imie i Nazwisko Rodzica:', 0, 0);
$pdf->Cell(100, 10, $imie_r . ' ' . $nazwisko_r, 0, 1);

$pdf->Cell(100, 10, 'Telefon:', 0, 0);
$pdf->Cell(100, 10, $tel, 0, 1);

$pdf->Cell(100, 10, 'Miasto:', 0, 0);
$pdf->Cell(100, 10, $city, 0, 1);

$pdf->Cell(100, 10, 'Wiek Dziecka:', 0, 0);
$pdf->Cell(100, 10, $selected_age, 0, 1);

$pdf->Cell(100, 10, 'Liczba Miejsc:', 0, 0);
$pdf->Cell(100, 10, $liczba_max, 0, 1);

$pdf->Cell(100, 10, 'Cena:', 0, 0);
$pdf->Cell(100, 10, $cena . ' PLN', 0, 1);

$pdf->Cell(100, 10, 'Zarezerwowano przez:', 0, 0);
$pdf->Cell(100, 10, $login, 0, 1);

$pdf->Cell(100, 10, 'Klucz Kodu kreskowego', 0, 0);
$pdf->Cell(100, 10, $barcode, 0, 1);

$pdf->Cell(100, 10, '', 0, 0);
$pdf->Cell(100, 10, '', 0, 1);

$pdf->Cell(100, 10, '', 0, 0);
$pdf->Cell(100, 10, '', 0, 1);

$pdf->Image('logo.png', 10, 5, -800);
$pdf->Image('barcode.png', 10, 150, -25);


$pdf->Output();
