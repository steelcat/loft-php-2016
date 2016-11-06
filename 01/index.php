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
echo (defined('CONSTANT') ? 'Константа определена и равна: ' . CONSTANT : 'Константа не определена.') . '<br>';
define('CONSTANT', 'new constant');
echo ((CONSTANT == 'new constant') ? 'Константа переопределена и равна: '
        . CONSTANT : 'Константа не переопределена.') . '<br>';

echo '<br>';

// #4
$age = 25;
if ($age >= 18 && $age <= 65) {
    echo 'Вам еще работать и работать';// Двойные кавычки избыточны - ПОФИКСИЛ
} elseif ($age > 65) { // так не читабельно надо разделять пробелами - ПОФИКСИЛ
    echo 'Вам пора на пенсию';
} elseif ($age >= 1 && $age<=17) {
    echo 'Вам ещё рано работать';
} else {
    echo 'Неизвестный возраст';
}
echo '<br>';

echo '<br>';

// #5
$day = true;
// если будет  true отработает - ПОФИКСИЛ
if (is_int($day)) {
    switch ($day) {
        case 1:
        case 2:
        case 3:
        case 4:
        case 5:
            $result = 'Это рабочий день';
            break;
        case 6:
        case 7:
            $result = 'Это выходной день';
            break;
        default:
            $result = "Неизвестный день";
    }
} else {
    $result = "Неизвестный день";
}
echo $result;
echo '<br>';

echo '<br>';

// #6

/**
 * BMW
 */
$bmw['model'] = 'X5';
$bmw['speed'] = 120;
$bmw['doors'] = 5;
$bmw['year']  = 2015;

/**
 * Toyota
 */
$toyota['model'] = 'RAV 4';
$toyota['speed'] = 130;
$toyota['doors'] = 3;
$toyota['year'] = 2014;

/**
 * Opel
 */
$opel['model'] = 'Astra';
$opel['speed'] = 110;
$opel['doors'] = 4;
$opel['year'] = 2010;

$cars = [
    ['car_name' => 'bmw', 'params'    => $bmw],
    ['car_name' => 'toyota', 'params' => $toyota],
    ['car_name' => 'opel', 'params'   => $opel]
];

foreach ($cars as $car) {
    echo 'CAR ' . $car['car_name'] . '<br>';
    foreach ($car['params'] as $param) {
        echo $param . ' ';
    }
    echo '<br>';
}

echo '<br>';

// #7
for ($x=1; $x<=10; $x++) {
    for ($y=1; $y<=10; $y++) {
        $result = $x * $y;
        if ($x == 1 || $y == 1) {
            $bracket = ['', ''];
        } elseif (($x % 2) == 0 && ($y % 2) == 0) {
            $bracket = ['(', ')'];
        } elseif (($x % 2) != 0 && ($y % 2) != 0) {
            $bracket = ['[', ']'];
        } else {
            $bracket = ['', ''];
        }
        echo ' ' . $bracket[0] . $result . $bracket[1] . ' ';
    }
    echo '<br>';
}
//в скобки надо заключить только результат,у тебя числа которые переумножаются тоже в скобках - ПОФИКСИЛ
echo '<br>';

// #8
$str = 'На улице хорошая погода';
echo $str;
echo '<br>';
$str_array = explode(' ', $str);
print_r($str_array);
echo '<br>';
$elements = count($str_array);
$index    = 0;
$reverse_array = [];

while ($index < $elements) :
    $reverse_array[] = $str_array[$elements - $index - 1];
    $index++;
endwhile;

$result = implode('_', $reverse_array);
echo $result;

echo "<br><img src='http://spiderdiaries.richmond.edu/_common_KP3/images/spiderdiaries/"
    . "blogs/danny17/Sophomroe%20Year%20Assets/Pig%20Roast/thats-all-folks-porky-pig.jpg'>";
