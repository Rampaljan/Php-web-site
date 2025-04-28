<?php

// Tworzenie nowego obrazu o wymiarach 
$image = imagecreatetruecolor(500, 100);

$bg = imagecolorallocatealpha($image, 10, 10, 10, 0);
imagefill($image, 0, 0, $bg);

////////////////////////////

//tworzenie losowego napisu
$length = 6;
$captchastring = bin2hex(random_bytes($length / 2));

//wyswietlanie go testowo
// echo($captchastring);
// echo("<br>");

//dzielenie tego napisu na tablice
$captchaarray = preg_split('//', $captchastring, -1, PREG_SPLIT_NO_EMPTY);

// //testowe wysietlaanie tablicy
// echo "The array of elements is: ";
// print_r($captchaarray);

//ustawianie koloru tekstu
$text_color = imagecolorallocate($image, 255, 255, 255);

//początkowe wymiaary litery
$h = 20;
$w = 80;

//for wyswietlajacy literki

for ($i = 0; $i < $length; $i++) {

    $angle = rand(-20, 20);

    imagettftext($image, 60, $angle, $h, $w, $text_color, 'arial.ttf', $captchaarray[$i]);

    $h += 80;
}

///////////////////////////

//wysyłanie tablicy do sesji

session_start();

$_SESSION["newsession"] = $captchastring;


/*session was getting*/



// Ustawienie nagłówka dla obrazu PNG
header("Content-type: image/png");
// Wyświetlanie obrazu
imagepng($image);
// Niszczenie obrazu, aby zwolnić pamięć
imagedestroy($image);
imagedestroy($smaller_image);
