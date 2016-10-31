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

// #3
define('CONSTANT', 'constant');
echo (defined('CONSTANT') ? "Константа определена и равна: " . CONSTANT : "Константа не определена.") . "<br>";
define('CONSTANT', 'new constant');
echo ((CONSTANT == 'new constant') ? "Константа переопределена и равна: "
        . CONSTANT : "Константа не переопределена.") . "<br>";

echo '<br>';

// #4
$age = 25;
if (($age>=18)&($age<=65)) {
    echo "Вам еще работать и работать";
} elseif ($age>65) {
    echo "Вам пора на пенсию";
} elseif (($age>=1)&($age<=17)) {
    echo "Вам ещё рано работать";
} else {
    echo "Неизвестный возраст";
}
echo "<br>";

echo "<br>";

// #5
$day = 6;
switch ($day) {
    case 1:
    case 2:
    case 3:
    case 4:
    case 5:
        echo "Это рабочий день";
        break;
    case 6:
    case 7:
        echo "Это выходной день";
        break;
    default:
        echo "Неизвестный день";
}
echo "<br>";

echo "<br>";

// #6

/**
 * BMW
 */
$bmw['model'] = "X5";
$bmw['speed'] = 120;
$bmw['doors'] = 5;
$bmw['year'] = 2015;

/**
 * Toyota
 */
$toyota['model'] = "RAV 4";
$toyota['speed'] = 130;
$toyota['doors'] = 3;
$toyota['year'] = 2014;

/**
 * Opel
 */
$opel['model'] = "Astra";
$opel['speed'] = 110;
$opel['doors'] = 4;
$opel['year'] = 2010;

$cars = [
    ['car_name' => 'bmw', 'params' => $bmw],
    ['car_name' => 'toyota', 'params' => $toyota],
    ['car_name' => 'opel', 'params' => $opel]
];

foreach ($cars as $car) {
    echo "CAR " . $car['car_name'] . "<br>";
    foreach ($car['params'] as $param) {
        echo $param . ' ';
    }
    echo "<br>";
}

echo "<br>";

// #7
for ($x=1; $x<=10; $x++) {
    for ($y=1; $y<=10; $y++) {
        $result = $x * $y;
        if ((($x % 2) == 0) & ((($y % 2) == 0))) {
            $bracket = ['(', ')'];
        } elseif ((($x % 2) != 0) & ((($y % 2) != 0))) {
            $bracket = ['[', ']'];
        } else {
            $bracket = ['', ''];
        }
        echo " " . $bracket[0] . $result . $bracket[1] . " ";
    }
    echo "<br>";
}

echo "<br>";
