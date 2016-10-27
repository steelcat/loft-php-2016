<?php

// #1
$name = 'Виталий';
$age = 41;
$age_second_digit = $age % 10;
switch ($age_second_digit) {
    case 1: {
        $age_title = 'год';
        break;
    }
    case 2: case 3: case 4: {
        $age_title = 'года';
        break;
    }
    default: {
        $age_title = 'лет';
    }
}
echo "Меня зовут: $name <br>";
echo "Мне " . $age . " $age_title <br>";
echo '“!|\\/’”\\<br>';
