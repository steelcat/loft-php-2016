<?php

// Задание 1

// #1
$name = 'Виталий';
$age = 43;
$age_second_digit = $age % 10;
switch ($age_second_digit) {
    case 1:
        $age_title = 'год';
        break;
    case 2:
    case 3:
    case 4:
        $age_title = 'года';
        break;
    default:
        $age_title = 'лет';
}
echo "Меня зовут: $name <br>";
echo "Мне " . $age . " $age_title <br>";
echo '“!|\\/’”\\<br>';

echo '<br>';

// #2
$pictures = 80;
$pictures_flomaster = 23;
$pictures_pencil = 40;

$pictures_painting = $pictures - ($pictures_flomaster + $pictures_pencil);
echo "Красками написано: $pictures_painting картин<br>";

echo '<br>';
