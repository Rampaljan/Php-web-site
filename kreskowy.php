<?php
// Tworzenie nowego obrazu o wymiarach 
$image = imagecreatetruecolor(750, 100);
$black = imagecolorallocatealpha($image, 0, 0, 0, 0);
$white = imagecolorallocatealpha($image, 255, 255, 255, 0);
$xpocz = 10;
$bg = imagecolorallocatealpha($image, 255, 255, 255, 0);
imagefill($image, 0, 0, $bg);
session_start();
$userfill = $_SESSION["barcode"];
$userfill = str_split($userfill);
for ($i = 0; $i < count($userfill); $i++) {
    switch ($userfill[$i]) {

        case "*":
            $sign = "bWbwBwBwb";
            break;

        case "0":
            $sign = "bwbWBwBwb";
            break;

        case "1":
            $sign = "BwbWbwbwB";
            break;

        case "2":
            $sign = "bwBWbwbwB";
            break;

        case "3":
            $sign = "BwBWbwbwb";
            break;

        case "4":
            $sign = "bwbWBwbwB";
            break;

        case "5":
            $sign = "BwbWBwbwb";
            break;

        case "6":
            $sign = "bwBWBwbwb";
            break;

        case "7":
            $sign = "bwbWbwBwB";
            break;

        case "8":
            $sign = "BwbWbwBwb";
            break;

        case "9":
            $sign = "bwBWbwBwb";
            break;
    }
    // echo("<br>");
    // echo("<br>");
    // echo($sign);
    // echo("<br>");
    $sign = str_split($sign);
    for ($j = 0; $j < count($sign); $j++) {
        switch ($sign[$j]) {

            case "w":
                // echo("<br>");
                // echo($sign[$j]);
                imagefilledrectangle($image, $xpocz, 0, $xpocz + 1, 100, $white);
                $xpocz += 1;
                break;

            case "W":
                // echo("<br>");
                // echo($sign[$j]);
                imagefilledrectangle($image, $xpocz, 0, $xpocz + 3, 100, $white);
                $xpocz += 3;
                break;

            case "b":
                // echo("<br>");
                // echo($sign[$j]);
                imagefilledrectangle($image, $xpocz, 0, $xpocz + 1, 100, $black);
                $xpocz += 1;
                break;

            case "B":
                // echo("<br>");
                // echo($sign[$j]);
                imagefilledrectangle($image, $xpocz, 0, $xpocz + 3, 100, $black);
                $xpocz += 3;
                break;
        }
    }

    imagefilledrectangle($image, $xpocz, 0, $xpocz + 1, 100, $white);
    $xpocz += 1;
}

imagepng($image, 'barcode.png');
// Ustawienie nagłówka dla obrazu PNG
header("Content-type: image/png");
// Wyświetlanie obrazu
imagepng($image);
// Niszczenie obrazu, aby zwolnić pamięć
imagedestroy($image);
