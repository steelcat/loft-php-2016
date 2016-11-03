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

echo '<br>';
