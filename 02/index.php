<?php

$arr = ['Хорошая', 'погода', 'сегодня'];

// #1
/**
 * @param array $arr
 * @param bool $cond
 * @return string
 */
function string_to_paragraph(array $arr, $cond = false)
{
    if ($cond) {
        $result = implode('', $arr);
        return $result;
    } else {
        $result = '';
        foreach ($arr as $arr_item) {
            $result = $result . "<p> $arr_item </p>";
        }
        echo $result;
        return $result;
    }
}

/**
 * Test of string_to_paragraph function
 */
string_to_paragraph($arr, false);
echo '<br>';
echo string_to_paragraph($arr, false);
echo '<br>';
var_dump(string_to_paragraph($arr, true));
echo '<br>';
echo string_to_paragraph($arr, true);

echo '<br><br>';

// #2
/**
 * @param $digits_arr
 * @param $arithmetic
 */
function arr_to_arithmetic($digits_arr, $arithmetic)
{
    $result = 0;
    try {
        foreach ($digits_arr as $digit) {
            if (is_numeric($digit) && !is_string($digit)) {
                switch ($arithmetic) {
                    case '+':
                        $result = $result + $digit;
                        break;
                    case '-':
                        $result = $result - $digit;
                        break;
                    case '*':
                        $result = $result * $digit;
                        break;
                    case '/':
                        $result = $result / $digit;
                        break;
                    default:
                        $result = "Задана некорректная арифметическая операция";
                }
            } else {
                $result = "Задано не числовое значение";
                break;
            }
        }
    } catch (Exception $e) {
        $result = "Произошла неизвестная ошибка";
    }
    echo $result;
}

/**
 * Test of arr_to_arithmetic function
 */
arr_to_arithmetic([1, 2, 3, 4.5, 5], '+'); // correct
echo '<br>';
arr_to_arithmetic([1, 2, '3', 4, 5], '+'); // not correct, not correct digit
echo '<br>';
arr_to_arithmetic([1, 2, false, 4, 5], '+'); // not correct, not correct digit
echo '<br>';
arr_to_arithmetic([1, 2, 3, 4, 5], '='); // not correct, not correct operator

echo '<br><br>';

// #3
