<?php
// #1
$xml_data = simplexml_load_file('data.xml');

echo '<h1>Заказ номер : ' . $xml_data["PurchaseOrderNumber"] . '</h1>';
echo 'Дата покупки : ' . $xml_data["OrderDate"];
echo '<h2>Адреса</h2>';
$addresses = $xml_data->Address;
foreach ($addresses as $address) {
    echo 'Тип адреса : ' . $address['Type'] . '<br>';
    echo '-----<br>';
    echo 'Имя : ' . (string) $address->Name . '<br>';
    echo 'Улица : ' . (string) $address->Street . '<br>';
    echo 'Город : ' . (string) $address->City . '<br>';
    echo 'Штат : ' . (string) $address->State . '<br>';
    echo 'Индекс : ' . (string) $address->Zip . '<br>';
    echo 'Страна : ' . (string) $address->Country . '<br>';
    echo '<br>';
}

echo 'Примечания к заказу : ' . (string) $xml_data->DeliveryNotes . '<br>';

echo '<h2>Товары</h2>';

$items = $xml_data->Items->Item;
foreach ($items as $item) {
    echo 'Артикул : ' . $item['PartNumber'] . '<br>';
    echo '-----<br>';
    echo 'Название : ' . (string) $item->ProductName . '<br>';
    echo 'Количество : ' . (string) $item->Quantity . '<br>';
    echo 'Цена : $' . (string) $item->USPrice . '<br>';
    echo 'Дата доставки : ' . (string) $item->ShipDate . '<br>';
    echo 'Комментарий : ' . (string) $item->Comment . '<br>';
    echo '<br>';
}

echo '<br><br>';

// #2
$first_array = [
    'Петя' => [
        'Пол' => 1,
        'Возраст' => 18,
        'Интересы' => [
            'Преферанс', 'PHP'
        ]
    ],
    'Вася' => [
        'Пол' => 1,
        'Возраст' => 22
    ],
    'Маша' => [
        'Пол' => 0,
        'Возраст' => 17,
        'Интересы' => [
            'Вязание', 'Взлом банкоматов'
        ]
    ]
];

$first_array_json = json_encode($first_array, JSON_UNESCAPED_UNICODE);
file_put_contents('output.json', $first_array_json);

$changed_array_json = file_get_contents('output.json');
$changed_array = json_decode($changed_array_json, true);
if (1) {
    $changed_array['Петя'] = [
        'Пол' => 0,
        'Возраст' => 33,
        'Интересы' => [
            'Дурак', 'JS'
        ]
    ];
}
$changed_array_json = json_encode($changed_array, JSON_UNESCAPED_UNICODE);
file_put_contents('output2.json', $changed_array_json);

$first_array_json = file_get_contents('output.json');
$first_array = json_decode($first_array_json, true);

$second_array_json = file_get_contents('output2.json');
$second_array = json_decode($changed_array_json, true);

foreach ($first_array as $key => $item) {
    echo 'У человека по имени ' . $key;
    if ($first_array[$key] && $second_array[$key]) {
        $diff = $first_array[$key] != $second_array[$key];
        if ($diff) {
            echo ' изменилось: ';
            print_r($second_array[$key]);
        } else {
            echo ' ничего не изменилось.';
        }
    } else {
        echo "элемент отсутствует.";
    }
    echo '<br>';
}

echo '<br><br>';

// #3
$array = [];
for ($i = 0; $i <= 50; $i++) {
    $array[$i] = rand(1, 100);
}
$fp = fopen('file.csv', 'w');
fputcsv($fp, $array, ',', '"');
fclose($fp);
$file_content = file_get_contents('file.csv');
$next_array = explode(',', $file_content);
$summa = 0;
foreach ($next_array as $num) {
    $num = (int) $num;
    if (!($num % 2)) {
        $summa += $num;
    }
}
echo "Сумма четных чисел: {$summa}<br>";

echo '<br><br>';

// #4
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json");
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$result = json_decode(curl_exec($curl), true);
$pages = array_values($result['query']['pages']);
foreach ($pages as $page) {
    $pagetitle = $page['title'];
    $pageid = $page['pageid'];
    echo "Title: $pagetitle <br>ID: $pageid <br>";
}
curl_close($curl);
