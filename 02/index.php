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
/**
 * @param $arithmetic
 * @param array ...$digits_arr
 */
function arr_to_arithmetic_extend($arithmetic, ...$digits_arr)
{
    arr_to_arithmetic($digits_arr, $arithmetic);
}

/**
 * Test of arr_to_arithmetic_extend function
 */
arr_to_arithmetic_extend('+', 1, 2, 3);
echo '<br>';
arr_to_arithmetic_extend('+', 1, 2, '%%%%');

echo '<br><br>';

// #4
/**
 * @param $first_digit
 * @param $second_digit
 */
function multi_table($first_digit, $second_digit)
{
    if (is_int($first_digit) && is_int($second_digit)) {
        for ($x=1; $x<=$first_digit; $x++) {
            for ($y=1; $y<=$second_digit; $y++) {
                $result = $x * $y;
                echo "$result ";
            }
            echo '<br>';
        }
    } else {
        echo "Одно из заданных значений не целое число";
    }
}

/**
 * Test of multi_table function
 */
multi_table(3, 4); // correct
echo '<br>';
multi_table(3, 4.5); // not correct
echo '<br>';

echo '<br><br>';

// #5
/**
 * @param $str
 * @return bool
 */
function palindrom($str)
{
    $str_rev = "";
    for ($i = mb_strlen($str, "UTF-8"); $i >= 0; $i--) {
        $str_rev = $str_rev . mb_substr($str, $i, 1, "UTF-8");
    }
    return ($str === $str_rev);
}

/**
 * @param $str
 */
function palindrom_echo($str)
{
    if (palindrom($str)) {
        echo "Строка является палиндромом";
    } else {
        echo "Строка не является палиндромом";
    }
}

/**
 * Test
 */
palindrom_echo('шабаш'); // true
echo '<br>';
palindrom_echo('шабашка'); // false
echo '<br>';

echo '<br><br>';

// #6
echo date("d.m.Y H:i");
echo '<br>';
echo strtotime("24.02.2016 00:00:00");
echo '<br>';

echo '<br><br>';
